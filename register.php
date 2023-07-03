<?php
  // Commencer la session
  session_start();
  
  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se connecter à la base de données
    $conn = new mysqli("localhost", "root", "Natalia280988!", "reservationsalles");

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les informations du formulaire
    $login = $_POST["login"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Vérifier si les deux mots de passe correspondent
    if ($password == $confirm_password) {
      // Insérer les informations dans la base de données
      $sql = "INSERT INTO utilisateurs (login, password) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $login, password_hash($password, PASSWORD_DEFAULT));
      $stmt->execute();
      // Rediriger vers la page de connexion
      header("Location: connexion.php");
    } else {
      echo "Les mots de passe ne correspondent pas.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
  }
?>
