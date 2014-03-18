<?php
include("TOOLS/template.php");
echo DTD . "\n";
echo XHTML . "\n";
if(isset($_COOKIE['code'])){
	header('Location: Detenues.php'); 
}
?>
<head>
		<?php echo HEAD . "\n";?>
    <title>As Videos Express - Accueil Mes films détenue</title>
</head>

<body>
    <div id="container">
	    <?php echo BAN . "\n";?>
	    <?php echo MENU . "\n";?>
	    
	    <div id="corpAcc">
	    	<h1>Mes films détenue</h1>
	    	
	    	
	    	<form action="Detenues.php" method="POST">
            <table summary="Connexion">
                <tr>
                    <td><label for="nom">Nom : </label></td>
                    <td><input name="nom" type="text" /></td>
                </tr>
                <tr>
                    <td><label for="pass">Numéro abonné : </label></td>
                    <td><input name="pass" type="password" /></td>
                </tr>
            </table>
            <input name="Valider" type="submit" />
        </form>
        
	    </div>
       
        <div id="banner">
            <img src="img/ban.png" width="0" height="0" alt="Banniere video express" /> 
        </div>

    </div>
    
    <?php echo FOOT . "\n";?>
   


</body>
</html>