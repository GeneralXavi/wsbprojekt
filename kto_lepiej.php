<!doctype html>
<html>
     <head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="UTF-8">
    <link href="css/style_kto_lepiej.css" rel="stylesheet" type="text/css" />

    <title> Who was better?</title>

		<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>


		<script>
    // POBIERANIE WARTOSCI GET PRZEZ JS
		function getUrlVars() {
				var vars = {};
				var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
				vars[key] = value;
				});
				return vars;
				} // źródło skryptu: http://papermashup.com/read-url-get-variables-withjavascript/
		</script>



     </head>

	 <body>


		 <?php // POLACZENIE Z BAZA DANYCH //
			include("polaczenie/baza.php");
			include("polaczenie/polaczenie.php");
		?>


		<div class="tytul">
      PORÓWNAJ PIŁKARZY!
		</div>

		<p class="statystyki">
      Statystyki meczu:
    </p>


			<div class=container>

				<div id="por1">
					<?php

            $id_porownania_get=(int)$_GET['porownanie']; // Pobranie wartosci okreslajaca numer porownania
						$name = $_GET['name']; // Pobbranie nazwy meczu

            /// !!! 1 w calym projekcie oznacza pilkarza, statystyke itp. znajdujacego sie po lewej stronie, a 2 po prawej stronie !!! /// 

            $query = $db->prepare("Select
                                    id_porownania,
                                    nazwa1,
                                    zdjecie1,
                                    nazwa2,
                                    zdjecie2,
                                    bramki1,
                                    przebiegniete1,
                                    podania1, przebiegniete2,
                                    podania2,
                                    bramki2,
                                    glosy1,
                                    glosy2
                                  FROM $name where id_porownania = :id_porownania_get");
            $query->bindValue(':id_porownania_get',$id_porownania_get, PDO::PARAM_INT);
            $query->execute();

            $row = $query->fetch();
            $id_porownania = $row['id_porownania'];
            $nazwa1 = $row['nazwa1'];
            $zdjecie1 = $row['zdjecie1'];
            $nazwa2 = $row['nazwa2'];
            $zdjecie2 = $row['zdjecie2'];
            $bramki1 = $row['bramki1'];
            $przebiegniete1 = $row['przebiegniete1'];
            $podania1 = $row['podania1'];
            $przebiegniete2 = $row['przebiegniete2'];
            $podania2= $row['podania2'];
            $bramki2 = $row['bramki2'];
            $glosy1 = $row['glosy1'];
            $glosy2 = $row['glosy2'];

            $query = $db->prepare("Select id_porownania FROM $name");
            $query->execute();
            $liczba_porownan = $query->rowCount();





					?>
						<div class="pierwszy_zdjecie">
						<?php
							echo "<img src='$zdjecie1' width='100%' height='100%' border='4' alt='' /> ";
						?>
						</div>
						<div id="pierwszy">
							<?php

									if ($id_porownania_get<=$liczba_porownan){ // WYSWIETLANIE KONKRETNYCH STATYSTYKCH KONKRETNEGO PILKARZA (Okreslonego przez id_porownania)
                    echo  "<div id='statystyki_schowaj'>";
  										echo " <p class='nazwa_d'> Przebiegnięte KM: ";
  										echo " <span class='nazwa_w'> $przebiegniete1 </span> </p> </br>";
  										echo "<p class='nazwa_d'> Podania: ";
  										echo " <span class='nazwa_w'> $podania1 </span> </p> </br>";
  										echo " <p class='nazwa_d'> Bramki: ";
  										echo " <span class='nazwa_w'> $bramki1 </span> </p> </br>";

  										echo '<input type="image" id="lepiej1" class="wybieram" src="image/kto_lepiej/wybieram.png"/>';
                    echo "</div>";

									}
									else { echo"<div id='koniec1'>"; // WYSWIETLENIE KONCOWYCH IMION PILKARZY I ICH LICZBE GLOSOW (wszystkich)
                      $query_end = $db->prepare("Select nazwa1, glosy1 FROM $name");
                      $query_end->execute();
                      while($row = $query_end->fetch()) {
											      echo "<span class='koniec_n'>" .$row['nazwa1'].":";
											      echo "<span class='koniec_g'>" .$row['glosy1']."</span> </span> </br>";
                      }

										echo "<p> Koniec możliwości glosowania </p>";
										echo "</div>";
									};

								?>

								<br>

						</div>

						<div class="nazwa1">
              <?php echo "$nazwa1" //WYSWIETLENIE NAZWY PIERWSZE PILKARZA ?>
						</div>




				</div>



						<div id="pomiedzy">

            <?php
              $porownanie = $id_porownania_get + 1; // Przeladowanie strony i zwiekszenie jej wartosci "id_porownania", przez co beda wyswietlac sie inni pilkarze
             ?>
             <a href="kto_lepiej.php?name=<?php echo $name?>&porownanie=<?php echo $porownanie ?>">
							<img class='kolejny' src='image/kto_lepiej/kolejny.png'>
            </a>

						</div>


					<div id="por2">

						<div class="drugie_zdjecie">
							<?php
								echo "<img src='$zdjecie2' width='100%' height='100%' border='4' alt='' /> <br>";
							?>
						</div>

						<div id="drugi">

										<?php

										$i=0;

											if ($id_porownania_get<=$liczba_porownan){
                        echo  "<div id='statystyki_schowaj2'>";
  												echo " <p class='nazwa_d'> Przebiegnięte KM: ";
  												echo " <span class='nazwa_w'> $przebiegniete2 </span> </p> </br>";
  												echo "<p class='nazwa_d'> Podania: ";
  												echo " <span class='nazwa_w'> $podania2 </span> </p> </br>";
  												echo " <p class='nazwa_d'> Bramki: ";
  												echo " <span class='nazwa_w'> $bramki2 </span> </p> </br>";

  												echo '<input id="lepiej2" type="image" class="wybieram" src="image\kto_lepiej/wybieram.png" />';
                        echo "</div>";
											}
											else { echo"<div id='koniec2'>";
                        $query_end = $db->prepare("Select nazwa2, glosy2 FROM $name");
                        $query_end->execute();
                        while($row = $query_end->fetch()) {
  											      echo "<span class='koniec_n'>" .$row['nazwa2'].":";
  											      echo "<span class='koniec_g'>" .$row['glosy2']."</span> </span> </br>";
                        }

												echo "<p> Koniec możliwości glosowania </p>";
												echo "</div>";

											};


									?>
										<br>


									</div>

									<div class="nazwa2">
									<?php
										echo "$nazwa2";
									?>
									</div>


							</div>

							<div class="powrot_div">

										<a href="home_page.php"> <img class="powrot" src="image/kto_lepiej/powrot.png"> </a>

									</div>
				</div>


        <script>

          document.getElementById("lepiej1").addEventListener("click",function(){
              $("#statystyki_schowaj,#statystyki_schowaj2").fadeOut(500);

              var name = getUrlVars()["name"]; // Pobranie nazwy meczu
              var porownanie = getUrlVars()["porownanie"]; // Pobranie id porownania

              setTimeout(function(){ // Wyslanie zmiennych do konkretnych plikow
                $('#pierwszy').load('funkcje_php/kto_lepiej/pierwszy_lepszy.php?name=' + name + '&porownanie=' + porownanie);
                $('#drugi').load('funkcje_php/kto_lepiej/drugi_gorszy.php?name=' + name + '&porownanie=' + porownanie);
              }, 500);


          });



          document.getElementById("lepiej2").addEventListener("click", function(){
            $("#statystyki_schowaj,#statystyki_schowaj2").fadeOut(500);

            var name = getUrlVars()["name"];
            var porownanie = getUrlVars()["porownanie"];

            setTimeout(function(){
              $('#drugi').load('funkcje_php/kto_lepiej/drugi_lepszy.php?name=' + name + '&porownanie=' + porownanie);
              $('#pierwszy').load('funkcje_php/kto_lepiej/pierwszy_gorszy.php?name=' + name + '&porownanie=' + porownanie);
            }, 500);



          });


          var tab = document.querySelectorAll("#lepiej1,#lepiej2");

          for (var i=0; i<tab.length; i++){
            tab[i].addEventListener("click", function(){

              var glosy1 = "<?php echo $glosy1 ?>"
              var glosy2 = "<?php echo $glosy2 ?>"
              glosy1*=1;
              glosy2*=1;

              setTimeout(function(){
                if (glosy1>glosy2){
                  var div = document.getElementById("por2");
                  div.style.opacity = "0.4";
                }
                else{
                  var div = document.getElementById("por1");
                  div.style.opacity = "0.4";
                }
              }, 500);

            })
          }

        </script>

			 </body>
		</html>
