<?php

require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";

    $statement = $pdo->prepare($query);// préparationd de la requete

    $statement->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);//finalisation de la requete
    $statement->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);

    $statement->execute();

    header('Location:/index.php');
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query); //lance une requête sql sur le serveur
$friends =  $statement->fetchALL(PDO::FETCH_ASSOC); //récupère les résultats

foreach($friends as $friend) {
    echo $friend['id'] . ' ' . $friend['firstname'] . ' ' . $friend['lastname'] . '<br>';
}
?>

<form action="" method="post">
    <label for="firstname">First Name :</label>
    <input type="text" name="firstname" id="firstname" required>
    <label for="lastname">Laste Name :</label>
    <input type="text" name="lastname" id="lastname" required>
    <button type="submit">Submit</button>
</form>