<?php
/**
 * All repeatable page content. Templates loop over these arrays — never
 * hardcode a card six times in the markup.
 */

declare(strict_types=1);

return [

/* ============================================================
   SERVICES (7) — used by the mega menu, S4 accordion,
   services.php, service-detail.php and the footer.
   ============================================================ */
'services' => [
    [
        'slug'  => 'cctv-surveillance-systems',
        'title' => 'CCTV Surveillance Systems',
        'icon'  => 'camera',
        'short' => 'Live monitoring and recording across every entry point.',
        'body'  => 'Centralised CCTV enabling real-time monitoring, threat prevention and coordinated response across industrial, commercial and residential sites.',
        'checks'=> ['Live Monitoring', 'Remote Access', 'HD Cameras', 'Secure Recording'],
        'image' => 'service-cctv.webp',
        'thumb' => 'service-thumb-cctv.webp',
    ],
    [
        'slug'  => 'fire-alarm-systems',
        'title' => 'Fire Alarm Systems',
        'icon'  => 'flame',
        'short' => 'Early detection that alerts before a fire takes hold.',
        'body'  => 'Addressable and conventional fire alarm panels, smoke and heat detectors, sounders and strobes — designed to code and commissioned with a full test report.',
        'checks'=> ['Addressable Panels', 'Smoke & Heat Detectors', 'Sounders & Strobes', 'Annual Testing'],
        'image' => 'service-fire-alarm.webp',
        'thumb' => 'service-thumb-fire-alarm.webp',
    ],
    [
        'slug'  => 'fire-fighting-systems',
        'title' => 'Fire Fighting Systems',
        'icon'  => 'droplet',
        'short' => 'Suppression that works the day it is needed.',
        'body'  => 'Hydrant and sprinkler networks, pumps, hose reels and extinguishers — installed, pressure tested and maintained on a documented schedule.',
        'checks'=> ['Hydrant & Sprinkler', 'Pump Rooms', 'Hose Reels', 'Pressure Testing'],
        'image' => 'service-fire-fighting.webp',
        'thumb' => 'service-thumb-fire-fighting.webp',
    ],
    [
        'slug'  => 'access-control-systems',
        'title' => 'Access Control Systems',
        'icon'  => 'fingerprint',
        'short' => 'Decide exactly who gets through which door.',
        'body'  => 'Biometric, card and PIN access across single doors or multi-site estates, with centralised permissions and a full audit trail of every entry.',
        'checks'=> ['Biometric & Face', 'Card & PIN', 'Electric Locks', 'Access Audit Trail'],
        'image' => 'service-access-control.webp',
        'thumb' => 'service-thumb-access-control.webp',
    ],
    [
        'slug'  => 'time-attendance-systems',
        'title' => 'Time Attendance Systems',
        'icon'  => 'clock',
        'short' => 'Attendance data your HR team can actually trust.',
        'body'  => 'Fingerprint and face-recognition terminals integrated with your payroll, producing shift, overtime and absence reports without manual reconciliation.',
        'checks'=> ['Fingerprint & Face', 'Shift Rules', 'Payroll Export', 'Absence Reports'],
        'image' => 'service-attendance.webp',
        'thumb' => 'service-thumb-attendance.webp',
    ],
    [
        'slug'  => 'intrusion-detection-systems',
        'title' => 'Intrusion Detection Systems',
        'icon'  => 'shield',
        'short' => 'Know the moment a perimeter is crossed.',
        'body'  => 'Motion, door and perimeter sensors wired to a central panel with siren, strobe and mobile alerts — zoned so a single trigger tells you exactly where.',
        'checks'=> ['Motion & Door Sensors', 'Perimeter Beams', 'Zoned Alerts', 'Mobile Notifications'],
        'image' => 'service-intrusion.webp',
        'thumb' => 'service-thumb-intrusion.webp',
    ],
    [
        'slug'  => 'gate-barrier-systems',
        'title' => 'Gate Barrier Systems',
        'icon'  => 'barrier',
        'short' => 'Controlled vehicle access without a manned gate.',
        'body'  => 'Boom barriers, sliding gates and bollards integrated with RFID, number-plate recognition or intercom so vehicles are cleared without stopping traffic.',
        'checks'=> ['Boom Barriers', 'RFID & ANPR', 'Intercom Integration', 'Safety Loops'],
        'image' => 'service-gate-barrier.webp',
        'thumb' => 'service-thumb-gate-barrier.webp',
    ],
],

/* ============================================================
   PROJECTS — S10 and portfolio.php / portfolio-detail.php
   ============================================================ */
'projects' => [
    [
        'slug' => 'multi-site-cctv-deployment',
        'title' => 'Multi-Site CCTV Deployment',
        'category' => 'Surveillance', 'location' => 'Karachi', 'year' => '2025',
        'image' => 'project-1.webp',
        'client' => 'National Refinery Limited',
        'summary' => 'Refinery-wide surveillance across process areas, gates and storage, feeding a single control room.',
        'cameras' => '96 cameras', 'hardware' => 'Hikvision IP · 3× 64-ch NVR · PoE backbone',
    ],
    [
        'slug' => 'integrated-fire-safety-system',
        'title' => 'Integrated Fire & Safety System',
        'category' => 'Fire Safety', 'location' => 'Karachi', 'year' => '2024',
        'image' => 'project-2.webp',
        'client' => 'Soorty Enterprises (Pvt) Ltd',
        'summary' => 'Addressable fire alarm and hydrant network across a working textile facility, phased around production.',
        'cameras' => '—', 'hardware' => 'Addressable panel · 400+ detectors · Hydrant ring main',
    ],
    [
        'slug' => 'access-control-rollout',
        'title' => 'Access Control Rollout',
        'category' => 'Access Control', 'location' => 'Karachi', 'year' => '2024',
        'image' => 'project-3.webp',
        'client' => 'Pakistan Air Force',
        'summary' => 'Biometric access and attendance across restricted zones, with centrally managed permissions.',
        'cameras' => '—', 'hardware' => 'Biometric readers · Electric locks · Central controller',
    ],
    [
        'slug' => 'aerial-base-perimeter-security',
        'title' => 'Aerial Base Perimeter Security',
        'category' => 'Defense & Perimeter', 'location' => 'Karachi', 'year' => '2024',
        'image' => 'showcase-1.webp',
        'client' => 'Pakistan Air Force',
        'summary' => 'Perimeter thermal and optical surveillance integrated with rapid response monitoring.',
        'cameras' => '64 cameras', 'hardware' => 'Thermal + PTZ · Fiber ring · Control console',
    ],
    [
        'slug' => 'defense-installation-security',
        'title' => 'Defense Installation Security',
        'category' => 'High Security', 'location' => 'Karachi', 'year' => '2024',
        'image' => 'showcase-2.webp',
        'client' => 'Pakistan Army',
        'summary' => 'Access control, visitor logging and automated surveillance across restricted checkpoints.',
        'cameras' => '48 cameras', 'hardware' => 'Biometric barriers · ANPR · Centralised server',
    ],
    [
        'slug' => 'commercial-facility-automation',
        'title' => 'Commercial Facility Automation',
        'category' => 'Building Automation', 'location' => 'Karachi', 'year' => '2025',
        'image' => 'showcase-3.webp',
        'client' => 'Corporate Plaza',
        'summary' => 'Integrated CCTV, smart access control and automated energy management across a 12-storey tower.',
        'cameras' => '80 cameras', 'hardware' => 'IP cameras · Cloud backup · Smart sensors',
    ],
],

/* ============================================================
   TEAM — S7 Team / Experts Strip
   ============================================================ */
'team' => [
    ['name' => 'Tariq Mehmood',   'role' => 'Chief Systems Architect', 'avatar' => 'avatars/t-1.webp', 'social' => '#'],
    ['name' => 'Farhan Siddiqui', 'role' => 'Lead Security Engineer',  'avatar' => 'avatars/t-2.webp', 'social' => '#'],
    ['name' => 'Asad Ullah',      'role' => 'Automation Specialist',   'avatar' => 'avatars/t-3.webp', 'social' => '#'],
    ['name' => 'Maria Qureshi',   'role' => 'Operations Manager',      'avatar' => 'avatars/t-4.webp', 'social' => '#'],
    ['name' => 'Zeeshan Ali',     'role' => 'Senior Field Technician', 'avatar' => 'avatars/t-5.webp', 'social' => '#'],
],

/* ============================================================
   APPROACH CAPSULES — S6 5-capsule pill gallery
   ============================================================ */
'capsules' => [
    ['image' => 'app-in-hand.webp',         'title' => 'Field Inspection'],
    ['image' => 'tech-warehouse-cam.webp',   'title' => 'Smart Surveillance'],
    ['image' => 'service-cctv.webp',         'title' => 'High Resolution Optics'],
    ['image' => 'service-fire-alarm.webp',   'title' => 'Fire Alarm Safety'],
    ['image' => 'why-dome-camera.webp',      'title' => 'Perimeter Defense'],
],

/* ============================================================
   TIMELINE STEPS — S8 Feature Process
   ============================================================ */
'timeline' => [
    ['no' => '01', 'title' => 'Comprehensive Site Survey', 'desc' => 'On-site technical evaluation to map sightlines, risk zones, and structural routing.'],
    ['no' => '02', 'title' => 'Custom Engineering & Spec', 'desc' => 'Hardware sizing, network topology, storage capacity, and power backup planning.'],
    ['no' => '03', 'title' => 'Precision Installation & Tuning', 'desc' => 'Concealed cabling, sensor placement, NVR configuration, and live angle optimization.'],
    ['no' => '04', 'title' => 'Handover & Documentation', 'desc' => 'Mobile app setup on all client devices, control room training, and test certification.'],
],

/* ============================================================
   REVIEWS — S11
   ============================================================ */
'reviews' => [
    ['name' => 'Ali Raza',    'role' => 'Facility Manager',  'avatar' => 'review-1.webp', 'stars' => 5,
     'text' => 'The install was clean, on schedule, and the control room handover was properly documented. Nothing was left half-finished.'],
    ['name' => 'Usman Khan',  'role' => 'Project Engineer',  'avatar' => 'review-2.webp', 'stars' => 5,
     'text' => 'They flagged two coverage gaps our previous contractor had missed and fixed them within the same quote.'],
    ['name' => 'Hina Sheikh', 'role' => 'Operations Head',   'avatar' => 'review-3.webp', 'stars' => 5,
     'text' => 'Fire alarm commissioning came with a full test report — the first time we have had paperwork we could actually file.'],
    ['name' => 'Bilal Ahmed', 'role' => 'IT Administrator',  'avatar' => 'review-4.webp', 'stars' => 5,
     'text' => 'Remote access was configured and tested on our own network before they left site. Support answers on the first ring.'],
],

/* ============================================================
   BLOG — S12 and blog.php / blog-detail.php
   ============================================================ */
'blog' => [
    ['slug' => 'right-cctv-setup-for-a-warehouse', 'title' => 'How to choose the right CCTV setup for a warehouse',
     'category' => 'Surveillance', 'date' => '2026-08-14', 'author' => 'Peace Automation', 'image' => 'blog-1.webp',
     'excerpt' => 'Racking creates blind spots that catch most installers out. Here is how we plan coverage for high-bay storage.', 'body' => "High-bay racking is what catches most installers out. A camera mounted for an empty floor loses half its usable view the day the racks fill up, and the aisles become long dark corridors that a wide-angle lens simply cannot resolve.|We plan warehouse coverage around three separate jobs: the perimeter and loading bays, the aisles, and the dispatch desk. Perimeter cameras want a wide field of view and good low-light performance. Aisle cameras want a narrower lens mounted along the run, not across it. The dispatch desk wants enough resolution to read a label.|Storage is the other thing people underestimate. A 16-camera site recording continuously at 4MP fills a 4TB disk in well under two weeks. We size the recorder for the retention you actually need, and set motion-based schedules on the low-traffic zones so the disk is spent where it matters."],
    ['slug' => 'addressable-vs-conventional-fire-alarms', 'title' => 'Addressable vs conventional fire alarm panels',
     'category' => 'Fire Safety', 'date' => '2026-08-02', 'author' => 'Peace Automation', 'image' => 'blog-2.webp',
     'excerpt' => 'Which panel type suits your building, and why the cheaper option often costs more over ten years.', 'body' => "A conventional panel divides the building into zones. When a detector triggers, the panel tells you which zone — not which device. In a small unit that is fine. In a three-floor building it means walking the floor to find the device that went off.|An addressable panel gives every detector its own identity. The panel names the exact device and location, which turns a ten-minute search into a ten-second read. It also monitors each device's health, so a dirty or failing detector is flagged before it causes a false alarm.|The cheaper option usually costs more over ten years. False alarms carry real cost in evacuations and lost production, and conventional systems are harder to extend — adding a zone often means pulling new cable rather than adding a device to an existing loop."],
    ['slug' => 'biometric-access-for-multi-site-offices', 'title' => 'Biometric access control across multiple offices',
     'category' => 'Access Control', 'date' => '2026-07-21', 'author' => 'Peace Automation', 'image' => 'blog-3.webp',
     'excerpt' => 'Centralised permissions, shared audit trails, and the mistakes that make multi-site rollouts painful.', 'body' => "The mistake we see most often is treating each branch as its own island. Separate controllers, separate user lists, separate spreadsheets. When someone leaves, their access has to be revoked three times, and it usually is not.|A multi-site rollout should have one permission model. Users and groups are defined centrally, each door belongs to a group, and revoking access once removes it everywhere. The audit trail lands in one place, which matters when you actually need to answer who opened what and when.|Plan the fallback before you plan the readers. Network drops, and a door that fails locked traps people while a door that fails open protects nobody. Each door needs a deliberate decision, documented, and tested at handover."],
    ['slug' => 'ai-surveillance-analytics-real-world-roi', 'title' => 'How AI video analytics cut false alarms in industrial sites',
     'category' => 'Automation', 'date' => '2026-06-28', 'author' => 'Peace Automation', 'image' => 'service-cctv.webp',
     'excerpt' => 'Traditional motion detection triggers on rain and leaves. Here is how deep-learning classification filters noise.', 'body' => "Traditional video motion detection counts pixels. When headlights sweep across a yard, a stray dog trots past, or heavy monsoon rain falls, the recorder flags an event and sounds an alarm. Security teams quickly suffer alarm fatigue and start ignoring alerts.|AI-powered cameras replace pixel-counting with trained object classification models. The neural processor recognizes human forms and vehicle profiles in real-time, completely ignoring animals, blowing foliage, shadows, and weather phenomena.|For industrial plants and perimeter sites, this cuts false alerts by over 95%. When a real perimeter line is crossed, the security operations center receives an instantaneous verified notification with an automated snapshot."],
    ['slug' => 'fire-safety-compliance-karachi-buildings', 'title' => 'Fire safety compliance checklist for commercial buildings',
     'category' => 'Fire Safety', 'date' => '2026-06-15', 'author' => 'Peace Automation', 'image' => 'service-fire-alarm.webp',
     'excerpt' => 'Everything building administrators need to verify before civil defense and municipal audits.', 'body' => "Building codes in Karachi require commercial, educational, and high-rise residential properties to maintain documented fire detection and suppression systems. During annual audits, inspectors look for documented maintenance logs, not just installed hardware.|Key compliance checkpoints include: certified addressable smoke and heat detector coverage in all enclosed spaces, dual power source battery standby on alarm panels (minimum 24-hour backup), clear sounder audibility exceeding 85dB across all zones, and manual call points within 30 meters of any exit route.|Peace Automation provides turnkey engineering audits, testing every single detector, sounder, and water flow switch, and issuing a certified commissioning test log ready for inspection."],
],

/* ============================================================
   INDUSTRIES — industries.php
   ============================================================ */
'industries' => [
    ['title' => 'Banks & Financial',      'image' => 'industry-bank.webp',       'text' => 'Vault, counter and ATM coverage with tamper alerts.'],
    ['title' => 'Corporate Offices',      'image' => 'industry-office.webp',     'text' => 'Reception, floor and server-room access control.'],
    ['title' => 'Educational Institutes', 'image' => 'industry-education.webp',  'text' => 'Corridors, gates and campus perimeter monitoring.'],
    ['title' => 'Factories',              'image' => 'industry-factory.webp',    'text' => 'Production floor, stores and fire safety integration.'],
    ['title' => 'Government',             'image' => 'industry-government.webp', 'text' => 'Restricted-zone access with full audit trails.'],
    ['title' => 'Hospitals',              'image' => 'industry-hospital.webp',   'text' => 'Wards, pharmacy and emergency-exit compliance.'],
    ['title' => 'Retail & Malls',         'image' => 'industry-mall.webp',       'text' => 'Shop floor, till points and loading bays.'],
    ['title' => 'Residential',            'image' => 'industry-residential.webp','text' => 'Entry gates, driveways and video door phones.'],
    ['title' => 'Warehousing',            'image' => 'industry-warehouse.webp',  'text' => 'High-bay racking, docks and perimeter beams.'],
],

/* ============================================================
   CLIENTS — S13 logo strip
   ============================================================ */
// Only real client logos we actually hold. Entries whose file is missing are
// skipped at render time rather than drawn as an empty box — add more here as
// the artwork arrives in assets/images/clients/.
'clients' => [
    ['name' => 'Pakistan Army',             'logo' => 'clients/client-1.png'],
    ['name' => 'Pakistan Air Force',        'logo' => 'clients/client-2.png'],
    ['name' => 'National Refinery Limited', 'logo' => 'clients/client-3.png'],
    ['name' => 'Soorty Enterprises',        'logo' => 'clients/client-4.png'],
],

/* ============================================================
   APPROACH STEPS — S6
   ============================================================ */
'steps' => [
    ['no' => '01', 'icon' => 'pin',   'title' => 'Site Analysis & Planning',
     'text' => 'We walk the site, map coverage and risk, and agree exactly what needs protecting before anything is quoted.'],
    ['no' => '02', 'icon' => 'cpu',   'title' => 'System Design & Engineering',
     'text' => 'Cameras, panels and cable routes are specified to the building — not to a generic package sheet.'],
    ['no' => '03', 'icon' => 'check', 'title' => 'Installation & Optimization',
     'text' => 'Installed, commissioned, tested and tuned, then handed over with documentation and training.'],
],

/* ============================================================
   WHY CHOOSE US — S9 icon accordion
   ============================================================ */
'strengths' => [
    ['icon' => 'headset',     'title' => 'Reliable Systems, Clear Communication',
     'text' => 'One point of contact from survey to handover, and a straight answer about what you do and do not need.'],
    ['icon' => 'nodes',        'title' => 'System Integration',
     'text' => 'CCTV, access control, attendance and fire alarm brought onto one platform instead of four disconnected systems.'],
    ['icon' => 'cpu',         'title' => 'Smart Automation',
     'text' => 'Scheduling, alerts and automated responses so the system acts on an event rather than just recording it.'],
    ['icon' => 'shield-check',      'title' => 'Security Design',
     'text' => 'Coverage planned around real risk and sightlines, with blind spots identified before a single cable is run.'],
],

/* ============================================================
   MARQUEE — S5
   ============================================================ */
'ticker' => ['Video Monitoring', 'Alarm Systems', 'CCTV Surveillance', 'Safety Solutions', 'Secure Entry',
             'Remote Access', 'Asset Protection', 'Fire Alarm', 'Fire Fighting', 'Automation'],

/* ============================================================
   PRODUCT CATEGORIES — sidebar filter on products.php
   ============================================================ */
'product_categories' => [
    'surveillance' => 'CCTV Surveillance',
    'access'       => 'Access Control',
    'fire'         => 'Fire & Safety',
    'barriers'     => 'Gate Barriers',
],

/* ============================================================
   PRODUCT FEATURES — checkbox filter on products.php
   ============================================================ */
'product_features' => [
    'night'   => 'Night Vision',
    'network' => 'Cloud / TCP-IP',
    'bio'     => 'Biometric',
    'weather' => 'Weatherproof',
    'vandal'  => 'Vandal Proof',
],

/* ============================================================
   PRODUCTS — products.php grid, product-detail.php, cart + checkout.
   'price' / 'old_price' are in PKR rupees (integers, no decimals).
   TODO: replace the placeholder prices with the real trade prices.
   ============================================================ */
'products' => [
    [
        'slug'      => '4k-ultra-hd-ai-bullet-camera',
        'name'      => '4K Ultra-HD AI Bullet Camera',
        'category'  => 'surveillance',
        'badge'     => 'Best Seller',
        'sku'       => 'PA-CAM-4K01',
        'price'     => 18500,
        'old_price' => 22000,
        'highlight' => '8MP 4K Sensor',
        'sub'       => 'Perimeter Grade',
        'short'     => 'Designed for building perimeters, parking lots, and compound boundaries with deep-learning human and vehicle classification that keeps false alerts off your monitoring screen.',
        'specs'     => ['8MP 4K Sensor', '60m Smart IR Night Vision', 'IP67 Metal Housing'],
        'features'  => ['night', 'weather', 'network'],
        'tags'      => ['CCTV', 'IP67', 'Night Vision'],
        'image'     => 'why-dome-camera.webp',
        'gallery'   => ['surveillance-cam.webp', 'tech-warehouse-cam.webp'],
        'body'      => [
            'A 4K bullet camera built for the outside of a building, where weather, glare and long distances break cheaper cameras. The 8MP sensor holds detail at the edge of the frame, so a number plate or a face stays readable when you zoom into recorded footage instead of turning into a grey smudge.',
            'On-board deep learning separates people and vehicles from moving branches, rain and stray animals, which means the alerts that reach your operator are the ones worth looking at. Mounted on a pole, a parapet or a boundary wall, it runs continuously on PoE with no local storage to fail.',
        ],
        'bullets'   => ['8MP 4K Resolution', '60m Smart IR Range', 'Human / Vehicle AI', 'IP67 Weather Sealed', 'PoE Single-Cable Power', '3-Year Brand Warranty'],
    ],
    [
        'slug'      => '360-high-speed-ptz-dome',
        'name'      => '360° High-Speed PTZ Dome',
        'category'  => 'surveillance',
        'badge'     => 'Enterprise',
        'sku'       => 'PA-PTZ-32X',
        'price'     => 145000,
        'old_price' => null,
        'highlight' => '32x Optical Zoom',
        'sub'       => 'Auto Tracking',
        'short'     => 'Continuous 360° pan-tilt coverage for expansive industrial warehouses, airport aprons, and municipal intersections, with automatic tracking that follows movement without an operator.',
        'specs'     => ['32x Optical Zoom', 'Auto Motion Tracking', 'IK10 Vandal Proof'],
        'features'  => ['night', 'vandal', 'network'],
        'tags'      => ['CCTV', 'PTZ', 'Enterprise'],
        'image'     => 'surveillance-cam.webp',
        'gallery'   => ['band-surveillance.webp', 'why-dome-camera.webp'],
        'body'      => [
            'One PTZ dome replaces a row of fixed cameras across a large open area. The 32x optical zoom reaches the far end of a yard or a runway apron and still resolves a face, and preset tours move the camera through the points that matter on a schedule you set.',
            'Auto motion tracking locks onto a moving target and follows it across the scene, which is what makes the camera useful overnight when nobody is watching the wall. The IK10 housing survives impact, and the whole unit is rated for continuous duty rather than occasional use.',
        ],
        'bullets'   => ['32x Optical Zoom', '360° Endless Pan', 'Auto Motion Tracking', 'IK10 Impact Rated', 'Preset Patrol Tours', '3-Year Brand Warranty'],
    ],
    [
        'slug'      => 'ai-touchless-face-palm-terminal',
        'name'      => 'AI Touchless Face & Palm Terminal',
        'category'  => 'access',
        'badge'     => 'High Precision',
        'sku'       => 'PA-BIO-FP50',
        'price'     => 42000,
        'old_price' => 48000,
        'highlight' => '0.2s Recognition',
        'sub'       => '50,000 Faces',
        'short'     => 'Hygiene-first touchless access and time-attendance terminal with spoof-proof anti-photo biometric verification, sized for head counts that outgrow a fingerprint reader.',
        'specs'     => ['0.2s Dual Camera', '50,000 Face Capacity', 'Live Mask Detection'],
        'features'  => ['bio', 'network'],
        'tags'      => ['Biometric', 'Attendance', 'Access Control'],
        'image'     => 'service-thumb-attendance.webp',
        'gallery'   => ['service-attendance.webp', 'service-access-control.webp'],
        'body'      => [
            'A dual-camera terminal that recognises a face in about two tenths of a second, so a shift change of a few hundred staff clears the door without a queue forming. Palm verification covers the cases where a face is not practical, and neither one needs anybody to touch the unit.',
            'The liveness check rejects a photograph or a phone screen held up to the lens, which is the failure most cheap face readers have. Attendance records sync to your server over TCP/IP, and the same events drive the door lock, so access and payroll read from one log.',
        ],
        'bullets'   => ['0.2s Face Recognition', '50,000 Face Templates', 'Palm Vein Backup', 'Anti-Spoof Liveness', 'TCP/IP Attendance Sync', '2-Year Brand Warranty'],
    ],
    [
        'slug'      => 'multi-door-central-access-controller',
        'name'      => 'Multi-Door Central Access Controller',
        'category'  => 'access',
        'badge'     => 'Networked',
        'sku'       => 'PA-ACC-4D08',
        'price'     => 36500,
        'old_price' => null,
        'highlight' => '4-Door / 8-Reader',
        'sub'       => 'Anti-Passback',
        'short'     => 'Industrial-grade central logic controller managing electromagnetic locks, turnstiles, and biometric reader networks from a single cabinet.',
        'specs'     => ['4-Door / 8-Reader', 'Anti-Passback Support', 'TCP/IP Cloud Sync'],
        'features'  => ['network', 'bio'],
        'tags'      => ['Access Control', 'RFID', 'Networked'],
        'image'     => 'service-thumb-access-control.webp',
        'gallery'   => ['service-access-control.webp', 'service-attendance.webp'],
        'body'      => [
            'The panel that actually decides who gets through a door. Four doors and eight readers run off one controller, with the decision logic held locally so the doors keep working correctly even when the network or the server is down.',
            'Anti-passback stops one card being handed back through a gate for a second person, and interlock rules let you build a proper airlock where the second door will not release until the first is closed. Everything logs to the server over TCP/IP for audit.',
        ],
        'bullets'   => ['4 Doors / 8 Readers', 'Offline Decision Logic', 'Anti-Passback Rules', 'Interlock / Airlock Mode', 'TCP/IP Server Sync', '2-Year Brand Warranty'],
    ],
    [
        'slug'      => 'addressable-fire-control-panel',
        'name'      => 'Addressable Fire Control Panel',
        'category'  => 'fire',
        'badge'     => 'EN54 Certified',
        'sku'       => 'PA-FAP-8L',
        'price'     => 185000,
        'old_price' => null,
        'highlight' => '2 to 8 Loops',
        'sub'       => '1,000 Devices',
        'short'     => 'Intelligent central command panel that pinpoints the exact detector location during an emergency event in real time, instead of telling you only which zone is alarming.',
        'specs'     => ['2 to 8 Loops', 'Up to 1,000 Devices', 'GSM Dialler Integration'],
        'features'  => ['network'],
        'tags'      => ['Fire Alarm', 'EN54', 'Panel'],
        'image'     => 'service-thumb-fire-alarm.webp',
        'gallery'   => ['service-fire-alarm.webp', 'service-fire-fighting.webp'],
        'body'      => [
            'An addressable panel names the device that went into alarm — third floor, east corridor, detector 42 — so the response team walks straight to it. A conventional panel can only point at a zone, which costs minutes in a building where minutes matter.',
            'Scales from two loops to eight and up to a thousand devices, so a single panel covers a full commercial tower. The GSM dialler raises the alarm off-site out of hours, and every event is written to the panel log for the fire inspector.',
        ],
        'bullets'   => ['2 to 8 Detection Loops', 'Up to 1,000 Devices', 'Device-Level Addressing', 'EN54 Certified', 'GSM Auto-Dialler', 'Full Event Log & Test Report'],
    ],
    [
        'slug'      => 'dual-optical-smoke-heat-detectors',
        'name'      => 'Dual-Optical Smoke & Heat Detectors',
        'category'  => 'fire',
        'badge'     => 'UL Listed',
        'sku'       => 'PA-DET-DO2',
        'price'     => 4800,
        'old_price' => 5500,
        'highlight' => 'Dual Photoelectric',
        'sub'       => 'False-Alarm Proof',
        'short'     => 'Early smoke detection with algorithmic false-alarm rejection, designed for corporate server rooms and high-density buildings where a nuisance evacuation is expensive.',
        'specs'     => ['Dual Photoelectric', 'Low-Current Standby', 'Dust-Immunity Chamber'],
        'features'  => [],
        'tags'      => ['Fire Alarm', 'Detector', 'UL Listed'],
        'image'     => 'service-fire-alarm.webp',
        'gallery'   => ['service-thumb-fire-alarm.webp', 'service-fire-fighting.webp'],
        'body'      => [
            'Two optical paths read the smoke chamber instead of one, and the detector compares them before it decides. That is what separates real smoke from steam, dust and cigarette haze — the three things that cause most nuisance evacuations in an office building.',
            'The sealed chamber resists dust build-up, so the detector holds its sensitivity between services rather than drifting towards false alarms. Combined heat sensing covers the fast-flame fires that produce little smoke early on.',
        ],
        'bullets'   => ['Dual Optical Chambers', 'Combined Heat Sensing', 'Dust-Immunity Design', 'Low Standby Current', 'Addressable or Conventional', 'UL Listed'],
    ],
    [
        'slug'      => 'high-speed-automated-boom-barrier',
        'name'      => 'High-Speed Automated Boom Barrier',
        'category'  => 'barriers',
        'badge'     => 'Heavy Duty',
        'sku'       => 'PA-BAR-15S',
        'price'     => 210000,
        'old_price' => 245000,
        'highlight' => '1.5s Rapid Opening',
        'sub'       => '5M Cycles MTBF',
        'short'     => 'High-traffic entrance barrier with integrated loop detectors, a flashing safety LED strip, and remote RFID gate sync for staff vehicles.',
        'specs'     => ['1.5s Rapid Opening', 'Brushless DC Motor', '5 Million Cycles MTBF'],
        'features'  => ['weather', 'network'],
        'tags'      => ['Barrier', 'RFID', 'Parking'],
        'image'     => 'service-thumb-gate-barrier.webp',
        'gallery'   => ['service-gate-barrier.webp', 'tech-warehouse-cam.webp'],
        'body'      => [
            'A one and a half second arm at a gate that sees a few thousand vehicles a day is the difference between traffic flowing and traffic backing onto the road. The brushless DC motor is rated at five million cycles, which is where cheaper geared barriers give up.',
            'Ground loop detectors hold the arm up while a vehicle is under it and drop it the moment the vehicle clears, so the barrier never lands on a bonnet. RFID tags on staff vehicles open it without anybody stopping at the guard post.',
        ],
        'bullets'   => ['1.5s Opening Time', 'Brushless DC Motor', '5 Million Cycle Rating', 'Ground Loop Safety', 'RFID Vehicle Tags', 'Manual Release On Power Cut'],
    ],
    [
        'slug'      => 'tripod-optical-flap-turnstiles',
        'name'      => 'Tripod & Optical Flap Turnstiles',
        'category'  => 'barriers',
        'badge'     => 'Stainless Steel',
        'sku'       => 'PA-TRN-304',
        'price'     => 275000,
        'old_price' => null,
        'highlight' => 'SUS304 Stainless',
        'sub'       => 'Drop-Arm Safety',
        'short'     => 'Pedestrian flow management gates designed for commercial towers, university campus gates, and factory lobbies where every entry has to be counted.',
        'specs'     => ['SUS304 Stainless', 'Emergency Drop-Arm', 'Biometric & Card Sync'],
        'features'  => ['bio', 'vandal'],
        'tags'      => ['Turnstile', 'Access Control', 'Lobby'],
        'image'     => 'tech-warehouse-cam.webp',
        'gallery'   => ['service-gate-barrier.webp', 'service-thumb-gate-barrier.webp'],
        'body'      => [
            'A turnstile turns an access policy into a physical fact — one badge, one person through. Tripod units suit a factory gate or a staff entrance; optical flap lanes suit a marble lobby where the hardware has to look like part of the building.',
            'SUS304 stainless steel handles an outdoor gate and daily cleaning without pitting. On a fire alarm signal the arms drop or the flaps open automatically so the lane becomes a clear evacuation route, which is a code requirement, not an option.',
        ],
        'bullets'   => ['SUS304 Stainless Body', 'Tripod or Flap Lanes', 'Fire Alarm Drop-Arm', 'Biometric & Card Readers', 'Bi-Directional Counting', 'Anti-Tailgate Sensors'],
    ],
    [
        'slug'      => 'quad-beam-perimeter-intrusion-barrier',
        'name'      => 'Quad-Beam Perimeter Intrusion Barrier',
        'category'  => 'surveillance',
        'badge'     => 'Perimeter',
        'sku'       => 'PA-IR-Q100',
        'price'     => 32000,
        'old_price' => null,
        'highlight' => '100m IR Beam',
        'sub'       => 'Anti-Fog & Frost',
        'short'     => 'An invisible infrared boundary tripwire that instantly triggers siren strobe units and notifies the monitoring room the moment somebody crosses the line.',
        'specs'     => ['100m Infrared Beam', 'Anti-Fog & Frost', 'Tamper Switch Alert'],
        'features'  => ['night', 'weather'],
        'tags'      => ['Perimeter', 'Intrusion', 'Night Vision'],
        'image'     => 'service-thumb-intrusion.webp',
        'gallery'   => ['service-intrusion.webp', 'band-surveillance.webp'],
        'body'      => [
            'Cameras tell you what happened; a beam barrier tells you the instant it is happening. Four beams across a hundred metres of boundary wall have to be broken together before the alarm fires, which is how birds and falling leaves get ignored.',
            'Heated optics keep working through Karachi fog and winter condensation, and the tamper switch reports anyone opening the housing. Wire it to the siren, the strobe and the monitoring room and the perimeter answers for itself at three in the morning.',
        ],
        'bullets'   => ['100m Beam Range', 'Quad-Beam Logic', 'Heated Anti-Fog Optics', 'Tamper Switch Alert', 'Siren & Strobe Output', 'Wall or Pole Mount'],
    ],
],

];
