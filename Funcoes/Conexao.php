<?
	//session_start();
	//$_SESSION["UsuarioBanco"] = "root,";

?>
<?
/*
	$DB_USER = "root";
	$DB_PASS = "root";
	$DB_HOST = "localhost";

	$DOC_ROOT = "sbcpa_prd";
	$DB_USER = "sbcpa_user";
	$DB_PASS = "a1b2c3d4";

	$DB_USER = "sbcpa_user2";
	$DB_PASS = "102030";
	$DB_HOST = "167.114.192.168";
*/	
	$DB_USER = "sbcpa_user_sipa";
	$DB_PASS = "@*SbCpA102030##";
	$DOC_ROOT = "sbcpa_sipa_02";
	$DB_HOST = "localhost";

	$Conn = mysql_connect ($DB_HOST,$DB_USER,$DB_PASS) or die("Não pode conectar: " . mysql_error());
	mysql_select_db ($DOC_ROOT,$Conn);

	$Data = date("Y-m-d");
	$Hora = date("H:i:s");

	session_start();
	$Usuario = $_SESSION["usuarioSBCPAsipaDsf3"];
?>
