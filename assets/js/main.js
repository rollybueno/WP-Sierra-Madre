(() => {
  const body = document.body;
  const header = document.querySelector('.site-header');
  const menu = document.querySelector('.menu-panel');
  const search = document.querySelector('.search-panel');
  const menuButton = document.querySelector('[data-menu-open]');
  const searchButton = document.querySelector('[data-search-open]');
  let lastFocus = null;

  if (!header || !menu || !search || !menuButton || !searchButton) return;

  const panels = [menu, search];
  const focusable = panel => [...panel.querySelectorAll('a[href], button, input')]
    .filter(element => !element.disabled && element.offsetParent !== null);

  panels.forEach(panel => {
    panel.setAttribute('aria-hidden', 'true');
    panel.setAttribute('inert', '');
  });

  function closePanel(panel, restoreFocus = true) {
    if (!panel || panel.getAttribute('aria-hidden') === 'true') return;
    panel.setAttribute('aria-hidden', 'true');
    panel.setAttribute('inert', '');
    body.classList.remove('overlay-open');
    menuButton.setAttribute('aria-expanded', 'false');
    searchButton.setAttribute('aria-expanded', 'false');
    if (restoreFocus) lastFocus?.focus();
  }

  function openPanel(panel, trigger) {
    panels.forEach(candidate => {
      if (candidate !== panel) closePanel(candidate, false);
    });
    lastFocus = trigger;
    panel.removeAttribute('inert');
    panel.setAttribute('aria-hidden', 'false');
    body.classList.add('overlay-open');
    trigger.setAttribute('aria-expanded', 'true');
    // Let the visibility transition start before attempting to focus its contents.
    requestAnimationFrame(() => requestAnimationFrame(() => {
      if (panel.getAttribute('aria-hidden') === 'false') {
        (panel.querySelector('input') || focusable(panel)[0])?.focus();
      }
    }));
  }

  menuButton.addEventListener('click', event => openPanel(menu, event.currentTarget));
  searchButton.addEventListener('click', event => openPanel(search, event.currentTarget));
  menu.querySelector('[data-menu-close]')?.addEventListener('click', () => closePanel(menu));
  search.querySelector('[data-search-close]')?.addEventListener('click', () => closePanel(search));
  menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => closePanel(menu, false)));

  document.addEventListener('keydown', event => {
    const panel = panels.find(candidate => candidate.getAttribute('aria-hidden') === 'false');
    if (!panel) return;
    if (event.key === 'Escape') {
      closePanel(panel);
      return;
    }
    if (event.key !== 'Tab') return;
    const items = focusable(panel);
    if (!items.length) return;
    const first = items[0];
    const last = items[items.length - 1];
    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  });

  const updateHeader = () => header.classList.toggle('is-scrolled', scrollY > innerHeight * .65);
  updateHeader();
  addEventListener('scroll', updateHeader, { passive: true });

  const lettersForm = document.querySelector('[data-letters-form]');
  const lettersStatus = document.querySelector('[data-letters-status]');
  lettersForm?.addEventListener('submit', event => {
    event.preventDefault();
    if (!lettersStatus) return;
    const email = new FormData(lettersForm).get('email')?.toString().trim() || '';
    const valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    lettersStatus.hidden = false;
    if (!valid) {
      lettersStatus.dataset.state = 'error';
      lettersStatus.textContent = 'That email does not look right. Check the address and try again.';
      return;
    }
    lettersStatus.dataset.state = 'success';
    lettersStatus.textContent = 'You are on the list. Field letters arrive when there is something worth sending.';
    lettersForm.reset();
  });

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => {
      if (entry.isIntersecting) { entry.target.classList.add('in-view'); observer.unobserve(entry.target); }
    }), { threshold: .12 });
    document.querySelectorAll('.reveal').forEach(element => observer.observe(element));
  }
})();
