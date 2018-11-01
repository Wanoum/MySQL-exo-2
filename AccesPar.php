<?php
  mysqli_select_db($mysqli, $base) or die("Impossible de sélectionner la base : $base");

  $attribute_chosen = isset($_GET['attributChoisi']) ? $_GET['attributChoisi'] : "";
  // echo $attribute_chosen;

  // Queries
  $stmt_select_choice = "SELECT $attribute_chosen FROM Vehicule GROUP BY $attribute_chosen;";
  $result = query($mysqli, $stmt_select_choice);

  echo "<ul>";
  while ($row = mysqli_fetch_assoc($result)) {
    print("<li><a href=\"\">".$row[$attribute_chosen]."</a></li>");
  }
  echo "</ul>";
?>
