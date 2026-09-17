<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle      = 'About Us | Peace Automation';
require_once __DIR__ . '/includes/header.php';
?>

<main>

<!-- ============ AB1 HERO ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Engineering Excellence — <em>Karachi's Trusted Partner</em></span>
      <h1>Transforming<br>Facilities Into<br>Secure Spaces</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>About Us</span>
      </nav>
      <a href="contact.php" class="btn btn--primary" style="margin-top:32px">
        Get a free quote <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('project-1.webp', 'Peace Automation security engineers in Karachi', 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">7+</span><span class="l">Years of<br>Excellence</span></div>
      <div class="svc-hero__pill"><?= icon('shield') ?><span>Established in Karachi</span></div>
    </div>
  </div>
</section>

<!-- ============ AB2 INTRO ============ -->
<section class="ab-intro-sec">
  <div class="container">
    <div class="ab-intro-head" style="text-align:center; margin-bottom:60px;">
      <span class="eyebrow" style="color:var(--ink); text-transform:none; font-weight:600;">We don't guess — <em style="color:var(--body); font-style:italic;">we grow.</em></span>
      <h2 id="abIntroHeading" style="max-width:1000px; margin:16px auto 0; font-size:clamp(2.5rem, 4.5vw, 4rem) !important; font-weight:800 !important; line-height:1.1 !important; color:var(--ink) !important;">We are a team of passionate security strategists, engineers, and analysts dedicated to growing businesses</h2>
      <p style="max-width:700px; margin:24px auto 0; color:var(--body); font-size:1.1rem; line-height:1.6;">We are a results-driven automation agency committed to helping organizations grow in an ever-evolving digital world focusing on measurable security results.</p>
    </div>
    
    <style>
      .ab-intro-row {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 24px;
        align-items: stretch;
        max-height: 420px;
      }
      @media (max-width: 992px) {
        .ab-intro-row { grid-template-columns: 1fr; max-height: none; }
      }
      /* Left Image */
      .ab-intro-left {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        height: 420px;
      }
      .ab-intro-left img {
        width: 100%; height: 100%;
        object-fit: cover; display: block;
      }
      .ab-intro-play {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 56px; height: 56px;
        border-radius: 50%;
        background: var(--lime);
        display: grid; place-items: center;
        z-index: 3;
        box-shadow: 0 4px 20px rgba(0,0,0,.25);
        transition: transform .3s var(--ease);
        text-decoration: none;
      }
      .ab-intro-play:hover { transform: translate(-50%, -50%) scale(1.1); }
      .ab-intro-play svg { width: 20px; height: 20px; fill: var(--ink); }
      /* Right Card */
      .ab-intro-right {
        border-radius: 16px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--navy-900) 40%, #3b1f8e 80%, #6c3ce0 100%);
        padding: clamp(32px, 4vw, 48px);
        display: flex; flex-direction: column; justify-content: space-between;
        position: relative;
        color: #fff;
        height: 420px;
      }
      .ab-intro-right::after {
        content: '';
        position: absolute; top: 0; right: 0;
        width: 50%; height: 100%;
        background: radial-gradient(ellipse at 100% 50%, rgba(108,60,224,.4) 0%, transparent 70%);
        pointer-events: none;
      }
      .ab-intro-quote {
        font-size: clamp(1.15rem, 1.8vw, 1.4rem);
        font-weight: 600;
        line-height: 1.5;
        color: #fff;
        margin: 0 0 auto;
        position: relative; z-index: 2;
      }
      .ab-intro-author {
        display: flex; align-items: center; gap: 14px;
        margin-top: 24px;
        position: relative; z-index: 2;
      }
      .ab-intro-author-img {
        position: relative;
      }
      .ab-intro-author-img img {
        width: 50px; height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255,255,255,.15);
      }
      .ab-intro-author-img .ab-q-icon {
        position: absolute;
        bottom: -4px; right: -10px;
        width: 28px; height: 28px;
        border-radius: 50%;
        background: var(--lime);
        display: grid; place-items: center;
        font-size: .85rem; font-weight: 900;
        color: var(--ink); line-height: 1;
      }
      .ab-intro-author h4 {
        color: #fff; font-size: 1rem; font-weight: 700; margin: 0;
      }
      .ab-intro-author span {
        color: rgba(255,255,255,.6); font-size: .85rem;
      }
    </style>

    <div class="ab-intro-row">
      <!-- LEFT: Image + Play -->
      <div class="ab-intro-left">
        <?= img('service-fire-alarm.webp', 'Team working', 800, 500, ['style' => 'width:100%; height:100%; object-fit:cover; display:block;']) ?>
        <a href="#" class="ab-intro-play" aria-label="Play Video">
          <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        </a>
      </div>

      <!-- RIGHT: Quote Slider Card -->
      <div class="ab-intro-right">
        <div class="swiper ab-quote-swiper" style="width:100%; position:relative; z-index:2;">
          <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide" style="display:flex; flex-direction:column; justify-content:space-between; height:auto;">
              <p class="ab-intro-quote">"A reliable and strategic team that understands digital growth and delivers measurable results."</p>
              <div class="ab-intro-author">
                <div class="ab-intro-author-img">
                  <img src="<?= asset('images/avatars/t-1.webp') ?>" alt="Michael Anderson">
                  <span class="ab-q-icon">❝</span>
                </div>
                <div>
                  <h4>Michael Anderson</h4>
                  <span>CEO & Founder</span>
                </div>
              </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide" style="display:flex; flex-direction:column; justify-content:space-between; height:auto;">
              <p class="ab-intro-quote">"Their innovative automation solutions helped us reduce operational risks and scale effectively."</p>
              <div class="ab-intro-author">
                <div class="ab-intro-author-img">
                  <img src="<?= asset('images/avatars/t-3.webp') ?>" alt="Sarah Connor">
                  <span class="ab-q-icon">❝</span>
                </div>
                <div>
                  <h4>Sarah Connor</h4>
                  <span>Operations Director</span>
                </div>
              </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide" style="display:flex; flex-direction:column; justify-content:space-between; height:auto;">
              <p class="ab-intro-quote">"Peace Automation transformed our facility with cutting-edge security. Professional, reliable, and always available."</p>
              <div class="ab-intro-author">
                <div class="ab-intro-author-img">
                  <img src="<?= asset('images/avatars/t-5.webp') ?>" alt="James Wilson">
                  <span class="ab-q-icon">❝</span>
                </div>
                <div>
                  <h4>James Wilson</h4>
                  <span>Plant Manager</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ============ AB3 STATS ============ -->
