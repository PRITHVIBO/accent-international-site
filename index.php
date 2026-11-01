<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];

$products = [
    [
        'name' => 'MANI K-Files & H-Files', 'category' => 'Endodontics', 'audience' => 'dentist student dealer',
        'brand' => 'MANI', 'type' => 'Root canal instrumentation', 'tag' => 'Endodontic essentials',
        'description' => 'Hand files for canal exploration, enlargement and shaping. Enquire for available sizes, lengths and packs.',
        'art' => 'file-art', 'source' => 'https://mani-global.com/hcp/dental/products/micro/micro-file/'
    ],
    [
        'name' => 'MANI Diamond Burs', 'category' => 'Operative', 'audience' => 'dentist student dealer',
        'brand' => 'MANI', 'type' => 'Rotary instruments', 'tag' => 'Precision rotary',
        'description' => 'Application-specific diamond burs in different shapes and grit options. Confirm the required bur code before ordering.',
        'art' => 'bur-art', 'source' => 'https://mani-global.com/hcp/dental/products/bur/dia-burs/'
    ],
    [
        'name' => 'WaveOne Gold / ProTaper family', 'category' => 'Endodontics', 'audience' => 'dentist dealer',
        'brand' => 'Dentsply Sirona', 'type' => 'NiTi shaping systems', 'tag' => 'Root canal shaping',
        'description' => 'Selected shaping systems for endodontic workflows. Ask about system, size, length and pack availability.',
        'art' => 'endo-art', 'source' => 'https://www.dentsplysirona.com/en-in/explore/endodontics.html'
    ],
    [
        'name' => 'AH Plus & obturation supplies', 'category' => 'Endodontics', 'audience' => 'dentist dealer',
        'brand' => 'Dentsply Sirona', 'type' => 'Root canal obturation', 'tag' => 'Canal filling',
        'description' => 'Root-canal sealer and related obturation products. Product format and regional availability should be confirmed.',
        'art' => 'obturation-art', 'source' => 'https://www.dentsplysirona.com/en-in/explore/endodontics.html'
    ],
    [
        'name' => 'Kerr restorative range', 'category' => 'Restorative', 'audience' => 'dentist dealer student',
        'brand' => 'Kerr', 'type' => 'Bonding & restorative materials', 'tag' => 'Restorative dentistry',
        'description' => 'Explore bonding agents, restorative materials and related consumables. Enquire with the procedure and preferred system.',
        'art' => 'restorative-art', 'source' => 'https://www.kerrdental.com/en-us'
    ],
    [
        'name' => 'Kerr ZenFlex RT & ZenSeal Pro', 'category' => 'Endodontics', 'audience' => 'dentist dealer',
        'brand' => 'Kerr', 'type' => 'Retreatment files & bioceramic sealer', 'tag' => 'Featured endodontics',
        'description' => 'Current Kerr endodontic product examples. Confirm the exact system, pack, availability and instructions for use before ordering.',
        'art' => 'kerr-endo-art', 'source' => 'https://www.kerrdental.com/en-us/endodontics'
    ],
    [
        'name' => 'HUGE PERFIT VPS Impression Materials', 'category' => 'Restorative', 'audience' => 'dentist dealer',
        'brand' => 'HUGE Dental', 'type' => 'Putty, heavy body, regular body, light body & monophase', 'tag' => 'Impression workflow',
        'description' => 'A selection of PERFIT addition-cure silicone impression materials. Ask for the viscosity, normal/fast set, cartridge or putty format and pack configuration you need.',
        'art' => 'huge-impression-art', 'source' => 'https://www.hugedental.com/products/'
    ],
    [
        'name' => 'HUGE TrusFIL Composite Restoratives', 'category' => 'Restorative', 'audience' => 'dentist dealer',
        'brand' => 'HUGE Dental', 'type' => 'Universal and flowable composite options', 'tag' => 'Direct restorations',
        'description' => 'Manufacturer-listed restorative examples include TrusFIL Universal and TrusFIL-Flow. Confirm shade, syringe size, pack and local availability.',
        'art' => 'huge-composite-art', 'source' => 'https://store.hugedental.com/collections/clinical-products'
    ],
    [
        'name' => 'HUGE TopCEM Resin Cement Systems', 'category' => 'Restorative', 'audience' => 'dentist dealer',
        'brand' => 'HUGE Dental', 'type' => 'Dual-cure, veneer and self-adhesive cement options', 'tag' => 'Cementation',
        'description' => 'HUGE lists TopCEM dual-cure resin cement and veneer cement options. Enquire with the exact system and intended restoration category.',
        'art' => 'huge-cement-art', 'source' => 'https://store.hugedental.com/collections/clinical-products'
    ],
    [
        'name' => 'HUGE Glass Ionomer Cement', 'category' => 'Restorative', 'audience' => 'dentist dealer student',
        'brand' => 'HUGE Dental', 'type' => 'Luting and restorative cement categories', 'tag' => 'Glass ionomer',
        'description' => 'Manufacturer catalogue includes glass ionomer cement categories. Confirm product variant, indication, pack and instructions for use before ordering.',
        'art' => 'huge-gic-art', 'source' => 'https://www.hugedental.com/products/'
    ],
    [
        'name' => 'HUGE CAD/CAM & Dental Lab Materials', 'category' => 'Laboratory', 'audience' => 'dentist dealer laboratory',
        'brand' => 'HUGE Dental', 'type' => 'Zirconia blocks, PMMA blocks and lab materials', 'tag' => 'Digital dentistry',
        'description' => 'Enquire about the available block/disc family, dimensions, shade, compatibility and intended milling workflow. Exact specifications are confirmed before quotation.',
        'art' => 'huge-cadcam-art', 'source' => 'https://www.hugedental.com/products/'
    ],
    [
        'name' => 'HUGE Denture & Prosthetic Lab Materials', 'category' => 'Laboratory', 'audience' => 'dentist dealer laboratory student',
        'brand' => 'HUGE Dental', 'type' => 'Synthetic polymer teeth, denture base polymers & tray materials', 'tag' => 'Dental laboratory',
        'description' => 'A sample of HUGE lab-side categories. Ask for product family, shade/size options, pack details and current sourcing lead time.',
        'art' => 'huge-lab-art', 'source' => 'https://www.hugedental.com/products/'
    ],
    [
        'name' => 'Oral surgery instrument requirements', 'category' => 'Surgical', 'audience' => 'dentist dealer',
        'brand' => 'Multi-brand sourcing', 'type' => 'Extraction forceps, elevators, periosteals & needle holders', 'tag' => 'Sourced on request',
        'description' => 'Share the instrument type, pattern, material, quantity and preferred manufacturer. Specific makes are confirmed before any quotation; no substitution without approval.',
        'art' => 'surgery-art', 'source' => 'https://www.cdsco.gov.in/opencms/opencms/en/Medical-Device-Diagnostics/Medical-Device-Diagnostics/'
    ],
    [
        'name' => 'Examination & hand instruments', 'category' => 'Instruments', 'audience' => 'dentist student dealer',
        'brand' => 'Multi-brand', 'type' => 'Mouth mirrors, probes & tweezers', 'tag' => 'Everyday instruments',
        'description' => 'Core examination instruments and hand tools for clinics, teaching labs and student kits.',
        'art' => 'hand-art', 'source' => 'https://www.mani-global.com/hcp/dental/'
    ],
    [
        'name' => 'Infection prevention essentials', 'category' => 'Clinic essentials', 'audience' => 'dentist dealer student',
        'brand' => 'Multi-brand', 'type' => 'PPE & sterilization supplies', 'tag' => 'Clinic readiness',
        'description' => 'Enquire about masks, gloves, disposable barriers, sterilization pouches and surface-care products.',
        'art' => 'clinic-art', 'source' => 'https://www.kerrdental.com/en-us'
    ],
    [
        'name' => 'Kerr CaviWipes Clear', 'category' => 'Clinic essentials', 'audience' => 'dentist dealer',
        'brand' => 'Kerr', 'type' => 'Surface cleaning wipes', 'tag' => 'Infection prevention',
        'description' => 'A Kerr surface-care product example for hard, non-porous surfaces. Check local product labelling and instructions before use.',
        'art' => 'clinic-art', 'source' => 'https://www.kerrdental.com/en-us'
    ],
    [
        'name' => 'Student instrument starter sets', 'category' => 'Student kits', 'audience' => 'student dealer',
        'brand' => 'Multi-brand', 'type' => 'Learning & practice essentials', 'tag' => 'For dental students',
        'description' => 'Build a kit around your college list: examination instruments, hand instruments and selected practical essentials.',
        'art' => 'student-art', 'source' => 'https://www.hugedental.com/products/'
    ],
    [
        'name' => 'Surgical sutures & accessories', 'category' => 'Surgical', 'audience' => 'dentist dealer',
        'brand' => 'Multi-brand', 'type' => 'Sutures & surgical accessories', 'tag' => 'Procedure support',
        'description' => 'Ask about suture material, gauge, length, needle type and pack size. Availability is subject to applicable requirements.',
        'art' => 'suture-art', 'source' => 'https://www.cdsco.gov.in/opencms/opencms/en/Medical-Device-Diagnostics/Medical-Device-Diagnostics/'
    ],
    [
        'name' => 'Rotary & finishing instruments', 'category' => 'Operative', 'audience' => 'dentist dealer student',
        'brand' => 'Multi-brand', 'type' => 'Burs, polishers & finishing', 'tag' => 'Operative dentistry',
        'description' => 'A selection of rotary and finishing categories for restorative and operative workflows. Confirm shank and application.',
        'art' => 'rotary-art', 'source' => 'https://mani-global.com/hcp/dental/products/bur/dia-burs/'
    ],
    [
        'name' => 'COXO Dental Handpieces & Equipment', 'category' => 'Equipment', 'audience' => 'dentist dealer',
        'brand' => 'COXO', 'type' => 'High/low-speed handpieces, dental devices and equipment', 'tag' => 'Equipment sourcing',
        'description' => 'Enquire by model and connection type for handpieces and other COXO dental equipment. Exact specification, local availability and service terms are confirmed before quotation.',
        'art' => 'equipment-art', 'source' => 'https://coxotec.com/'
    ],
    [
        'name' => 'COXO Endodontic Motors & Curing Lights', 'category' => 'Endodontics', 'audience' => 'dentist dealer',
        'brand' => 'COXO', 'type' => 'Endodontic treatment devices, apex locators and LED curing lights', 'tag' => 'Clinical equipment',
        'description' => 'COXO lists endodontic treatment systems, apex locators and LED curing lights. Ask for the exact model, included accessories and warranty/service availability.',
        'art' => 'endo-art', 'source' => 'https://coxotec.com/'
    ],
    [
        'name' => 'KaVo Dental Units & Handpieces', 'category' => 'Equipment', 'audience' => 'dentist dealer',
        'brand' => 'KaVo Kerr', 'type' => 'Dental practice equipment, handpieces and instruments', 'tag' => 'Practice equipment',
        'description' => 'Enquire about dental chairs/units, instruments and handpiece requirements by exact model and configuration. Installation, service coverage and delivery are confirmed separately.',
        'art' => 'equipment-art', 'source' => 'https://www.kavo.com/en/products'
    ],
    [
        'name' => 'VERICOM Dental & Laboratory Materials', 'category' => 'Restorative', 'audience' => 'dentist dealer laboratory',
        'brand' => 'VERICOM', 'type' => 'Dental materials, laboratory materials and digital materials', 'tag' => 'Clinical & lab range',
        'description' => 'VERICOM publishes dental, laboratory and digital material categories. Share the exact product name or reference so the correct variant can be checked.',
        'art' => 'restorative-art', 'source' => 'https://www.vericom.co.kr/eng/main/main.html'
    ],
    [
        'name' => 'Kulzer Flexitime Impression Materials', 'category' => 'Restorative', 'audience' => 'dentist dealer laboratory',
        'brand' => 'Kulzer', 'type' => 'VPS precision impression materials', 'tag' => 'Precision impressions',
        'description' => 'Kulzer lists Flexitime precision impression products. Confirm viscosity, set time, cartridge/putty format and pack configuration for the requested workflow.',
        'art' => 'obturation-art', 'source' => 'https://www.kulzer.com/en/en/for-dentists/startpage-dentists.html'
    ],
    [
        'name' => 'Kulzer Venus Restorative Materials', 'category' => 'Restorative', 'audience' => 'dentist dealer',
        'brand' => 'Kulzer', 'type' => 'Composite restorative materials and adhesive systems', 'tag' => 'Direct restorations',
        'description' => 'Kulzer lists Venus composites and adhesive solutions. Ask for the exact product, shade, syringe/capsule format and current supply details.',
        'art' => 'restorative-art', 'source' => 'https://www.kulzer.com/en/en/for-dentists/products-by-indication/restorative-materials/overview-restorative-materials.html'
    ],
    [
        'name' => 'Zhermack Impression Materials', 'category' => 'Restorative', 'audience' => 'dentist dealer laboratory',
        'brand' => 'Zhermack', 'type' => 'Alginate, gypsum and silicone impression materials', 'tag' => 'Impression workflow',
        'description' => 'Zhermack is a dental materials manufacturer with alginate, gypsum and silicone ranges. Confirm product family, set type, pack and indication before order.',
        'art' => 'huge-impression-art', 'source' => 'https://www.zhermack.com/en/'
    ],
    [
        'name' => '3M Filtek Restoratives & Single Bond Adhesive', 'category' => 'Restorative', 'audience' => 'dentist dealer',
        'brand' => '3M', 'type' => 'Composite restoratives, bonding agents and RelyX cements', 'tag' => 'Restorative systems',
        'description' => 'Examples in 3M India’s dental catalogue include Filtek restoratives, Single Bond Universal Adhesive and RelyX cements. Confirm shade, pack and current regional availability.',
        'art' => 'restorative-art', 'source' => 'https://www.3mindia.in/3M/en_IN/dental-in/products/'
    ],
    [
        'name' => 'DiaDent Gutta Percha & Paper Points', 'category' => 'Endodontics', 'audience' => 'dentist dealer student',
        'brand' => 'DiaDent', 'type' => 'Root canal filling and absorbent paper points', 'tag' => 'Endodontic essentials',
        'description' => 'DiaDent’s catalogue includes gutta-percha and paper points. Confirm taper, size, length, pack quantity and exact product reference.',
        'art' => 'endo-art', 'source' => 'https://www.diadent.kr/'
    ],
    [
        'name' => 'Woodpecker Curing Lights, Endo Motors & Scalers', 'category' => 'Equipment', 'audience' => 'dentist dealer',
        'brand' => 'WOODPECKER', 'type' => 'LED curing lights, endodontic motors and ultrasonic scalers', 'tag' => 'Clinical devices',
        'description' => 'Woodpecker’s product range includes curing lights, endodontic motors and ultrasonic scalers. Confirm model, accessories, warranty and regional service support.',
        'art' => 'equipment-art', 'source' => 'https://www.glwoodpecker.com/'
    ],
    [
        'name' => 'Dental Chairs, Surgical Equipment & Diode Lasers', 'category' => 'Equipment', 'audience' => 'dentist dealer',
        'brand' => 'Multi-brand sourcing', 'type' => 'Dental chairs, clinical equipment and diode laser systems', 'tag' => 'On-demand equipment',
        'description' => 'The supplied Accent International brochure lists dental chairs, equipment and dental diode lasers. Share the required brand, model, configuration and installation location; sourcing and service feasibility are confirmed first.',
        'art' => 'equipment-art', 'source' => 'https://www.cdsco.gov.in/opencms/opencms/en/Medical-Device-Diagnostics/Medical-Device-Diagnostics/'
    ],
];

