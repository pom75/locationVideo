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
                }if(isset( $_POST['code'] )){
                	$sql = "SELECT * FROM ABONNES WHERE ABONNES.Code = '".$_POST['code']."'";
                    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                    $dn = mysql_fetch_assoc($req);
                	$estCo = true;
	                
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
    <title>As Videos Express - Commande</title>
</head>

<body>
    <div id="container">
	    <?php echo BAN . "\n";?>
	    <?php echo MENU . "\n";?>
	    
	    <div id="corpAcc">
	    	<h1>Commander un film</h1>
	    	<?php 
	    		if($estCo){
		    	if($dn['NbCassettes'] < 3){
		    		
		    		$var = 3 - $dn['NbCassettes'];
		    		echo("Nombre de film que vous pouvez encore comander : ".$var);
		    		echo('<br><form action="ConfirmeCommande.php" method="POST"><table border><tr><td>Numéro du film</td><td>Support</td></tr>');
		    		for($i = 0 ; $i< $var ; $i++){
		    			echo('<tr>');
		    			echo('<td>');
		    			echo('<input name="nom'.$i.'" type="text" />');
		    			echo('</td>');
		    			echo('<td>');
		    			echo('<input type="radio" name="support'.$i.'" value="DVD"> DVD <br>');
		    			echo('<input type="radio" name="support'.$i.'" value="VHS"> VHS <br>');
		    			echo('<input type="HIDDEN" name="code" value="'.$dn['Code'].'">');
		    			echo('</td>');
		    			echo('</tr>');
			    		
		    		}
		    		echo('</table><input name="Valider" type="submit" /></form>');
		    	

			    	
		    	}else{
			    	echo("<p>Vous avez atteinds le nombre maximum de film en votre possession , Retouner des film pour pouvoir commander a nouveau</p>");
		    	}
		    	
		    	
		    	
		    	
	    	}else{
		    	
		    	echo("<a href='IdentificationC.php'>Erreur d'identification , clicker ici pour retourner au menu d'identification</a>");
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