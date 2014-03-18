<?php
include("TOOLS/template.php");
include("TOOLS/functions.php");
echo DTD . "\n";
echo XHTML . "\n";

?>
<head>
		<?php echo HEAD . "\n";?>
    <title>As Videos Express - Commande</title>
</head>

<body>
    <div id="container">
	    <?php echo BAN . "\n";?>
	    <?php echo MENU . "\n";?>
	    
	    <div id="corpAcc">
	    	<h1>Commande confirmer</h1>
	    	<?php 
	    	$co = DB_connect();
	    	
	    	
	    	 $cpt = 0;
            if (isset($_POST['nomF0']) && isset($_POST['exemp0'])) {
                $cpt++;
                if (isset($_POST['nomF1']) && isset($_POST['exemp1'])) {
                    $cpt++;

                    if (isset($_POST['nomF2']) && isset($_POST['exemp2'])) {
                        $cpt++;
                    }
                }
            }
            
             //Si le mec a rentrer plus de 0 film
            if ($cpt > 0) {
            	//Pour tous les films qu'il a rentrer on fait
                for ($i = 0; $i < $cpt; $i++) {
                	$sql1 = "UPDATE CASSETTES SET Statut = 'empruntee' WHERE CASSETTES.NoFilm = '" .$_POST['nomF'.$i.''] . "' AND CASSETTES.NoExemplaire = '" . $_POST['exemp'.$i.'']."'";
                    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>' . $req1 . '<br>' . mysql_error());
                    
                    $sql1 = "UPDATE ABONNES SET NbCassettes = NbCassettes + 1 WHERE Code = '".$_POST['code']."' ";
                    $req1 = mysql_query($sql1) or die('Erreur SQL !<br>' . $req1 . '<br>' . mysql_error());
                     
                
                }
                
                
            }
	    		
	    		
	    		 DB_close($co);
	    	?>
        
	    </div>
       
        <div id="banner">
            <img src="img/ban.png" width="0" height="0" alt="Banniere video express" /> 
        </div>

    </div>
    

    <?php echo FOOT . "\n";?>
</body>
</html>