<section class="ab-stats-sec" style="margin-top:60px;">
  <div class="container">
    <div class="ab-stats-grid">
      <div class="ab-stat">
        <div class="ab-stat-circle"><div class="ab-stat-circle-inner"><h3>99%</h3></div></div>
        <span class="ab-stat-label">(Client Satisfaction)</span>
        <p class="ab-stat-desc">We deliver is guided by your goals expectations communication.</p>
      </div>
      <div class="ab-stat">
        <div class="ab-stat-circle"><div class="ab-stat-circle-inner"><h3>93%</h3></div></div>
        <span class="ab-stat-label">(Increase in Security)</span>
        <p class="ab-stat-desc">We deliver is guided by your goals expectations communication.</p>
      </div>
      <div class="ab-stat">
        <div class="ab-stat-circle"><div class="ab-stat-circle-inner"><h3>90%</h3></div></div>
        <span class="ab-stat-label">(Boost Efficiency)</span>
        <p class="ab-stat-desc">We deliver is guided by your goals expectations communication.</p>
      </div>
      <div class="ab-stat">
        <div class="ab-stat-circle"><div class="ab-stat-circle-inner"><h3>20+</h3></div></div>
        <span class="ab-stat-label">(Supported Regions)</span>
        <p class="ab-stat-desc">We deliver is guided by your goals expectations communication.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ AB4 BANNER PARALLAX ============ -->
