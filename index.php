<?php
$success = false;
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $message = trim($_POST["message"] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $error = "Vyplňte prosím všechna pole.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Zadejte platný e-mail.";
    } else {
        $to = "info@michalchocholaty.cz";
        $subject = "Nová zpráva z webu Michal Chocholatý";
        $body = "Od: $name\nE-mail: $email\n\nZpráva:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
        if (mail($to, $subject, $body, $headers)) {
            $success = true;
        } else {
            $error = "Došlo k chybě při odesílání.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Michal Chocholatý — Fotograf</title>

<!-- SEO -->
<meta name="description" content="Profesionální fotograf Michal Chocholatý – portréty, svatební a umělecká fotografie. Zachycuji emoce, světlo a příběhy napříč Českou republikou.">
<meta name="keywords" content="fotograf Kolin, Michal Chocholatý, svatební fotograf, portréty, focení, fotografie, umělecký fotograf, fotoatelier, wedding photographer, portrait photography, Czech Republic">
<meta name="author" content="Michal Chocholatý">
<meta name="robots" content="index, follow">

<!-- Open Graph -->
<meta property="og:title" content="Michal Chocholatý — Fotograf">
<meta property="og:description" content="Profesionální fotograf zaměřený na portréty, svatby a uměleckou tvorbu.">
<meta property="og:image" content="img/fotka1.jpg">
<meta property="og:type" content="website">
<meta property="og:url" content="https://www.michalchocholaty.cz">
<meta property="og:locale" content="cs_CZ">

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">

<style>
:root {
  --accent: #4ea8de;
  --bg1: #0e0e0f;
  --bg2: #141517;
  --text: #eaeaea;
  --muted: #a9a9a9;
}
body {
  margin: 0;
  font-family: "Manrope", sans-serif;
  background: linear-gradient(180deg, var(--bg1), var(--bg2));
  color: var(--text);
  scroll-behavior: smooth;
}

/* NAVBAR */
nav {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: rgba(14,14,15,0.85);
  backdrop-filter: blur(8px);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 24px;
  z-index: 1000;
  border-bottom: 1px solid #1f1f1f;
  box-sizing: border-box;
}
.logo {
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: 700;
  color: var(--accent);
  font-size: 1.1em;
  text-decoration: none;
}
.logo svg {
  width: 26px;
  height: 26px;
  fill: var(--accent);
}
nav .links {
  display: flex;
  gap: 24px;
  align-items: center;
}
nav .links a {
  color: var(--text);
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}
nav .links a:hover {
  color: var(--accent);
}

/* MOBILE MENU */
.menu-toggle {
  display: none;
  font-size: 1.8em;
  color: var(--accent);
  cursor: pointer;
}
@media (max-width: 850px) {
  .menu-toggle { display: block; }
  .links {
    position: absolute;
    top: 64px;
    left: 0;
    width: 100%;
    background: rgba(10,10,11,0.95);
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 30px 0;
    transform: translateY(-100%);
    transition: 0.3s ease-in-out;
  }
  body.menu-open .links {
    transform: translateY(0);
  }
}

/* HEADER */
header {
  position: relative;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #fff;
  background: url('img/3449.jpg') center/cover no-repeat;
}
header::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.55);
}
header .hero-content {
  position: relative;
  z-index: 2;
  max-width: 800px;
  padding: 0 20px;
}
header .hero-content img.logo-top {
  width: 120px;
  height: auto;
  margin-bottom: 25px;
  filter: drop-shadow(0 0 6px rgba(0,0,0,0.7));
}
header h1 {
  font-size: 3.2em;
  font-weight: 700;
  margin: 0;
  color: var(--accent);
}
header p {
  font-size: 1.2em;
  margin-top: 15px;
  color: #ddd;
}
header a.scroll-btn {
  display: inline-block;
  margin-top: 40px;
  padding: 12px 30px;
  background: var(--accent);
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  border-radius: 4px;
  transition: 0.3s;
}
header a.scroll-btn:hover { background: #6dc3ff; }

/* SECTION */
section {
  padding: 90px 20px;
  max-width: 1100px;
  margin: 0 auto;
}
section h2 {
  text-align: center;
  color: var(--accent);
  font-size: 2em;
  margin-bottom: 50px;
}

/* ABOUT */
.about {
  max-width: 700px;
  margin: 0 auto;
  text-align: center;
  color: var(--muted);
  line-height: 1.8;
  font-size: 1.1em;
}

/* GALLERY */
.gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 18px;
  padding: 0 10px;
}
.gallery img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 10px;
  filter: grayscale(100%) contrast(1.05);
  transition: all 0.6s ease;
  box-shadow: 0 6px 18px rgba(0,0,0,0.25);
}
.gallery img:hover {
  filter: grayscale(0%) contrast(1);
  transform: scale(1.04);
  box-shadow: 0 10px 24px rgba(0,0,0,0.35);
}

