<?php
include("TOOLS/template.php");
include("TOOLS/functions.php");
echo DTD . "\n";
echo XHTML . "\n";
?>
<?php //traitemment du formulaire  + Stoquer dans un tableau le résultat ?>
<head>
		<?php echo HEAD . "\n";?>
    <title>As Videos Express - Résultat de la recherche de Description</title>
</head>

<body>
    <div id="container">
	    <?php echo BAN . "\n";?>
	    <?php echo MENU . "\n";?>
	    
	    <div id="corpAcc">
	    	<h1>Résultat de la recherche du descriptif de films</h1>
	    	<?php
		    	$co = DB_connect();
                                $cpt = 0;
                                $sql = "SELECT * FROM FILMS WHERE FILMS.NoFilm = '".$_POST['num']."'";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                while ($dn = mysql_fetch_assoc($req)) {
                                $cpt++;

                                    foreach ($dn as $key => $value) {
                                    	
                                    	echo('<br> '.$key.' : '.$value);
	                                  
                                        
                                    }
                                }
                                $sql = "SELECT Acteur FROM ACTEURS WHERE ACTEURS.NoFilm = '".$_POST['num']."'";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                while ($dn = mysql_fetch_assoc($req)) {
                                $cpt++;

                                    foreach ($dn as $key => $value) {
                                    	
                                    	echo('<br> '.$key.' : '.$value);
	                                  
                                        
                                    }
                                }


                                DB_close($co);
                                
	    	 if($cpt == 0){
		    	echo("<p>Aucun film ne correspond à la recherche</p>");
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