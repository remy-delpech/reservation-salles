<?php
  // Commencer la session
  session_start();
  
  // Se connecter à la base de données
  $conn = new mysqli("localhost", "root", "Natalia280988!", "reservationsalles");

  // Vérifier la connexion à la base de données
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Récupérer toutes les réservations de la base de données
  $sql = "SELECT * FROM reservations JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id ORDER BY debut";
  $result = $conn->query($sql);

  // Créer un tableau pour stocker les réservations
  $reservations = array();
  while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
  }

  // Fermer la connexion à la base de données
  $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Planning</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <h1>Planning</h1>
  <!-- Afficher les réservations -->
  <?php foreach ($reservations as $reservation): ?>
    <div>
      <h2><?= $reservation["titre"] ?></h2>
      <p>Reservé par : <?= $reservation["login"] ?></p>
      <p>De : <?= $reservation["debut"] ?> à <?= $reservation["fin"] ?></p>
    </div>
  <?php endforeach; ?>
</body>
</html>
