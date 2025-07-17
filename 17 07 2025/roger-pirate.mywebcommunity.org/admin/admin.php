<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Statistiques des Visiteurs</title>
  <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #ffeb3b;
      color: #000;
      font-family: 'Special Elite', cursive;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    #compteur {
      font-size: 6rem;
      text-align: center;
    }
    button {
      margin-top: 30px;
      padding: 15px 30px;
      font-size: 1.2rem;
      font-family: 'Special Elite', cursive;
      background: #000;
      color: #ffeb3b;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div id="compteur">Chargement...</div>
  <button onclick="rechargerCompteur()">🔄 Recharger</button>

  <script>
    async function getTotalVisites() {
      const response = await fetch('../get_data.php');
      const data = await response.json();
      const total = Object.values(data).reduce((acc, val) => acc + val, 0);
      return total;
    }

    async function afficherCompteur() {
      const total = await getTotalVisites();
      document.getElementById('compteur').innerText = total + ' visiteurs';
    }

    function rechargerCompteur() {
      afficherCompteur();
    }

    afficherCompteur();
  </script>
</body>
</html>
