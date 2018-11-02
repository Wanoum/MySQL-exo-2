<?php
  // include("config.inc.php");
  // include("functions.inc.php");

  // $mysqli = mysqli_connect($host, $user, $pass) or die("Problème de création de la base : ".mysqli_error());
  mysqli_select_db($mysqli, $base) or die("Impossible de sélectionner la base : $base");

  $attribute_chosen = isset($_GET['attributChoisi']) ? $_GET['attributChoisi'] : "";
  $value_chosen = isset($_GET['valeurChoisie']) ? $_GET['valeurChoisie'] : "";

  // Queries
  $stmt_select_attribute_value = "SELECT * FROM Vehicule WHERE $attribute_chosen='$value_chosen';";
  $result = query($mysqli, $stmt_select_attribute_value);

  echo "<ul>";
  while ($row = mysqli_fetch_assoc($result)) {
    print("<li>
      <a href=\"?p=listeAnnonces&attributChoisi=ref&valeurChoisie=".$row['ref']."\">".$row['ref']."</a>
      <a href=\"?p=listeAnnonces&attributChoisi=marque&valeurChoisie=".$row['marque']."\">".$row['marque']."</a>
      <a href=\"?p=listeAnnonces&attributChoisi=type&valeurChoisie=".$row['type']."\">".$row['type']."</a>
      <a href=\"?p=listeAnnonces&attributChoisi=couleur&valeurChoisie=".$row['couleur']."\">".$row['couleur']."</a>
      <a href=\"?p=listeAnnonces&attributChoisi=annee&valeurChoisie=".$row['annee']."\">".$row['annee']."</a>
      <a href=\"?p=listeAnnonces&attributChoisi=prix&valeurChoisie=".$row['prix']."\">".$row['prix']."</a>
    </li>");
  }
  echo "</ul>";
?>
