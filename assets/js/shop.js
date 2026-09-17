/* =========================================================
   Peace Automation — shop behaviour
   Cart calls, quantity steppers, product gallery, tabs, toasts.
   Every page gets this file; each block exits early when its
   markup is not on the page.
   ========================================================= */
(function () {
  'use strict';

  var CSRF = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';
  var API  = 'api/cart.php';

  /* ---------- toast ---------- */
  var toastEl = null;
  var toastTimer;

  function toast(message, isError) {
    if (!toastEl) {
      toastEl = document.createElement('div');
      toastEl.className = 'shop-toast';
      toastEl.setAttribute('role', 'status');
      toastEl.setAttribute('aria-live', 'polite');
      document.body.appendChild(toastEl);
    }
    toastEl.textContent = message;
    toastEl.classList.toggle('is-error', !!isError);
    toastEl.classList.add('is-on');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { toastEl.classList.remove('is-on'); }, 2800);
  }

  /* ---------- cart API ---------- */
  function post(action, data) {
    var body = new FormData();
    body.append('action', action);
    body.append('csrf_token', CSRF);
    Object.keys(data || {}).forEach(function (k) { body.append(k, data[k]); });

    return fetch(API, { method: 'POST', body: body, credentials: 'same-origin' })
      .then(function (r) { return r.json().then(function (j) { return { ok: r.ok, json: j }; }); })
      .then(function (res) {
        if (!res.ok || !res.json.ok) {
          throw new Error(res.json.message || 'Something went wrong. Please try again.');
        }
        paintCount(res.json.cart.count);
        return res.json;
      });
  }

  function paintCount(n) {
    document.querySelectorAll('[data-cart-count]').forEach(function (el) { el.textContent = n; });
    var btn = document.getElementById('header-cart');
    if (btn) { btn.classList.toggle('has-items', n > 0); }
  }

  /* ---------- add to cart (grid cards + detail page) ---------- */
  document.addEventListener('click', function (ev) {
    var btn = ev.target.closest('[data-add-to-cart]');
    if (!btn) { return; }
    ev.preventDefault();

    // Cards have no quantity field; only the detail page points at one.
    var qtySel   = btn.dataset.qtyFrom;
    var qtyInput = qtySel ? document.querySelector(qtySel) : null;
    var qty      = qtyInput ? Math.max(1, parseInt(qtyInput.value, 10) || 1) : 1;
    var label    = btn.textContent;

    btn.disabled = true;
    btn.classList.add('is-busy');

    post('add', { slug: btn.dataset.addToCart, qty: qty })
      .then(function () {
        btn.textContent = 'Added';
        toast(qty > 1 ? qty + ' items added to your cart.' : 'Added to your cart.');
        setTimeout(function () { btn.textContent = label; }, 1600);
      })
      .catch(function (err) { toast(err.message, true); })
      .finally(function () {
        btn.disabled = false;
        btn.classList.remove('is-busy');
      });
  });

  /* ---------- quantity steppers ---------- */
  document.addEventListener('click', function (ev) {
    var step = ev.target.closest('[data-qty-step]');
    if (!step) { return; }

    var wrap  = step.closest('[data-qty]');
    var input = wrap && wrap.querySelector('input');
    if (!input) { return; }

    var min = parseInt(input.min, 10) || 1;
    var max = parseInt(input.max, 10) || 99;
    var next = (parseInt(input.value, 10) || min) + (step.dataset.qtyStep === 'up' ? 1 : -1);

    input.value = Math.min(max, Math.max(min, next));
    input.dispatchEvent(new Event('change', { bubbles: true }));
  });

  /* ---------- cart page lines ---------- */
  var cartPage = document.getElementById('cartLines');
  if (cartPage) {
    // Quantity change → update the line and repaint the totals.
    cartPage.addEventListener('change', function (ev) {
      var input = ev.target.closest('input[data-line-qty]');
      if (!input) { return; }

      post('set', { slug: input.dataset.lineQty, qty: input.value })
        .then(function (res) { paintCartPage(res.cart); })
        .catch(function (err) { toast(err.message, true); });
    });

    cartPage.addEventListener('click', function (ev) {
      var rm = ev.target.closest('[data-line-remove]');
      if (!rm) { return; }
      ev.preventDefault();

      post('remove', { slug: rm.dataset.lineRemove })
        .then(function (res) {
          toast('Item removed.');
          paintCartPage(res.cart);
        })
        .catch(function (err) { toast(err.message, true); });
    });

    var clearBtn = document.getElementById('cartClear');
    if (clearBtn) {
      clearBtn.addEventListener('click', function () {
        if (!window.confirm('Remove everything from your cart?')) { return; }
        post('clear', {})
          .then(function (res) { paintCartPage(res.cart); })
          .catch(function (err) { toast(err.message, true); });
      });
    }
  }

  function paintCartPage(cart) {
    // An emptied cart reloads so the page shows its empty state and the
    // checkout button disappears with it.
    if (!cart.count) { window.location.reload(); return; }

    cart.items.forEach(function (item) {
      var row = document.querySelector('[data-line="' + item.slug + '"]');
      if (!row) { return; }
      var lineEl = row.querySelector('[data-line-total]');
      if (lineEl) { lineEl.textContent = 'Rs ' + item.line.toLocaleString('en-US'); }
    });

    // Drop any row the server no longer has.
    document.querySelectorAll('[data-line]').forEach(function (row) {
      var still = cart.items.some(function (i) { return i.slug === row.dataset.line; });
      if (!still) { row.remove(); }
    });

    document.querySelectorAll('[data-cart-subtotal]').forEach(function (el) {
      el.textContent = cart.subtotal_display;
    });
  }

  /* ---------- product gallery ---------- */
  var gallery = document.getElementById('pdGallery');
  if (gallery) {
    var mainImg = gallery.querySelector('[data-gallery-main] img');
    var thumbs  = gallery.querySelectorAll('[data-gallery-thumb]');

    thumbs.forEach(function (thumb) {
      thumb.addEventListener('click', function () {
        var img = thumb.querySelector('img');
        if (!img || !mainImg) { return; }
        mainImg.src = img.src;
        mainImg.alt = img.alt;
        thumbs.forEach(function (t) { t.classList.remove('is-active'); });
        thumb.classList.add('is-active');
      });
    });

    // Zoom button → full-size overlay
    var zoomBtn = gallery.querySelector('[data-gallery-zoom]');
    if (zoomBtn && mainImg) {
      zoomBtn.addEventListener('click', function () {
        var box = document.createElement('div');
        box.className = 'pd-lightbox';
        box.innerHTML = '<button type="button" class="pd-lightbox__close" aria-label="Close">&times;</button>'
                      + '<img src="' + mainImg.src + '" alt="' + mainImg.alt + '">';
        document.body.appendChild(box);
        document.body.style.overflow = 'hidden';

        function close() {
          box.remove();
          document.body.style.overflow = '';
          document.removeEventListener('keydown', onKey);
        }
        function onKey(e) { if (e.key === 'Escape') { close(); } }

        box.addEventListener('click', function (e) {
          if (e.target === box || e.target.closest('.pd-lightbox__close')) { close(); }
        });
        document.addEventListener('keydown', onKey);
      });
    }
  }

  /* ---------- description / reviews tabs ---------- */
  var tabBar = document.getElementById('pdTabs');
  if (tabBar) {
    var tabs   = tabBar.querySelectorAll('[role="tab"]');
    var panels = document.querySelectorAll('[role="tabpanel"]');

    function selectTab(tab) {
      tabs.forEach(function (t) {
        var on = t === tab;
        t.classList.toggle('is-active', on);
        t.setAttribute('aria-selected', on ? 'true' : 'false');
        t.tabIndex = on ? 0 : -1;
      });
      panels.forEach(function (p) {
        p.hidden = p.id !== tab.getAttribute('aria-controls');
      });
    }

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () { selectTab(tab); });
      tab.addEventListener('keydown', function (e) {
        if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') { return; }
        var list = Array.prototype.slice.call(tabs);
        var next = list[(list.indexOf(tab) + (e.key === 'ArrowRight' ? 1 : -1) + list.length) % list.length];
        selectTab(next);
        next.focus();
      });
    });

    // Deep link: product-detail.php?...#reviews opens the reviews tab.
    if (window.location.hash === '#reviews') {
      var reviewTab = tabBar.querySelector('[aria-controls="pdReviews"]');
      if (reviewTab) { selectTab(reviewTab); }
    }
  }

  /* ---------- star rating input on the review form ---------- */
  var ratePicker = document.getElementById('reviewRating');
  if (ratePicker) {
    var field = ratePicker.querySelector('input[type="hidden"]');
    var stars = ratePicker.querySelectorAll('button');

    function paintStars(value) {
      stars.forEach(function (s, i) { s.classList.toggle('is-on', i < value); });
    }

    stars.forEach(function (star, i) {
      star.addEventListener('click', function () {
        field.value = i + 1;
        paintStars(i + 1);
      });
      star.addEventListener('mouseenter', function () { paintStars(i + 1); });
    });
    ratePicker.addEventListener('mouseleave', function () {
      paintStars(parseInt(field.value, 10) || 0);
    });
    paintStars(parseInt(field.value, 10) || 0);
  }
})();
