<?php
include("TOOLS/template.php");
include("TOOLS/functions.php");
echo DTD . "\n";
echo XHTML . "\n";
?>
<head>
		<?php echo HEAD . "\n";?>
    <title>As Videos Express - Résultat de la Recherche</title>
</head>

<body>
    <div id="container">
	    <?php echo BAN . "\n";?>
	    <?php echo MENU . "\n";?>
	    
	    <div id="corpAcc">
	    	<h1>Résultat de la recherche de films</h1>
	    	
	    	<?php
	    	$sql = "SELECT * FROM FILMS ";
	    	$cpt2 = 0;
		    	 if($_POST['titre'] == '' && $_POST['support'] == "Indifférent" && $_POST['dispo'] == "Indifférent" && $_POST['genre'] == "Indifférent" && $_POST['nomR'] == "Indifférent" && $_POST['nomA'] == "Indifférent"){
			    	 $co = DB_connect();
                                $sql = "SELECT FILMS.Titre,FILMS.Realisateur,FILMS.Genre,FILMS.Duree,FILMS.Synopsis,FILMS.Annee FROM FILMS ";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                while ($dn = mysql_fetch_assoc($req)) {
	                                	echo("<br><br><br>");
                                    foreach ($dn as $key => $value) {
                                    $cpt2++;
                                    	
	                                    	echo('<br> '.$key.' : '.$value);
                                    	
                                        
                                    }
                                }
                                DB_close($co);

		    	 }else{
			    	 $sql = "SELECT DISTINCT FILMS.Titre,FILMS.Realisateur,FILMS.Genre,FILMS.Duree,FILMS.Synopsis,FILMS.Annee FROM FILMS,ACTEURS,CASSETTES WHERE ";
			    	 $cpt = 0;
			    	 
			    	
			    	 
			    	 if($_POST['support'] != "Indifférent"){
				    	 if($cpt > 0){
					    	 $sql .= "AND CASSETTES.NoFilm = FILMS.NoFilm AND CASSETTES.Support = '".$_POST['support']."' ";
				    	 }else{
					    	 $sql .= "CASSETTES.NoFilm = FILMS.NoFilm AND CASSETTES.Support = '".$_POST['support']."' ";
					    	 $cpt++;
				    	 }
			    	 }
			    	 
			    	 if($_POST['dispo'] != "Indifférent"){
				    	 if($cpt > 0){
					    	 $sql .= "AND CASSETTES.NoFilm = FILMS.NoFilm AND CASSETTES.Statut = 'disponible' ";
				    	 }else{
					    	 $sql .= "CASSETTES.NoFilm = FILMS.NoFilm AND CASSETTES.Statut = 'disponible' ";
					    	 $cpt++;
				    	 }
			    	 }
			    	 
			    	 if($_POST['genre'] != "Indifférent"){
				    	 if($cpt > 0){
					    	 $sql .= "AND FILMS.Genre = '".$_POST['genre']."' ";
				    	 }else{
					    	 $sql .= "FILMS.Genre = '".$_POST['genre']."' ";
					    	 $cpt++;
				    	 }
			    	 }
			    	 
			    	 if($_POST['nomR'] != "Indifférent"){
				    	 if($cpt > 0){
					    	 $sql .= "AND FILMS.Realisateur = '".$_POST['nomR']."' ";
				    	 }else{
					    	 $sql .= "FILMS.Realisateur = '".$_POST['nomR']."' ";
					    	 $cpt++;
				    	 }
			    	 }
			    	 
			    	 if($_POST['nomA'] != "Indifférent"){
				    	 if($cpt > 0){
					    	 $sql .= "AND ACTEURS.NoFilm = FILMS.NoFilm AND ACTEURS.Acteur = '".$_POST['nomA']."' ";
				    	 }else{
					    	 $sql .= "ACTEURS.NoFilm = FILMS.NoFilm AND ACTEURS.Acteur = '".$_POST['nomA']."' ";
					    	 $cpt++;
				    	 }
			    	 }
			    	 
			    	 if($_POST['titre'] != ''){
				    	 if($cpt > 0){
					    	 $sql .= "AND FILMS.Titre REGEXP '".$_POST['titre']."'";
				    	 }else{
					    	 $sql .= "FILMS.Titre REGEXP '".$_POST['titre']."'";
					    	 $cpt++;
				    	 }
			    	 }
			    	  
			    	 
			    	 $co = DB_connect();
			    	 $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                     $tab = array();
                                while ($dn = mysql_fetch_assoc($req)) {
	                                echo("<br><br><br>");
                                    foreach ($dn as $key => $value) {
                                    $cpt2++;
                                    	
	                                    	echo('<br> '.$key.' : '.$value);
                                    	
                                        
                                    }
                                }
                                DB_close($co);

		    	 }
		    	 
		    	 if($cpt2 == 0){
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