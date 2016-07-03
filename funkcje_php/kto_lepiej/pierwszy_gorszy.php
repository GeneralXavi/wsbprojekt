<?php

	include("../../polaczenie/baza.php");
	include("../../polaczenie/polaczenie.php");
	$name =  $_GET['name'];
	$id_porownania = (int)$_GET['porownanie'];

	$query = $db->prepare("Select nazwa1, glosy1, id_porownania from $name where id_porownania= :id_porownania");
	$query->bindValue(":id_porownania",$id_porownania, PDO::PARAM_INT);
	$query->execute();

	$row = $query->fetch();

	$nazwa1 = $row['nazwa1'];
	$glosy1 = $row['glosy1'];

	echo "<p> $nazwa1 </p> </br>";
	echo "<p> Uzyskane głosy: $glosy1 </p>";

?>
