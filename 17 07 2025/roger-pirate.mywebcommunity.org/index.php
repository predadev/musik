<?php
// Fichier de sauvgarde
$data_file = 'data.txt';

// Ne pas compter si c’est l’admin
$ip = $_SERVER['REMOTE_ADDR'];
$ips_exclues = ['81.65.167.182', '2a02:842b:8140:2001:6035:c614:897e:9414', '92.184.117.156', '']; // ⇦ remplace IP

if ($_SERVER['REQUEST_URI'] !== '/admin/admin.php' && !in_array($ip, $ips_exclues)) {

    $data = file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : [];

    $jours_fr = [
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
        'Sunday' => 'Dimanche',
    ];
    $jour = $jours_fr[date('l')];
    $data[$jour] = ($data[$jour] ?? 0) + 1;

    file_put_contents($data_file, json_encode($data));
}
// Parti HTML
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Roger Pirate</title>
  <link rel="icon" href="logo.png" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
  <style>
   /* modifier l'apparance. */       
    body {
      background-color: black;
      color: white;
      font-family: 'Special Elite', monospace;
      margin: 0;
    }

    .header {
      text-align: center;
      padding: 20px;
      color: yellow;
    }

    .header .logo {
      height: 100px;
      width: auto;
    }

    .container {
      display: flex;
    }

    .menu {
      width: 200px;
      background-color: black;
      color: yellow;
      font-weight: bold;
      font-size: 20px;
      padding: 10px;
    }

    .menu a {
      color: yellow;
      text-decoration: none;
      display: block;
      margin-bottom: 10px;
    }
    .content a {
      color: yellow;
      text-decoration: underline;
}


    .content {
      flex-grow: 1;
      padding: 20px;
    }

    section {
      display: none;
    }

    section:target {
      display: block;
    }
    /* Definir les vignette. */  
    #news:target ~ .content #news,
    #groupe:target ~ .content #groupe,
    #koncert:target ~ .content #koncert,
    #photos:target ~ .content #photos,
    #links:target ~ .content #links,
    #contact:target ~ .content #contact {
      display: block;
    }

    body:not(:has(:target)) #news {
      display: block;
    }

    h2 {
      color: yellow;
    }

    /* Galerie photo */
    .gallery {
      margin-top: 10px;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .gallery img {
      height: 200px;
      object-fit: cover;
      border: 4px solid yellow;
      border-radius: 8px;
      cursor: pointer;
      transition: transform 0.3s;
    }

    .gallery img:hover {
      transform: scale(1.05);
    }

    /* Lightbox */
    .lightbox {
      display: none;
      position: fixed;
      z-index: 999;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.9);
      justify-content: center;
      align-items: center;
    }

    .lightbox img {
      max-width: 90%;
      max-height: 90%;
      border: 4px solid yellow;
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <div class="header">
    <img src="logo.gif" alt="Logo Roger Pirate" class="logo" />
    <h1>Roger Pirate</h1>
    <p>https://roger-pirate.mywebcommunity.org</p>
  </div>

  <div class="container">
    <nav class="menu">
      <a href="#news">News</a>  
      <a href="/Inaccessible/">Groupe</a>
      <a href="/Inaccessible/">Muzik</a>
      <a href="#koncert">Koncert</a>
      <a href="#photos">Photos</a>
      <a href="#Videos">Videos</a>
      <a href="/Inaccessible/">Links</a>
      <a href="#Contact">Contact</a>
      <a href="/Inscription/">Newsletter</a>    
    </nav>

    <div class="content">
      <section id="news">
        <h2>LES NEWS</h2>
        <p>10/07/2025 : Photo upload sur le site !</p>
      </section>

      <section id="groupe">
        <h2>LE GROUPE</h2>
        <p>EN COURS DE TRAVAUX.</p>
      </section>

      <section id="koncert">
        <h2>KONCERT</h2>
        <p>AUCUN CONCERT PRÉVU POUR LE MOMENT</p>
      </section>

      <section id="photos">
        <h2>PHOTOS</h2>
        <p>Photo fête du collège du 24 juin 2025 :</p>
        <div class="gallery">
          <img src="/photos/photo0.jpg" alt="Photo 0">
          <img src="/photos/photo1.jpg" alt="Photo 1">
          <img src="/photos/photo2.jpg" alt="Photo 2">
          <img src="/photos/photo3.jpg" alt="Photo 3">
          <img src="/photos/photo4.jpg" alt="Photo 4">
          <img src="/photos/photo5.jpg" alt="Photo 5">
          <img src="/photos/photo6.jpg" alt="Photo 6">
          <img src="/photos/photo7.jpg" alt="Photo 7">
          <img src="/photos/photo8.jpg" alt="Photo 8">
        </div>
        <div id="lightbox" class="lightbox" onclick="closeLightbox()">
          <img id="lightbox-img" src="" alt="Zoomed photo">
        </div>
      </section>
            
      <section id="Videos">
        <h2>Videos</h2>
        <p>Lien : <a href="https://drive.google.com/drive/folders/1SPvOKBede9u9UxSU8GKwwmAx2acJztbD?usp=drive_link" target="_blank">CLICK ICI</a></p>
      </section>
 

      <section id="links">
        <h2>LINKS</h2>
        <p>EN COURS DE TRAVAUX.</p>
      </section>

      <section id="Contact">
        <h2>CONTACT</h2>
        <p>Voici nos coordonnées : Contact.RogerPirate@gmail.com pour plus d'info ou des koncert...</p>
      </section>
    </div>
  </div>

  <script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    document.querySelectorAll('.gallery img').forEach(img => {
      img.addEventListener('click', () => {
        lightboxImg.src = img.src;
        lightbox.style.display = 'flex';
      });
    });

    function closeLightbox() {
      lightbox.style.display = 'none';
      lightboxImg.src = '';
    }
  </script>
</body>
</html>
