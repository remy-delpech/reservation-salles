<!DOCTYPE html>
<html>
<head>
  <title>Profil</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <h1>Profil</h1>
  <form action="update_profile.php" method="post">
    <label for="login">Login:</label><br>
    <input type="text" id="login" name="login"><br>
    <label for="new_password">New Password:</label><br>
    <input type="password" id="new_password" name="new_password"><br>
    <label for="confirm_new_password">Confirm New Password:</label><br>
    <input type="password" id="confirm_new_password" name="confirm_new_password"><br>
    <input type="submit" value="Mettre à jour">
  </form>
</body>
</html>
