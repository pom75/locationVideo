<!doctype html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='fr' lang='fr'>
<head>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-15'/>
				<meta name='revisit-after' content='0 days'/>
				<link rel='stylesheet' href='../asve.css' type='text/css' media='screen' charset='utf-8'/>
    <title>As Videos Express </title>
</head>

<body>
   <div id="container">
	    <div id='banner'><a href='Accueil.php'><img src='../img/ban.png' width='960' height='200' alt='Banniere video express' /> </a></div>
	    <div id='access'><ul><li><a href='Accueil.php'>Home</a></li><li><a href='AccueilDescriptif.php'>Descriptif de films</a></li><li><a href='AccueilRecherche.php'>Recherche de films</a></li><li><a href='IdentificationD.php'>Mes films dtenues</a></li><li><a href='IdentificationC'>Commande de films</a></li></ul></div>
	    <div id="corpAcc">
	    	<h1>Retour</h1>
	    	<?php
	    	include("../TOOLS/functions.php");
	    	if(!isset($_POST['numF']) && !isset($_POST['numE'])){
		    	echo("Numero de fil ou d'exemplaire vide");
	    	}else{
		    	$co = DB_connect();
                                
                                $sql = "SELECT * FROM EMPRES WHERE EMPRES.NoFilm = '".$_POST['numF']."' AND EMPRES.NoExemplaire = '".$_POST['numE']."'";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                $dn = mysql_fetch_assoc($req);
                                
				if( mysql_num_rows($req)<1)
                {	
                	echo("Numero de film ou numero d'emplaire inexistant dans la bd");
                }else{
                
	                $sql = "UPDATE CASSETTES SET Statut = 'disponible' WHERE CASSETTES.NoFilm = '".$_POST['numF']."' AND CASSETTES.NoExemplaire = '".$_POST['numE']."' ";
					$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					
	                $sql = "UPDATE ABONNES SET NbCassettes = NbCassettes - 1 WHERE Code = '".$dn['CodeAbonne']."'  ";
					$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					
					$sql = "DELETE FROM EMPRES WHERE EMPRES.NoFilm = '".$_POST['numF']."' AND EMPRES.NoExemplaire = '".$_POST['numE']."'  ";
					$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					
					echo("Mise a jour effectuer (sauf si une putain d'erreur aparais");
                }

                                DB_close($co);
		    	
		    	
	    	}
	    	?>
        
	    </div>
       
        <div id="banner">
            <img src="img/ban.png" width="0" height="0" alt="Banniere video express" /> 
        </div>

    </div>
    

    <div id="footer">SA Vidos Express | Dupont et Durant ©</div>
</body>
</html>