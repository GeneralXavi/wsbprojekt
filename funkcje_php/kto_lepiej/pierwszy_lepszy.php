<?php

	include("../../polaczenie/baza.php");
	include("../../polaczenie/polaczenie.php");
	$name =  $_GET['name'];
	$id_porownania = (int)$_GET['porownanie'];
	$ciastko = $name . $id_porownania;

	$query = $db->prepare("Select nazwa1, glosy1, id_porownania from $name where id_porownania= :id_porownania");
	$query->bindValue(":id_porownania",$id_porownania, PDO::PARAM_INT);
	$query->execute();

	$row = $query->fetch();

	$nazwa1 = $row['nazwa1'];
	$glosy1 = $row['glosy1'];

	$glosy1_p = $glosy1 + 1;

	if(isset($_COOKIE[$ciastko])){
		echo "<p> $nazwa1 </p> </br>";
		echo "<p> Uzyskane głosy: $glosy1 </p>";

			echo "</br> <p style='color:red'>Juz glosowałes! </p> </br> ";

	}
	else{
setcookie("$ciastko", 1,  time()+3600*48);

		$update = $db->prepare("UPDATE $name SET glosy1 = :glosy1_p WHERE id_porownania= :id_porownania"); // Zwiekszenie liczby glosow o 1
		$update->bindValue(":glosy1_p", $glosy1_p, PDO::PARAM_INT);
		$update->bindValue(":id_porownania", $id_porownania, PDO::PARAM_INT);
		$update->execute();

		echo "<p> $nazwa1 </p> </br>";
		echo "<p> Uzyskane głosy: $glosy1_p </p>";



	}
?>
