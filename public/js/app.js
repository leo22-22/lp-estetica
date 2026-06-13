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
  const lbImg       = document.getElementById('lb-img');

  function openLightbox(item) {
    const realImg  = item.querySelector('img');
    const title    = realImg?.alt || item.querySelector('.galeria-placeholder span')?.textContent.trim() || '';
    const category = item.dataset.category || '';
    const iconEl   = item.querySelector('.galeria-placeholder i');

    lbTitle.textContent    = title;
    lbCategory.textContent = category.charAt(0).toUpperCase() + category.slice(1).replace(/-/g, ' ');

    if (realImg) {
      lbImg.src           = realImg.src;
      lbImg.alt           = realImg.alt;
      lbImg.style.display = 'block';
      lbIcon.style.display= 'none';
    } else {
      lbImg.style.display = 'none';
      lbIcon.style.display= '';
      lbIcon.className    = iconEl ? iconEl.className : 'fas fa-image';
    }

    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox?.classList.remove('open');
    document.body.style.overflow = '';
    if (lbImg) { lbImg.src = ''; lbImg.style.display = 'none'; }
    if (lbIcon) lbIcon.style.display = '';
  }

  galeriaItems.forEach(item => item.addEventListener('click', () => openLightbox(item)));
  lbClose?.addEventListener('click', closeLightbox);
  lightbox?.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

  /* ---- Contact form → WhatsApp + salva no servidor ---- */
  const contatoForm = document.getElementById('contato-form');
  contatoForm?.addEventListener('submit', function (e) {
    e.preventDefault();
    const nome     = document.getElementById('nome').value.trim();
    const telefone = document.getElementById('telefone').value.trim();
    const email    = document.getElementById('email').value.trim();
    const servico  = document.getElementById('servico').value;
    const mensagem = document.getElementById('mensagem').value.trim();

    if (!nome || !telefone || !servico) {
      document.querySelectorAll('#contato-form [required]').forEach(f => f.reportValidity());
      return;
    }

    // 1. Abre WhatsApp de forma síncrona (antes de qualquer await) para não ser bloqueado por popup blockers
    const wpp   = (this.dataset.wpp || '5511999999999').replace(/\D/g, '');
    const lines = ['Olá! Gostaria de agendar um horário.', ''];
    lines.push(`*Nome:* ${nome}`);
    lines.push(`*Telefone:* ${telefone}`);
    if (email)    lines.push(`*E-mail:* ${email}`);
    lines.push(`*Serviço:* ${servico}`);
    if (mensagem) lines.push(`*Mensagem:* ${mensagem}`);
    window.open(`https://wa.me/${wpp}?text=${encodeURIComponent(lines.join('\n'))}`, '_blank');

    // 2. Salva no banco em background (sem bloquear a UX)
    fetch(this.action, {
      method: 'POST',
      body: new FormData(this),
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    }).catch(() => {});

    contatoForm.reset();
  });

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

  /* ---- Antes/Depois Carousel ---- */
  const adTrack = document.getElementById('adTrack');
  if (adTrack) {
    const slides   = adTrack.querySelectorAll('.ad-slide');
    const dotsWrap = document.getElementById('adDots');
    const btnPrev  = document.getElementById('adPrev');
    const btnNext  = document.getElementById('adNext');
    let current    = 0;
    let autoTimer;

    function goTo(idx) {
      current = (idx + slides.length) % slides.length;
      adTrack.style.transform = `translateX(-${current * 100}%)`;
      dotsWrap.querySelectorAll('.ad-dot').forEach((d, i) =>
        d.classList.toggle('active', i === current)
      );
      btnPrev.disabled = slides.length <= 1;
      btnNext.disabled = slides.length <= 1;
    }

    // Build dots
    slides.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.className = 'ad-dot' + (i === 0 ? ' active' : '');
      dot.setAttribute('aria-label', `Slide ${i + 1}`);
      dot.addEventListener('click', () => { goTo(i); resetAuto(); });
      dotsWrap.appendChild(dot);
    });

    btnPrev?.addEventListener('click', () => { goTo(current - 1); resetAuto(); });
    btnNext?.addEventListener('click', () => { goTo(current + 1); resetAuto(); });

    // Auto-play
    function startAuto() { autoTimer = setInterval(() => goTo(current + 1), 4500); }
    function resetAuto()  { clearInterval(autoTimer); startAuto(); }

    if (slides.length > 1) startAuto();
    goTo(0);

    // Touch/swipe
    let touchStartX = 0;
    adTrack.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
    adTrack.addEventListener('touchend',   e => {
      const dx = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(dx) > 50) { dx < 0 ? goTo(current + 1) : goTo(current - 1); resetAuto(); }
    }, { passive: true });
  }

  /* ---- Auto-hide flash message ---- */
  const flash = document.getElementById('flash-msg');
  if (flash) {
    setTimeout(() => flash.style.opacity = '0', 5000);
    setTimeout(() => flash.remove(), 5600);
  }

})();
