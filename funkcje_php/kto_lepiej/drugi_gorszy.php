<?php

include("../../polaczenie/baza.php");
include("../../polaczenie/polaczenie.php");
$name =  $_GET['name'];
$id_porownania = (int)$_GET['porownanie'];

$query = $db->prepare("Select nazwa2, glosy2, id_porownania from $name where id_porownania= :id_porownania");
$query->bindValue(":id_porownania",$id_porownania, PDO::PARAM_INT);
$query->execute();

$row = $query->fetch();

$nazwa2 = $row['nazwa2'];
$glosy2 = $row['glosy2'];

echo "<p> $nazwa2 </p> </br>";
echo "<p> Uzyskane głosy: $glosy2 </p>";

?>