$categories = ['All products', 'Endodontics', 'Restorative', 'Surgical', 'Operative', 'Instruments', 'Equipment', 'Clinic essentials', 'Student kits', 'Laboratory'];
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#071b22">
  <meta property="og:title" content="Accent International | Dental Imports, Exports & On-Demand Supply">
  <meta property="og:description" content="Dental chairs, clinical materials, surgical instruments, equipment and diode laser enquiries for dentists, dealers, laboratories and students.">
  <meta name="description" content="Accent International is a Jaipur dental imports and exports business for clinical materials, surgical instruments, dental chairs, equipment and diode laser enquiries. Request on-demand sourcing and a clear quotation.">
  <title>Accent International | Dental Imports, Exports & Clinical Supply</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script>document.documentElement.classList.add('js');</script>
</head>
<body>
  <div class="scroll-progress" aria-hidden="true"><span id="scrollProgress"></span></div>
  <div class="announcement">
    <span class="announcement-dot"></span>
    <span>Dental imports · Exports · On-demand supply · Jaipur, India</span>
    <a href="#catalogue">Explore the range <span aria-hidden="true">↗</span></a>
  </div>

  <header class="site-header" id="top">
    <nav class="nav-wrap container" aria-label="Main navigation">
      <a class="brand-lockup" href="#top" aria-label="Accent International home">
        <span class="brand-mark"><img src="assets/images/accent-emblem.png" alt="Accent International tooth and A emblem" width="68" height="48"></span>
        <span class="brand-name">Accent<span>International</span></span>
      </a>
      <button class="nav-toggle" id="navToggle" aria-label="Open navigation" aria-expanded="false" aria-controls="mainNav"><span></span><span></span></button>
      <div class="nav-links" id="mainNav">
        <a href="#solutions">Who we serve</a>
        <a href="#catalogue">Catalogue</a>
        <a href="#brands">Brands</a>
        <a href="#story">Our approach</a>
        <a href="#supply-questions">FAQs</a>
        <a href="#contact" class="nav-cta">Request a quote <span>↗</span></a>
      </div>
    </nav>
  </header>

  <main>
    <section class="hero" aria-labelledby="heroTitle">
      <div class="hero-image" aria-hidden="true"></div>
      <div class="hero-grid" aria-hidden="true"></div>
      <div class="hero-orb orb-one" aria-hidden="true"></div>
      <div class="hero-orb orb-two" aria-hidden="true"></div>
      <div class="hero-scan" aria-hidden="true"></div>
      <div class="container hero-content">
        <div class="eyebrow hero-eyebrow"><span class="eyebrow-line"></span> Dental imports, exports & sourcing</div>
        <h1 id="heroTitle">The right supply.<br><em>Without the guesswork.</em></h1>
        <p class="hero-copy">From dental chairs and clinical materials to surgical instruments and diode laser enquiries, we help dentists, dealers, laboratories and students source against an exact requirement — with clear specifications, availability checks and customer approval before dispatch.</p>
        <div class="hero-actions">
          <a class="button button-light" href="#catalogue">Explore products <span>↗</span></a>
          <a class="text-link hero-secondary" href="#solutions"><span class="play-icon">▶</span> Build your requirement</a>
        </div>
        <div class="hero-footnote"><span class="pulse-dot"></span> Clinical · Surgical · Equipment · Dental imports & exports</div>
      </div>
      <div class="hero-side-note" aria-hidden="true"><span>01</span> / DENTAL SOURCING / JAIPUR</div>
      <div class="hero-floating-card float-card-top" aria-hidden="true"><span class="float-icon">✳</span><span><b>Clinical</b><small>Everyday essentials</small></span></div>
      <div class="hero-floating-card float-card-bottom" aria-hidden="true"><span class="float-icon float-icon-gold">⌁</span><span><b>Surgical</b><small>Precision instruments</small></span></div>
      <a class="scroll-cue" href="#solutions" aria-label="Scroll to discover"><span></span> SCROLL TO DISCOVER</a>
    </section>

    <section class="ticker" aria-label="Product categories">
      <div class="ticker-track">
        <span>ENDODONTICS</span><b>✳</b><span>RESTORATIVE</span><b>✳</b><span>ORAL SURGERY</span><b>✳</b><span>CLINIC ESSENTIALS</span><b>✳</b><span>STUDENT KITS</span><b>✳</b>
        <span>ENDODONTICS</span><b>✳</b><span>RESTORATIVE</span><b>✳</b><span>ORAL SURGERY</span><b>✳</b><span>CLINIC ESSENTIALS</span><b>✳</b><span>STUDENT KITS</span><b>✳</b>
      </div>
    </section>

    <section class="section intro-section" id="solutions">
      <div class="container">
        <div class="section-heading intro-heading" data-reveal>
          <div>
            <div class="eyebrow"><span class="eyebrow-line"></span> One network. Different needs.</div>
            <h2>Made for the people<br>behind <em>every smile.</em></h2>
          </div>
          <p class="section-lead">Whether you run a practice, supply a network or are learning the craft, your requirements are different. Your product partner should understand that.</p>
        </div>
        <div class="audience-grid">
          <article class="audience-card dentist-card" data-reveal>
            <div class="audience-number">01 / CLINICS</div><div class="audience-icon">✳</div>
            <h3>For dentists<br>& clinics</h3>
            <p>Clinical consumables, restorative materials, endodontic systems and surgical instruments for day-to-day practice.</p>
            <a href="#contact" class="card-link" data-interest="Dentist / Clinic enquiry">Discuss clinic requirements <span>↗</span></a>
            <div class="audience-watermark">D</div>
          </article>
          <article class="audience-card dealer-card" data-reveal>
            <div class="audience-number">02 / TRADE</div><div class="audience-icon">⌘</div>
            <h3>For dealers<br>& distributors</h3>
            <p>Enquire about product lines, repeat requirements, bulk quantities and brand availability for your market.</p>
            <a href="#contact" class="card-link" data-interest="Dealer / Bulk enquiry">Start a trade conversation <span>↗</span></a>
            <div class="audience-watermark">B</div>
          </article>
          <article class="audience-card student-card" data-reveal>
            <div class="audience-number">03 / LEARNING</div><div class="audience-icon">✧</div>
            <h3>For dental<br>students</h3>
            <p>Build your practical kit around your college list, with clear guidance on categories, sizes and product options.</p>
            <a href="#contact" class="card-link" data-interest="Dental student enquiry">Build a student kit <span>↗</span></a>
            <div class="audience-watermark">S</div>
          </article>
          <article class="audience-card lab-card" data-reveal>
            <div class="audience-number">04 / LAB WORKFLOWS</div><div class="audience-icon">⌬</div>
            <h3>For dental<br>laboratories</h3>
            <p>Enquire about impression, denture, CAD/CAM and prosthetic materials with exact dimensions and shade requirements.</p>
            <a href="#contact" class="card-link" data-interest="Dental laboratory enquiry">Discuss lab materials <span>↗</span></a>
            <div class="audience-watermark">L</div>
          </article>
        </div>
        <div class="supply-experience" data-reveal>
          <div class="supply-experience-copy">
            <div class="eyebrow"><span class="eyebrow-line"></span> A sourcing experience that responds to you</div>
            <h3 id="personaTitle">For a busy dental practice</h3>
            <p id="personaDescription">Tell us the procedure, brand, model, size and quantity. We will check the requirement and share a clear quotation and lead-time expectation.</p>
            <div class="persona-tabs" role="group" aria-label="Choose your customer type">
              <button type="button" class="persona-tab is-active" data-persona="clinic" aria-pressed="true">I am a dentist</button>
              <button type="button" class="persona-tab" data-persona="dealer" aria-pressed="false">I am a dealer</button>
              <button type="button" class="persona-tab" data-persona="student" aria-pressed="false">I am a student</button>
              <button type="button" class="persona-tab" data-persona="lab" aria-pressed="false">I run a lab</button>
            </div>
            <a class="button button-dark" id="personaCta" href="#contact">Build my requirement <span>↗</span></a>
          </div>
          <div class="supply-flow" aria-label="How an on-demand supply enquiry works">
            <div class="supply-flow-heading"><span>FROM REQUEST TO DELIVERY</span><b>Four clear steps</b></div>
            <div class="flow-step"><span class="flow-number">01</span><div><b>Send the exact need</b><small>Brand · code · pack · quantity · pincode</small></div><span class="flow-state">YOU</span></div>
            <div class="flow-step"><span class="flow-number">02</span><div><b>We check the source</b><small>Variant, availability or sourcing lead time</small></div><span class="flow-state">CHECK</span></div>
            <div class="flow-step"><span class="flow-number">03</span><div><b>Review your quotation</b><small>Price, delivery estimate and product details</small></div><span class="flow-state">APPROVE</span></div>
            <div class="flow-step"><span class="flow-number">04</span><div><b>Supply after approval</b><small>No unapproved brand or model substitution</small></div><span class="flow-state">DISPATCH</span></div>
            <p class="supply-note">Product and source details are checked per request. Available batch/expiry and documentation are shared where applicable. No unapproved substitution; this website does not display live stock or promise same-day delivery.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="catalogue-section section" id="catalogue">
      <div class="container">
        <div class="section-heading catalogue-heading" data-reveal>
          <div><div class="eyebrow"><span class="eyebrow-line"></span> Explore the range</div><h2>Essentials for<br><em>every procedure.</em></h2></div>
          <div class="catalogue-heading-right"><p class="section-lead">A starting catalogue of commonly requested dental product categories. Select a product to add it to your enquiry.</p><span class="catalogue-count"><strong><?= count($products) ?></strong> SAMPLE CATEGORIES</span></div>
        </div>
        <div class="catalogue-tools" data-reveal>
          <div class="filter-list" role="group" aria-label="Filter products by category">
            <?php foreach ($categories as $index => $category): ?>
              <button class="filter-chip<?= $index === 0 ? ' is-active' : '' ?>" data-filter="<?= e($category) ?>" type="button"><?= e($category) ?></button>
            <?php endforeach; ?>
          </div>
          <label class="search-box"><span aria-hidden="true">⌕</span><input type="search" id="productSearch" placeholder="Search products or brands" aria-label="Search products or brands"></label>
        </div>
        <div class="product-grid" id="productGrid">
          <?php foreach ($products as $index => $product): ?>
            <article class="product-card" data-category="<?= e($product['category']) ?>" data-search="<?= e(strtolower($product['name'].' '.$product['brand'].' '.$product['type'].' '.$product['description'])) ?>" data-reveal style="--card-index: <?= (int)$index ?>">
              <div class="product-visual <?= e($product['art']) ?>">
                <span class="product-tag"><?= e($product['tag']) ?></span>
                <span class="product-brand-stamp"><?= e($product['brand']) ?></span>
                <div class="product-artwork" aria-hidden="true"><span></span><i></i><b></b></div>
                <span class="product-index">0<?= $index + 1 ?></span>
              </div>
              <div class="product-info">
                <div class="product-meta"><span><?= e($product['category']) ?></span><span><?= e($product['brand']) ?></span></div>
                <h3><?= e($product['name']) ?></h3>
                <p class="product-type"><?= e($product['type']) ?></p>
                <p class="product-description"><?= e($product['description']) ?></p>
                <div class="product-actions"><button class="add-enquiry" type="button" data-product="<?= e($product['name']) ?>">Add to enquiry <span>+</span></button><a href="<?= e($product['source']) ?>" target="_blank" rel="noopener noreferrer" class="source-link" aria-label="View external product reference">↗</a></div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
        <div class="empty-state" id="emptyState" hidden>No matching products. Try another product name or category.</div>
        <div class="catalogue-note"><span>ⓘ</span> Product names and examples are for enquiry guidance. Models, sizes, pack configurations, regional availability and pricing must be confirmed before order. Brand names belong to their respective owners.</div>
      </div>
    </section>

    <section class="brand-section section" id="brands">
      <div class="container">
        <div class="brand-intro" data-reveal>
          <div><div class="eyebrow eyebrow-light"><span class="eyebrow-line"></span> Brands named in the company brochure</div><h2>Recognised names.<br><em>One clear enquiry.</em></h2></div>
          <p>These names are transcribed from the supplied Accent International brochure, with HUGE Dental and Dentsply Sirona retained from the earlier catalogue. Use the enquiry link to ask about an exact brand, model or product code.</p>
        </div>
        <div class="relationship-strip" data-reveal>
          <article class="relationship-card relationship-mani"><span class="relationship-kicker">AS STATED ON THE SUPPLIED BROCHURE</span><strong>MANI</strong><span>“Authorised Distributor”</span></article>
          <article class="relationship-card relationship-import"><span class="relationship-kicker">AS SHOWN UNDER “EXCLUSIVE IMPORTER”</span><strong>IMD <i>×</i> COXO</strong><span>Confirm current appointment and import rights before public use</span></article>
          <article class="relationship-card relationship-sourcing"><span class="relationship-kicker">OTHER PRODUCT BRANDS</span><strong>On-demand sourcing</strong><span>Exact product, variant and availability checked per enquiry</span></article>
        </div>
        <div class="brand-grid brand-grid-expanded">
          <article class="brand-card" data-reveal><span class="brand-card-top">01 / JAPAN</span><strong class="brand-word mani-word">MANI<sup>®</sup></strong><span class="brand-status status-claimed">Brochure: authorised distributor</span><span class="brand-focus">Endodontic files · Micro instruments · Burs</span><div class="brand-card-actions"><a href="#contact" data-interest="MANI brand enquiry">Enquire about MANI ↗</a><a href="https://mani-global.com/hcp/dental/" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">02 / DENTAL DEVICES</span><strong class="brand-word coxo-word">COXO</strong><span class="brand-status status-claimed">Brochure: exclusive importer listing</span><span class="brand-focus">Handpieces · Endodontic devices · Curing lights</span><div class="brand-card-actions"><a href="#contact" data-interest="COXO brand enquiry">Enquire about COXO ↗</a><a href="https://coxotec.com/" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">03 / IMPORT BRAND</span><strong class="brand-word imd-word">IMD<small>Innovation For You</small></strong><span class="brand-status status-claimed">Brochure: exclusive importer listing</span><span class="brand-focus">Brand and product range to be confirmed against the requested item</span><div class="brand-card-actions"><a href="#contact" data-interest="IMD brand enquiry">Enquire about IMD ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">04 / DENTAL EQUIPMENT & MATERIALS</span><strong class="brand-word kerr-word">KaVo <span>·</span> Kerr</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Practice equipment · Handpieces · Restorative & endodontic materials</span><div class="brand-card-actions"><a href="#contact" data-interest="KaVo Kerr brand enquiry">Enquire about KaVo Kerr ↗</a><a href="https://www.kavo.com/en/products" target="_blank" rel="noopener noreferrer">KaVo ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">05 / DENTAL MATERIALS</span><strong class="brand-word vericom-word">VERICOM</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Dental materials · Laboratory materials · Digital materials</span><div class="brand-card-actions"><a href="#contact" data-interest="VERICOM brand enquiry">Enquire about VERICOM ↗</a><a href="https://www.vericom.co.kr/eng/main/main.html" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">06 / CLINICAL & LAB</span><strong class="brand-word kulzer-word">KULZER</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Impression materials · Restoratives · Prosthetics · CAD/CAM</span><div class="brand-card-actions"><a href="#contact" data-interest="Kulzer brand enquiry">Enquire about Kulzer ↗</a><a href="https://www.kulzer.com/en/en/start/homepage.html" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">07 / IMPRESSION MATERIALS</span><strong class="brand-word zhermack-word">Zhermack</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Alginate · Gypsum · Silicone impression compounds</span><div class="brand-card-actions"><a href="#contact" data-interest="Zhermack brand enquiry">Enquire about Zhermack ↗</a><a href="https://www.zhermack.com/en/" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">08 / AS PRINTED</span><strong class="brand-word imdsi-word">IMDSI</strong><span class="brand-status status-confirm">Name/range to confirm</span><span class="brand-focus">Transcribed from the supplied brochure; share a photo or product code to identify the exact item</span><div class="brand-card-actions"><a href="#contact" data-interest="IMDSI brand enquiry">Enquire about IMDSI ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">09 / DENTAL BRAND</span><strong class="brand-word apple-word">Apple Dent</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Ask us to confirm the precise product range and pack details</span><div class="brand-card-actions"><a href="#contact" data-interest="Apple Dent brand enquiry">Enquire about Apple Dent ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">10 / DENTAL PRODUCTS</span><strong class="brand-word bdc-word">BDC</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">“The Dental Product Innovators” — brochure tagline</span><div class="brand-card-actions"><a href="#contact" data-interest="BDC brand enquiry">Enquire about BDC ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">11 / RESTORATIVE SYSTEMS</span><strong class="brand-word three-m-word">3M</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Filtek restoratives · Adhesives · RelyX cements</span><div class="brand-card-actions"><a href="#contact" data-interest="3M dental brand enquiry">Enquire about 3M Dental ↗</a><a href="https://www.3mindia.in/3M/en_IN/dental-in/products/" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">12 / ENDODONTICS</span><strong class="brand-word diadent-word">DiaDent</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Gutta-percha · Paper points · Obturation materials</span><div class="brand-card-actions"><a href="#contact" data-interest="DiaDent brand enquiry">Enquire about DiaDent ↗</a><a href="https://www.diadent.kr/" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">13 / DENTAL EQUIPMENT</span><strong class="brand-word woodpecker-word">WOODPECKER</strong><span class="brand-status">Shown on supplied brochure</span><span class="brand-focus">Curing lights · Endo motors · Ultrasonic scalers</span><div class="brand-card-actions"><a href="#contact" data-interest="Woodpecker brand enquiry">Enquire about Woodpecker ↗</a><a href="https://www.glwoodpecker.com/" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">14 / AS PRINTED</span><strong class="brand-word dwhite-word">D-WHITE</strong><span class="brand-status status-confirm">Name/range to confirm</span><span class="brand-focus">Transcribed from the supplied brochure; confirm exact product reference</span><div class="brand-card-actions"><a href="#contact" data-interest="D-WHITE brand enquiry">Enquire about D-WHITE ↗</a></div></article>
          <article class="brand-card huge-brand-card" data-reveal><span class="brand-card-top">15 / CLINICAL & LAB MATERIALS</span><strong class="brand-word huge-word">HUGE<span> Dental</span></strong><span class="brand-status status-extended">Retained in extended catalogue</span><span class="brand-focus">PERFIT impressions · TrusFIL composites · TopCEM cements · Lab materials</span><div class="brand-card-actions"><a href="#contact" data-interest="HUGE Dental brand enquiry">Enquire about HUGE ↗</a><a href="https://www.hugedental.com/" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
          <article class="brand-card" data-reveal><span class="brand-card-top">16 / GLOBAL DENTAL</span><strong class="brand-word ds-word">Dentsply<span> Sirona</span></strong><span class="brand-status status-extended">Retained in extended catalogue</span><span class="brand-focus">Endodontics · Restoratives · Digital dentistry</span><div class="brand-card-actions"><a href="#contact" data-interest="Dentsply Sirona brand enquiry">Enquire about Dentsply ↗</a><a href="https://www.dentsplysirona.com/en-in.html" target="_blank" rel="noopener noreferrer">Manufacturer ↗</a></div></article>
        </div>
        <p class="brand-disclaimer">Brand names are displayed as text references, not as manufacturer logos or proof of partnership. The brochure states MANI as an authorised-distributor relationship and places IMD / COXO beneath an “Exclusive Importer” heading. Confirm that each appointment, import right and logo-use permission is current before publishing those claims. All other brand references require item-by-item stock and sourcing confirmation.</p>
      </div>
    </section>

    <section class="story-section section" id="story">
      <div class="container story-layout">
        <div class="story-visual" data-reveal>
          <div class="story-image-panel"><div class="story-image-glow"></div><div class="story-visual-label"><span>THE ACCENT APPROACH</span><b>Details matter.</b></div><div class="story-vertical-text">CLARITY / CARE / CONSISTENCY</div><div class="story-orbit orbit-a"></div><div class="story-orbit orbit-b"></div><div class="story-center-mark">A<span>+</span></div></div>
          <div class="story-image-caption"><span>01—03</span> A more considered way to source dental essentials</div>
        </div>
        <div class="story-copy" data-reveal>
          <div class="eyebrow"><span class="eyebrow-line"></span> About Accent International</div>
          <h2>Not just a product list.<br><em>A better supply experience.</em></h2>
          <p class="story-lead">Accent International is a Jaipur-based dental imports and exports business. Its supplied company brochure lists dental chairs, equipment materials, surgical instruments and dental diode lasers, alongside clinical product brands. The working approach is requirement-first: confirm the exact product, manufacturer, model, pack, availability and delivery expectation — then proceed only after the customer approves the details.</p>
          <div class="company-facts" aria-label="Company profile highlights"><div><strong>Jaipur</strong><small>Rajasthan, India</small></div><div><strong>Imports & exports</strong><small>Dental items and equipment</small></div><div><strong>On demand</strong><small>Requirement-led sourcing</small></div></div>
          <div class="principle-list">
            <div><span>01</span><section><h3>Understand the requirement</h3><p>Capture the product name, brand, catalogue code, pack, quantity and delivery pin — or share a product photo/reference.</p></section></div>
            <div><span>02</span><section><h3>Make product details clear</h3><p>Check the stated manufacturer, exact variant and pack, availability or sourcing lead time. Ask for available invoice, batch/expiry and product documentation details where applicable; disclose any gap before approval.</p></section></div>
            <div><span>03</span><section><h3>Build long-term relationships</h3><p>Share a clear quotation, available product details and delivery expectation. No alternate brand, model or pack is substituted without customer approval.</p></section></div>
          </div>
          <a class="button button-dark" href="#contact">Let's discuss your needs <span>↗</span></a>
          <p class="owner-note">Product specifications, availability, packaging and applicable documentation are confirmed at enquiry stage before an order is accepted.</p>
        </div>
      </div>
    </section>

    <section class="quote-band">
      <div class="quote-band-noise" aria-hidden="true"></div>
      <div class="container quote-band-content" data-reveal>
        <span class="quote-mark">“</span><p>You send the requirement. We check the details. You approve before we source or dispatch.</p><span class="quote-caption">Clear specifications · Confirmed availability · Customer-approved supply</span>
      </div>
    </section>

    <section class="contact-section section" id="contact">
      <div class="container contact-layout">
        <div class="contact-copy" data-reveal>
          <div class="eyebrow"><span class="eyebrow-line"></span> Start a conversation</div>
          <h2>Tell us what<br>your practice <em>needs.</em></h2>
          <p>Need a product that is not in the catalogue? Send the brand, code, size, quantity and delivery pincode. We can check on-demand sourcing and share a quotation with availability and lead time before you decide.</p>
          <div class="contact-points"><div><span class="contact-point-icon">↗</span><span><b>On-demand sourcing</b><small>Ask for items beyond the listed catalogue; lead time is confirmed first.</small></span></div><div><span class="contact-point-icon">◎</span><span><b>Clear before dispatch</b><small>Make, pack, quantity, availability and delivery details are shared for approval.</small></span></div></div>
          <div class="business-location" data-reveal>
            <div class="location-top"><span class="contact-point-icon">⌖</span><div><b>Visit Accent International</b><small>Address printed on the supplied company brochure</small></div></div>
            <address>B-9, Someshwar Mahadev Marg,<br>Bhrampuri Khurra, Shivaji Chowk,<br>Jaipur, Rajasthan 302002, India</address>
            <div class="contact-person-list">
              <div><b>Sandeep Gupta</b><a href="tel:+919829066117">+91 98290 66117</a></div>
              <div><b>Krishna Gupta</b><a href="tel:+919529309175">+91 95293 09175</a></div>
            </div>
            <div class="location-actions"><a href="https://www.google.com/maps/search/?api=1&query=B-9%2C%20Someshwar%20Mahadev%20Marg%2C%20Bhrampuri%20Khurra%2C%20Shivaji%20Chowk%2C%20Jaipur%20302002" target="_blank" rel="noopener noreferrer">Get directions ↗</a><a href="tel:+919829066117">Call Sandeep ↗</a><a href="tel:+919529309175">Call Krishna ↗</a></div>
            <div class="email-list"><a href="mailto:accentinternational21@yahoo.com">accentinternational21@yahoo.com</a><a href="mailto:sandeep66117@yahoo.com">sandeep66117@yahoo.com</a></div>
            <div class="location-map"><iframe title="Map search for the Accent International address printed on its supplied brochure in Jaipur" src="https://www.google.com/maps?q=B-9%2C%20Someshwar%20Mahadev%20Marg%2C%20Bhrampuri%20Khurra%2C%20Shivaji%20Chowk%2C%20Jaipur%20302002&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>
            <div class="profile-links"><span>BUSINESS CONTACT</span><a href="https://in.linkedin.com/in/sandeep-gupta-8678b22b" target="_blank" rel="noopener noreferrer">Sandeep Gupta on LinkedIn ↗</a></div>
            <p class="listing-note">Address, names, telephone numbers and email addresses are transcribed from the supplied company brochure. Please confirm the exact map pin and contact details before publishing or arranging a visit.</p>
          </div>
          <div class="contact-side-note">ACCENT INTERNATIONAL <span>·</span> DENTAL SUPPLY ENQUIRIES</div>
        </div>
        <div class="contact-form-wrap" data-reveal>
          <div class="form-topline"><span>PRODUCT ENQUIRY</span><span>01 — 04</span></div>
          <form id="quoteForm" action="api/quote.php" method="post" novalidate>
            <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
            <div class="honeypot" aria-hidden="true"><label>Leave this field empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
            <div class="form-row">
              <label class="field"><span>Your name <i>*</i></span><input name="name" type="text" placeholder="Full name" autocomplete="name" required minlength="2" maxlength="80"></label>
              <label class="field"><span>I'm enquiring as <i>*</i></span><select name="buyer_type" required><option value="">Choose one</option><option>Dentist / Clinic</option><option>Dealer / Distributor</option><option>Dental student</option><option>Dental laboratory</option><option>Other</option></select></label>
            </div>
            <div class="form-row">
              <label class="field"><span>Phone / WhatsApp <i>*</i></span><input name="phone" type="tel" placeholder="+91 98XXXXXXXX" autocomplete="tel" required minlength="8" maxlength="20"></label>
              <label class="field"><span>Email</span><input name="email" type="email" placeholder="you@example.com" autocomplete="email" maxlength="120"></label>
            </div>
            <div class="form-row">
              <label class="field"><span>City</span><input name="city" type="text" placeholder="Your city" autocomplete="address-level2" maxlength="80"></label>
              <label class="field"><span>Interested in</span><select name="interest"><option value="General enquiry">General enquiry</option><option>Endodontics</option><option>Restorative dentistry</option><option>Oral surgery</option><option>Clinic essentials</option><option>Student instruments / kit</option><option>Bulk / dealer enquiry</option><option>Laboratory materials</option><option>Dental chairs & equipment</option><option>Dental diode laser systems</option><option>MANI / COXO / IMD products</option><option>VERICOM / Kulzer / Zhermack materials</option><option>3M / DiaDent / Woodpecker products</option><option>HUGE Dental products</option><option>Dentsply Sirona products</option></select></label>
            </div>
            <div class="form-row">
              <label class="field"><span>Approx. quantity</span><input name="quantity" type="text" placeholder="e.g. 2 packs / 50 units" maxlength="60"></label>
              <label class="field"><span>Delivery pincode</span><input name="pincode" type="text" inputmode="numeric" placeholder="6-digit pincode" pattern="[0-9]{6}" maxlength="6"></label>
            </div>
            <label class="field field-full"><span>When do you need it?</span><select name="timing"><option value="No fixed date">No fixed date</option><option>Routine replenishment</option><option>Needed within 7 days</option><option>Planned purchase / future date</option><option>Urgent — please confirm feasibility</option></select></label>
            <label class="field field-full"><span>Products / requirements <i>*</i></span><textarea name="message" id="enquiryMessage" rows="4" placeholder="Tell us the product, brand, model, size, quantity or share your requirement..." required minlength="10" maxlength="2000"></textarea></label>
            <label class="consent-line"><input type="checkbox" name="consent" value="yes" required><span>I agree to be contacted about this enquiry. Please do not include patient-identifiable information.</span></label>
            <button class="button button-dark submit-button" type="submit"><span class="button-label">Send product enquiry</span><span class="button-arrow">↗</span></button>
            <p class="form-feedback" id="formFeedback" role="status" aria-live="polite"></p>
            <p class="form-privacy">Your details are used to respond to this enquiry. Do not submit patient records, medical images or sensitive personal information.</p>
          </form>
        </div>
      </div>
    </section>

    <section class="faq-section section" id="supply-questions">
      <div class="container faq-layout">
        <div data-reveal><div class="eyebrow"><span class="eyebrow-line"></span> Before you place a request</div><h2>Supply, with<br><em>clear answers.</em></h2><p class="section-lead">No live-stock guesses. No surprise substitutions. We confirm the details before you approve an order.</p></div>
        <div class="faq-list" data-reveal>
          <details><summary>Can you arrange products that are not shown in the catalogue?</summary><p>Yes. Share the product name, manufacturer, catalogue code or a photo reference, plus the quantity and delivery pincode. We can check on-demand sourcing and confirm whether it can be arranged.</p></details>
          <details><summary>How do I know what I am being quoted for?</summary><p>Ask for the manufacturer, exact product/variant, pack size, quantity, price and estimated dispatch or delivery timeline. Available batch, expiry, invoice and product documentation details are shared where applicable.</p></details>
          <details><summary>What happens if the requested item is unavailable?</summary><p>We will tell you that it is unavailable or requires additional sourcing time. Any alternate brand, model, size or pack must be shown to you and approved before proceeding.</p></details>
          <details><summary>Do you show live stock or guarantee same-day delivery?</summary><p>No. This website is an enquiry catalogue, not a live inventory system. Availability and delivery feasibility are checked for each order before confirmation.</p></details>
        </div>
      </div>
    </section>

    <section class="final-cta">
      <div class="container final-cta-inner"><div><span class="eyebrow eyebrow-light"><span class="eyebrow-line"></span> The next step starts here</span><h2>Let's make sourcing<br><em>feel more certain.</em></h2></div><a href="#contact" class="round-cta" aria-label="Go to enquiry form"><span>Start<br>an enquiry</span><b>↗</b></a></div>
    </section>
  </main>

  <a class="whatsapp-float" href="https://wa.me/919829066117?text=Hello%20Accent%20International%2C%20I%20would%20like%20to%20enquire%20about%20dental%20products." target="_blank" rel="noopener noreferrer" aria-label="Send a dental product enquiry on WhatsApp"><span class="whatsapp-icon" aria-hidden="true"><svg viewBox="0 0 32 32" focusable="false"><path d="M16 4.5a11.5 11.5 0 0 0-9.9 17.35L4.6 27.5l5.8-1.48A11.5 11.5 0 1 0 16 4.5Z" fill="none" stroke="currentColor" stroke-width="2.2"/><path d="M12.1 10.4c.35-.4.8-.45 1.17-.1l1.37 1.35c.3.3.35.74.12 1.1l-.65.98c.68 1.48 1.87 2.67 3.35 3.35l.98-.65c.36-.23.8-.18 1.1.12l1.35 1.37c.35.37.3.82-.1 1.17-.57.5-1.3.77-2.06.77-3.78 0-7.5-3.72-7.5-7.5 0-.76.27-1.49.77-2.06Z" fill="currentColor"/></svg></span><span>Ask for a product</span><b>↗</b></a>

  <footer class="site-footer">
    <div class="container footer-main">
      <a class="brand-lockup footer-brand" href="#top"><span class="brand-mark"><img src="assets/images/accent-emblem.png" alt="Accent International tooth and A emblem" width="68" height="48"></span><span class="brand-name">Accent<span>International</span></span></a>
      <p>Dental imports & exports · Clinical materials · Surgical instruments · Dental equipment</p>
      <div class="footer-links"><a href="#solutions">Who we serve</a><a href="#catalogue">Catalogue</a><a href="#brands">Brands</a><a href="#contact">Enquiries</a></div>
    </div>
    <div class="container footer-bottom"><span>© <?= date('Y') ?> Accent International. All rights reserved.</span><span>Brand names and trademarks are the property of their respective owners.</span><a href="#top">Back to top ↑</a></div>
  </footer>
  <script src="assets/js/app.js" defer></script>
</body>
</html>
