<!DOCTYPE html>
<html>
<head>
  <title>Réservation</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <h1>Nouvelle réservation</h1>
  <form action="create_reservation.php" method="post">
    <label for="titre">Titre:</label><br>
    <input type="text" id="titre" name="titre"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>
    <label for="debut">Début:</label><br>
    <input type="datetime-local" id="debut" name="debut"><br>
    <label for="fin">Fin:</label><br>
    <input type="datetime-local" id="fin" name="fin"><br>
    <input type="submit" value="Réserver">
  </form>
</body>
</html>
