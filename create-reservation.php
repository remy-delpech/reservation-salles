<?php
  // Commencer la session
  session_start();
  
  // Vérifier si l'utilisateur est connecté
  if (!isset($_SESSION["login"])) {
    header("Location: connexion.php");
    exit();
  }

  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se connecter à la base de données
    $conn = new mysqli("localhost", "root", "Natalia280988!", "reservationsalles");

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les informations du formulaire
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $debut = $_POST["debut"];
    $fin = $_POST["fin"];

    // Insérer la nouvelle réservation dans la base de données
    $sql = "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES (?, ?, ?, ?, (SELECT id FROM utilisateurs WHERE login = ?))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $titre, $description, $debut, $fin, $_SESSION["login"]);
    $stmt->execute();

    // Rediriger vers la page de planning
    header("Location: planning.php");

    // Fermer la connexion à la base de données
    $conn->close();
    }
?>
  