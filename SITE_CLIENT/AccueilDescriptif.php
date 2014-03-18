<?php
include("TOOLS/template.php");
echo DTD . "\n";
echo XHTML . "\n";
?>
<head>
		<?php echo HEAD . "\n";?>
    <title>As Videos Express - Accueil Descriptif</title>
</head>

<body>
    <div id="container">
	    <?php echo BAN . "\n";?>
	    <?php echo MENU . "\n";?>
	    
	    <div id="corpAcc">
	    	<h1>Descriptif de films</h1>
	    	
	    	
	    	<form action="Descriptif.php" method="POST">
            <table summary="Rechercher le Descriptif d'un film">
                <tr>
                    <td><label for="num">Numéro de film : </label></td>
                    <td><input name="num" type="text" /></td>
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

