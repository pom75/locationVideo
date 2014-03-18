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

	    	<h1>Retour d'un produit</h1>
	    	
	    	
	    	<form action="Retour.php" method="POST">
            <table summary="Champs de saisies">
                <tr>
                    <td><label for="numF">Numéro de film : </label></td>
                    <td><input name="numF" type="text" /></td>
                </tr>
                <tr>
                    <td><label for="numE">Numéro d'exemplaire : </label></td>
                    <td><input name="numE" type="text" /></td>
                </tr>
            </table>
            <input name="Valider" type="submit" />
        </form>
        
	    </div>
       
        <div id="banner">
            <img src="img/ban.png" width="0" height="0" alt="Banniere video express" /> 
        </div>

    </div>
    
    <div id="footer">SA Vidos Express | Dupont et Durant ©</div>
   


</body>
</html>