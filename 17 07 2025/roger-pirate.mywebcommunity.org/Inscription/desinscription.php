<?php
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(strtolower($_POST['email'] ?? ''));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
        $messageType = "error";
    } else {
        $file = 'abonnes.txt';

        if (!file_exists($file)) {
            $message = "Aucun abonné enregistré.";
            $messageType = "error";
        } else {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (!in_array($email, $lines)) {
                $message = "Cette adresse email n’est pas inscrite.";
                $messageType = "error";
            } else {
                $lines = array_filter($lines, fn($line) => strtolower(trim($line)) !== $email);
                file_put_contents($file, implode(PHP_EOL, $lines) . PHP_EOL);
                $message = "Vous êtes bien désinscrit.";
                $messageType = "success";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Désinscription Newsletter</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Special+Elite&display=swap');

  /* Appliquer box-sizing border-box à tout */
  *, *::before, *::after {
    box-sizing: border-box;
  }

  html, body {
    height: 100%;
    margin: 0;
    background: #000;
    font-family: 'Special Elite', monospace;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #ffdd00;
    text-align: center;
  }

  .container {
    background: #111;
    border: 3px solid #ffdd00;
    border-radius: 12px;
    padding: 30px 20px;
    max-width: 360px;
    width: 100%;
    max-width: 100vw; /* S'assurer que jamais on dépasse la largeur de la fenêtre */
    box-shadow: 0 0 12px #ffdd00;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  h1 {
    margin-bottom: 25px;
    font-size: 1.7rem;
  }

  input[type="email"] {
    width: 100%;
    padding: 12px 15px;
    font-size: 1rem;
    border-radius: 8px;
    border: 2px solid #ffdd00;
    background: #222;
    color: #ffdd00;
    font-family: 'Special Elite', monospace;
    margin-bottom: 20px;
    transition: border-color 0.3s ease;
  }

  input[type="email"]:focus {
    outline: none;
    border-color: #ffff00;
  }

  button {
    width: 100%;
    background: #ff4444;
    color: #000;
    font-weight: bold;
    font-family: 'Special Elite', monospace;
    border: none;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }

  button:hover {
    background: #cc0000;
    transform: scale(1.05);
  }

  #retour {
    margin-top: 15px;
    width: 100%;
    background: transparent;
    color: #ffdd00;
    border: 2px solid #ffdd00;
    padding: 10px;
    border-radius: 8px;
    cursor: pointer;
    font-family: 'Special Elite', monospace;
    font-size: 1rem;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  #retour:hover {
    background: #ffdd00;
    color: #000;
  }

  .message {
    font-weight: bold;
    margin-top: 15px;
    padding: 12px 15px;
    border-radius: 8px;
    font-size: 1rem;
    user-select: none;
    max-width: 100%;
    word-wrap: break-word;
    line-height: 1.3;
  }

  .success {
    color: #00ff55;
    border: 2px solid #00ff55;
    background: #002a11;
    animation: fadeInMessage 0.6s ease forwards;
  }

  .error {
    color: #ff4444;
    border: 2px solid #ff4444;
    background: #2a0000;
    animation: fadeInMessage 0.6s ease forwards;
  }

  @keyframes fadeInMessage {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
</head>
<body>
  <div class="container">
    <h1>Désinscription</h1>
    <form method="POST" novalidate>
      <input type="email" name="email" placeholder="Votre adresse email" required />
      <button type="submit">Se désinscrire</button>
    </form>
    <button id="retour" onclick="window.location.href='https://roger-pirate.mywebcommunity.org'">Retour</button>

    <?php if ($message): ?>
      <div class="message <?= $messageType ?>">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
