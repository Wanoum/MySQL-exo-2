<?php
  query($mysqli, 'DROP DATABASE IF EXISTS '.$base);
  query($mysqli, 'CREATE DATABASE '.$base);
  mysqli_select_db($mysqli, $base) or die("Impossible de sélectionner la base : $base");

  // Queries
  $stmt_create_table = "CREATE TABLE `Vehicule` (
    `ref` INT NOT NULL AUTO_INCREMENT,
    `marque` VARCHAR(120) NOT NULL,
    `type` VARCHAR(120) NOT NULL,
    `couleur` VARCHAR(120) NOT NULL,
    `annee` INT NOT NULL,
    `prix` INT NOT NULL,
    PRIMARY KEY (`ref`)
  ) ENGINE = InnoDB;";

  query($mysqli, $stmt_create_table);

  // Extract data from other file
  $string_data = file_get_contents('Vehicule.txt');
  $string_data_formated = str_replace(array("\r\n"), "'), ('", $string_data);
  $string_data_formated = str_replace("|", "', '", $string_data_formated);

  $stmt_insert_data = "INSERT INTO `Vehicule` (`marque`, `type`, `couleur`, `annee`, `prix`) VALUES ('$string_data_formated');";
  query($mysqli, $stmt_insert_data);

  // Insertion successful or not?
  if (mysqli_affected_rows($mysqli) == 0) {
    echo "<p>Problème de chargement dans la base de données.</p>";
  } else {
    echo "<p>Chargement réussi pour ".mysqli_affected_rows($mysqli)." éléments.</p>";
  }
?>
