/**
 * IGP Form — Shared JavaScript
 * ============================
 * Handles:
 *  - sessionStorage management (save / get / list all igp_ keys)
 *  - Debug panel (live key-value display)
 *  - Google Analytics helpers (getGACookie, igpSendGA)
 *  - Option-card selection (clickable tile UI)
 *  - Step navigation (URL-param based, history.pushState)
 *  - Room management for multi-split (krok 2)
 *  - FormData builder for final submission
 */

(function (window) {
    'use strict';

    // ─── CONFIG ───────────────────────────────────────────────────────────────
    /** Prefix applied to every sessionStorage key owned by this form. */
    var IGP_PREFIX = 'igp_';

    // ─── SESSION STORAGE ──────────────────────────────────────────────────────

    /**
     * Save a value to sessionStorage under the igp_ namespace.
     * Objects / arrays are automatically JSON-stringified.
     *
     * @param {string} key   — storage key WITHOUT the igp_ prefix
     * @param {*}      value — any serialisable value
     */
    function igpSave(key, value) {
        var storageKey   = IGP_PREFIX + key;
        var storageValue = (typeof value === 'object') ? JSON.stringify(value) : String(value);
        sessionStorage.setItem(storageKey, storageValue);
        console.log('[IGP Storage] Saved:', storageKey, '=', value);
        igpUpdateDebugPanel();
    }

    /**
     * Read a value from sessionStorage.
     * JSON values are automatically parsed back to objects/arrays.
     *
     * @param {string} key — storage key WITHOUT the igp_ prefix
     * @returns {*|null}
     */
    function igpGet(key) {
        var raw = sessionStorage.getItem(IGP_PREFIX + key);
        if (raw === null) return null;
        try   { return JSON.parse(raw); }
        catch (e) { return raw; }
    }

    /**
     * Return ALL igp_-prefixed sessionStorage entries as a plain object
     * (keys without the prefix, values already parsed).
     *
     * @returns {Object}
     */
    function igpGetAll() {
        var result = {};
        for (var i = 0; i < sessionStorage.length; i++) {
            var k = sessionStorage.key(i);
            if (k && k.indexOf(IGP_PREFIX) === 0) {
                var shortKey = k.slice(IGP_PREFIX.length);
                result[shortKey] = igpGet(shortKey);
            }
        }
        return result;
    }

    /**
     * Remove all igp_-prefixed entries from sessionStorage.
     */
    function igpClearAll() {
        var toRemove = [];
        for (var i = 0; i < sessionStorage.length; i++) {
            var k = sessionStorage.key(i);
            if (k && k.indexOf(IGP_PREFIX) === 0) toRemove.push(k);
        }
        toRemove.forEach(function (k) { sessionStorage.removeItem(k); });
        console.log('[IGP Storage] Cleared all IGP entries.');
        igpUpdateDebugPanel();
    }

    // ─── DEBUG PANEL ──────────────────────────────────────────────────────────

    /**
     * Refresh the on-page debug panel (#igp-debug-panel) with the current
     * sessionStorage snapshot. If the element is absent, nothing happens.
     */
    function igpUpdateDebugPanel() {
        var panel = document.getElementById('igp-debug-panel');
        if (!panel) return;

        var data = igpGetAll();
        var keys = Object.keys(data);

        if (keys.length === 0) {
            panel.innerHTML = '<em class="text-muted small">Žiadne uložené hodnoty</em>';
            return;
        }

        var html = '<table class="table table-sm table-bordered mb-0 small">'
                 + '<thead class="table-dark"><tr><th>Kľúč</th><th>Hodnota</th></tr></thead>'
                 + '<tbody>';
        keys.forEach(function (k) {
            var val = (typeof data[k] === 'object')
                ? JSON.stringify(data[k], null, 2)
                : data[k];
            html += '<tr>'
                  + '<td><code class="text-primary">' + igpEscHtml(IGP_PREFIX + k) + '</code></td>'
                  + '<td><pre class="mb-0 small text-muted">' + igpEscHtml(String(val)) + '</pre></td>'
                  + '</tr>';
        });
        html += '</tbody></table>';
        panel.innerHTML = html;
    }

    /** Minimal HTML entity escaping for display in the debug panel. */
    function igpEscHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // ─── GOOGLE ANALYTICS ─────────────────────────────────────────────────────

    /**
     * Extract the GA client ID from the _ga cookie.
     * Cookie format:  GA1.X.<client_id_part1>.<client_id_part2>
     *
     * Usage in fetch / XMLHttpRequest:
     *   formData.append('ga_id', getGACookie());
     *
     * @returns {string|null}
     */
    function getGACookie() {
        var match = document.cookie.match(/_ga=([^;]+)/);
        if (!match) return null;
        var parts = match[1].split('.');
        if (parts.length >= 4) return parts[2] + '.' + parts[3];
        return match[1];
    }

    /**
     * Fire a Google Analytics 4 event via gtag().
     * Falls back to console.log when gtag is not loaded (local dev).
     *
     * @param {string} eventName — GA4 event name
     * @param {Object} params    — additional event parameters
     */
    function igpSendGA(eventName, params) {
        params = Object.assign({ igp_form: true }, params || {});
        if (typeof gtag === 'function') {
            gtag('event', eventName, params);
            console.log('[IGP GA] Event sent:', eventName, params);
        } else {
            console.log('[IGP GA] gtag not available. Would send:', eventName, params);
        }
    }

    // ─── OPTION CARDS ─────────────────────────────────────────────────────────

    /**
     * Initialise clickable option-card tiles inside a container.
     *
     * Each card must have class "igp-option-card" and a data-value attribute.
     * Selecting a card adds the "selected" class, deselects siblings, and
     * saves the value to sessionStorage.
     *
     * @param {string}   containerSelector  — CSS selector of the wrapping element
     * @param {string}   storageKey         — sessionStorage key (WITHOUT igp_ prefix)
     * @param {Object}   [opts]
     * @param {string}   [opts.gaEvent]     — GA4 event name fired on selection
     * @param {Function} [opts.onChange]    — callback(value, cardElement) on selection
     */
    function igpInitOptionCards(containerSelector, storageKey, opts) {
        opts = opts || {};
        var container = document.querySelector(containerSelector);
        if (!container) return;

        var cards = container.querySelectorAll('.igp-option-card');

        // Restore previously saved selection
        var saved = igpGet(storageKey);
        if (saved !== null) {
            cards.forEach(function (card) {
                if (card.dataset.value === String(saved)) {
                    card.classList.add('selected');
                }
            });
        }

        // Attach click handlers
        cards.forEach(function (card) {
            card.addEventListener('click', function () {
                // Deselect all cards in this group
                cards.forEach(function (c) { c.classList.remove('selected'); });
                // Select the clicked card
                card.classList.add('selected');

                var value = card.dataset.value;
                igpSave(storageKey, value);

                if (opts.gaEvent) {
                    igpSendGA(opts.gaEvent, { value: value, key: storageKey });
                }
                if (typeof opts.onChange === 'function') {
                    opts.onChange(value, card);
                }
            });
        });
    }

    // ─── STEP NAVIGATION ──────────────────────────────────────────────────────

    /**
     * Navigate to a numbered form step by updating the ?krok= URL parameter.
     * Uses history.pushState so the URL updates without a full page reload when
     * the form is rendered as a single-page template.
     *
     * @param {number} stepNum — 1-based step number
     */
    function igpGoToStep(stepNum) {
        var url = new URL(window.location.href);
        url.searchParams.set('krok', stepNum);
        history.pushState({ krok: stepNum }, '', url.toString());
        igpShowStep(stepNum);
    }

    /**
     * Read the current step from the ?krok= URL parameter.
     * Returns 1 if the parameter is absent.
     *
     * @returns {number}
     */
    function igpGetCurrentStep() {
        var params = new URLSearchParams(window.location.search);
        return parseInt(params.get('krok') || '1', 10);
    }

    /**
     * Show only the step panel matching stepNum.
     * Panels are identified by data-krok="N" on any element with class
     * "igp-step-panel".
     *
     * @param {number} stepNum
     */
    function igpShowStep(stepNum) {
        var panels = document.querySelectorAll('.igp-step-panel');
        panels.forEach(function (panel) {
            var n = parseInt(panel.dataset.krok, 10);
            if (n === stepNum) {
                panel.classList.remove('igp-hidden');
            } else {
                panel.classList.add('igp-hidden');
            }
        });

        // Update step indicator
        var items = document.querySelectorAll('.igp-step-item');
        items.forEach(function (item) {
            var n = parseInt(item.dataset.step, 10);
            item.classList.remove('active', 'completed');
            if (n < stepNum)  item.classList.add('completed');
            if (n === stepNum) item.classList.add('active');
        });

        // Refresh debug panel whenever step changes
        igpUpdateDebugPanel();

        // Scroll to top of the form
        var formEl = document.getElementById('igp-formular');
        if (formEl) formEl.scrollIntoView({ behavior: 'smooth', block: 'start' });

        console.log('[IGP Step] Showing step', stepNum, '| Session data:', igpGetAll());
    }

    // ─── ROOMS MANAGEMENT (Krok 2 — Multi-split) ─────────────────────────────

    /** Internal counter to give each room row a unique index. */
    var _igpRoomIndex = 0;

    /**
     * Add a blank room row to #igp-rooms-container.
     * Each field change automatically persists rooms to sessionStorage.
     */
    function igpAddRoom() {
        var container = document.getElementById('igp-rooms-container');
        if (!container) return;

        _igpRoomIndex++;
        var idx = _igpRoomIndex;

        var row = document.createElement('div');
        row.className        = 'igp-room-row border rounded p-3 mb-2 bg-white';
        row.dataset.roomIndex = idx;
        row.innerHTML = ''
            + '<div class="row g-2 align-items-end">'
            +   '<div class="col-12 col-md-4">'
            +     '<label class="form-label small fw-semibold mb-1">Názov miestnosti</label>'
            +     '<input type="text" class="form-control igp-input igp-room-name" placeholder="Napr. Obývačka" data-idx="' + idx + '">'
            +   '</div>'
            +   '<div class="col-6 col-md-3">'
            +     '<label class="form-label small fw-semibold mb-1">Plocha (m²)</label>'
            +     '<input type="number" class="form-control igp-input igp-room-area" placeholder="25" min="1" step="1" data-idx="' + idx + '">'
            +   '</div>'
            +   '<div class="col-6 col-md-3">'
            +     '<label class="form-label small fw-semibold mb-1">Výška (m)</label>'
            +     '<input type="number" class="form-control igp-input igp-room-height" placeholder="2.7" step="0.1" min="1" data-idx="' + idx + '">'
            +   '</div>'
            +   '<div class="col-12 col-md-2 text-md-end">'
            +     '<button type="button" class="btn btn-link text-danger p-0 small fw-semibold" onclick="igpRemoveRoom(this)">Odstrániť</button>'
            +   '</div>'
            + '</div>';

        // Persist to sessionStorage on any input change
        row.querySelectorAll('input').forEach(function (input) {
            input.addEventListener('input', igpSaveRooms);
        });

        container.appendChild(row);
        igpSaveRooms();
        console.log('[IGP Rooms] Added room #' + idx);
    }

    /**
     * Remove a room row.
     *
     * @param {HTMLElement} btn — the "Odstrániť" button element
     */
    function igpRemoveRoom(btn) {
        var row = btn.closest('.igp-room-row');
        if (!row) return;
        var idx = row.dataset.roomIndex;
        row.remove();
        igpSaveRooms();
        console.log('[IGP Rooms] Removed room #' + idx);
    }

    /**
     * Serialise all room rows into sessionStorage as a JSON array.
     * Each entry: { name, area, height }
     */
    function igpSaveRooms() {
        var container = document.getElementById('igp-rooms-container');
        if (!container) return;

        var rooms = [];
        container.querySelectorAll('.igp-room-row').forEach(function (row) {
            rooms.push({
                name:   (row.querySelector('.igp-room-name')   || {}).value || '',
                area:   (row.querySelector('.igp-room-area')   || {}).value || '',
                height: (row.querySelector('.igp-room-height') || {}).value || '',
            });
        });

        igpSave('krok2_miestnosti', rooms);
    }

    /**
     * Restore room rows from sessionStorage.
     * If no rooms are saved, adds one blank row to start from.
     */
    function igpRestoreRooms() {
        var saved = igpGet('krok2_miestnosti');

        if (!Array.isArray(saved) || saved.length === 0) {
            igpAddRoom();
            return;
        }

        saved.forEach(function (room) {
            igpAddRoom();
            var container = document.getElementById('igp-rooms-container');
            if (!container) return;
            var lastRow = container.lastElementChild;
            if (!lastRow) return;
            var nameEl   = lastRow.querySelector('.igp-room-name');
            var areaEl   = lastRow.querySelector('.igp-room-area');
            var heightEl = lastRow.querySelector('.igp-room-height');
            if (nameEl)   nameEl.value   = room.name   || '';
            if (areaEl)   areaEl.value   = room.area   || '';
            if (heightEl) heightEl.value = room.height || '';
        });
    }

    // ─── FORM DATA BUILDER ────────────────────────────────────────────────────

    /**
     * Append all igp_ sessionStorage values to a FormData object.
     * Also appends the GA client ID if available.
     *
     * @param {FormData} [formData] — existing FormData; a new one is created if omitted
     * @returns {FormData}
     */
    function igpBuildFormData(formData) {
        formData = formData || new FormData();
        var all = igpGetAll();

        Object.keys(all).forEach(function (key) {
            var val = all[key];
            formData.append('igp_' + key, (typeof val === 'object') ? JSON.stringify(val) : String(val));
        });

        // Attach GA client ID
        var gaId = getGACookie();
        if (gaId) {
            formData.append('ga_id', gaId);
            console.log('[IGP Form] GA ID appended:', gaId);
        }

        return formData;
    }

    // ─── PUBLIC API ───────────────────────────────────────────────────────────
    // Attach everything to window so inline event handlers can call functions.

    window.IGPForm = {
        save:           igpSave,
        get:            igpGet,
        getAll:         igpGetAll,
        clearAll:       igpClearAll,
        updateDebug:    igpUpdateDebugPanel,
        initCards:      igpInitOptionCards,
        goToStep:       igpGoToStep,
        getCurrentStep: igpGetCurrentStep,
        showStep:       igpShowStep,
        addRoom:        igpAddRoom,
        removeRoom:     igpRemoveRoom,
        saveRooms:      igpSaveRooms,
        restoreRooms:   igpRestoreRooms,
        buildFormData:  igpBuildFormData,
        sendGA:         igpSendGA,
        getGACookie:    getGACookie,
    };

    // Also expose individual helpers directly for concise inline calls
    window.igpSave             = igpSave;
    window.igpGet              = igpGet;
    window.igpGetAll           = igpGetAll;
    window.igpAddRoom          = igpAddRoom;
    window.igpRemoveRoom       = igpRemoveRoom;
    window.igpSaveRooms        = igpSaveRooms;
    window.igpUpdateDebugPanel = igpUpdateDebugPanel;
    window.getGACookie         = getGACookie;
    window.igpSendGA           = igpSendGA;

    // ─── AUTO-INIT ────────────────────────────────────────────────────────────

    document.addEventListener('DOMContentLoaded', function () {
        // Refresh debug panel immediately
        igpUpdateDebugPanel();
        console.log('[IGP Form] Initialized. Session data:', igpGetAll());

        // If on the multi-step formular, show the correct step from URL
        var formEl = document.getElementById('igp-formular');
        if (formEl) {
            var step = igpGetCurrentStep();
            igpShowStep(step);
        }

        // Handle browser back/forward within step navigation
        window.addEventListener('popstate', function (e) {
            if (e.state && e.state.krok) {
                igpShowStep(e.state.krok);
            }
        });
    });

}(window));
