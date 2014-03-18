<?php
include("TOOLS/template.php");
include("TOOLS/functions.php");
echo DTD . "\n";
echo XHTML . "\n";
?>
<head>
    <?php echo HEAD . "\n"; ?>
    <title>As Videos Express - Accueil Recherche</title>
</head>

<body>
    <div id="container">
        <?php echo BAN . "\n"; ?>
        <?php echo MENU . "\n"; ?>

        <div id="corpAcc">
            <h1>Recherche de films</h1>


            <form action="Recherche.php" method="POST">
                <table summary="Rechercher le Descriptif d'un film">
                    <tr>
                        <td><label for="titre">Titre du film : </label></td>
                        <td><input name="titre" type="text" /></td>
                    </tr>
                    <tr>
                        <td><label for="support">Support : </label></td>
                        <td>
                            <select  name="support" size="1">
                                <option >DVD</option>	                    
                                <option >VHS</option>
                                <option  selected>Indifférent</option>
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <td><label for="dispo">Disponibilit?? : </label></td>
                        <td>
                            <select  name="dispo" size="1">
                                <option >Disponible</option>
                                <option  selected>Indifférent</option>
                            </select>
                        </td>

                    </tr>

                    <tr>
                        <td><label for="genre"> Genre du film : </label></td>
                        <td>
                            <select  name="genre" size="1">

                                <?php
                                $co = DB_connect();
                                $sql = "SELECT DISTINCT Genre FROM FILMS ";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                $tab = array();
                                
                                while ($dn = mysql_fetch_assoc($req)) {

                                    foreach ($dn as $key => $value) {
                                    
	                                    	echo("<option>".$value."</option>");
	                                    
                                        
                                    }
                                }


                                DB_close($co);
                                ?>
                                <option  selected>Indifférent</option>
                            </select>
                        </td>

                    </tr>

                    <tr>
                        <td><label for="nomR"> Nom du r??alisateur : </label></td>
                        <td>
                            <select  name="nomR" size="1">
                                <?php
                                $co = DB_connect();
                                $sql = "SELECT DISTINCT Realisateur FROM FILMS ";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                $tab = array();
                                
                                while ($dn = mysql_fetch_assoc($req)) {

                                    foreach ($dn as $key => $value) {
                                    
	                                    	echo("<option>".$value."</option>");
	                                    
                                        
                                    }
                                }


                                DB_close($co);
                                ?>
                                <option  selected>Indifférent</option>
                            </select>
                        </td>

                    </tr>

                    <tr>
                        <td><label for="nomA"> Nom d'un acteur : </label></td>
                        <td>
                            <select  name="nomA" size="1">
                                 <?php
                                $co = DB_connect();
                                $sql = "SELECT DISTINCT Acteur FROM ACTEURS ";
                                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
                                $tab = array();
                                
                                while ($dn = mysql_fetch_assoc($req)) {

                                    foreach ($dn as $key => $value) {
                                    
	                                    	echo("<option>".$value."</option>");
	                                    
                                        
                                    }
                                }

                                DB_close($co);
                                ?>
                                <option  selected>Indifférent</option>
                            </select>
                        </td>

                    </tr>

                </table>
                <input name="Valider" type="submit" />
            </form>

        </div>

        <div id="banner">
            <img src="img/ban.png" width="0" height="0" alt="Banniere video express" /> 
        </div>

    </div>

    <?php echo FOOT . "\n"; ?>

</body>
</html>