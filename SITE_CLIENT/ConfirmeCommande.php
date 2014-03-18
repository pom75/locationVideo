<?php
include("TOOLS/template.php");
include("TOOLS/functions.php");
echo DTD . "\n";
echo XHTML . "\n";
//ON pécho la bd pour l'insertion
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=mysql51-77.perso;dbname=locationfaabc', 'locationfaabc', 'maimai1', $pdo_options);
?>
<head>
    <?php echo HEAD . "\n"; ?>
    <title>As Videos Express - Comande</title>
</head>

<body>
    <div id="container">
        <?php echo BAN . "\n"; ?>
        <?php echo MENU . "\n"; ?>

        <div id="corpAcc">
            <h1>Confirmation commandes</h1>
            <?php
            
            //ON compte le nombre de films rentrer pour boucler dessus
            $cpt = 0;
            if (isset($_POST['nom0']) && isset($_POST['support0'])) {
                $cpt++;
                if (isset($_POST['nom1']) && isset($_POST['support1'])) {
                    $cpt++;

                    if (isset($_POST['nom2']) && isset($_POST['support2'])) {
                        $cpt++;
                    }
                }
            }


            $co = DB_connect();

            $cmp = 0;
            $buff = '';
            
            //Si le mec a rentrer plus de 0 film
            if ($cpt > 0) {
            
            	//ON cree le tableau
                echo('<br><form action="ExecuteCommande.php" method="POST"><table border>');
                
                //Pour tous les films qu'il a rentrer on fait
                for ($i = 0; $i < $cpt; $i++) {
                
                	//On chope le titre du film
                	$sql = "SELECT FILMS.Titre FROM FILMS WHERE FILMS.NoFilm = '" . $_POST['nom' . $i] . "' ";
                    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                    $dn = mysql_fetch_assoc($req);
                    
                    $titre = $dn['Titre'];
                
                
                    echo("<tr>");
                    echo("<td>No film : " . $_POST['nom' . $i] . "</td>");
                    echo("<td>Titre : " . $titre . "</td>");
                    
                    
                    //On regarde si il y a des cassette disponible dans le support demander
                    $sql = "SELECT * FROM CASSETTES WHERE CASSETTES.NoFilm = '" . $_POST['nom' . $i] . "' AND CASSETTES.Support = '" . $_POST['support' . $i] . "' AND CASSETTES.Statut = 'disponible' ";
                    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                    $dn = mysql_fetch_assoc($req);
                    
                    //Si il y a pas de film disponible
                    if (mysql_num_rows($req) == 0) {
                    
                    	//On look toute films reservé du meme support 
	                    $sql = "SELECT * FROM CASSETTES WHERE CASSETTES.NoFilm = '" . $_POST['nom' . $i] . "' AND CASSETTES.Support = '" . $_POST['support' . $i] . "' AND CASSETTES.Statut = 'reservee' ";
	                    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
	                    $dn = mysql_fetch_assoc($req);
	                    
	                    //Si On trouve des cassette reserver
	                     if (mysql_num_rows($req) > 0) {
	                     
	                     	//On regarde si les 5 minute son dépassé
		                    $sql = "SELECT * FROM EMPRES WHERE EMPRES.NoFilm = '" . $dn['NoFilm']. "' AND EMPRES.NoExemplaire = '" .$dn['NoExemplaire']. "' AND EMPRES.DateEmpRes < DATE_SUB(NOW(),INTERVAL 5 MINUTE) ";
		                    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
		                    $dn = mysql_fetch_assoc($req);
	                    }
                    
                    }

                    //Si dans tous les tests précedant On toruve un résultat (on aura les bon $dn)
                    if (mysql_num_rows($req) > 0) {
                    
                    	//On reserve la cassette
                    	$sql1 = "UPDATE CASSETTES SET Statut = 'reservee' WHERE CASSETTES.NoFilm = '" .$dn['NoFilm'] . "' AND CASSETTES.NoExemplaire = '" . $dn['NoExemplaire']."'";
                    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>' . $req1 . '<br>' . mysql_error());
                    
                    //On suprime la précedente réservation si il y en a une et qu'elle a dépassé 5 min
                    $sql1 = "DELETE FROM EMPRES WHERE EMPRES.NoFilm = '" .$dn['NoFilm'] . "' AND EMPRES.NoExemplaire = '" . $dn['NoExemplaire']."'";
                    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>' . $req1 . '<br>' . mysql_error());
                    
                    //ON insert la nouvelle réservation
                    $req = $bdd->prepare("INSERT INTO EMPRES(NoFilm,NoExemplaire,CodeAbonne,DateEmpRes) VALUES( :NoFilm, :NoExemplaire , :CodeAbonne, NOW())");
			        $req->execute(array(
			            'NoFilm' => $_POST['nom' . $i],
			            'NoExemplaire' => $dn['NoExemplaire'],
			            'CodeAbonne' => $_POST['code']
			        ));


                    
                    
                        echo('<td>Le film est disponible <input type="checkbox" name="nomF' . $i . '" value="' . $_POST['nom' . $i] . '" checked ><input type="HIDDEN" name="exemp'.$i.'" value="' . $dn['NoExemplaire'] . '"></td>');
                        $cmp++;
                        
                    //Si on toruve pas de film avec le support demander , on essais avec n'importe quel type de suport (meme chose que précédamment donc pas de commentaire)
                    } else {

                        $sql = "SELECT * FROM CASSETTES WHERE CASSETTES.NoFilm = '" . $_POST['nom' . $i] . "' AND CASSETTES.Statut = 'disponible' ";
                        $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                        $dn = mysql_fetch_assoc($req);
                        
                         if (mysql_num_rows($req) == 0) {
	                    $sql = "SELECT * FROM CASSETTES WHERE CASSETTES.NoFilm = '" . $_POST['nom' . $i] . "'  AND CASSETTES.Statut = 'reservee' ";
	                    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
	                    $dn = mysql_fetch_assoc($req);
	                     if (mysql_num_rows($req) > 0) {
	                     	$buff = $dn['Support'];
		                    $sql = "SELECT * FROM EMPRES WHERE EMPRES.NoFilm = '" . $dn['NoFilm']. "' AND EMPRES.NoExemplaire = '" .$dn['NoExemplaire']. "' AND EMPRES.DateEmpRes < DATE_SUB(NOW(),INTERVAL 5 MINUTE) ";
		                    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
		                    $dn = mysql_fetch_assoc($req);
	                    }
                    
                    }
                        
                        
                        if (mysql_num_rows($req) > 0) {
                        	$sql1 = "UPDATE CASSETTES SET Statut = 'reservee' WHERE CASSETTES.NoFilm = '" .$dn['NoFilm'] . "' AND CASSETTES.NoExemplaire = '" . $dn['NoExemplaire']."'";
                    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>' . $req1 . '<br>' . mysql_error());
                    
                    $sql1 = "DELETE FROM EMPRES WHERE EMPRES.NoFilm = '" .$dn['NoFilm'] . "' AND EMPRES.NoExemplaire = '" . $dn['NoExemplaire']."'";
                    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>' . $req1 . '<br>' . mysql_error());
                    
                    
                     $req = $bdd->prepare("INSERT INTO EMPRES(NoFilm,NoExemplaire,CodeAbonne,DateEmpRes) VALUES( :NoFilm, :NoExemplaire , :CodeAbonne, NOW())");
			        $req->execute(array(
			            'NoFilm' => $_POST['nom' . $i],
			            'NoExemplaire' => $dn['NoExemplaire'],
			            'CodeAbonne' => $_POST['code']
			        ));
			        
			        
			        
                        	$cmp++;
                            echo('<td>Le film est disponible en ' . $buff . ' si vous le souhait??  <input type="checkbox" name="nomF' . $i . '" value="' . $_POST['nom' . $i] . '" ><input type="HIDDEN" name="exemp'.$i.'" value="' . $dn['NoExemplaire'] . '"></td>');
                        } else {
                            echo("<td>Le film n'est ni disponible en VHS ni en DVD</td>");
                        }
                    }
                    echo("</tr>");
                }
                //Si on trouve des film disponible on affiche le bouton pour commander
                if ($cmp > 0) {
                    echo('<input type="HIDDEN" name="code" value="' . $_POST['code'] . '">');
                    echo('</table><input name="Valider" type="submit" value="Commander !" /></form>');
                } else {
                	//Sinon on avant un nouveau formulaire avec le code du mec pour revenir a la page précédante
                    echo('</table></form>');
                    echo('<br><form action="Commande.php" method="POST"><input type="HIDDEN" name="code" value="' . $_POST['code'] . '"><input name="Revenir" type="submit" value="Revenir" /></form>');
                }
            } else {
                echo("Aucun choix effectué");
            }


            DB_close($co);
            ?>





        </div>

        <div id="banner">
            <img src="img/ban.png" width="0" height="0" alt="Banniere video express" /> 
        </div>

    </div>


<?php echo FOOT . "\n"; ?>
</body>
</html>