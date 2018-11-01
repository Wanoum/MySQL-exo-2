<?php
  mysqli_select_db($mysqli, $base) or die("Impossible de sélectionner la base : $base");

  $attribute_chosen = isset($_GET['attributChoisi']) ? $_GET['attributChoisi'] : "";
  // echo "$attribute_chosen";

  // Queries
  $stmt_select_attribute = "SELECT $attribute_chosen FROM Vehicule GROUP BY $attribute_chosen;";
  $result = query($mysqli, $stmt_select_attribute);

  echo "<ul>";
  while ($row = mysqli_fetch_assoc($result)) {
    print("<li><a href=\"?p=listeAnnonces&attributChoisi=".$attribute_chosen."&valeurChoisie=".$row[$attribute_chosen]."\">".$row[$attribute_chosen]."</a></li>");
  }
  echo "</ul>";
?>
