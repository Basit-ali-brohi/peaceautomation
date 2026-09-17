<!-- ============ 14. PACKAGES ============ -->
<section class="section-y section-light">
  <div class="container-x">

    <div class="max-w-2xl mb-14 fade-up">
      <span class="section-label mb-5">
        <span class="rule"></span>
        Packages
        <span class="dot"></span>
        Supplied, installed, configured
      </span>
      <h2>Straightforward pricing, no hidden extras.</h2>
      <p class="measure mt-5" style="color:var(--body-dark)">
        Every package includes the survey, hardware, installation, cabling and app setup.
        Final price depends on cable runs and camera positions — the survey confirms it.
      </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 items-start">
      <?php foreach (site('packages') as $pkg): ?>
      <div class="rounded-2xl p-8 relative fade-up"
           style="background:var(--bg-light); border:<?= $pkg['popular'] ? '2px solid var(--accent)' : '1px solid var(--border-light)' ?>">

        <?php if ($pkg['popular']): ?>
        <span class="absolute -top-3 left-8 px-3.5 py-1 rounded-full text-xs font-semibold"
              style="background:var(--accent); color:var(--accent-ink)">Most popular</span>
        <?php endif; ?>

        <h3 class="mb-1" style="color:var(--heading-dark)"><?= htmlspecialchars($pkg['name']) ?></h3>
        <p class="text-sm mb-6" style="color:var(--body-dark)"><?= htmlspecialchars($pkg['cameras']) ?></p>

        <p class="mb-7">
          <span class="text-xs uppercase tracking-wide block mb-1" style="color:var(--body-dark); opacity:.7">From</span>
          <span class="text-3xl font-semibold" style="color:var(--heading-dark); font-variant-numeric:tabular-nums">
            <?= htmlspecialchars($pkg['price']) ?>
          </span>
        </p>

        <ul class="space-y-3 mb-8">
          <?php foreach ($pkg['includes'] as $inc): ?>
          <li class="flex items-start gap-3 text-sm" style="color:var(--body-dark)">
            <span class="check-bullet mt-0.5"><i class="fa-solid fa-check"></i></span>
            <?= htmlspecialchars($inc) ?>
          </li>
          <?php endforeach; ?>
        </ul>

        <a href="contact.php" class="<?= $pkg['popular'] ? 'btn-primary' : 'btn-secondary' ?> w-full justify-center">
          Get this package
          <span class="btn-ico"><i class="fa-solid fa-arrow-right"></i></span>
        </a>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="text-xs mt-8 text-center" style="color:var(--body-dark); opacity:.7">
      Prices pending — set them in <code>config/site.php → packages</code>
    </p>
  </div>
</section>
