document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('igp-form');
  if (!form) return;

  var steps   = Array.from(form.querySelectorAll('.igp-step'));
  var current = 0;
  var PREFIX  = 'igpForm:';

  function showStep(i) {
    steps.forEach(function (step, idx) { step.hidden = idx !== i; });
  }

  function saveField(name, value) {
    sessionStorage.setItem(PREFIX + name, value);
    console.log('[IGP]', name, '=', value);
  }

  function loadState() {
    form.querySelectorAll('.igp-group input[name]').forEach(function (el) {
      var saved = sessionStorage.getItem(PREFIX + el.name);
      if (saved === null) return;
      if (el.type === 'radio')         el.checked = el.value === saved;
      else if (el.type === 'checkbox') el.checked = saved === '1';
      else                             el.value   = saved;
    });
    form.querySelectorAll('.igp-group input').forEach(function (input) {
      var card = input.closest('.igp-card');
      if (card) card.classList.toggle('is-selected', input.checked);
    });
    var savedStep = sessionStorage.getItem(PREFIX + '_step');
    if (savedStep !== null) {
      current = Math.min(parseInt(savedStep, 10) || 0, steps.length - 1);
    }
  }

  function validateStep() {
    var groups = {};
    steps[current].querySelectorAll('.igp-group input[type="radio"]').forEach(function (el) {
      if (!groups[el.name]) groups[el.name] = false;
      if (el.checked)       groups[el.name] = true;
    });
    return Object.keys(groups).filter(function (n) { return !groups[n]; });
  }

  function showErrors(invalid) {
    clearErrors();
    invalid.forEach(function (name) {
      var group = steps[current].querySelector('.igp-group[data-name="' + name + '"]');
      if (!group) return;
      var p = document.createElement('p');
      p.className = 'igp-error';
      p.textContent = 'Prosím, vyberte jednu z možností.';
      group.appendChild(p);
    });
  }

  function clearErrors() {
    form.querySelectorAll('.igp-error').forEach(function (el) { el.remove(); });
  }

  // Card selection via native label → radio/checkbox change
  form.addEventListener('change', function (ev) {
    var input = ev.target;
    if (!input.name || !input.closest('.igp-group')) return;

    if (input.type === 'radio') {
      form.querySelectorAll('input[name="' + input.name + '"]').forEach(function (r) {
        var card = r.closest('.igp-card');
        if (card) card.classList.toggle('is-selected', r.checked);
      });
    } else {
      var card = input.closest('.igp-card');
      if (card) card.classList.toggle('is-selected', input.checked);
    }

    saveField(input.name, input.type === 'checkbox' ? (input.checked ? '1' : '0') : input.value);
  });

  form.addEventListener('click', function (ev) {
    if (ev.target.closest('.igp-next')) {
      var invalid = validateStep();
      if (invalid.length) { showErrors(invalid); return; }
      clearErrors();
      current++;
      sessionStorage.setItem(PREFIX + '_step', String(current));
      showStep(current);
    } else if (ev.target.closest('.igp-prev')) {
      clearErrors();
      if (current > 0) current--;
      sessionStorage.setItem(PREFIX + '_step', String(current));
      showStep(current);
    }
  });

  loadState();
  showStep(current);
});
