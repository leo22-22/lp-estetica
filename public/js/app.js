/* Eduarda Cardoso Estética – Main JS */

(function () {
  'use strict';

  /* ---- Navbar scroll ---- */
  const navbar = document.getElementById('navbar');
  const backToTop = document.getElementById('back-to-top');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 80) {
      navbar.classList.add('scrolled');
      backToTop.classList.add('visible');
    } else {
      navbar.classList.remove('scrolled');
      backToTop.classList.remove('visible');
    }
  }, { passive: true });

  /* ---- Mobile nav toggle ---- */
  const navToggle = document.getElementById('nav-toggle');
  const navLinks = document.getElementById('nav-links');

  navToggle?.addEventListener('click', () => {
    navLinks.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', navLinks.classList.contains('open'));
  });

  navLinks?.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => navLinks.classList.remove('open'));
  });

  /* ---- Smooth scroll for all anchor links ---- */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const id = a.getAttribute('href');
      if (id === '#') return;
      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        const offset = 80;
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  /* ---- Back to top ---- */
  backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  /* ---- Gallery filter ---- */
  const filterBtns = document.querySelectorAll('.filter-btn');
  const galeriaItems = document.querySelectorAll('.galeria-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.dataset.filter;
      galeriaItems.forEach(item => {
        if (filter === 'all' || item.dataset.category === filter) {
          item.classList.remove('hidden');
        } else {
          item.classList.add('hidden');
        }
      });
    });
  });

  /* ---- Gallery lightbox ---- */
  const lightbox    = document.getElementById('lightbox');
  const lbClose     = document.getElementById('lb-close');
  const lbTitle     = document.getElementById('lb-title');
  const lbCategory  = document.getElementById('lb-category');
  const lbIcon      = document.getElementById('lb-icon');

  function openLightbox(item) {
    const title    = item.querySelector('.galeria-placeholder span')?.textContent.trim() || '';
    const category = item.dataset.category || '';
    const iconEl   = item.querySelector('.galeria-placeholder i');
    lbTitle.textContent    = title;
    lbCategory.textContent = category.charAt(0).toUpperCase() + category.slice(1).replace(/-/g, ' ');
    lbIcon.className       = iconEl ? iconEl.className : 'fas fa-image';
    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox?.classList.remove('open');
    document.body.style.overflow = '';
  }

  galeriaItems.forEach(item => item.addEventListener('click', () => openLightbox(item)));
  lbClose?.addEventListener('click', closeLightbox);
  lightbox?.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

  /* ---- Phone mask ---- */
  const phoneInput = document.getElementById('telefone');
  phoneInput?.addEventListener('input', e => {
    let v = e.target.value.replace(/\D/g, '').slice(0, 11);
    if (v.length >= 11) {
      v = v.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    } else if (v.length >= 7) {
      v = v.replace(/(\d{2})(\d{4,5})(\d{0,4})/, '($1) $2-$3');
    } else if (v.length >= 2) {
      v = v.replace(/(\d{2})(\d*)/, '($1) $2');
    }
    e.target.value = v;
  });

  /* ---- Intersection Observer for animations ---- */
  const observerOpts = { threshold: 0.12, rootMargin: '0px 0px -50px 0px' };
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0) scale(1)';
        observer.unobserve(entry.target);
      }
    });
  }, observerOpts);

  document.querySelectorAll('[data-aos]').forEach(el => {
    el.style.opacity = '0';
    el.style.transition = 'opacity .6s ease, transform .6s ease';
    const delay = el.dataset.aosDelay ? parseInt(el.dataset.aosDelay) : 0;
    el.style.transitionDelay = delay + 'ms';

    const anim = el.dataset.aos;
    if (anim === 'fade-right') el.style.transform = 'translateX(-40px)';
    else if (anim === 'fade-left') el.style.transform = 'translateX(40px)';
    else if (anim === 'zoom-in') el.style.transform = 'scale(.9)';
    else el.style.transform = 'translateY(30px)';

    observer.observe(el);
  });

  /* ---- Auto-hide flash message ---- */
  const flash = document.getElementById('flash-msg');
  if (flash) {
    setTimeout(() => flash.style.opacity = '0', 5000);
    setTimeout(() => flash.remove(), 5600);
  }

})();
