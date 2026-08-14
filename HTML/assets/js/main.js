(() => {
  const body = document.body;
  const header = document.querySelector('[data-header]');
  const menu = document.querySelector('[data-menu]');
  const search = document.querySelector('[data-search]');
  const menuButton = document.querySelector('[data-menu-open]');
  let lastFocus;

  const focusable = panel => [...panel.querySelectorAll('a, button, input')];
  function openPanel(panel, trigger) {
    lastFocus = trigger;
    [menu, search].forEach(p => { if (p !== panel) closePanel(p); });
    panel.setAttribute('aria-hidden', 'false');
    body.classList.add('overlay-open');
    trigger?.setAttribute('aria-expanded', 'true');
    requestAnimationFrame(() => (panel.querySelector('input') || focusable(panel)[0])?.focus());
  }
  function closePanel(panel) {
    if (!panel || panel.getAttribute('aria-hidden') === 'true') return;
    panel.setAttribute('aria-hidden', 'true');
    body.classList.remove('overlay-open');
    menuButton.setAttribute('aria-expanded', 'false');
    lastFocus?.focus();
  }
  document.querySelector('[data-menu-open]').addEventListener('click', e => openPanel(menu, e.currentTarget));
  document.querySelector('[data-menu-close]').addEventListener('click', () => closePanel(menu));
  document.querySelector('[data-search-open]').addEventListener('click', e => openPanel(search, e.currentTarget));
  document.querySelector('[data-search-close]').addEventListener('click', () => closePanel(search));
  menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => closePanel(menu)));
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closePanel(menu); closePanel(search); }
    if (e.key !== 'Tab') return;
    const panel = [menu, search].find(p => p.getAttribute('aria-hidden') === 'false');
    if (!panel) return;
    const items = focusable(panel), first = items[0], last = items.at(-1);
    if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
  });
  document.querySelector('[data-search-form]').addEventListener('submit', e => e.preventDefault());
  addEventListener('scroll', () => header.classList.toggle('is-scrolled', scrollY > innerHeight * .65), { passive: true });

  const preview = document.querySelector('[data-place-image]');
  document.querySelectorAll('[data-image]').forEach(link => {
    const swap = () => { if (preview.src.endsWith(link.dataset.image)) return; preview.classList.add('is-changing'); setTimeout(() => { preview.src = link.dataset.image; preview.classList.remove('is-changing'); }, 140); };
    link.addEventListener('mouseenter', swap); link.addEventListener('focus', swap);
  });

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('in-view'); observer.unobserve(entry.target); } }), { threshold: .12 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  }
})();
