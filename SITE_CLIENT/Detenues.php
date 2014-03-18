<?php
include("TOOLS/template.php");
include("TOOLS/functions.php");
echo DTD . "\n";
echo XHTML . "\n";
$co = DB_connect();
 if(!isset($_COOKIE['code'])){

 $username = $_POST['nom'];
                        $password = $_POST['pass'];
                        
$estCo = false;


                                
                                $sql = "SELECT * FROM ABONNES WHERE ABONNES.Code = '".$password."'";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                $dn = mysql_fetch_assoc($req);
                                
				if($dn['Nom']==$username && mysql_num_rows($req)>0)
                {	
                	$estCo = true;
                	
                	setcookie("nom",$username,time()+6000000000);
                	setcookie("code",$password,time()+6000000000);
                }
                
               	                
                }else{
	                $sql = "SELECT * FROM ABONNES WHERE ABONNES.Code = '".$_COOKIE['code']."'";
	                 $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                $dn = mysql_fetch_assoc($req);
	                $estCo = true;
                }

                                DB_close($co); ?>
<head>
		<?php echo HEAD . "\n";?>
    <title>As Videos Express - Mes films détenue</title>
</head>

<body>
    <div id="container">
	    <?php echo BAN . "\n";?>
	    <?php echo MENU . "\n";?>
	    
	    <div id="corpAcc">
	    	<h1>Mes films détenues</h1>
	    	<?php 
	    		if($estCo){
		    	if($dn['NbCassettes'] > 0){
		    	$co = DB_connect();
		    	$sql = "SELECT DISTINCT EMPRES.NoFilm,EMPRES.NoExemplaire,FILMS.Titre,FILMS.Realisateur,EMPRES.DateEmpRes FROM FILMS,EMPRES,CASSETTES WHERE EMPRES.CodeAbonne = '".$dn['Code']."' AND EMPRES.NoFilm = FILMS.NoFilm AND EMPRES.NoFilm = CASSETTES.NoFilm AND EMPRES.NoExemplaire = CASSETTES.NoExemplaire AND CASSETTES.Statut = 'empruntee'";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                echo("<table border>");
                                echo("<tr><td align=center>numéro du film</td><td align=center>numéro d'exemplaire</td><td align=center>titre</td><td align=center>réalisateur</td><td align=center>date d'emprunt</td></tr>");
                                while ($dn = mysql_fetch_assoc($req)) {
                                
	                               echo("<tr>");
                                    foreach ($dn as $key => $value) {
                                    	
                                    	echo('<td align=center>'.$value.'</td>');
	                                  
                                        
                                    }
                                    echo("<tr>");
                                    
                                }
                                echo("</table>");
                                DB_close($co);

			    	
		    	}else{
			    	echo("<p>Vous n'avez actuellement aucun film en votre possession</p>");
		    	}
		    	
		    	
		    	
		    	
	    	}else{
		    	
		    	echo("<a href='IdentificationD.php'>Erreur d'identification , clicker ici pour retourner au menu d'identification</a>");
	    	} 
	    	?>
	    	
	    	
        
	    </div>
       
        <div id="banner">
            <img src="img/ban.png" width="0" height="0" alt="Banniere video express" /> 
        </div>

    </div>
    

    <?php echo FOOT . "\n";?>
</body>
</html>