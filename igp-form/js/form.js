document.addEventListener('DOMContentLoaded', function(){
  const form = document.querySelector('.igp-form');
  const steps = document.querySelectorAll('.igp-step');
  let current = 0;
  const STORAGE_KEY = 'igpFormState';

  function show(i){
    steps.forEach((s, idx)=> s.style.display = (idx===i ? 'block':'none'));
  }

  function saveState(){
    if (!form) return;
    const data = {};
    form.querySelectorAll('input, select, textarea').forEach(el=>{
      if (!el.name) return;
      if (el.type === 'radio'){
        if (el.checked) data[el.name] = el.value;
      } else if (el.type === 'checkbox'){
        data[el.name] = el.checked;
      } else {
        data[el.name] = el.value;
      }
    });
    // persist current step as well
    data._currentStep = current;
    sessionStorage.setItem(STORAGE_KEY, JSON.stringify(data));
  }

  function loadState(){
    if (!form) return;
    const raw = sessionStorage.getItem(STORAGE_KEY);
    if (!raw) return;
    try{
      const data = JSON.parse(raw);
      form.querySelectorAll('input, select, textarea').forEach(el=>{
        if (!el.name) return;
        if (el.type === 'radio'){
          if (data[el.name] && data[el.name] === el.value) el.checked = true;
        } else if (el.type === 'checkbox'){
          el.checked = !!data[el.name];
        } else {
          if (data[el.name] !== undefined) el.value = data[el.name];
        }
      });
      // restore visuals for card elements
      form.querySelectorAll('.igp-card').forEach(card=>{
        const input = card.querySelector('input[type="radio"], input[type="checkbox"]');
        if (!input || !input.name) return;
        if ((input.type === 'radio' && data[input.name] === input.value) || (input.type === 'checkbox' && !!data[input.name])){
          card.classList.add('selected');
        } else {
          card.classList.remove('selected');
        }
      });

      // restore current step if present
      if (typeof data._currentStep !== 'undefined'){
        current = parseInt(data._currentStep, 10) || 0;
      }
    } catch(e){ console.warn('igpForm: invalid state', e); }
  }

  function updateIndicators(){
    const indicators = document.querySelectorAll('.igp-step-indicator');
    indicators.forEach((el, idx)=>{
      if (idx === current) el.classList.add('active'); else el.classList.remove('active');
    });
  }

  if(steps.length === 0 || !form) return;
  loadState();
  show(current);
  updateIndicators();

  document.querySelectorAll('.igp-next').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      saveState();
      if (current < steps.length -1) { current++; show(current); }
      updateIndicators();
    });
  });

  document.querySelectorAll('.igp-prev').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      saveState();
      if (current > 0) { current--; show(current); }
      updateIndicators();
    });
  });

  // Clicking card toggles radio and saves state
  document.querySelectorAll('.igp-card').forEach(card=>{
    card.addEventListener('click', (e)=>{
      const input = card.querySelector('input[type="radio"], input[type="checkbox"]');
      if (input){
        if (input.type === 'radio'){
          // unselect siblings
          const name = input.name;
          form.querySelectorAll(`input[name="${name}"]`).forEach(r=> r.checked = false);
          input.checked = true;
        } else if (input.type === 'checkbox'){
          input.checked = !input.checked;
        }
        // visual
        if (input.type === 'radio'){
          form.querySelectorAll('.igp-card').forEach(c=> c.classList.remove('selected'));
        }
        if (input.checked) card.classList.add('selected');
        saveState();
      }
    });
  });

  // save on any direct input change
  form.addEventListener('change', saveState);

  // handle final submit -> keeps data in sessionStorage for later use
  form.addEventListener('submit', function(ev){
    saveState();
    // leave default behaviour to the page (or prevent and do ajax here)
  });

});
