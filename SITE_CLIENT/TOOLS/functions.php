<?php


function DB_connect(){
	//$db = mysql_connect('poux.ufr-info-p6.jussieu.fr', 'video52', '4576');
	//mysql_select_db('videoN', $db);
	
	return $db;
}

function DB_execSQL($req,$serv){
        return mysql_query($req) or die('Erreur SQL !<br>' . $req . '<br>' . mysql_error());
}

function DB_close($db){
	mysql_close($db);
}


?>