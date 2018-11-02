<?php
  mysqli_select_db($mysqli, $base) or die("Impossible de sélectionner la base : $base");

  $arr_brands_chosen = isset($_GET['listeMarquesChoisies']) ? $_GET['listeMarquesChoisies'] : array();
  $arr_colors_chosen = isset($_GET['listeCouleursChoisies']) ? $_GET['listeCouleursChoisies'] : array();
  $min_year = isset($_GET['anneeMinimum']) ? $_GET['anneeMinimum'] : '';
  $max_price = isset($_GET['prixMaximum']) ? $_GET['prixMaximum'] : '';
  $order_by = isset($_GET['tri']) ? $_GET['tri'] : '';

  if(empty($arr_brands_chosen)) {
    array_push($arr_brands_chosen, 'Opel', 'Peugeot', 'Renault');
  }
  if(empty($arr_colors_chosen)) {
    array_push($arr_colors_chosen, 'Blanche', 'Bleue', 'Grise', 'Rouge', 'Verte');
  }

  $arr_brands_chosen = implode("', '", $arr_brands_chosen);
  $arr_colors_chosen = implode("', '", $arr_colors_chosen);

  $stmt_search = "SELECT * FROM Vehicule
    WHERE marque IN ('$arr_brands_chosen') AND couleur IN ('$arr_colors_chosen')
    AND annee >= $min_year AND prix <= $max_price
    ORDER BY $order_by;";

  $result = query($mysqli, $stmt_search);
  echo "<p>".mysqli_affected_rows($mysqli)." résultats trouvés.</p>";

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