<section class="ab-banner-sec" id="abBanner">
  <div class="ab-banner-bg">
    <?= img('tech-warehouse-cam.webp', 'Warehouse cameras', 1920, 1080) ?>
  </div>
  <div class="ab-banner-content" id="abBannerContent">
    <span class="eyebrow" style="letter-spacing:1px;font-size:0.95rem;">GET CONSULTATIONS - <em style="color:var(--blue-600)">WORK TOGETHER</em></span>
    <h2>Let's build a smarter automation strategy</h2>
    <a href="contact.php" class="btn btn--primary" style="background:var(--lime);color:var(--ink);border:none;">
      GET STARTED <span class="btn__chip" style="background:var(--ink);color:var(--lime);"><?= icon('arrow') ?></span>
    </a>
  </div>
</section>

<!-- ============ AB5 TEAM ============ -->
<section class="ab-team-sec">
  <div class="container">
    <div class="ab-team-top">
      <div style="flex:1;">
        <span class="eyebrow" style="color:var(--body);letter-spacing:1px;">MEET OUR PROFESSIONALS — <em style="color:var(--ink)">100+ MEMBERS.</em></span>
        <h2 class="ab-team-heading">Meet our professional team members</h2>
      </div>
      <div style="text-align:right;flex:0 1 400px;">
        <p style="color:var(--body);font-size:1.1rem;line-height:1.6;margin-bottom:24px;">Team is made up of talented professionals who bring creativity, strategy, and technical expertise.</p>
        <a href="about.php" class="btn btn--primary btn--exp">
          VIEW ALL MEMBERS <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>

    <div class="ab-team-grid">
      <div class="ab-team-member">
        <div class="ab-team-photo"><?= img('avatars/t-1.webp', 'Alexander', 300, 300) ?></div>
        <div class="ab-team-name">Alexander Mitchell</div>
        <div class="ab-team-role">Head of IT Operations</div>
        <span class="ab-team-plus">+</span>
      </div>
      <div class="ab-team-member">
        <div class="ab-team-photo"><?= img('avatars/t-2.webp', 'Christopher', 300, 300) ?></div>
        <div class="ab-team-name">Christopher Langford</div>
        <div class="ab-team-role">Project Manager</div>
        <span class="ab-team-plus">+</span>
      </div>
      <div class="ab-team-member">
        <div class="ab-team-photo"><?= img('avatars/t-3.webp', 'Nathaniel', 300, 300) ?></div>
        <div class="ab-team-name">Nathaniel Blackwood</div>
        <div class="ab-team-role">Cybersecurity Lead</div>
        <span class="ab-team-plus">+</span>
      </div>
      <div class="ab-team-member">
        <div class="ab-team-photo"><?= img('avatars/t-4.webp', 'Theodore', 300, 300) ?></div>
        <div class="ab-team-name">Theodore Carrington</div>
        <div class="ab-team-role">Lead Automation Designer</div>
        <span class="ab-team-plus">+</span>
      </div>
    </div>
  </div>
</section>

<!-- ============ MARQUEE RIBBONS (Between Team & Process) ============ -->
<div class="ab-marquee-bridge" style="position:relative; height:0; z-index:10; overflow:visible;">
  <div class="ab-marquee-wrapper ab-mq-1" style="position:absolute; top:-60px; left:-5%; width:110%;">
    <div class="ab-mq-inner">
      <span>✳ Industrial Automation</span>
      <span>✳ Access Control</span>
      <span>✳ Surveillance</span>
      <span>✳ IoT Solutions</span>
      <span>✳ Fire Safety</span>
      <span>✳ Industrial Automation</span>
      <span>✳ Access Control</span>
      <span>✳ Surveillance</span>
      <span>✳ IoT Solutions</span>
      <span>✳ Fire Safety</span>
    </div>
  </div>
  <div class="ab-marquee-wrapper ab-mq-2" style="position:absolute; top:-30px; left:-5%; width:110%;">
    <div class="ab-mq-inner">
      <span>✳ Smart Analytics</span>
      <span>✳ Network Security</span>
      <span>✳ Cloud Integration</span>
      <span>✳ Process Optimization</span>
      <span>✳ Data Protection</span>
      <span>✳ Smart Analytics</span>
      <span>✳ Network Security</span>
      <span>✳ Cloud Integration</span>
      <span>✳ Process Optimization</span>
      <span>✳ Data Protection</span>
    </div>
  </div>
