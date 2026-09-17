/* =========================================================
   Peace Automation — interactions
   GSAP + ScrollTrigger · Swiper 11 · Lenis
   ========================================================= */
(function () {
  'use strict';

  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var lenis   = null;   // shared so the panels can stop/start it while open

  /* ---------- Preloader (always runs, even reduced) ---------- */
  var pre = document.getElementById('preloader');
  if (pre) {
    if (reduced) { pre.remove(); }
    else {
      var hide = function () {
        pre.classList.add('is-done');
        setTimeout(function () { pre.remove(); }, 500);
      };
      window.addEventListener('load', hide);
      setTimeout(hide, 4000); // never trap the page behind a stalled asset
    }
  }

  document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       Header: solid past 60px
       ===================================================== */
    var header = document.getElementById('header');
    var toTop  = document.getElementById('back-to-top');
    var ring   = toTop ? toTop.querySelector('.fab__ring circle') : null;
    var ringLen = 0;

    if (ring) {
      ringLen = ring.getTotalLength();
      ring.style.strokeDasharray = ringLen;
      ring.style.strokeDashoffset = ringLen;
    }

    function onScroll() {
      var y = window.scrollY;

      /* Sticky background after 60px */
      if (header) header.classList.toggle('is-stuck', y > 60);

      /* Hide on scroll DOWN, show on scroll UP */
      if (header && y > 80) {
        if (y > lastScrollY + 4) {
          header.classList.add('is-hidden');      // scrolling down
        } else if (y < lastScrollY - 4) {
          header.classList.remove('is-hidden');   // scrolling up
        }
      } else if (header) {
        header.classList.remove('is-hidden');     // near top — always show
      }
      lastScrollY = y;

      if (toTop) {
        toTop.classList.toggle('is-on', y > 400);
        if (ring) {
          var max = document.documentElement.scrollHeight - window.innerHeight;
          var pct = max > 0 ? Math.min(y / max, 1) : 0;
          ring.style.strokeDashoffset = ringLen - ringLen * pct;
        }
      }
    }
    var lastScrollY = window.scrollY;
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    toTop && toTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: reduced ? 'auto' : 'smooth' });
    });

    /* =====================================================
       Slide-in panels — info panel (grid icon) and nav drawer
       (hamburger). Two separate components, one shared shell.
       ===================================================== */
    var overlay   = document.getElementById('panel-overlay');
    var openPanel = null;
    var lastFocus = null;

    function scrollbarWidth() {
      return window.innerWidth - document.documentElement.clientWidth;
    }

    function panelOpen(panel, trigger) {
      if (openPanel) panelClose();            // only one open at a time
      openPanel = panel;
      lastFocus = trigger || document.activeElement;

      panel.classList.add('is-open');
      panel.setAttribute('aria-hidden', 'false');
      trigger && trigger.setAttribute('aria-expanded', 'true');

      overlay.hidden = false;
      requestAnimationFrame(function () { overlay.classList.add('is-open'); });

      // lock scroll without a layout shift
      document.body.style.paddingRight = scrollbarWidth() + 'px';
      document.body.style.overflow = 'hidden';
      lenis && lenis.stop();

      (panel.querySelector('a[href],button') || panel).focus();
    }

    function panelClose() {
      if (!openPanel) return;
      var panel = openPanel;
      openPanel = null;

      panel.classList.remove('is-open');
      panel.setAttribute('aria-hidden', 'true');
      overlay.classList.remove('is-open');
      setTimeout(function () { if (!openPanel) overlay.hidden = true; }, 320);

      document.querySelectorAll('[aria-controls]').forEach(function (b) {
        b.setAttribute('aria-expanded', 'false');
      });

      document.body.style.overflow = '';
      document.body.style.paddingRight = '';
      lenis && lenis.start();

      lastFocus && lastFocus.focus();
    }

    [['info-open', 'info-panel'], ['nav-open', 'nav-drawer']].forEach(function (pair) {
      var trigger = document.getElementById(pair[0]);
      var panel   = document.getElementById(pair[1]);
      if (!trigger || !panel) return;

      trigger.addEventListener('click', function () {
        panel.classList.contains('is-open') ? panelClose() : panelOpen(panel, trigger);
      });
      panel.querySelectorAll('[data-panel-close]').forEach(function (b) {
        b.addEventListener('click', panelClose);
      });
      panel.querySelectorAll('a[href]').forEach(function (a) {
        a.addEventListener('click', panelClose);
      });
    });

    overlay && overlay.addEventListener('click', panelClose);

    document.addEventListener('keydown', function (e) {
      if (!openPanel) return;
      if (e.key === 'Escape') { panelClose(); return; }
      if (e.key !== 'Tab') return;

      var f = openPanel.querySelectorAll(
        'a[href],button:not([disabled]),input,select,textarea,[tabindex]:not([tabindex="-1"])'
      );
      if (!f.length) return;
      var first = f[0], last = f[f.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    });

    // Services accordion inside the nav drawer
    document.querySelectorAll('[data-drawer-acc]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var sub = btn.nextElementSibling;
        var isOpen = sub.classList.toggle('is-open');
        btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      });
    });

    /* =====================================================
       Accordions (S4 services, S9 strengths, FAQs)
       grid-template-rows 0fr → 1fr
       ===================================================== */
    document.querySelectorAll('[data-acc]').forEach(function (group) {
      var rowSel = group.dataset.acc === 'icon' ? '.iacc__row' : '.acc__row';
      var btnSel = group.dataset.acc === 'icon' ? '.iacc__btn' : '.acc__btn';
      var rows = group.querySelectorAll(rowSel);

      rows.forEach(function (row) {
        var btn = row.querySelector(btnSel);
        if (!btn) return;
        btn.setAttribute('aria-expanded', row.classList.contains('is-open') ? 'true' : 'false');

        btn.addEventListener('click', function () {
          var isOpen = row.classList.contains('is-open');
          rows.forEach(function (r) {
            r.classList.remove('is-open');
            var b = r.querySelector(btnSel);
            b && b.setAttribute('aria-expanded', 'false');
          });
          if (!isOpen) {
            row.classList.add('is-open');
            btn.setAttribute('aria-expanded', 'true');
            // crossfade the paired media panel
            var media = document.querySelector('[data-acc-media="' + group.dataset.accGroup + '"]');
            if (media && row.dataset.media) {
              media.querySelectorAll('[data-media-key]').forEach(function (el) {
                el.classList.toggle('is-current', el.dataset.mediaKey === row.dataset.media);
              });
            }
          }
        });
      });
    });

    /* =====================================================
       Forms — contact + newsletter (fetch → JSON)
       ===================================================== */
    function wireForm(form, endpoint, noteEl) {
      if (!form) return;
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var note = noteEl ? document.getElementById(noteEl) : null;

        // clear previous errors
        form.querySelectorAll('.field').forEach(function (f) { f.classList.remove('has-error'); });
        if (note) { note.className = 'form-note'; note.textContent = ''; }

        var btn = form.querySelector('[type="submit"]');
        btn && (btn.disabled = true);

        fetch(endpoint, { method: 'POST', body: new FormData(form) })
          .then(function (r) { return r.json(); })
          .then(function (res) {
            if (res.ok) {
              form.reset();
              if (note) { note.className = 'form-note form-note--ok is-on'; note.textContent = res.message; }
            } else {
              if (res.errors) {
                Object.keys(res.errors).forEach(function (name) {
                  var input = form.querySelector('[name="' + name + '"]');
                  var wrap = input && input.closest('.field');
                  if (wrap) {
                    wrap.classList.add('has-error');
                    var msg = wrap.querySelector('.field__err');
                    if (msg) msg.textContent = res.errors[name];
                  }
                });
              }
              if (note) { note.className = 'form-note form-note--err is-on'; note.textContent = res.message || 'Please check the form and try again.'; }
            }
          })
          .catch(function () {
            if (note) { note.className = 'form-note form-note--err is-on'; note.textContent = 'Network error — please try again.'; }
          })
          .finally(function () { btn && (btn.disabled = false); });
      });
    }
    wireForm(document.getElementById('contact-form'), 'api/contact.php', 'contact-note');
    wireForm(document.getElementById('newsletter-form'), 'api/newsletter.php', 'nl-note');

    /* =====================================================
       Everything below is motion — skipped entirely when the
       visitor asks for reduced motion.
       ===================================================== */
    if (reduced) {
      document.querySelectorAll('.reveal .rw').forEach(function (w) { w.style.color = 'var(--ink)' ; });
      document.querySelectorAll('[data-count]').forEach(function (el) {
        el.textContent = el.dataset.count + (el.dataset.suffix || '');
      });
      initSwipers(true);
      return;
    }

    /* ---------- Lenis ⇄ ScrollTrigger sync ----------
       gsap.ticker drives Lenis (no standalone rAF loop), and every Lenis
       scroll updates ScrollTrigger — otherwise pins never see the real
       scroll position and jitter. */
    var hasGsap = window.gsap && window.ScrollTrigger;
    if (hasGsap) gsap.registerPlugin(ScrollTrigger);

    if (window.Lenis && hasGsap) {
      lenis = new window.Lenis({ duration: 1.1, smoothWheel: true });

      lenis.on('scroll', ScrollTrigger.update);
      gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
      gsap.ticker.lagSmoothing(0);

      ScrollTrigger.refresh();

      window.addEventListener('load', function () { ScrollTrigger.refresh(); });

      var rsTimer = null;
      window.addEventListener('resize', function () {
        clearTimeout(rsTimer);
        rsTimer = setTimeout(function () { ScrollTrigger.refresh(); }, 200);
      });
    } else if (window.Lenis) {
      lenis = new window.Lenis({ duration: 1.1, smoothWheel: true });
      (function raf(t) { lenis.raf(t); requestAnimationFrame(raf); })(0);
    }

    /* ---------- Hero entrance (one timeline, 70ms stagger) ---------- */
    var hero = document.querySelector('[data-hero]');
    if (hero && hasGsap) {
      var bits = hero.querySelectorAll('[data-hero-item]');
      var cards = hero.querySelectorAll('.hero__card');
      var tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
      tl.from(bits, { y: 26, opacity: 0, duration: .7, stagger: .07 })
        .from(cards, { scale: .94, y: 20, opacity: 0, duration: .6, stagger: .1 }, '-=.3');
    }

    /* ---------- Hero collage scroll parallax (images inside cards) ---------- */
    if (hasGsap) {
      var collage = document.querySelector('[data-hero-collage]');
      if (collage) {
        var stConfig = { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: 0.8 };

        /* top-wide card → image slides UP inside */
        var wideCard = collage.querySelector('.hero__card--wide');
        if (wideCard) {
          var wideImg = wideCard.querySelector('img');
          if (wideImg) gsap.fromTo(wideImg, { yPercent: 10, scale: 1.2 }, { yPercent: -20, scale: 1, ease: 'none', scrollTrigger: stConfig });
        }

        /* tall right card → image slides DOWN inside */
        var tallCard = collage.querySelector('.hero__card--tall');
        if (tallCard) {
          var tallImg = tallCard.querySelector('img');
          if (tallImg) gsap.fromTo(tallImg, { yPercent: -10, scale: 1 }, { yPercent: 18, scale: 1.2, ease: 'none', scrollTrigger: stConfig });
        }

        /* lime bottom-left → image drifts UP */
        var limeCard = collage.querySelector('.hero__card--lime');
        if (limeCard) {
          var limeImg = limeCard.querySelector('img');
          if (limeImg) gsap.fromTo(limeImg, { yPercent: 8, scale: 1.15 }, { yPercent: -15, scale: 1, ease: 'none', scrollTrigger: stConfig });
        }

        /* white bottom-left → image drifts DOWN */
        var whiteCard = collage.querySelector('.hero__card--white');
        if (whiteCard) {
          var whiteImg = whiteCard.querySelector('img');
          if (whiteImg) gsap.fromTo(whiteImg, { yPercent: -6, scale: 1 }, { yPercent: 14, scale: 1.15, ease: 'none', scrollTrigger: stConfig });
        }
      }
    }


    if (hasGsap) {
      document.querySelectorAll('.reveal').forEach(function (el) {
        gsap.to(el.querySelectorAll('.rw'), {
          color: getComputedStyle(document.documentElement).getPropertyValue('--ink').trim() || '#0B1220',
          stagger: 1,
          ease: 'none',
          scrollTrigger: { trigger: el, start: 'top 80%', end: 'bottom 55%', scrub: true }
        });
      });
    }


    /* =====================================================
       S8 — Smart Surveillance: pin + scroll-driven rotation

       Uses the 48-frame canvas turntable when assets/images/spin/
       exists, otherwise a rotateY fallback on the still.
       ===================================================== */
    var surv = document.querySelector('.surveillance');
    if (surv && hasGsap && window.innerWidth > 992) {
      var spin = surv.querySelector('.spin');
      var hint = surv.querySelector('[data-spin-hint]');
      var canvas = surv.querySelector('canvas#camSpin');

      if (spin) {
        // Section pins, camera turns a full 360° tied 1:1 to scroll, then releases.
        gsap.to(spin, {
          rotateY: 360,
          ease: 'none',
          scrollTrigger: {
            trigger: surv,
            start: 'top top',
            end: '+=80%',
            pin: true,
            pinSpacing: true,
            scrub: 1,
            anticipatePin: 1,
            invalidateOnRefresh: true,
            onUpdate: function (self) {
              if (hint) hint.classList.toggle('is-done', self.progress > 0.9);
            }
          }
        });
      } else if (canvas) {
        // --- real 360° turntable ---
        var ctx    = canvas.getContext('2d');
        var TOTAL  = 48;
        var images = [];
        var state  = { frame: 0 };

        function render() {
          var img = images[Math.round(state.frame)];
          if (!img || !img.complete) return;
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        }

        for (var i = 0; i < TOTAL; i++) {
          var im = new Image();
          // first 12 eager so the section is never blank, rest lazy
          if (i >= 12) im.loading = 'lazy';
          im.onload = (function (idx) {
            return function () { if (idx === 0) render(); };
          })(i);
          im.src = 'assets/images/spin/cam-' + String(i + 1).padStart(3, '0') + '.webp';
          images.push(im);
        }

        gsap.to(state, {
          frame: TOTAL - 1,
          ease: 'none',
          onUpdate: render,
          scrollTrigger: {
            trigger: surv, start: 'top top', end: '+=80%',
            pin: true, pinSpacing: true, scrub: 1,
            anticipatePin: 1, invalidateOnRefresh: true
          }
        });
      }
    }

    /* =====================================================
       S11 — badge intro. The badge itself is CSS position:sticky
       (see .reviews__badge) rather than a GSAP pin, so it stays
       bounded by its grid and cannot escape the section.
       ===================================================== */
    var badge = document.querySelector('.reviews__badge');
    if (badge && hasGsap) {
      gsap.from(badge, {
        scale: 0.82, autoAlpha: 0, duration: .5, ease: 'back.out(1.6)',
        scrollTrigger: { trigger: '.reviews', start: 'top 75%', once: true }
      });
    }

    /* ---------- Parallax band ---------- */
    if (hasGsap) {
      document.querySelectorAll('[data-parallax]').forEach(function (el) {
        gsap.fromTo(el, { yPercent: -8 }, {
          yPercent: 8, ease: 'none',
          scrollTrigger: { trigger: el.parentElement, start: 'top bottom', end: 'bottom top', scrub: true }
        });
      });

      /* ---------- Seonex Signature Entrance Animations ---------- */

      // 1. Section Headings (Eyebrow, Title, Subtitle) across all sections
      document.querySelectorAll('.section, .surveillance, .client-strip, .cta-connect').forEach(function (sec) {
        var head = sec.querySelector('.row-between > div:first-child, .center, .section-head, .surveillance__copy');
        if (head && !head.closest('.hero')) {
          var items = head.querySelectorAll('.eyebrow, h2, p:not(.measure)');
          if (items.length) {
            gsap.from(items, {
              y: 28,
              opacity: 0,
              duration: 0.75,
              stagger: 0.1,
              ease: 'power2.out',
              scrollTrigger: { trigger: head, start: 'top 88%', once: true }
            });
          }
        }
      });

      // 2. S2 Technology Grid Cards
      var techGrid = document.querySelector('.tech__grid');
      if (techGrid) {
        gsap.from(techGrid.children, {
          y: 35,
          opacity: 0,
          duration: 0.7,
          stagger: 0.14,
          ease: 'power2.out',
          scrollTrigger: { trigger: techGrid, start: 'top 85%', once: true }
        });
      }

      // 3. S3 Statement photo & quote card
      var stmtPair = document.querySelector('.statement-pair');
      if (stmtPair) {
        gsap.from(stmtPair.children, {
          y: 30,
          opacity: 0,
          duration: 0.7,
          stagger: 0.15,
          ease: 'power2.out',
          scrollTrigger: { trigger: stmtPair, start: 'top 85%', once: true }
        });
      }

      // 4. S4 Services Accordion Rows & Media Showcase
      var svcGroup = document.querySelector('[data-acc-group="svc"]');
      if (svcGroup) {
        gsap.from(svcGroup.querySelectorAll('.acc__row'), {
          y: 25,
          opacity: 0,
          duration: 0.55,
          stagger: 0.08,
          ease: 'power2.out',
          scrollTrigger: { trigger: svcGroup, start: 'top 85%', once: true }
        });
        var svcMedia = document.querySelector('.acc-media');
        if (svcMedia) {
          gsap.from(svcMedia, {
            scale: 0.95,
            opacity: 0,
            duration: 0.75,
            ease: 'power2.out',
            scrollTrigger: { trigger: svcMedia, start: 'top 85%', once: true }
          });
        }
      }

      // 5. S6 Approach: Pill Capsules Gallery, Steps & Control Room Banner
      var pillGallery = document.querySelector('.pill-gallery');
      if (pillGallery) {
        gsap.from(pillGallery.querySelectorAll('.pill-card'), {
          y: 30, opacity: 0, duration: 0.6, stagger: 0.08, ease: 'power2.out',
          scrollTrigger: { trigger: pillGallery, start: 'top 85%', once: true }
        });
      }

      var approachSteps = document.querySelectorAll('.approach__grid .step');
      if (approachSteps.length) {
        gsap.from(approachSteps, {
          x: 28, opacity: 0, duration: 0.6, stagger: 0.1, ease: 'power2.out',
          scrollTrigger: { trigger: '.approach__grid', start: 'top 80%', once: true }
        });
      }

      var approachBanner = document.querySelector('.approach-banner');
      if (approachBanner) {
        gsap.from(approachBanner, {
          y: 30, opacity: 0, duration: 0.8, ease: 'power2.out',
          scrollTrigger: { trigger: approachBanner, start: 'top 85%', once: true }
        });
      }

      // 6. S7 Team Specialists
      var teamStrip = document.querySelector('.team-strip');
      if (teamStrip) {
        gsap.from(teamStrip.querySelectorAll('[data-team-card]'), {
          y: 30, opacity: 0, duration: 0.6, stagger: 0.09, ease: 'power2.out',
          scrollTrigger: { trigger: teamStrip, start: 'top 85%', once: true }
        });
      }


      // 7. S8 Timeline Methodology
      var timelineMedia = document.querySelector('.timeline-media');
      if (timelineMedia) {
        gsap.from(timelineMedia, {
          scale: 0.94, opacity: 0, duration: 0.75, ease: 'power2.out',
          scrollTrigger: { trigger: timelineMedia, start: 'top 85%', once: true }
        });
      }

      var timelineItems = document.querySelectorAll('.timeline-item');
      if (timelineItems.length) {
        gsap.from(timelineItems, {
          x: 30, opacity: 0, duration: 0.55, stagger: 0.12, ease: 'power2.out',
          scrollTrigger: { trigger: '.timeline-grid', start: 'top 80%', once: true }
        });
      }

      // 8. S10 Projects Portfolio Cards
      var projectCards = document.querySelectorAll('.grid.g-3 .pcard');
      if (projectCards.length) {
        gsap.from(projectCards, {
          y: 40, opacity: 0, duration: 0.65, stagger: 0.1, ease: 'power2.out',
          scrollTrigger: { trigger: '.grid.g-3', start: 'top 85%', once: true }
        });
      }

      // 9. S11 Reviews Testimonial Cards
      var reviewCards = document.querySelectorAll('.reviews__wrap .rcard');
      if (reviewCards.length) {
        gsap.from(reviewCards, {
          y: 35, opacity: 0, duration: 0.65, stagger: 0.1, ease: 'power2.out',
          scrollTrigger: { trigger: '.reviews__wrap', start: 'top 80%', once: true }
        });
      }

      // 10. S13 Let's Connect: Capsule pop & Pulse Circle Button
      var ctaConnect = document.querySelector('.cta-connect');
      if (ctaConnect) {
        var capsule = ctaConnect.querySelector('.cta-connect__capsule');
        if (capsule) {
          gsap.from(capsule, {
            scale: 0.75, opacity: 0, duration: 0.75, ease: 'back.out(1.6)',
            scrollTrigger: { trigger: ctaConnect, start: 'top 85%', once: true }
          });
        }

        var circleBtn = ctaConnect.querySelector('.btn-circle-lime');
        if (circleBtn) {
          gsap.from(circleBtn, {
            scale: 0.6, rotation: -45, opacity: 0, duration: 0.8, ease: 'back.out(1.8)',
            scrollTrigger: { trigger: ctaConnect, start: 'top 80%', once: true }
          });
        }
      }

      // 11. S11b Eye-Opening Camera Banner — scroll-tied (open ↓ / close ↑)
      var eyeBanner = document.getElementById('eye-banner');
      if (eyeBanner) {
        var lidTop     = eyeBanner.querySelector('.eye-banner__lid--top');
        var lidBot     = eyeBanner.querySelector('.eye-banner__lid--bot');
        var eyeContent = eyeBanner.querySelector('.eye-banner__content');

        if (lidTop && lidBot) {
          /* Set initial closed state */
          gsap.set(lidTop,     { scaleY: 1 });
          gsap.set(lidBot,     { scaleY: 1 });
          if (eyeContent) gsap.set(eyeContent, { opacity: 0, y: 28 });

          /* Scrub timeline — animation follows scroll both directions */
          var eyeTl = gsap.timeline({
            scrollTrigger: {
              trigger: eyeBanner,
              start:   'top 88%',       /* starts closing when banner top hits 88% vh */
              end:     'center 50%',    /* fully open when banner centre reaches mid-screen */
              scrub:   1.4              /* smooth lag — feels like real eyelids */
            }
          });

          /* Lids retract from centre outward (ease:none so scroll drives it 1:1) */
          eyeTl.to(lidTop, { scaleY: 0, ease: 'none', duration: 1 }, 0)
               .to(lidBot, { scaleY: 0, ease: 'none', duration: 1 }, 0);

          /* Content fades in once eye is ~40% open */
          if (eyeContent) {
            eyeTl.to(eyeContent, { opacity: 1, y: 0, ease: 'none', duration: 0.7 }, 0.35);
          }
        }
      }
    }

    /* ---------- Custom Cursor (Seonex dot + ring) ---------- */
    var dot  = document.querySelector('.cursor-dot');
    var ring = document.querySelector('.cursor-ring');
    if (dot && ring && window.matchMedia('(hover:hover)').matches) {
      var moveDot  = gsap ? gsap.quickTo(dot,  'css', { duration: 0.1, ease: 'none' }) : null;
      var moveRing = gsap ? gsap.quickTo(ring, 'css', { duration: 0.28, ease: 'power2.out' }) : null;

      document.addEventListener('mousemove', function (e) {
        var x = e.clientX, y = e.clientY;
        if (moveDot && moveRing) {
          dot.style.left  = x + 'px'; dot.style.top  = y + 'px';
          ring.style.left = x + 'px'; ring.style.top = y + 'px';
        }
      });

      /* Toggle hover class on interactive elements */
      var hoverEls = 'a,button,.btn,.pill-card,.pcard,.team-member,.rcard';
      document.querySelectorAll(hoverEls).forEach(function (el) {
        el.addEventListener('mouseenter', function () { document.body.classList.add('cursor-hover'); });
        el.addEventListener('mouseleave', function () { document.body.classList.remove('cursor-hover'); });
      });
    }

    /* ---------- Universal data-reveal IntersectionObserver ---------- */
    var revealItems = document.querySelectorAll('[data-reveal],[data-reveal-group]');
    if (revealItems.length) {
      var revIO = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (!en.isIntersecting) return;
          en.target.classList.add('in-view');
          revIO.unobserve(en.target);
        });
      }, { threshold: 0.12, rootMargin: '0px 0px -48px 0px' });
      revealItems.forEach(function (el) { revIO.observe(el); });
    }

    /* ---------- Magnetic Buttons ---------- */
    document.querySelectorAll('.btn,.btn-circle-lime').forEach(function (btn) {
      btn.addEventListener('mousemove', function (e) {
        var r = btn.getBoundingClientRect();
        var dx = (e.clientX - (r.left + r.width  / 2)) * 0.28;
        var dy = (e.clientY - (r.top  + r.height / 2)) * 0.28;
        if (hasGsap) {
          gsap.to(btn, { x: dx, y: dy, duration: 0.35, ease: 'power2.out' });
        }
      });
      btn.addEventListener('mouseleave', function () {
        if (hasGsap) {
          gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1,0.5)' });
        }
      });
    });

    /* ---------- Counters — trigger on scroll ---------- */
    var counterEls = document.querySelectorAll('[data-count]');
    if (counterEls.length) {
      var ctIO = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (!en.isIntersecting) return;
          ctIO.unobserve(en.target);
          var el = en.target;
          var target = parseFloat(el.dataset.count);
          var dec    = parseInt(el.dataset.decimals || '0', 10);
          var suffix = el.dataset.suffix || '';
          var start = performance.now();
          var dur = 1700;
          (function tick(now) {
            var p = Math.min((now - start) / dur, 1);
            var eased = 1 - Math.pow(1 - p, 4);
            el.textContent = (eased * target).toLocaleString('en-US', {
              minimumFractionDigits: dec, maximumFractionDigits: dec
            }) + suffix;
            if (p < 1) requestAnimationFrame(tick);
          })(start);
        });
      }, { threshold: 0.5 });
      counterEls.forEach(function (el) { el.textContent = '0'; ctIO.observe(el); });
    }

    initSwipers(false);


    /* ---------- Legacy fade-up (pages not yet migrated) ---------- */
    var fades = document.querySelectorAll('.fade-up');
    if (fades.length) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (!en.isIntersecting) return;
          en.target.classList.add('in-view');
          io.unobserve(en.target);
        });
      }, { threshold: .08, rootMargin: '0px 0px -50px 0px' });
      fades.forEach(function (el) { io.observe(el); });
    }
  });

  /* =====================================================
     Swiper init
     ===================================================== */
  function initSwipers(noAuto) {
    if (!window.Swiper) return;

    document.querySelectorAll('[data-swiper]').forEach(function (el) {
      var kind   = el.dataset.swiper;
      var scope  = el.closest('[data-swiper-scope]') || el.parentElement;
      var prevEl = scope.querySelector('[data-swiper-prev]');
      var nextEl = scope.querySelector('[data-swiper-next]');

      var opts = { slidesPerView: 1, spaceBetween: 24 };
      if (kind === 'blog')     opts.breakpoints = { 640: { slidesPerView: 2 }, 1100: { slidesPerView: 2 } };
      if (kind === 'showcase') opts.breakpoints = { 768: { slidesPerView: 1 } };
      if (!noAuto) opts.autoplay = { delay: 6000, pauseOnMouseEnter: true };

      var sw = new window.Swiper(el, opts);

      // Wire the buttons explicitly so prev really goes back, and reflect
      // the disabled state at either end.
      function syncEnds() {
        if (prevEl) prevEl.classList.toggle('is-disabled', sw.isBeginning);
        if (nextEl) nextEl.classList.toggle('is-disabled', sw.isEnd);
        if (prevEl) prevEl.disabled = sw.isBeginning;
        if (nextEl) nextEl.disabled = sw.isEnd;
      }
      prevEl && prevEl.addEventListener('click', function () { sw.slidePrev(); });
      nextEl && nextEl.addEventListener('click', function () { sw.slideNext(); });
      sw.on('slideChange', syncEnds);
      sw.on('resize', syncEnds);
      syncEnds();
    });
  }
})();
