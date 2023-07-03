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

    // Vérifier si les informations correspondent à un utilisateur existant
    $sql = "SELECT * FROM utilisateurs WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user["password"])) {
        // L'utilisateur est connecté
        $_SESSION["login"] = $login;
        // Rediriger vers la page d'accueil
        header("Location: index.php");
      } else {
        echo "Mot de passe incorrect.";
      }
    } else {
      echo "Aucun utilisateur trouvé avec ce login.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
  }
?>