</div>

<!-- ============ AB6 PROCESS (STEPS) ============ -->
<section class="ab-process-sec" style="padding-top:100px;">
  <div class="container">
    <div class="ab-process-head">
      <span class="eyebrow" style="color:#fff; text-transform:none;">Driven by Strategy. <em style="color:var(--lime); font-style:italic;">Focused on Results.</em></span>
      <h2 class="anim-heading">We build customized automation solutions connecting facilities with the right security focus is on transparency, performance</h2>
    </div>

    <div class="ab-process-images">
      <div class="ab-process-img"><?= img('project-1.webp', 'Team', 400, 300) ?></div>
      <div class="ab-process-img"><?= img('project-2.webp', 'Working', 400, 300) ?></div>
      <div class="ab-process-img"><?= img('project-3.webp', 'Setup', 400, 300) ?></div>
      <div class="ab-process-img"><?= img('tech-warehouse-cam.webp', 'Office', 400, 300) ?></div>
    </div>

    <p class="ab-process-text">You always know what's working. Our clear reports, honest communication, and performance tracking keep you informed and confident at every step.</p>

    <div class="ab-process-steps">
      <div class="ab-step">
        <div class="ab-step-num">01</div>
        <h3>Data-Driven Strategies</h3>
        <p>We don't guess—we analyze. Every system is powered by real data, facility insights, and performance metrics to ensure measurable safety.</p>
      </div>
      <div class="ab-step">
        <div class="ab-step-num">02</div>
        <h3>Full-Service Expertise</h3>
        <p>From advanced CCTV and access control to full industrial automation, we provide complete solutions under one roof—saving you complexity.</p>
      </div>
      <div class="ab-step">
        <div class="ab-step-num">03</div>
        <h3>Customized Growth Solutions</h3>
        <p>No one-size-fits-all plans. We tailor strategies to your facility goals, industry requirements, and infrastructure for sustainable success.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ AB7 TESTIMONIALS ============ -->
