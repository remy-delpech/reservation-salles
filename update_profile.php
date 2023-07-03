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
    $conn = new mysqli("localhost", "username", "password", "reservationsalles");

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les informations du formulaire
    $login = $_POST["login"];
    $new_password = $_POST["new_password"];
    $confirm_new_password = $_POST["confirm_new_password"];

    // Vérifier si les deux nouveaux mots de passe correspondent
    if ($new_password == $confirm_new_password) {
      // Mettre à jour les informations de l'utilisateur dans la base de données
      $sql = "UPDATE utilisateurs SET login = ?, password = ? WHERE login = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $login, password_hash($new_password, PASSWORD_DEFAULT), $_SESSION["login"]);
      $stmt->execute();
      // Mettre à jour le login de l'utilisateur dans la session
      $_SESSION["login"] = $login;
      // Rediriger vers la page de profil
      header("Location: profil.php");
    } else {
      echo "Les nouveaux mots de passe ne correspondent pas.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
  }
?>
