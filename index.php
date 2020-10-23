<!-- TODO: Executer la requête (query) comme en haut mais sur une seule ligne cette fois (exemple 2 )
$capitalV2 = $connect->query("SELECT * FROM `capital`")->fetchAll();-->

<?php

// TODO: Connexion à la BDD
$connect = new PDO('mysql:host=localhost;dbname=pays', 'root', '',);

// TODO: Faire la requête (query) pour get toutes les capitales (exemple1)
$query = "SELECT * FROM `capital`";

// TODO: Build la requête (query) (exemple1)
$querybuilder = $connect->query($query);

// TODO: Executer la requête (query) (exemple1)
$capitals = $querybuilder->fetchAll();




if (isset($_GET["capital"])) {
    // TODO: Récupère (Get) capitale dans l'url ($_GET) on stock la capilate dans une variable
$getcapital = $_GET["capital"];

// TODO: Préparer une requête pour chercher la capitale qui = pays
$sql = "SELECT country FROM capital WHERE capital = :capital";
$prepare = $connect->prepare($sql);

// TODO: Passer les paramètres à la requête (query)
$prepare->bindParam(':capital', $getcapital);

// TODO: Executer la requête (query)
$prepare->execute();
$country = $prepare->fetch();
// TODO: Afficher le resultat
$result = "La " . $country['country'] ." a pour capitale $getcapital";
}

?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
          crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Trouver capitale</title>
</head>
<body>

<?php if (isset($result)): ?>
<h1> <?= $result ?> </h1>
<?php endif; ?>

<form method="GET" action="index.php">
    <select class="form-control form-control-lg" name="capital">
        <option selected="selected">Sélectionner un pays</option>';
        <!-- TODO: Afficher le resultat dans un foreach-->
        <?php foreach ($capitals as $capital): ?>

            <option> <?= $capital["capital"] ?> </option>

        <?php endforeach; ?>
    </select>
    <!-- TODO: Soumettre (submit) le formulaire (form) //-->
    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
</form>
</body>