<section class="ab-testi-sec">
  <div class="container">
    <span class="eyebrow" style="color:var(--body); text-transform:none;">Clients Testimonials — <strong style="color:var(--ink);">4.9/5 (300+ Reviews).</strong></span>
    <h2 class="anim-heading">Clients' feedback reflects the trust results, & long partnerships.</h2>
    
    <div class="swiper ab-testi-swiper">
      <div class="swiper-wrapper">
        <!-- Testimonial 1 -->
        <div class="swiper-slide">
          <div class="ab-testi-card">
            <div>
              <div class="ab-testi-stars">Rating 
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
              </div>
              <p>"Their automation strategies delivered real, measurable growth for our facility. Security increased, operations improved, and compliance followed. Clear communication made them a trusted partner."</p>
            </div>
            <div class="ab-testi-avatar"><img src="<?= asset('images/avatars/t-1.webp') ?>" alt="Client"></div>
          </div>
        </div>
        
        <!-- Testimonial 2 -->
        <div class="swiper-slide">
          <div class="ab-testi-card">
            <div>
              <div class="ab-testi-stars">Rating 
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
              </div>
              <p>"From access control to site-wide surveillance, everything was well-planned and performance-driven. We saw steady improvement across all channels. A professional team that truly understands digital security."</p>
            </div>
            <div class="ab-testi-avatar"><img src="<?= asset('images/avatars/t-2.webp') ?>" alt="Client"></div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="swiper-slide">
          <div class="ab-testi-card">
            <div>
              <div class="ab-testi-stars">Rating 
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
              </div>
              <p>"They transformed our online presence with smart strategy and creative execution. The results were transparent and easy to track. We highly recommend them for any growing business needing automation."</p>
            </div>
            <div class="ab-testi-avatar"><img src="<?= asset('images/avatars/t-3.webp') ?>" alt="Client"></div>
          </div>
        </div>
        
        <!-- Testimonial 4 -->
        <div class="swiper-slide">
          <div class="ab-testi-card">
            <div>
              <div class="ab-testi-stars">Rating 
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
              </div>
              <p>"Their integration of IoT systems into our existing infrastructure was seamless. Everything works exactly as promised, saving us time and ensuring security around the clock."</p>
            </div>
            <div class="ab-testi-avatar"><img src="<?= asset('images/avatars/t-4.webp') ?>" alt="Client"></div>
          </div>
        </div>

      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  /* 1. Hero Text Animation */
  var words = document.querySelectorAll('.ab-word');
  if(words.length) {
    // Initial state
    gsap.set(words, { y: 40, opacity: 0 });
    // Animate in
    gsap.to(words, {
      y: 0,
      opacity: 1,
      duration: 0.8,
      stagger: 0.1,
      ease: 'power3.out',
      delay: 0.2
    });
  }
  
  var heroImg = document.querySelector('.ab-hero__img');
  if(heroImg) {
    gsap.from(heroImg, {
      x: 60, opacity: 0, duration: 1, ease: 'power3.out', delay: 0.4
    });
  }

  /* 2. Banner Parallax Scroll Animation */
  var bannerSec = document.getElementById('abBanner');
  var bannerContent = document.getElementById('abBannerContent');
  
  if (bannerSec && bannerContent) {
    gsap.to(bannerContent, {
      // offsetTop handles the CSS top:15%, so we subtract it from the total movement
      y: () => bannerSec.offsetHeight - bannerContent.offsetTop - bannerContent.offsetHeight - 140, // Stops 140px safely above the bottom
      ease: 'none',
      scrollTrigger: {
        trigger: bannerSec,
        start: 'top top',    
        end: 'bottom bottom', 
        scrub: 1.2
      }
    });
  }
  // Initialize Swiper for the quote card
  if (document.querySelector('.ab-quote-swiper')) {
    new Swiper('.ab-quote-swiper', {
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      effect: 'fade',
      fadeEffect: { crossFade: true },
      pagination: {
        el: '.ab-quote-swiper .swiper-pagination',
        clickable: true,
      },
    });
  }

  // Initialize Swiper for the Testimonials section
  if (document.querySelector('.ab-testi-swiper')) {
    new Swiper('.ab-testi-swiper', {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 20,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.ab-testi-swiper .swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        768: { slidesPerView: 2, spaceBetween: 30 },
        1024: { slidesPerView: 3, spaceBetween: 30 }
      }
    });
  }

  // Generalized Split text & Stagger Animation for ALL designated headings
  var animHeadings = document.querySelectorAll('#abIntroHeading, .anim-heading, .ab-team-heading');
  animHeadings.forEach(function(heading) {
    if (heading) {
      // Avoid splitting if it's already split
      if (heading.querySelector('.ab-word')) return;
      
      var words = heading.innerText.split(' ');
      heading.innerHTML = '';
      words.forEach(function(word) {
        var span = document.createElement('span');
        span.className = 'ab-word';
        span.innerText = word + ' ';
        heading.appendChild(span);
      });
      
      gsap.fromTo(heading.querySelectorAll('.ab-word'), 
        { y: 40, opacity: 0 },
        { 
          y: 0, opacity: 1, 
          stagger: 0.03, 
          duration: 0.8, 
          ease: 'power3.out',
          scrollTrigger: {
            trigger: heading,
            start: 'top 85%'
          }
        }
      );
    }
  });

});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
