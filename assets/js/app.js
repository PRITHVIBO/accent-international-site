(() => {
  'use strict';
  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Scroll progress and sticky-header treatment.
  const progress = $('#scrollProgress');
  const header = $('.site-header');
  let scrollTicking = false;
  const updateScroll = () => {
    const max = document.documentElement.scrollHeight - window.innerHeight;
    const amount = max > 0 ? (window.scrollY / max) * 100 : 0;
    if (progress) progress.style.width = `${amount}%`;
    if (header) header.classList.toggle('is-scrolled', window.scrollY > 12);
    scrollTicking = false;
  };
  window.addEventListener('scroll', () => {
    if (!scrollTicking) {
      window.requestAnimationFrame(updateScroll);
      scrollTicking = true;
    }
  }, { passive: true });
  updateScroll();

  // Mobile navigation.
  const navToggle = $('#navToggle');
  const nav = $('#mainNav');
  const closeNav = () => {
    if (!nav || !navToggle) return;
    nav.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
    navToggle.setAttribute('aria-label', 'Open navigation');
    document.body.classList.remove('menu-open');
  };
  if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
      const willOpen = !nav.classList.contains('is-open');
      nav.classList.toggle('is-open', willOpen);
      navToggle.setAttribute('aria-expanded', String(willOpen));
      navToggle.setAttribute('aria-label', willOpen ? 'Close navigation' : 'Open navigation');
      document.body.classList.toggle('menu-open', willOpen);
    });
    $$('a', nav).forEach(link => link.addEventListener('click', closeNav));
    document.addEventListener('keydown', event => { if (event.key === 'Escape') closeNav(); });
  }

  // Scroll reveal with a graceful no-IntersectionObserver fallback.
  const revealItems = $$('[data-reveal]');
  if ('IntersectionObserver' in window && !reducedMotion) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -35px 0px' });
    revealItems.forEach((item, index) => {
      item.style.setProperty('--reveal-delay', `${Math.min(index % 4, 3) * 65}ms`);
      observer.observe(item);
    });
  } else {
    revealItems.forEach(item => item.classList.add('is-visible'));
  }

  // Catalogue filtering and search.
  const filterButtons = $$('.filter-chip');
  const productCards = $$('.product-card');
  const searchInput = $('#productSearch');
  const emptyState = $('#emptyState');
  let activeCategory = 'All products';
  const filterProducts = () => {
    const query = (searchInput?.value || '').trim().toLowerCase();
    let visible = 0;
    productCards.forEach(card => {
      const categoryMatch = activeCategory === 'All products' || card.dataset.category === activeCategory;
      const searchMatch = !query || (card.dataset.search || '').includes(query);
      const show = categoryMatch && searchMatch;
      card.hidden = !show;
      if (show) visible += 1;
    });
    if (emptyState) emptyState.hidden = visible !== 0;
  };
  filterButtons.forEach(button => button.addEventListener('click', () => {
    activeCategory = button.dataset.filter || 'All products';
    filterButtons.forEach(item => item.classList.toggle('is-active', item === button));
    filterProducts();
  }));
  searchInput?.addEventListener('input', filterProducts);

  // Persona-specific visitor journey: tailor the CTA and pre-select the enquiry form.
  const personaProfiles = {
    clinic: {
      title: 'For a busy dental practice',
      description: 'Tell us the procedure, brand, model, size and quantity. We will check the requirement and share a clear quotation and lead-time expectation.',
      buyer: 'Dentist / Clinic', interest: 'General enquiry', note: 'Clinic replenishment or procedure-specific requirement'
    },
    dealer: {
      title: 'For dealers and distributors',
      description: 'Share product lines, expected volumes, repeat-order patterns and your delivery locations. We can check bulk and on-demand sourcing options for a trade quotation.',
      buyer: 'Dealer / Distributor', interest: 'Bulk / dealer enquiry', note: 'Dealer / bulk sourcing enquiry'
    },
    student: {
      title: 'For dental students',
      description: 'Share your college practical list or a photo of the required kit. We can help organise the enquiry by instrument, size and quantity.',
      buyer: 'Dental student', interest: 'Student instruments / kit', note: 'Dental student kit enquiry'
    },
    lab: {
      title: 'For dental laboratories',
      description: 'Tell us the restoration workflow, material family, block/disc dimensions, shade or pack. We will check the exact specification and sourcing lead time.',
      buyer: 'Dental laboratory', interest: 'Laboratory materials', note: 'Dental laboratory materials enquiry'
    }
  };
  const personaTitle = $('#personaTitle');
  const personaDescription = $('#personaDescription');
  const personaCta = $('#personaCta');
  const buyerSelect = $('select[name="buyer_type"]');
  const interestSelect = $('select[name="interest"]');
  let activePersona = 'clinic';
  const setPersona = (key, addNote = false) => {
    const profile = personaProfiles[key];
    if (!profile) return;
    activePersona = key;
    if (personaTitle) personaTitle.textContent = profile.title;
    if (personaDescription) personaDescription.textContent = profile.description;
    $$('.persona-tab').forEach(tab => {
      const active = tab.dataset.persona === key;
      tab.classList.toggle('is-active', active);
      tab.setAttribute('aria-pressed', String(active));
    });
    if (buyerSelect) buyerSelect.value = profile.buyer;
    if (interestSelect) interestSelect.value = profile.interest;
    if (personaCta) personaCta.textContent = key === 'dealer' ? 'Request a trade quote ↗' : key === 'student' ? 'Build my student kit ↗' : key === 'lab' ? 'Ask for lab materials ↗' : 'Build my requirement ↗';
    if (addNote) appendRequirement(`Enquiry type: ${profile.note}`);
  };
  $$('.persona-tab').forEach(tab => tab.addEventListener('click', () => setPersona(tab.dataset.persona || 'clinic', false)));
  personaCta?.addEventListener('click', () => setPersona(activePersona, true));

  // Add catalogue items and audience choices to the enquiry message.
  const messageField = $('#enquiryMessage');
  const appendRequirement = value => {
    if (!messageField) return;
    const current = messageField.value.trim();
    const lines = current ? current.split('\n').map(line => line.trim()).filter(Boolean) : [];
    if (!lines.some(line => line.toLowerCase() === value.toLowerCase())) lines.push(value);
    messageField.value = lines.join('\n');
    messageField.focus({ preventScroll: true });
    $('#contact')?.scrollIntoView({ behavior: reducedMotion ? 'auto' : 'smooth', block: 'start' });
  };
  $$('.add-enquiry').forEach(button => button.addEventListener('click', () => {
    appendRequirement(`Product of interest: ${button.dataset.product || 'Dental product'}`);
    button.classList.add('was-added');
    button.innerHTML = 'Added to enquiry <span>✓</span>';
  }));
  $$('[data-interest]').forEach(link => link.addEventListener('click', () => {
    const interest = link.dataset.interest;
    const select = $('select[name="buyer_type"]');
    if (select && interest) {
      if (interest.toLowerCase().includes('dentist')) { select.value = 'Dentist / Clinic'; setPersona('clinic', false); }
      else if (interest.toLowerCase().includes('dealer')) { select.value = 'Dealer / Distributor'; setPersona('dealer', false); }
      else if (interest.toLowerCase().includes('student')) { select.value = 'Dental student'; setPersona('student', false); }
      else if (interest.toLowerCase().includes('laboratory')) { select.value = 'Dental laboratory'; setPersona('lab', false); }
    }
    if (interest) appendRequirement(`Enquiry type: ${interest}`);
  }));

  // AJAX form submission. Server-side validation remains authoritative.
  const form = $('#quoteForm');
  const feedback = $('#formFeedback');
  const submitButton = $('.submit-button', form || document);
  const buttonLabel = $('.button-label', form || document);
  form?.addEventListener('submit', async event => {
    event.preventDefault();
    if (!form.reportValidity()) return;
    if (feedback) {
      feedback.textContent = 'Sending your enquiry…';
      feedback.classList.remove('is-error');
    }
    if (submitButton) submitButton.disabled = true;
    if (buttonLabel) buttonLabel.textContent = 'Sending…';
    try {
      const response = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'Accept': 'application/json' }
      });
      const result = await response.json().catch(() => ({}));
      if (!response.ok || !result.ok) throw new Error(result.message || 'Something went wrong. Please try again.');
      if (feedback) feedback.textContent = result.message || 'Thank you. Your enquiry has been received.';
      if (result.csrf_token) {
        const tokenField = $('input[name="csrf_token"]', form);
        if (tokenField) tokenField.value = result.csrf_token;
      }
      form.reset();
      setPersona('clinic', false);
      $$('.add-enquiry').forEach(button => {
        button.classList.remove('was-added');
        button.innerHTML = 'Add to enquiry <span>+</span>';
      });
    } catch (error) {
      if (feedback) {
        feedback.textContent = error.message || 'Unable to send right now. Please try again.';
        feedback.classList.add('is-error');
      }
    } finally {
      if (submitButton) submitButton.disabled = false;
      if (buttonLabel) buttonLabel.textContent = 'Send product enquiry';
    }
  });

  // Desktop-only soft spotlight follows the pointer without controlling content.
  if (!reducedMotion && window.matchMedia('(pointer:fine)').matches) {
    const hero = $('.hero');
    hero?.addEventListener('pointermove', event => {
      const rect = hero.getBoundingClientRect();
      const x = ((event.clientX - rect.left) / rect.width) * 100;
      const y = ((event.clientY - rect.top) / rect.height) * 100;
      hero.style.setProperty('--pointer-x', `${x}%`);
      hero.style.setProperty('--pointer-y', `${y}%`);
    }, { passive: true });
  }
})();
