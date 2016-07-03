<?php
try{
  $db = new PDO('mysql:host=localhost;dbname=kolumna_wsb', $db_user, $db_password);
}catch(PDOException $e){
   print "Error!: " . $e->getMessage() . "<br/>";
  echo 'Połączenie nie mogło zostać utworzone.<br />';
}
?>
