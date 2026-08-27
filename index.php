<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Peminjaman Ruangan — Universitas Teknokrat Indonesia</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#F5F6FB;
    --surface:#FFFFFF;
    --ink:#171B33;
    --ink-soft:#5B5F7A;
    --primary:#1E2A5E;
    --primary-light:#33407F;
    --primary-dim:#EDEFF8;
    --accent:#E8A33D;
    --accent-dim:#FBEBD2;
    --ok:#2F9E6E;
    --ok-dim:#E4F5EC;
    --danger:#D14343;
    --danger-dim:#FBE7E7;
    --line:#E2E4F0;
    --radius:14px;
    --shadow:0 2px 10px rgba(23,27,51,0.06), 0 10px 30px rgba(23,27,51,0.06);
  }
  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body{
    margin:0;
    background:var(--bg);
    color:var(--ink);
    font-family:'Inter',sans-serif;
    -webkit-font-smoothing:antialiased;
  }
  h1,h2,h3,h4{
    font-family:'Space Grotesk',sans-serif;
    margin:0;
    color:var(--ink);
    letter-spacing:-0.01em;
  }
  .mono{font-family:'JetBrains Mono',monospace;}
  p{margin:0;color:var(--ink-soft);line-height:1.6;}
  a{color:inherit;}
  button{font-family:inherit;}
  .wrap{max-width:1120px;margin:0 auto;padding:0 24px;}
  ::selection{background:var(--accent);color:#171308;}
  :focus-visible{outline:3px solid var(--accent);outline-offset:2px;}

  /* ---------- NAV ---------- */
  header.nav{
    position:sticky;top:0;z-index:50;
    background:rgba(245,246,251,0.88);
    backdrop-filter:blur(10px);
    border-bottom:1px solid var(--line);
  }
  .nav-inner{
    max-width:1120px;margin:0 auto;padding:14px 24px;
    display:flex;align-items:center;justify-content:space-between;gap:16px;
  }
  .brand{display:flex;align-items:center;gap:11px;text-decoration:none;}
  .brand-mark{width:38px;height:38px;flex:none;}
  .brand-text{line-height:1.15;}
  .brand-text b{display:block;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:15px;color:var(--primary);}
  .brand-text span{display:block;font-size:11px;color:var(--ink-soft);}
  nav.links{display:flex;gap:28px;align-items:center;}
  nav.links a{
    font-size:14px;font-weight:600;text-decoration:none;color:var(--ink-soft);
    padding:6px 2px;border-bottom:2px solid transparent;transition:.15s;
  }
  nav.links a:hover{color:var(--primary);border-color:var(--accent);}
  .nav-cta{
    background:var(--primary);color:#fff;border:none;padding:10px 18px;
    border-radius:999px;font-weight:600;font-size:13.5px;cursor:pointer;
    transition:.15s;
  }
  .nav-cta:hover{background:var(--primary-light);}
  .menu-toggle{display:none;background:none;border:none;cursor:pointer;padding:6px;}

  /* ---------- HERO ---------- */
  .hero{padding:64px 0 40px;}
  .hero-grid{display:grid;grid-template-columns:1.1fr 0.9fr;gap:48px;align-items:center;}
  .eyebrow{
    display:inline-flex;align-items:center;gap:8px;
    font-size:12.5px;font-weight:600;color:var(--primary);
    background:var(--primary-dim);padding:6px 12px;border-radius:999px;
    margin-bottom:18px;
  }
  .eyebrow .dot{width:6px;height:6px;border-radius:50%;background:var(--accent);}
  .hero h1{font-size:44px;line-height:1.12;font-weight:700;}
  .hero h1 em{font-style:normal;color:var(--primary);position:relative;}
  .hero p.lead{margin-top:18px;font-size:16.5px;max-width:480px;}
  .hero-cta{display:flex;gap:12px;margin-top:30px;flex-wrap:wrap;}
  .btn-primary,.btn-ghost{
    padding:13px 24px;border-radius:10px;font-weight:600;font-size:14.5px;
    cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;
    transition:.15s;border:1.5px solid transparent;
  }
  .btn-primary{background:var(--primary);color:#fff;}
  .btn-primary:hover{background:var(--primary-light);transform:translateY(-1px);}
  .btn-ghost{background:var(--surface);color:var(--ink);border-color:var(--line);}
  .btn-ghost:hover{border-color:var(--primary);}
  .hero-stats{display:flex;gap:28px;margin-top:36px;flex-wrap:wrap;}
  .hero-stats div b{display:block;font-family:'Space Grotesk',sans-serif;font-size:24px;color:var(--primary);}
  .hero-stats div span{font-size:12.5px;color:var(--ink-soft);}

  .hero-art{position:relative;}
  .skyline{width:100%;height:auto;filter:drop-shadow(0 20px 30px rgba(30,42,94,0.18));}

  /* ---------- SECTION SHELL ---------- */
  section{padding:70px 0;}
  .section-head{max-width:620px;margin-bottom:40px;}
  .section-head .eyebrow{margin-bottom:14px;}
  .section-head h2{font-size:30px;font-weight:700;}
  .section-head p{margin-top:10px;font-size:15.5px;}
  .alt-bg{background:var(--surface);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}

  /* ---------- ROOMS / BUILDING SELECTOR ---------- */
  .building-tabs{display:flex;gap:10px;margin-bottom:28px;}
  .building-tab{
    flex:1;background:var(--surface);border:1.5px solid var(--line);border-radius:var(--radius);
    padding:18px 20px;cursor:pointer;text-align:left;transition:.15s;
  }
  .building-tab:hover{border-color:var(--primary-light);}
  .building-tab.active{border-color:var(--primary);background:var(--primary-dim);}
  .building-tab b{font-family:'Space Grotesk',sans-serif;font-size:16px;display:block;}
  .building-tab span{font-size:13px;color:var(--ink-soft);}

  .explorer{display:grid;grid-template-columns:180px 1fr;gap:28px;background:var(--surface);
    border:1px solid var(--line);border-radius:18px;padding:26px;box-shadow:var(--shadow);}

  /* elevator-style floor panel — signature element */
  .lift-panel{
    background:linear-gradient(180deg,#1B2450,#171B33);
    border-radius:14px;padding:14px 10px;display:flex;flex-direction:column;gap:8px;
    position:relative;
  }
  .lift-label{color:#8992C4;font-size:10.5px;font-family:'JetBrains Mono',monospace;
    text-align:center;letter-spacing:.06em;margin-bottom:4px;}
  .lift-btn{
    appearance:none;border:1px solid rgba(255,255,255,0.14);background:rgba(255,255,255,0.04);
    color:#C9CDEA;border-radius:10px;padding:12px 6px;font-family:'JetBrains Mono',monospace;
    font-size:13px;font-weight:600;cursor:pointer;display:flex;flex-direction:column;align-items:center;
    gap:4px;transition:.15s;
  }
  .lift-btn .led{width:7px;height:7px;border-radius:50%;background:#3A4076;transition:.15s;}
  .lift-btn:hover{background:rgba(255,255,255,0.09);color:#fff;}
  .lift-btn.active{background:var(--accent);color:#241804;border-color:var(--accent);}
  .lift-btn.active .led{background:#241804;box-shadow:0 0 8px 2px rgba(232,163,61,0.9);}

  .room-list{display:flex;flex-direction:column;gap:10px;}
  .room-list h4{font-size:13px;color:var(--ink-soft);font-weight:600;text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px;}
  .room-card{
    display:flex;justify-content:space-between;align-items:center;gap:14px;
    border:1.5px solid var(--line);border-radius:12px;padding:14px 16px;cursor:pointer;transition:.15s;background:#fff;
  }
  .room-card:hover{border-color:var(--primary-light);}
  .room-card.selected{border-color:var(--primary);background:var(--primary-dim);}
  .room-card .rc-left b{font-family:'Space Grotesk',sans-serif;font-size:15px;}
  .room-card .rc-left span{font-size:12.5px;color:var(--ink-soft);display:block;margin-top:2px;}
  .room-card .rc-cap{font-family:'JetBrains Mono',monospace;font-size:12.5px;background:var(--accent-dim);
    color:#8A5A0E;padding:5px 10px;border-radius:8px;white-space:nowrap;}
  .room-card .rc-pick{width:20px;height:20px;border-radius:50%;border:2px solid var(--line);flex:none;}
  .room-card.selected .rc-pick{border-color:var(--primary);background:var(--primary);
    box-shadow:inset 0 0 0 3px #fff;}

  /* ---------- WIZARD ---------- */
  .wizard{background:var(--surface);border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);overflow:hidden;}
  .steps-bar{display:flex;border-bottom:1px solid var(--line);}
  .step-tab{flex:1;padding:16px 10px;text-align:center;font-size:12.5px;font-weight:600;color:var(--ink-soft);
    position:relative;background:#fbfbfe;}
  .step-tab .num{display:inline-flex;width:22px;height:22px;border-radius:50%;background:var(--line);color:#fff;
    align-items:center;justify-content:center;font-size:11.5px;margin-right:7px;font-family:'JetBrains Mono',monospace;}
  .step-tab.done{color:var(--ok);background:var(--ok-dim);}
  .step-tab.done .num{background:var(--ok);}
  .step-tab.current{color:var(--primary);background:var(--primary-dim);}
  .step-tab.current .num{background:var(--primary);}
  .step-panel{padding:32px;display:none;}
  .step-panel.active{display:block;}
  .field-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;}
  .field{display:flex;flex-direction:column;gap:6px;}
  .field label{font-size:13px;font-weight:600;color:var(--ink);}
  .field .hint{font-size:11.5px;color:var(--ink-soft);font-weight:400;}
  .field input,.field select,.field textarea{
    border:1.5px solid var(--line);border-radius:10px;padding:11px 13px;font-size:14px;
    font-family:'Inter',sans-serif;background:#fff;color:var(--ink);
  }
  .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--primary);}
  .field textarea{resize:vertical;min-height:80px;}
  .selected-room-chip{
    display:inline-flex;align-items:center;gap:10px;background:var(--primary-dim);border:1px solid var(--line);
    border-radius:12px;padding:10px 16px;margin-bottom:20px;font-size:13.5px;
  }
  .selected-room-chip b{font-family:'Space Grotesk',sans-serif;}
  .selected-room-chip button{background:none;border:none;color:var(--primary);font-weight:600;cursor:pointer;font-size:12.5px;}

  .timeline-wrap{margin-top:6px;background:#fbfbfe;border:1px solid var(--line);border-radius:12px;padding:16px 18px;}
  .timeline-wrap h4{font-size:12.5px;color:var(--ink-soft);text-transform:uppercase;letter-spacing:.04em;margin-bottom:12px;}
  .timeline{position:relative;height:34px;background:var(--ok-dim);border-radius:8px;overflow:hidden;}
  .timeline .block{position:absolute;top:0;bottom:0;background:var(--danger);opacity:0.82;}
  .timeline .block span{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;
    font-size:10.5px;color:#fff;font-family:'JetBrains Mono',monospace;font-weight:600;padding:0 4px;overflow:hidden;white-space:nowrap;}
  .timeline-scale{display:flex;justify-content:space-between;margin-top:6px;font-size:10.5px;color:var(--ink-soft);
    font-family:'JetBrains Mono',monospace;}

  .wizard-actions{display:flex;justify-content:space-between;padding:22px 32px;border-top:1px solid var(--line);background:#fbfbfe;}
  .btn-back{background:none;border:1.5px solid var(--line);border-radius:10px;padding:11px 20px;font-weight:600;
    font-size:13.5px;cursor:pointer;color:var(--ink-soft);}
  .btn-back:hover{border-color:var(--ink-soft);}
  .btn-next{background:var(--primary);color:#fff;border:none;border-radius:10px;padding:11px 22px;font-weight:600;
    font-size:13.5px;cursor:pointer;}
  .btn-next:hover{background:var(--primary-light);}
  .btn-next:disabled{background:#B9BEDC;cursor:not-allowed;}

  .review-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px 24px;margin-bottom:22px;}
  .review-item{border-bottom:1px dashed var(--line);padding-bottom:10px;}
  .review-item span{font-size:11.5px;color:var(--ink-soft);text-transform:uppercase;letter-spacing:.04em;display:block;margin-bottom:3px;}
  .review-item b{font-size:14.5px;font-family:'Space Grotesk',sans-serif;}

  .alert{border-radius:10px;padding:12px 15px;font-size:13.5px;margin-bottom:16px;display:none;gap:10px;align-items:flex-start;}
  .alert.show{display:flex;}
  .alert.error{background:var(--danger-dim);color:#8C2626;border:1px solid #F1C4C4;}
  .alert.ok{background:var(--ok-dim);color:#1B6B49;border:1px solid #B9E5CE;}

  .success-panel{padding:48px 32px;text-align:center;display:none;}
  .success-panel.active{display:block;}
  .success-icon{width:64px;height:64px;border-radius:50%;background:var(--ok-dim);display:flex;align-items:center;
    justify-content:center;margin:0 auto 20px;}
  .success-code{display:inline-block;margin-top:16px;background:var(--primary-dim);color:var(--primary);
    font-family:'JetBrains Mono',monospace;font-weight:600;padding:9px 18px;border-radius:8px;font-size:14px;}
  .success-panel .review-grid{max-width:440px;margin:26px auto;text-align:left;}

  /* ---------- SCHEDULE / JADWAL ---------- */
  .schedule-filters{display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap;}
  .schedule-filters select,.schedule-filters input{
    border:1.5px solid var(--line);border-radius:10px;padding:9px 13px;font-size:13.5px;background:#fff;
  }
  table.schedule{width:100%;border-collapse:collapse;background:var(--surface);border:1px solid var(--line);
    border-radius:14px;overflow:hidden;}
  table.schedule th{
    background:var(--primary-dim);color:var(--primary);text-align:left;font-size:11.5px;text-transform:uppercase;
    letter-spacing:.04em;padding:12px 16px;font-weight:700;
  }
  table.schedule td{padding:13px 16px;font-size:13.5px;border-top:1px solid var(--line);color:var(--ink);}
  table.schedule tr:hover td{background:#fbfbfe;}
  .badge-gedung{font-family:'JetBrains Mono',monospace;font-size:11px;padding:3px 9px;border-radius:6px;font-weight:600;}
  .badge-gedung.ICT{background:var(--primary-dim);color:var(--primary);}
  .badge-gedung.GSG{background:var(--accent-dim);color:#8A5A0E;}
  .empty-row td{text-align:center;color:var(--ink-soft);padding:30px;}

  /* ---------- HOW IT WORKS ---------- */
  .flow{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
  .flow-step{background:var(--surface);border:1px solid var(--line);border-radius:14px;padding:22px 20px;}
  .flow-step .n{font-family:'JetBrains Mono',monospace;color:var(--accent);font-weight:700;font-size:13px;margin-bottom:10px;}
  .flow-step h4{font-size:15.5px;margin-bottom:6px;}
  .flow-step p{font-size:13px;}

  /* ---------- RULES ---------- */
  .rules-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
  .rule-card{background:var(--surface);border:1px solid var(--line);border-radius:14px;padding:20px 22px;}
  .rule-card h4{font-size:14.5px;margin-bottom:8px;display:flex;align-items:center;gap:8px;}
  .rule-card ul{margin:0;padding-left:18px;color:var(--ink-soft);font-size:13.5px;line-height:1.8;}

  /* ---------- FOOTER ---------- */
  footer{background:var(--primary);color:#D9DCF2;padding:50px 0 26px;margin-top:20px;}
  .footer-grid{display:grid;grid-template-columns:1.4fr 1fr 1fr;gap:40px;}
  footer h4{color:#fff;font-size:14px;margin-bottom:14px;}
  footer p{color:#AEB3DA;font-size:13.5px;}
  footer .brand-text b{color:#fff;}
  footer .brand-text span{color:#AEB3DA;}
  footer ul{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:9px;}
  footer ul a{color:#C7CAE8;font-size:13.5px;text-decoration:none;}
  footer ul a:hover{color:#fff;}
  .footer-bottom{margin-top:36px;padding-top:20px;border-top:1px solid rgba(255,255,255,0.12);
    font-size:12.5px;color:#9CA1CC;display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;}

  /* ---------- RESPONSIVE ---------- */
/*  @media (max-width:880px){
    nav.links{display:none;}
    .menu-toggle{display:block;}
    .hero-grid{grid-template-columns:1fr;}
    .hero-art{order:-1;max-width:320px;margin:0 auto;}
    .hero h1{font-size:32px;}
    .explorer{grid-template-columns:1fr;}
    .lift-panel{flex-direction:row;overflow-x:auto;}
    .field-row{grid-template-columns:1fr;}
    .review-grid{grid-template-columns:1fr;}
    .flow{grid-template-columns:1fr 1fr;}
    .rules-grid{grid-template-columns:1fr;}
    .footer-grid{grid-template-columns:1fr;gap:26px;}
    .steps-bar{flex-wrap:wrap;}
    .step-tab{min-width:50%;}
  } */
    /* ---------- RESPONSIVE IMPROVEMENTS ---------- */
@media (max-width: 880px) {
  .wrap {
    padding: 0 16px; /* Kurangi padding samping agar konten lebih luas */
  }

  /* 1. Header & Navigasi */
  nav.links {
    display: none; /* Disembunyikan untuk tampilan mobile */
  }
  .menu-toggle {
    display: block;
  }
  .nav-cta {
    padding: 8px 14px;
    font-size: 12.5px;
  }

  /* 2. Hero Section */
  .hero {
    padding: 32px 0 24px;
  }
  .hero-grid {
    grid-template-columns: 1fr;
    gap: 28px;
    text-align: left;
  }
  .hero-art {
    order: -1; /* Pindahkan gambar ilustrasi ke atas teks di mobile */
    max-width: 280px;
    margin: 0 auto;
  }
  .hero h1 {
    font-size: 28px;
    line-height: 1.2;
  }
  .hero p.lead {
    font-size: 14.5px;
  }
  
  /* Tombol Hero penuh selebar layar di HP */
  .hero-cta {
    flex-direction: column;
    gap: 10px;
  }
  .btn-primary, .btn-ghost {
    width: 100%;
    justify-content: center;
  }

  /* Statistik (2 Gedung, 9 Ruangan, dll) Rapi 2 Kolom */
  .hero-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-top: 24px;
    background: var(--surface);
    padding: 16px;
    border-radius: var(--radius);
    border: 1px solid var(--line);
  }
  .hero-stats div b {
    font-size: 20px;
  }

  /* 3. Tab Gedung & Denah Ruangan (Explorer) */
  .building-tabs {
    flex-direction: column;
    gap: 8px;
  }
  .building-tab {
    padding: 12px 16px;
  }
  .explorer {
    grid-template-columns: 1fr;
    padding: 16px;
    gap: 18px;
  }

  /* Panel Lift (Pilihan Lantai) geser menyamping di HP */
  .lift-panel {
    flex-direction: row;
    overflow-x: auto;
    justify-content: space-between;
    padding: 8px;
  }
  .lift-label {
    display: none; /* Sembunyikan label di HP agar hemat ruang */
  }
  .lift-btn {
    flex: 1;
    padding: 8px 12px;
    flex-direction: row;
    justify-content: center;
    font-size: 12px;
  }

  /* Card Ruangan */
  .room-card {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
    padding: 12px;
  }
  .room-card .rc-cap {
    align-self: flex-start;
  }

  /* 4. Wizard / Formulir Peminjaman */
  .wizard {
    border-radius: 12px;
  }
  .steps-bar {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Step 1-2 di atas, 3-4 di bawah */
  }
  .step-tab {
    font-size: 11.5px;
    padding: 10px 6px;
  }
  .step-panel {
    padding: 18px 14px;
  }
  .field-row {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  .wizard-actions {
    padding: 14px 16px;
  }
  .review-grid {
    grid-template-columns: 1fr;
  }

  /* 5. Tabel Jadwal Peminjaman (Responsif dengan Scroll Horizontal) */
  .schedule-filters {
    flex-direction: column;
  }
  .schedule-filters select, 
  .schedule-filters input, 
  .schedule-filters button {
    width: 100%;
  }
  
  /* Pembungkus tabel agar bisa di-scroll ke samping jika lebar */
  #jadwal .wrap {
    overflow-x: auto;
  }
  table.schedule {
    min-width: 550px; /* Menjaga isi tabel tetap rapi & terbaca */
  }

  /* 6. Alur & Ketentuan (Flow & Rules) */
  .flow {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  .rules-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }

  /* 7. Footer */
  footer {
    padding: 36px 0 20px;
  }
  .footer-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
  .footer-bottom {
    flex-direction: column;
    gap: 6px;
    text-align: center;
  }
}
  @media (prefers-reduced-motion: reduce){
    html{scroll-behavior:auto;}
    *{transition:none !important;}
  }
</style>
</head>
<body>

<!-- ============ NAV ============ -->
<header class="nav">
  <div class="nav-inner">
    <a href="#top" class="brand">
      <svg class="brand-mark" viewBox="0 0 40 40" fill="none">
        <rect width="40" height="40" rx="9" fill="#1E2A5E"/>
        <path d="M10 27V16.5L20 11l10 5.5V27" stroke="#E8A33D" stroke-width="2.2" stroke-linejoin="round"/>
        <rect x="17" y="20" width="6" height="7" fill="#E8A33D"/>
      </svg>
      <span class="brand-text"><b>SIRUANG</b><span>Univ. Teknokrat Indonesia</span></span>
    </a>
    <nav class="links">
      <a href="#ruangan">Ruangan</a>
      <a href="#pinjam">Ajukan Peminjaman</a>
      <a href="#jadwal">Jadwal</a>
      <a href="#aturan">Ketentuan</a>
      <a href="#kontak">Kontak</a>
    </nav>
    <button class="nav-cta" onclick="document.getElementById('pinjam').scrollIntoView()">Pinjam Ruangan</button>
  </div>
</header>

<div id="top"></div>

<!-- ============ HERO ============ -->
<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow"><span class="dot"></span> Sistem Informasi Ruangan Kampus</span>
      <h1>Pinjam ruangan kampus,<br><em>tanpa antre ke loket.</em></h1>
      <p class="lead">Ajukan peminjaman ruang di Gedung ICT dan GSG secara online. Cek ketersediaan jadwal secara real-time, isi formulir dalam 4 langkah, dan dapatkan kode konfirmasi seketika.</p>
      <div class="hero-cta">
        <a href="#pinjam" class="btn-primary">Ajukan Peminjaman →</a>
        <a href="#jadwal" class="btn-ghost">Cek Jadwal Ruangan</a>
      </div>
      <div class="hero-stats">
        <div><b>2</b><span>Gedung tersedia</span></div>
        <div><b>9</b><span>Ruangan aktif</span></div>
        <div><b>6</b><span>Lantai terjangkau</span></div>
        <div><b>07–21</b><span>Jam operasional</span></div>
      </div>
    </div>
    <div class="hero-art">
      <svg class="skyline" viewBox="0 0 420 340" fill="none" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="210" cy="318" rx="180" ry="14" fill="#1E2A5E" opacity="0.06"/>
        <!-- GSG building -->
        <rect x="20" y="180" width="150" height="120" rx="6" fill="#33407F"/>
        <path d="M14 180 L95 130 L176 180 Z" fill="#1E2A5E"/>
        <g fill="#7C87C4">
          <rect x="38" y="200" width="18" height="18" rx="2"/>
          <rect x="66" y="200" width="18" height="18" rx="2"/>
          <rect x="94" y="200" width="18" height="18" rx="2"/>
          <rect x="122" y="200" width="18" height="18" rx="2"/>
          <rect x="38" y="228" width="18" height="18" rx="2"/>
          <rect x="66" y="228" width="18" height="18" rx="2"/>
          <rect x="94" y="228" width="18" height="18" rx="2"/>
          <rect x="122" y="228" width="18" height="18" rx="2"/>
        </g>
        <rect x="80" y="258" width="30" height="42" rx="2" fill="#E8A33D"/>
        <!-- ICT tower -->
        <rect x="195" y="90" width="120" height="210" rx="6" fill="#1E2A5E"/>
        <g fill="#4A5590">
          <rect x="212" y="112" width="20" height="20" rx="2"/>
          <rect x="242" y="112" width="20" height="20" rx="2"/>
          <rect x="272" y="112" width="20" height="20" rx="2"/>
          <rect x="212" y="144" width="20" height="20" rx="2"/>
          <rect x="242" y="144" width="20" height="20" rx="2"/>
          <rect x="272" y="144" width="20" height="20" rx="2"/>
          <rect x="212" y="176" width="20" height="20" rx="2"/>
          <rect x="242" y="176" width="20" height="20" rx="2"/>
          <rect x="272" y="176" width="20" height="20" rx="2"/>
          <rect x="212" y="208" width="20" height="20" rx="2"/>
          <rect x="242" y="208" width="20" height="20" rx="2"/>
          <rect x="272" y="208" width="20" height="20" rx="2"/>
        </g>
        <rect x="212" y="240" width="20" height="20" rx="2" fill="#E8A33D"/>
        <rect x="242" y="240" width="20" height="20" rx="2" fill="#E8A33D"/>
        <rect x="272" y="240" width="20" height="20" rx="2" fill="#4A5590"/>
        <rect x="245" y="272" width="20" height="28" rx="2" fill="#0F1533"/>
        <!-- small annex -->
        <rect x="320" y="220" width="70" height="80" rx="6" fill="#33407F"/>
        <g fill="#7C87C4">
          <rect x="332" y="236" width="16" height="16" rx="2"/>
          <rect x="356" y="236" width="16" height="16" rx="2"/>
          <rect x="332" y="260" width="16" height="16" rx="2"/>
          <rect x="356" y="260" width="16" height="16" rx="2"/>
        </g>
      </svg>
    </div>
  </div>
</section>

<!-- ============ RUANGAN ============ -->
<section id="ruangan" class="alt-bg">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow"><span class="dot"></span> Denah Gedung</span>
      <h2>Jelajahi ruangan per gedung dan lantai</h2>
      <p>Pilih gedung, tekan tombol lantai seperti panel lift, lalu lihat ruangan yang tersedia di lantai tersebut.</p>
    </div>

    <div class="building-tabs">
      <button class="building-tab active" data-building="ICT" onclick="selectBuilding('ICT')">
        <b>Gedung ICT</b>
        <span>Lantai 1–3 · Lab, kelas & ruang seminar</span>
      </button>
      <button class="building-tab" data-building="GSG" onclick="selectBuilding('GSG')">
        <b>Gedung GSG</b>
        <span>Lantai 1–3 · Aula & ruang serbaguna</span>
      </button>
    </div>

    <div class="explorer">
      <div class="lift-panel">
        <div class="lift-label">PANEL LANTAI</div>
        <button class="lift-btn" data-floor="3" onclick="selectFloor(3)"><span class="led"></span>Lt. 3</button>
        <button class="lift-btn" data-floor="2" onclick="selectFloor(2)"><span class="led"></span>Lt. 2</button>
        <button class="lift-btn active" data-floor="1" onclick="selectFloor(1)"><span class="led"></span>Lt. 1</button>
      </div>
      <div class="room-list">
        <h4 id="roomListTitle">Gedung ICT — Lantai 1</h4>
        <div id="roomListContainer"></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CARA KERJA ============ -->
<section>
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow"><span class="dot"></span> Alur Proses</span>
      <h2>4 langkah dari pilih ruangan sampai terkonfirmasi</h2>
    </div>
    <div class="flow">
      <div class="flow-step"><div class="n">01</div><h4>Pilih Ruangan</h4><p>Tentukan gedung, lantai, dan ruangan sesuai kapasitas acara.</p></div>
      <div class="flow-step"><div class="n">02</div><h4>Cek Jadwal</h4><p>Lihat jam yang sudah terisi lalu pilih slot waktu yang kosong.</p></div>
      <div class="flow-step"><div class="n">03</div><h4>Isi Data Diri</h4><p>Lengkapi identitas peminjam dan tujuan penggunaan ruangan.</p></div>
      <div class="flow-step"><div class="n">04</div><h4>Terima Kode</h4><p>Dapatkan kode konfirmasi sebagai bukti peminjaman sah.</p></div>
    </div>
  </div>
</section>

<!-- ============ FORM PEMINJAMAN (WIZARD) ============ -->
<section id="pinjam" class="alt-bg">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow"><span class="dot"></span> Formulir</span>
      <h2>Ajukan peminjaman ruangan</h2>
      <p>Lengkapi setiap langkah berikut. Data yang sudah dipilih di bagian denah gedung akan otomatis terisi.</p>
    </div>

    <div class="wizard">
      <div class="steps-bar" id="stepsBar">
        <div class="step-tab current" data-step="1"><span class="num">1</span>Ruangan</div>
        <div class="step-tab" data-step="2"><span class="num">2</span>Waktu</div>
        <div class="step-tab" data-step="3"><span class="num">3</span>Data Diri</div>
        <div class="step-tab" data-step="4"><span class="num">4</span>Konfirmasi</div>
      </div>

      <!-- STEP 1 -->
      <div class="step-panel active" id="panel-1">
        <div class="alert error" id="alertStep1"><span>⚠</span><span>Silakan pilih ruangan terlebih dahulu di bagian denah gedung di atas.</span></div>
        <p style="margin-bottom:14px;">Ruangan yang sedang dipilih:</p>
        <div id="step1RoomDisplay"></div>
      </div>

      <!-- STEP 2 -->
      <div class="step-panel" id="panel-2">
        <div id="selectedChipStep2"></div>
        <div class="field-row">
          <div class="field">
            <label>Tanggal Penggunaan</label>
            <input type="date" id="fTanggal">
          </div>
          <div class="field"></div>
          <div class="field">
            <label>Jam Mulai</label>
            <select id="fJamMulai"></select>
          </div>
          <div class="field">
            <label>Jam Selesai</label>
            <select id="fJamSelesai"></select>
          </div>
        </div>
        <div class="alert error" id="alertStep2"><span>⚠</span><span id="alertStep2Text">Jam yang dipilih bentrok dengan jadwal lain.</span></div>
        <div class="timeline-wrap">
          <h4>Ketersediaan pada tanggal terpilih (07:00–21:00)</h4>
          <div class="timeline" id="timelineBar"></div>
          <div class="timeline-scale">
            <span>07:00</span><span>09:00</span><span>11:00</span><span>13:00</span><span>15:00</span><span>17:00</span><span>19:00</span><span>21:00</span>
          </div>
        </div>
      </div>

      <!-- STEP 3 -->
      <div class="step-panel" id="panel-3">
        <div class="field-row">
          <div class="field">
            <label>Nama Lengkap Peminjam</label>
            <input type="text" id="fNama" placeholder="cth. Budi Santoso">
          </div>
          <div class="field">
            <label>NIM / NIP / Nama Unit</label>
            <input type="text" id="fIdentitas" placeholder="cth. 23312051 / HMIF">
          </div>
        </div>
        <div class="field-row">
          <div class="field">
            <label>Nomor WhatsApp Aktif</label>
            <input type="tel" id="fKontak" placeholder="cth. 0812xxxxxxx">
          </div>
          <div class="field">
            <label>Program Studi / Fakultas / Unit</label>
            <input type="text" id="fUnit" placeholder="cth. Informatika">
          </div>
        </div>
        <div class="field">
          <label>Keperluan Peminjaman <span class="hint">— jelaskan singkat acara/kegiatan</span></label>
          <textarea id="fKeperluan" placeholder="cth. Rapat koordinasi himpunan mahasiswa, dihadiri 25 peserta"></textarea>
        </div>
      </div>

      <!-- STEP 4 -->
      <div class="step-panel" id="panel-4">
        <div class="alert error" id="alertStep4"><span>⚠</span><span>Terjadi bentrok jadwal. Silakan kembali ke langkah Waktu.</span></div>
        <p style="margin-bottom:18px;">Periksa kembali detail peminjaman sebelum mengirim.</p>
        <div class="review-grid" id="reviewGrid"></div>
      </div>

      <!-- SUCCESS -->
      <div class="success-panel" id="panelSuccess">
        <div class="success-icon">
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none"><path d="M4 12.5L9 17.5L20 6.5" stroke="#2F9E6E" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h2>Peminjaman Berhasil Diajukan</h2>
        <p style="margin-top:8px;">Simpan kode konfirmasi berikut sebagai bukti peminjaman ruangan Anda.</p>
        <div class="success-code mono" id="successCode">UTI-000000</div>
        <div class="review-grid" id="successReview"></div>
        <button class="btn-primary" onclick="resetWizard()">Ajukan Peminjaman Baru</button>
      </div>

      <div class="wizard-actions" id="wizardActions">
        <button class="btn-back" id="btnBack" onclick="prevStep()">Kembali</button>
        <button class="btn-next" id="btnNext" onclick="nextStep()">Lanjut</button>
      </div>
    </div>
  </div>
</section>

<!-- ============ JADWAL ============ -->
<section id="jadwal">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow"><span class="dot"></span> Transparansi Jadwal</span>
      <h2>Jadwal peminjaman ruangan</h2>
      <p>Semua pengajuan yang masuk pada sesi ini ditampilkan di sini agar tidak terjadi tabrakan jadwal.</p>
    </div>
    <div class="schedule-filters">
      <select id="filterGedung" onchange="renderSchedule()">
        <option value="">Semua Gedung</option>
        <option value="ICT">Gedung ICT</option>
        <option value="GSG">Gedung GSG</option>
      </select>
      <input type="date" id="filterTanggal" onchange="renderSchedule()">
      <button class="btn-ghost" onclick="clearFilters()">Reset Filter</button>
    </div>
    <table class="schedule">
      <thead>
        <tr><th>Tanggal</th><th>Jam</th><th>Ruangan</th><th>Peminjam</th><th>Keperluan</th></tr>
      </thead>
      <tbody id="scheduleBody"></tbody>
    </table>
  </div>
</section>

<!-- ============ ATURAN ============ -->
<section id="aturan" class="alt-bg">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow"><span class="dot"></span> Ketentuan</span>
      <h2>Yang perlu diperhatikan sebelum meminjam</h2>
    </div>
    <div class="rules-grid">
      <div class="rule-card">
        <h4>🕒 Waktu peminjaman</h4>
        <ul>
          <li>Ruangan hanya dapat dipinjam pada jam 07.00–21.00 WIB.</li>
          <li>Pengajuan disarankan dilakukan minimal 1 hari sebelum penggunaan.</li>
          <li>Durasi harus sesuai jadwal yang diajukan; toleransi keterlambatan maksimal 15 menit.</li>
        </ul>
      </div>
      <div class="rule-card">
        <h4>📋 Kelengkapan data</h4>
        <ul>
          <li>Wajib mencantumkan nama, NIM/NIP/unit, dan nomor kontak aktif.</li>
          <li>Keperluan peminjaman diisi dengan jelas dan sesuai kegiatan sebenarnya.</li>
          <li>Peminjam bertanggung jawab atas kebersihan dan kelengkapan ruangan.</li>
        </ul>
      </div>
      <div class="rule-card">
        <h4>🏢 Kapasitas ruangan</h4>
        <ul>
          <li>Jumlah peserta tidak boleh melebihi kapasitas ruangan yang dipilih.</li>
          <li>Untuk acara besar, gunakan Aula GSG Lantai 1 (kapasitas hingga 300 orang).</li>
        </ul>
      </div>
      <div class="rule-card">
        <h4>✅ Konfirmasi</h4>
        <ul>
          <li>Kode konfirmasi yang diterbitkan menjadi bukti sah peminjaman.</li>
          <li>Pembatalan mohon diinformasikan kepada pengelola gedung sesegera mungkin.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ FOOTER ============ -->
<footer id="kontak">
  <div class="wrap footer-grid">
    <div>
      <a href="#top" class="brand">
        <svg class="brand-mark" viewBox="0 0 40 40" fill="none">
          <rect width="40" height="40" rx="9" fill="#E8A33D"/>
          <path d="M10 27V16.5L20 11l10 5.5V27" stroke="#1E2A5E" stroke-width="2.2" stroke-linejoin="round"/>
          <rect x="17" y="20" width="6" height="7" fill="#1E2A5E"/>
        </svg>
        <span class="brand-text"><b>SIRUANG</b><span>Univ. Teknokrat Indonesia</span></span>
      </a>
      <p style="margin-top:16px;max-width:280px;">Sistem peminjaman ruangan untuk memudahkan mahasiswa, dosen, dan unit kampus menggunakan fasilitas Gedung ICT dan GSG.</p>
    </div>
    <div>
      <h4>Navigasi</h4>
      <ul>
        <li><a href="#ruangan">Denah Ruangan</a></li>
        <li><a href="#pinjam">Ajukan Peminjaman</a></li>
        <li><a href="#jadwal">Jadwal Ruangan</a></li>
        <li><a href="#aturan">Ketentuan Peminjaman</a></li>
      </ul>
    </div>
    <div>
      <h4>Kontak Pengelola</h4>
      <ul>
        <li>Biro Sarana &amp; Prasarana</li>
        <li>Kampus Universitas Teknokrat Indonesia</li>
        <li>Bandar Lampung, Lampung</li>
        <li>Jam layanan: 07.00–21.00 WIB</li>
      </ul>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <span>© 2026 Universitas Teknokrat Indonesia — Sistem Peminjaman Ruangan.</span>
    <span>Dibuat untuk kebutuhan internal kampus.</span>
  </div>
</footer>

<script>
/* ================= DATA ================= */
/*const ROOMS = [
  {id:'ict-101', gedung:'ICT', lantai:1, nama:'ICT 101', tipe:'Lab Komputer', kapasitas:40},
  {id:'ict-102', gedung:'ICT', lantai:1, nama:'ICT 102', tipe:'Ruang Diskusi', kapasitas:20},
  {id:'ict-201', gedung:'ICT', lantai:2, nama:'ICT 201', tipe:'Ruang Seminar', kapasitas:60},
  {id:'ict-202', gedung:'ICT', lantai:2, nama:'ICT 202', tipe:'Ruang Rapat', kapasitas:15},
  {id:'ict-301', gedung:'ICT', lantai:3, nama:'ICT 301', tipe:'Ruang Multimedia', kapasitas:50},
  {id:'ict-302', gedung:'ICT', lantai:3, nama:'ICT 302', tipe:'Ruang Kelas', kapasitas:35},
  {id:'gsg-1',   gedung:'GSG', lantai:1, nama:'Aula GSG Lantai 1', tipe:'Aula Utama', kapasitas:300},
  {id:'gsg-2',   gedung:'GSG', lantai:2, nama:'GSG Lantai 2', tipe:'Ruang Serbaguna', kapasitas:150},
  {id:'gsg-3',   gedung:'GSG', lantai:3, nama:'GSG Lantai 3', tipe:'Ruang Workshop', kapasitas:100},
]; */

let ROOMS = [];

async function loadRooms() {
    try {
        const response = await fetch("api/rooms.php");

        if (!response.ok) {
            throw new Error("Gagal mengambil data ruangan");
        }

        const data = await response.json();

        ROOMS = data.map(room => ({
            ...room,
            lantai: Number(room.lantai),
            kapasitas: Number(room.kapasitas)
        }));

        renderRoomList();

    } catch (error) {
        console.error(error);
        alert("Gagal mengambil data ruangan dari server.");
    }
}

loadRooms();

function todayISO(){ return new Date().toISOString().slice(0,10); }

// contoh data awal agar jadwal & timeline tidak kosong saat pertama dibuka
/*let bookings = [
  {id:'UTI-DEMO01', roomId:'ict-201', tanggal:todayISO(), jamMulai:'09:00', jamSelesai:'11:00', nama:'Dewi Anjani', identitas:'21312033', kontak:'0812xxxxxx1', unit:'Sistem Informasi', keperluan:'Seminar proposal skripsi'},
  {id:'UTI-DEMO02', roomId:'gsg-1', tanggal:todayISO(), jamMulai:'13:00', jamSelesai:'17:00', nama:'Panitia Wisuda', identitas:'BAAK', kontak:'0812xxxxxx2', unit:'Biro Akademik', keperluan:'Gladi bersih wisuda'},
]; */
let bookings = [];

async function loadBookings() {
    try {
        const response = await fetch("api/bookings.php");

        if (!response.ok) {
            throw new Error("Gagal mengambil data booking");
        }

        bookings = await response.json();

        renderSchedule();
        renderTimeline();

    } catch (error) {
        console.error(error);
        alert("Gagal mengambil data peminjaman.");
    }
}

let state = { building:'ICT', floor:1, selectedRoom:null, step:1 };

/* ================= EXPLORER (GEDUNG & LANTAI) ================= */
function selectBuilding(b){
  state.building = b;
  document.querySelectorAll('.building-tab').forEach(el=>el.classList.toggle('active', el.dataset.building===b));
  renderRoomList();
}
function selectFloor(f){
  state.floor = f;
  document.querySelectorAll('.lift-btn').forEach(el=>el.classList.toggle('active', Number(el.dataset.floor)===f));
  renderRoomList();
}
function renderRoomList(){
  document.getElementById('roomListTitle').textContent = `Gedung ${state.building} — Lantai ${state.floor}`;
  const list = ROOMS.filter(r=>r.gedung===state.building && r.lantai===state.floor);
  const box = document.getElementById('roomListContainer');
  box.innerHTML = list.map(r=>`
    <div class="room-card ${state.selectedRoom===r.id?'selected':''}" onclick="pickRoom('${r.id}')">
      <div class="rc-left">
        <b>${r.nama}</b>
        <span>${r.tipe}</span>
      </div>
      <span class="rc-cap">Kapasitas ${r.kapasitas}</span>
      <div class="rc-pick"></div>
    </div>`).join('');
  renderStep1();
}
function pickRoom(id){
  state.selectedRoom = id;
  renderRoomList();
  renderStep1();
  renderChipStep2();
  renderTimeline();
}
function roomById(id){ return ROOMS.find(r=>r.id===id); }

/* ================= WIZARD ================= */
function renderStep1(){
  const alertBox = document.getElementById('alertStep1');
  const disp = document.getElementById('step1RoomDisplay');
  const r = state.selectedRoom ? roomById(state.selectedRoom) : null;
  if(!r){
    alertBox.classList.add('show');
    disp.innerHTML = '';
  } else {
    alertBox.classList.remove('show');
    disp.innerHTML = `
      <div class="room-card selected" style="cursor:default;">
        <div class="rc-left"><b>${r.nama}</b><span>Gedung ${r.gedung} · Lantai ${r.lantai} · ${r.tipe}</span></div>
        <span class="rc-cap">Kapasitas ${r.kapasitas}</span>
        <div class="rc-pick"></div>
      </div>`;
  }
  updateNextButton();
}
function renderChipStep2(){
  const r = state.selectedRoom ? roomById(state.selectedRoom) : null;
  const box = document.getElementById('selectedChipStep2');
  if(!r){ box.innerHTML=''; return; }
  box.innerHTML = `<div class="selected-room-chip"><b>${r.nama}</b><span>Gedung ${r.gedung} · Lt.${r.lantai} · maks ${r.kapasitas} orang</span>
    <button onclick="document.querySelector('.step-tab[data-step=\\'1\\']').click()">Ganti</button></div>`;
}

function generateTimeOptions(selectEl, selected){
  let html = '';
  for(let h=7; h<=21; h++){
    for(let m=0; m<60; m+=30){
      if(h===21 && m>0) continue;
      const val = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}`;
      html += `<option value="${val}" ${val===selected?'selected':''}>${val}</option>`;
    }
  }
  selectEl.innerHTML = html;
}

function toMinutes(t){ const [h,m]=t.split(':').map(Number); return h*60+m; }

function renderTimeline(){
  const r = state.selectedRoom ? roomById(state.selectedRoom) : null;
  const tanggal = document.getElementById('fTanggal').value;
  const bar = document.getElementById('timelineBar');
  bar.innerHTML = '';
  if(!r || !tanggal) return;
  const dayBookings = bookings.filter(b=>b.roomId===r.id && b.tanggal===tanggal);
  const startDay = 7*60, endDay = 21*60, span = endDay-startDay;
  dayBookings.forEach(b=>{
    const left = ((toMinutes(b.jamMulai)-startDay)/span)*100;
    const width = ((toMinutes(b.jamSelesai)-toMinutes(b.jamMulai))/span)*100;
    const div = document.createElement('div');
    div.className='block';
    div.style.left = left+'%';
    div.style.width = width+'%';
    div.innerHTML = `<span>${b.jamMulai}–${b.jamSelesai}</span>`;
    bar.appendChild(div);
  });
}

function hasConflict(roomId, tanggal, jamMulai, jamSelesai, excludeId){
  const s = toMinutes(jamMulai), e = toMinutes(jamSelesai);
  return bookings.some(b=>{
    if(b.roomId!==roomId || b.tanggal!==tanggal) return false;
    if(excludeId && b.id===excludeId) return false;
    const bs = toMinutes(b.jamMulai), be = toMinutes(b.jamSelesai);
    return !(e<=bs || s>=be);
  });
}

function updateNextButton(){
  const btn = document.getElementById('btnNext');
  if(state.step===1){ btn.disabled = !state.selectedRoom; }
  else { btn.disabled = false; }
}

function nextStep(){
  if(state.step===1){
    if(!state.selectedRoom) return;
  }
  if(state.step===2){
    const tanggal = document.getElementById('fTanggal').value;
    const jm = document.getElementById('fJamMulai').value;
    const js = document.getElementById('fJamSelesai').value;
    const alertBox = document.getElementById('alertStep2');
    const alertText = document.getElementById('alertStep2Text');
    if(!tanggal){
      alertText.textContent = 'Silakan pilih tanggal penggunaan ruangan.';
      alertBox.classList.add('show'); return;
    }
    if(toMinutes(js) <= toMinutes(jm)){
      alertText.textContent = 'Jam selesai harus lebih besar dari jam mulai.';
      alertBox.classList.add('show'); return;
    }
    if(hasConflict(state.selectedRoom, tanggal, jm, js)){
      alertText.textContent = 'Ruangan sudah dipakai pada rentang jam tersebut. Silakan pilih jam lain (lihat garis waktu di bawah).';
      alertBox.classList.add('show'); return;
    }
    alertBox.classList.remove('show');
  }
  if(state.step===3){
    const required = ['fNama','fIdentitas','fKontak','fUnit','fKeperluan'];
    for(const id of required){
      if(!document.getElementById(id).value.trim()){
        document.getElementById(id).focus();
        return;
      }
    }
    renderReview();
  }
  if(state.step===4){
    submitBooking();
    return;
  }
  goToStep(state.step+1);
}
function prevStep(){ goToStep(state.step-1); }

function goToStep(n){
  state.step = n;
  document.querySelectorAll('.step-panel').forEach(p=>p.classList.remove('active'));
  document.getElementById('panel-'+n).classList.add('active');
  document.querySelectorAll('.step-tab').forEach(t=>{
    const ts = Number(t.dataset.step);
    t.classList.toggle('current', ts===n);
    t.classList.toggle('done', ts<n);
  });
  document.getElementById('btnBack').style.visibility = n===1 ? 'hidden':'visible';
  document.getElementById('btnNext').textContent = n===4 ? 'Kirim Pengajuan' : 'Lanjut';
  if(n===2){ renderChipStep2(); if(!document.getElementById('fTanggal').value){ document.getElementById('fTanggal').value = todayISO(); } renderTimeline(); }
  updateNextButton();
}

// klik langsung pada tab step (hanya mundur / ke step yang sudah selesai)
document.getElementById('stepsBar').addEventListener('click', e=>{
  const tab = e.target.closest('.step-tab');
  if(!tab) return;
  const target = Number(tab.dataset.step);
  if(target < state.step) goToStep(target);
});

function renderReview(){
  const r = roomById(state.selectedRoom);
  const tanggal = document.getElementById('fTanggal').value;
  const jm = document.getElementById('fJamMulai').value;
  const js = document.getElementById('fJamSelesai').value;
  const data = [
    ['Ruangan', `${r.nama} (Gedung ${r.gedung} · Lt.${r.lantai})`],
    ['Tanggal', formatTanggal(tanggal)],
    ['Waktu', `${jm} – ${js} WIB`],
    ['Nama Peminjam', document.getElementById('fNama').value],
    ['NIM/NIP/Unit', document.getElementById('fIdentitas').value],
    ['Nomor Kontak', document.getElementById('fKontak').value],
    ['Prodi/Fakultas/Unit', document.getElementById('fUnit').value],
    ['Keperluan', document.getElementById('fKeperluan').value],
  ];
  document.getElementById('reviewGrid').innerHTML = data.map(([k,v])=>
    `<div class="review-item"><span>${k}</span><b>${escapeHtml(v)}</b></div>`).join('');
}

function formatTanggal(iso){
  if(!iso) return '-';
  const d = new Date(iso+'T00:00:00');
  return d.toLocaleDateString('id-ID', {weekday:'long', day:'numeric', month:'long', year:'numeric'});
}
function escapeHtml(s){ const d=document.createElement('div'); d.textContent=s; return d.innerHTML; }

/*function submitBooking(){
  const tanggal = document.getElementById('fTanggal').value;
  const jm = document.getElementById('fJamMulai').value;
  const js = document.getElementById('fJamSelesai').value;
  if(hasConflict(state.selectedRoom, tanggal, jm, js)){
    document.getElementById('alertStep4').classList.add('show');
    return;
  }
  const code = 'UTI-' + Math.random().toString(36).slice(2,8).toUpperCase();
  const booking = {
    id: code, roomId: state.selectedRoom, tanggal, jamMulai: jm, jamSelesai: js,
    nama: document.getElementById('fNama').value,
    identitas: document.getElementById('fIdentitas').value,
    kontak: document.getElementById('fKontak').value,
    unit: document.getElementById('fUnit').value,
    keperluan: document.getElementById('fKeperluan').value,
  };
  bookings.push(booking);
  renderSchedule();
  showSuccess(booking);
} */

async function submitBooking() {
    const tanggal = document.getElementById('fTanggal').value;
    const jm = document.getElementById('fJamMulai').value;
    const js = document.getElementById('fJamSelesai').value;

    const booking = {
        roomId: state.selectedRoom,
        tanggal: tanggal,
        jamMulai: jm,
        jamSelesai: js,
        nama: document.getElementById('fNama').value,
        identitas: document.getElementById('fIdentitas').value,
        kontak: document.getElementById('fKontak').value,
        unit: document.getElementById('fUnit').value,
        keperluan: document.getElementById('fKeperluan').value
    };

    try {

        // Cek bentrok ke server
        const conflictResponse = await fetch("api/check_conflict.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(booking)
        });

        const conflict = await conflictResponse.json();

        if (conflict.conflict) {
            document.getElementById('alertStep4').classList.add('show');
            return;
        }

        // Simpan ke database
        const response = await fetch("api/create_booking.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(booking)
        });

        const result = await response.json();

        if (!result.success) {
            alert(result.message || "Gagal menyimpan peminjaman.");
            return;
        }

        // Kode dari database
        booking.id = result.kode;

        // Ambil ulang data dari database
        await loadBookings();

        // Tampilkan halaman sukses
        showSuccess(booking);

    } catch (error) {

        console.error(error);

        alert("Terjadi kesalahan saat menghubungi server.");
    }
}

function showSuccess(b){
  const r = roomById(b.roomId);
  document.querySelectorAll('.step-panel').forEach(p=>p.classList.remove('active'));
  document.getElementById('wizardActions').style.display = 'none';
  document.getElementById('stepsBar').style.display = 'none';
  document.getElementById('successCode').textContent = b.id;
  document.getElementById('successReview').innerHTML = [
    ['Ruangan', `${r.nama} (Gedung ${r.gedung})`],
    ['Tanggal', formatTanggal(b.tanggal)],
    ['Waktu', `${b.jamMulai} – ${b.jamSelesai} WIB`],
    ['Atas Nama', b.nama],
  ].map(([k,v])=>`<div class="review-item"><span>${k}</span><b>${escapeHtml(v)}</b></div>`).join('');
  document.getElementById('panelSuccess').classList.add('active');
}

function resetWizard(){
  state.selectedRoom = null; state.step = 1;
  ['fNama','fIdentitas','fKontak','fUnit','fKeperluan'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('panelSuccess').classList.remove('active');
  document.getElementById('wizardActions').style.display = 'flex';
  document.getElementById('stepsBar').style.display = 'flex';
  renderRoomList();
  goToStep(1);
  document.getElementById('pinjam').scrollIntoView();
}

/* ================= JADWAL TABLE ================= */
function renderSchedule(){
  const gedung = document.getElementById('filterGedung').value;
  const tanggal = document.getElementById('filterTanggal').value;
  let rows = bookings.map(b=>({...b, room: roomById(b.roomId)}));
  if(gedung) rows = rows.filter(r=>r.room.gedung===gedung);
  if(tanggal) rows = rows.filter(r=>r.tanggal===tanggal);
  rows.sort((a,b)=> a.tanggal===b.tanggal ? a.jamMulai.localeCompare(b.jamMulai) : a.tanggal.localeCompare(b.tanggal));
  const body = document.getElementById('scheduleBody');
  if(rows.length===0){
    body.innerHTML = `<tr class="empty-row"><td colspan="5">Belum ada jadwal peminjaman untuk filter ini.</td></tr>`;
    return;
  }
  body.innerHTML = rows.map(r=>`
    <tr>
      <td class="mono">${r.tanggal}</td>
      <td class="mono">${r.jamMulai}–${r.jamSelesai}</td>
      <td><span class="badge-gedung ${r.room.gedung}">${r.room.gedung}</span> ${r.room.nama}</td>
      <td>${escapeHtml(r.nama)}</td>
      <td>${escapeHtml(r.keperluan)}</td>
    </tr>`).join('');
}
function clearFilters(){
  document.getElementById('filterGedung').value='';
  document.getElementById('filterTanggal').value='';
  renderSchedule();
}

/* ================= INIT ================= */
/*document.getElementById('fTanggal').min = todayISO();
document.getElementById('fTanggal').value = todayISO();
generateTimeOptions(document.getElementById('fJamMulai'), '09:00');
generateTimeOptions(document.getElementById('fJamSelesai'), '10:00');
document.getElementById('fTanggal').addEventListener('change', renderTimeline);
document.getElementById('fJamMulai').addEventListener('change', ()=>document.getElementById('alertStep2').classList.remove('show'));
document.getElementById('fJamSelesai').addEventListener('change', ()=>document.getElementById('alertStep2').classList.remove('show'));

renderRoomList();
renderSchedule();
goToStep(1); */

async function init() {

    document.getElementById('fTanggal').min = todayISO();
    document.getElementById('fTanggal').value = todayISO();

    generateTimeOptions(
        document.getElementById('fJamMulai'),
        '09:00'
    );

    generateTimeOptions(
        document.getElementById('fJamSelesai'),
        '10:00'
    );

    document
        .getElementById('fTanggal')
        .addEventListener('change', renderTimeline);

    document
        .getElementById('fJamMulai')
        .addEventListener('change', () =>
            document.getElementById('alertStep2').classList.remove('show')
        );

    document
        .getElementById('fJamSelesai')
        .addEventListener('change', () =>
            document.getElementById('alertStep2').classList.remove('show')
        );

    await loadRooms();
    await loadBookings();

    goToStep(1);
}

init();

</script>
</body>
</html>