/* BUTTON UNDER GALLERY */
.gallery-btn {
  display: flex;
  justify-content: center;
  margin-top: 40px;
}
.gallery-btn a {
  text-decoration: none;
  background: none;
  color: var(--accent);
  border: 2px solid var(--accent);
  padding: 12px 30px;
  font-weight: 600;
  transition: 0.3s;
}
.gallery-btn a:hover {
  background: var(--accent);
  color: #fff;
}

/* CONTACT */
.contact {
  text-align: center;
  color: var(--muted);
  font-size: 1.05em;
}
.contact a {
  color: var(--accent);
  text-decoration: none;
  font-weight: 600;
}
form {
  max-width: 600px;
  margin: 40px auto 0;
  display: flex;
  flex-direction: column;
  gap: 15px;
}
input, textarea {
  background: #1c1d21;
  border: none;
  padding: 14px;
  color: #fff;
  font-size: 1em;
  border-left: 3px solid transparent;
  transition: border-color 0.3s;
}
input:focus, textarea:focus {
  border-color: var(--accent);
  outline: none;
}
button {
  background: var(--accent);
  color: #fff;
  border: none;
  padding: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}
button:hover { background: #6dc3ff; }
.msg { text-align: center; margin-top: 20px; }

footer {
  text-align: center;
  padding: 30px;
  border-top: 1px solid #222;
  color: var(--muted);
  font-size: 0.9em;
}
</style>
</head>
<body>

<nav>
  <a href="#" class="logo">
    <svg viewBox="0 0 512 512">
      <path d="M149.1 64l-25.9 32H64c-17.7 0-32 14.3-32 32v288c0 17.7 14.3 32 32 32h384c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32h-59.2l-25.9-32H149.1zm106.9 96a128 128 0 1 1 0 256 128 128 0 1 1 0-256zm0 48a80 80 0 1 0 0 160 80 80 0 1 0 0-160z"/>
    </svg>
    Michal Chocholatý
  </a>

  <div class="menu-toggle" onclick="document.body.classList.toggle('menu-open')">
    ☰
  </div>

  <div class="links">
    <a href="#omne">O mně</a>
    <a href="#galerie">Galerie</a>
    <a href="#kontakt">Kontakt</a>
  </div>
</nav>

<header>
  <div class="hero-content">
    <img src="img/logo.png" alt="Logo Michal Chocholatý" class="logo-top">
    <h1>Michal Chocholatý</h1>
    <p>Fotograf s vášní pro světlo, emoce a detaily, které vypráví příběhy.</p>
    <a href="#galerie" class="scroll-btn">Zobrazit portfolio</a>
  </div>
</header>

<section id="omne">
  <h2>O mně</h2>
  <div class="about">
    <p>
      <strong>Michal Chocholatý</strong> je zkušený fotograf s praxí od roku <strong>1994</strong>, specializující se na
      <strong>portrétní, ateliérovou a glamour fotografii</strong>, street snímky, svatby a fotografování dětí.  
      Jeho styl spojuje jemné světelné formování s autentickým a empatickým přístupem, díky čemuž vznikají fotografie plné emocí a atmosféry.  
      Ať už v ateliéru nebo v terénu, dokáže zachytit jedinečné okamžiky – od intimních portrétů přes slavnostní svatební momenty až po radostné dětské snímky.  
      S důrazem na profesionální a osobité vyjádření nabízí své služby jak soukromým osobám, tak firmám.
    </p>
  </div>
</section>

<section id="galerie">
  <h2>Galerie</h2>
  <div class="gallery">
    <?php for ($i=1; $i<=9; $i++): ?>
      <img src="img/fotka<?= $i ?>.jpg" alt="Fotografie <?= $i ?>">
    <?php endfor; ?>
  </div>

  <div class="gallery-btn">
    <a href="https://www.instagram.com/michal_chocholaty/" target="_blank">📸 Více fotek na Instagramu</a>
  </div>
</section>

<section id="kontakt">
  <h2>Kontakt</h2>
  <div class="contact">
    <p>📍 Kolín, Česká republika</p>
    <p>📞 <a href="tel:+420773020334">+420 773 020 334</a></p>
    <p>📧 <a href="mailto:info@michalchocholaty.cz">info@michalchocholaty.cz</a></p>
    <p>🌐 Instagram: <a href="https://www.instagram.com/michal_chocholaty/" target="_blank">@michal_chocholaty</a></p>
  </div>

  <form method="post" action="#kontakt">
    <input type="text" name="name" placeholder="Vaše jméno" required>
    <input type="email" name="email" placeholder="Váš e-mail" required>
    <textarea name="message" rows="5" placeholder="Vaše zpráva..." required></textarea>
    <button type="submit">Odeslat zprávu</button>
  </form>

  <?php if ($success): ?>
    <div class="msg" style="color:#6dc3ff;">✅ Zpráva byla úspěšně odeslána. Děkuji!</div>
  <?php elseif ($error): ?>
    <div class="msg" style="color:#ff6b6b;">❌ <?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
</section>

<footer>
  © 2025 Michal Chocholatý — Všechna práva vyhrazena
</footer>

</body>
</html>
