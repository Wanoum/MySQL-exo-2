<!DOCTYPE html>
<html>
<head>
  <title>Petites annonces automobiles</title>
	<meta charset="utf-8" />
	<style type="text/css">
    body {
    	font-family: Arial, Helvetica, sans-serif;
    	font-size: 1em;
    	color: black;
    }

    h1 {
    	text-align: center;
    	font-size: 1.4em;
    }

    h2 {
    	margin-top: 0.2em;
    	font-size: 1.2em;
    }

    .flex-container{
        display: flex;
    	justify-content: center;
    }

    div div {
    	background-color: #aaa;
    	margin: 10px;
    	padding: 10px;
    	border: solid black 1px;
    }
	</style>
</head>

<body>
  <?php
    include("config.inc.php");
    include("functions.inc.php");

    // Initialisation
    $mysqli = mysqli_connect($host, $user, $pass) or die("Problème de création de la base : ".mysqli_error());

    // Initialisation des tableaux qui parametrent l'interface
    $ListeMarques  = array("Opel","Peugeot","Renault");
    $ListeCouleurs = array("Blanche","Bleue","Grise","Rouge","Verte");
  ?>

  <h1>Petites annonces automobiles</h1>

  <nav>
    <div class="flex-container">
    	<div style="background-color: #cfc">
    		<h2>Accès par&nbsp;:</h2>
    		<ul>
    			<li><a href="?p=navigation&attributChoisi=ref">ref</a></li>
    			<li><a href="?p=navigation&attributChoisi=marque">marque</a></li>
    			<li><a href="?p=navigation&attributChoisi=couleur">couleur</a></li>
    		</ul>
    	</div>
    	<div style="background-color: #ffc">
    		<h2>Recherche&nbsp;:</h2>
    		<form method="get" action="">
    		<input type="hidden" name="p" value="recherche" />
    		Marque&nbsp;:

    		<?php
     	    foreach($ListeMarques as $Marque) {
            echo '
      			<input type="checkbox" name="listeMarquesChoisies[]" value="'.$Marque.'"'
      			.(in_array($Marque,$_GET['listeMarquesChoisies'])?'checked="checked"':'')
      			.'>'.$Marque;
      		}
  	    ?>
    		<br />
    		Couleur&nbsp;:
    	    <?php
      	    foreach($ListeCouleurs as $Couleur) {
              echo '
      			<input type="checkbox" name="listeCouleursChoisies[]" value="'.$Couleur.'"'
      			.(in_array($Couleur,$_GET['listeCouleursChoisies'])?'checked="checked"':'')
      			.'> '.$Couleur;
            }
          ?>
    		<br />
    		Construite après&nbsp;:
    		<select name="anneeMinimum" size="1">
    		<?php
      		for($i = 1974; $i < 2002; $i = $i + 2) {
            echo '
      			<option '.($i==$_GET['anneeMinimum']?'selected="selected"':'').'>'.$i.'</option>';
      		}
    		?>
    		</select>
    		<br />
    		Prix inférieur à&nbsp;:
    		<input type="text" maxlength="7" name="prixMaximum"
    		      value="<?php if(isset($_GET['prixMaximum'])) echo $_GET['prixMaximum']; else echo '4000'?>">
              &euro;
    		<br />
    		Triées par&nbsp;:
    		<select name="tri" size="1">
    		<?php
      		foreach(['ref','marque','type','couleur','annee','prix'] as $attribut) {
            echo '
      			<option '.($attribut==$_GET['tri']?'selected="selected"':'').'>'.$attribut.'</option>';
      		}
    		?>
    		</select>
    	    <input style="float: right"type="submit" value="OK">
    		</form>
    	</div>
    </div>
  </nav>

  <main>
    <?php
      if(!isset($_GET['p'])) include('CreationBdd.php');
      else {
      	if($_GET['p']=='navigation') {
      		include('AccesPar.php');
      	}
      	elseif($_GET['p']=='recherche') {
      		include('Recherche.php');
      	}
      	elseif($_GET['p']=='listeAnnonces') {
      		include('ListeAnnonces.php');
      	}
      	else echo 'option p='.$_GET['p'].' invalide';
      }
    ?>
  </main>
</body>
</html>
