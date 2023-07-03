<?php
  // Commencer la session
  session_start();
  
  // Vérifier si l'utilisateur est connecté
  if (!isset($_SESSION["login"])) {
    header("Location: connexion.php");
    exit();
  }
  
  // Vérifier si un id de réservation a été fourni
  if (!isset($_GET["id"])) {
    echo "Aucune réservation spécifiée.";
    exit();
  }

  // Se connecter à la base de données
  $conn = new mysqli("localhost", "root", "Natalia280988!", "reservationsalles");

  // Vérifier la connexion à la base de données
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Récupérer la réservation de la base de données
  $sql = "SELECT * FROM reservations JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE reservations.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET["id"]);
  $stmt->execute();
  $result = $stmt->get_result();
  $reservation = $result->fetch_assoc();

  // Fermer la connexion à la base de données
  $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Réservation</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <h1>Réservation</h1>
  <!-- Afficher les détails de la réservation -->
  <div>
    <h2><?= $reservation["titre"] ?></h2>
    <p>Reservé par : <?= $reservation["login"] ?></p>
    <p>Description : <?= $reservation["description"] ?></p>
    <p>De : <?= $reservation["debut"] ?> à <?= $reservation["fin"] ?></p>
  </div>
</body>
</html>
