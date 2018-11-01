<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Création Bdd</title>
</head>
<body>
  <?php
    include("config.inc.php");
    include("functions.inc.php");

    // Initialisation
    $mysqli = mysqli_connect($host, $user, $pass) or die("Problème de création de la base : ".mysqli_error());
    query($mysqli, 'DROP DATABASE IF EXISTS '.$base);
    query($mysqli, 'CREATE DATABASE '.$base);
  	mysqli_select_db($mysqli, $base) or die("Impossible de sélectionner la base : $base");

    // Queries
    $stmt_create_table = "CREATE TABLE `Automobiles`.`Vehicule` (
      `ref` INT NOT NULL AUTO_INCREMENT,
      `marque` VARCHAR(120) NOT NULL,
      `type` VARCHAR(120) NOT NULL,
      `couleur` VARCHAR(120) NOT NULL,
      `annee` INT NOT NULL,
      `prix` INT NOT NULL,
      PRIMARY KEY (`ref`)
    ) ENGINE = InnoDB;";
    $stmt_insert_data = "INSERT INTO `Vehicule` (`marque`, `type`, `couleur`, `annee`, `prix`)
      VALUES ";
      // ('\"r', '\"r', '\"r', '23', '23'), (NULL, '\"r', '\"r', '\"r', '23', '23')

    query($mysqli, $stmt_create_table);

    // Extract data from other file
    $arr_data = file('Vehicule.txt');

    foreach ($arr_data as $offers) {
      $arr_exploded = explode("|", $offers);
      $string_imploded = implode("', '", $arr_exploded);

      $stmt_insert_data .= "('".$string_imploded."'), ";
    }

    $stmt_insert_data .= "('', '', '', '', '');";

    query($mysqli, $stmt_insert_data);

    if (mysqli_affected_rows($mysqli) == 0) {
      echo "Problème de chargement dans la base de données.";
    } else {
      echo "Chargement réussi pour ".mysqli_affected_rows($mysqli)." éléments.";
    }
  ?>
</body>
</html>
