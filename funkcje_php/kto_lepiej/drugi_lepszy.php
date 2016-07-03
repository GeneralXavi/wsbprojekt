<?php

	include("../../polaczenie/baza.php");
	include("../../polaczenie/polaczenie.php");
	$name =  $_GET['name'];
	$id_porownania = (int)$_GET['porownanie'];
	$ciastko = $name . $id_porownania;

	$query = $db->prepare("Select nazwa2, glosy2, id_porownania from $name where id_porownania= :id_porownania");
	$query->bindValue(":id_porownania",$id_porownania, PDO::PARAM_INT);
	$query->execute();

	$row = $query->fetch();

	$glosy2 = $row['glosy2'];
	$nazwa2 = $row['nazwa2'];

	$glosy2_p = $glosy2 + 1;

	if(isset($_COOKIE[$ciastko])){

		echo "<p> $nazwa2 </p> </br>";
		echo "<p> Uzyskane głosy: $glosy2 </p>";

		echo "</br> <p style='color:red'>Juz glosowałes! </p> </br>";
	}
	else{
setcookie("$ciastko", 1,  time()+3600*48);
		$update = $db->prepare("UPDATE $name SET glosy2 = :glosy2_p WHERE id_porownania= :id_porownania");  // Zwiekszenie liczby glosow o 1 w bazie
		$update->bindValue(":glosy2_p", $glosy2_p, PDO::PARAM_INT);
		$update->bindValue(":id_porownania", $id_porownania, PDO::PARAM_INT);
		$update->execute();

		echo "<p> $nazwa2 </p> </br>";
		echo "<p> Uzyskane głosy: $glosy2_p </p>";

	}
?>
