<?php
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

  // TODO: Find an alternative
  $stmt_insert_data .= "('', '', '', '', '');";

  query($mysqli, $stmt_insert_data);

  // Insertion successful or not?
  if (mysqli_affected_rows($mysqli) == 0) {
    echo "<p>Problème de chargement dans la base de données.</p>";
  } else {
    echo "<p>Chargement réussi pour ".mysqli_affected_rows($mysqli)." éléments.</p>";
  }
?>
