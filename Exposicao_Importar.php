<? require("Estilo/Estilo.php");?>
<title>SIPA</title>
<link href="Estilo.css" rel="stylesheet" type="text/css">
<h3>Importar Exposição</h3>
<?
	$link = "http://www.sbcpa.com.br/extranet/Exposicao_ResultadoImportacao.asp";
	//$link = "http://sistemas/extranet/Exposicao_ResultadoImportacao.asp";

	require("Funcoes/Conexao.php");
	$Carga = $_POST["Carga"];
	$IDExposicao = $_POST["IDExposicao"];
	$Carga1 = str_replace("\'","'",$Carga);

	//die($Carga1);
	
	//APAGAR REGISTROS TEMPORÁRIOS
		$sql = "DELETE FROM TBEXPOSICAOTEMP";
	//	$sql_result = mysql_query($sql,$Conn);
		
		$sql = "DELETE FROM tbcachorroexposicaotemp";
	//	$sql_result = mysql_query($sql,$Conn);


	// IMPORTAR OS DADOS COM A FORMATAÇÃO DA EXTRANET	
		$sql = "DELETE FROM tbsqlimport WHERE IDExposicao = $IDExposicao";
	//	$sql_result = mysql_query($sql,$Conn);
	
		$v = split("INSERT INTO",$Carga);
		$t = substr_count($Carga,"INSERT INTO");
		for($i=1; $i<=$t; $i++){
			$sql = "INSERT INTO tbsqlimport (IDExposicao,TXSQLIMPORT) values ($IDExposicao,'$v[$i]')";
		//	$sql_result = mysql_query($sql,$Conn);
		}
	
		$v = split("INSERT INTO",$Carga1);
		$t = substr_count($Carga1,"INSERT INTO");
		for($i=1; $i<=$t; $i++){
			$sql = "INSERT INTO $v[$i]";
		//	$sql_result = mysql_query($sql,$Conn);
		}

	//CADASTRAR PROPRIETÁRIOS
		$IDProprietarios = "0";
		$sqll = "select * from tbproprietariotemp";
		$sql_resultt = mysql_query($sqll,$Conn);
		while ($row = mysql_fetch_array($sql_resultt))
		{
			$IdP = 0;
			$sql22 = "select * from tbproprietario where idproprietariotemp = $row[IdProprietario]";
			$sql_resultt22 = mysql_query($sql22,$Conn);
			while ($row2 = mysql_fetch_array($sql_resultt22)){
				$IdP = $row2["IdProprietario"];
			}
					
			if ($IdP == 0){
				$sql2 = "INSERT INTO tbproprietario (NoProprietario, EdProprietario, NoBairro, NuCEP, NoCidade, SgUF, NoEmail, NuTelefones, DSHomePage, IdProprietarioTemp) VALUES ('$row[NoProprietario]', '$row[EdProprietario]', '$row[NoBairro]', '$row[NuCEP]', '$row[NoCidade]', '$row[SgUF]', '$row[NoEmail]', '$row[NuTelefones]',  '$row[DSHomePage]', $row[IdProprietario])";
				$sql_result = mysql_query($sql2,$Conn);
				$IdP = mysql_insert_id();
				$IDProprietarios = $IDProprietarios . "," . $row["IdProprietario"];
				
				$TpAcaoLog = "I";
				$sql2 = "INSERT INTO tbproprietario (IdProprietario, NoProprietario, EdProprietario, NoBairro, NuCEP, NoCidade, SgUF, NoEmail, NuTelefones, DSHomePage) VALUES ($IdP, '$row[NoProprietario]', '$row[EdProprietario]', '$row[NoBairro]', '$row[NuCEP]', '$row[NoCidade]', '$row[SgUF]', '$row[NoEmail]', '$row[NuTelefones]',  '$row[DSHomePage]')";
				$NoTabelaLog = "TBProprietario";
				$DsAcaoLog = str_replace("'","|",$sql2);
				$DsAcaoLog = str_replace('"','',$DsAcaoLog);
				$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdP,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
				mysql_query($SqlAcaoLog,$Conn);
			}

			$sql3 = "DELETE FROM TBPROPRIETARIOTEMP WHERE IDProprietario = $row[IdProprietario]";
			$sql_result = mysql_query($sql3,$Conn);
							
			$sql3 = "UpDate tbcachorroexposicaotemp Set IDProprietario = $IdP Where IDProprietarioTemp = $row[IdProprietario]";
			$sql_result = mysql_query($sql3,$Conn);
		}


	
		$sqlAtualizarProprietario = "Select * From tbcachorroexposicaotemp where IDExposicao = $IDExposicao";
				
		$sql_resulttp2 = mysql_query($sqlAtualizarProprietario,$Conn);
		while ($row = mysql_fetch_array($sql_resulttp2))
		{		
			$sqlAp = "update tbcachorro Set IdProprietario = $row[IDProprietario] where IDCachorro = $row[IDCachorro];";
			$sql_resultsssss = mysql_query($sqlAp,$Conn);	
		}


	/*
	//CADASTRAR OS CACHORROS TEMPORÁRIOS
		$sqll = "SELECT * FROM TBCACHORROEXPOSICAOTEMP WHERE IDCACHORRO>0 AND IDEXPOSICAO=$IDExposicao";
		$sql_resultt1 = mysql_query($sqll,$Conn);
		while ($row = mysql_fetch_array($sql_resultt1))
		{
			$sql3 = "UpDate tbcachorro Set IDProprietario = $row[IdProprietario] Where IDCachorro = $row[IDCachorro]";
			$sql_result = mysql_query($sql3,$Conn);
		}
	*/

	//CADASTRAR OS CACHORROS TEMPORÁRIOS
		$sqll = "SELECT * FROM TBCACHORROEXPOSICAOTEMP WHERE IDCACHORRO=0 AND IDEXPOSICAO=$IDExposicao";
		$sql_resultt1 = mysql_query($sqll,$Conn);
		while ($row = mysql_fetch_array($sql_resultt1))
		{
			$sql2 = "INSERT INTO tbcachorro (NoCachorro,DaNascimento,NuRegistroNacional,TPSexo,NoTatuagem,IdRaioX,IdSelecao,IdCachorroPai,IdCachorroMae,IdProprietario) values ('$row[NOCachorro]', '$row[DTNascimento]', '$row[NuRegistroNacional]', '$row[TPSexo]', '$row[NoTatuagem]', $row[IdRaioX], $row[IdSelecao], $row[IDCachorroPai], $row[IDCachorroMae], $row[IDProprietario])";
			$sql_result = mysql_query($sql2,$Conn);
			$NovoIDCachorro = mysql_insert_id();
			
			$TpAcaoLog = "I";
			$IdRegistroLog = $NovoIDCachorro;
			$sql2 = "INSERT INTO tbcachorro (IDCachorro,NoCachorro,DaNascimento,NuRegistroNacional,TPSexo,NoTatuagem,IdRaioX,IdSelecao,IdCachorroPai,IdCachorroMae,IdProprietario) values ($NovoIDCachorro, '$row[NOCachorro]', '$row[DTNascimento]', '$row[NuRegistroNacional]', '$row[TPSexo]', '$row[NoTatuagem]', $row[IdRaioX], $row[IdSelecao], $row[IDCachorroPai], $row[IDCachorroMae], $row[IDProprietario])";
			$NoTabelaLog = "TBCachorro";
			$DsAcaoLog = str_replace("'","|",$sql2);
			$DsAcaoLog = str_replace('"','',$DsAcaoLog);
			$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
			mysql_query($SqlAcaoLog,$Conn);
			
			$sql3 = "UpDate tbcachorroexposicaotemp Set IDCachorro = $NovoIDCachorro Where IDCachorroExposicao = $row[IDCachorroExposicao]";
			$sql_result = mysql_query($sql3,$Conn);
		}
	
	//CADASTRAR A EXPOSIÇÃO
		$sqll = "SELECT * FROM TBEXPOSICAOTEMP WHERE IDEXPOSICAO=$IDExposicao";
		$sql_resultt2 = mysql_query($sqll,$Conn);
		while ($row = mysql_fetch_array($sql_resultt2))
		{
			$sql2 = "INSERT INTO TBEXPOSICAO (IdClube, NoExposicao, EdExposicao, NoCidade, SgUF, DTInicio, DTTermino, NoJuizes, InCINENacional, InPontosDobrado) values ($row[IdClube], '$row[NoExposicao]', '$row[EdExposicao]', '$row[NoCidade]', '$row[SgUF]', '$row[DTInicio]', '$row[DTTermino]', '$row[NoJuizes]', $row[InCINENacional], $row[InPontosDobrado])";
			$sql_result = mysql_query($sql2,$Conn);
			$NovoIDExposicao = mysql_insert_id();
			
			$TpAcaoLog = "I";
			$sql2 = "INSERT INTO TBEXPOSICAO (IDExposicao, IdClube, NoExposicao, EdExposicao, NoCidade, SgUF, DTInicio, DTTermino, NoJuizes, InCINENacional, InPontosDobrado) values ($NovoIDExposicao, $row[IdClube], '$row[NoExposicao]', '$row[EdExposicao]', '$row[NoCidade]', '$row[SgUF]', '$row[DTInicio]', '$row[DTTermino]', '$row[NoJuizes]', $row[InCINENacional], $row[InPontosDobrado])";
			$NoTabelaLog = "TBExposicao";
			$DsAcaoLog = str_replace("'","|",$sql2);
			$DsAcaoLog = str_replace('"','',$DsAcaoLog);
			$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$NovoIDExposicao,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
			$sql_result = mysql_query($SqlAcaoLog,$Conn);
			
			$sql3 = "UpDate tbcachorroexposicaotemp Set IDExposicao = $NovoIDExposicao Where IDExposicao = $IDExposicao";
			$sql_result = mysql_query($sql3,$Conn);
		}
		
	//CADASTRAR O RESULTADO EXPOSIÇÃO 
		$sqll = "SELECT * FROM tbcachorroexposicaotemp WHERE IDEXPOSICAO=$NovoIDExposicao";
		//echo($sqll);
		$sql_resultt3 = mysql_query($sqll,$Conn);
		while ($row = mysql_fetch_array($sql_resultt3))
		{
			$sql2 = "INSERT INTO tbexposicaoresultado (IdExposicao, IDCachorro, InCategoria, InClassificacao, InQualificacao) values ($row[IDExposicao], $row[IDCachorro], $row[IDCategoria], $row[IDClassificacao], $row[IDQualificacaoCao])";
			mysql_query($sql2,$Conn);
			
			//echo("$sql2 <br>");
			
			
			$TpAcaoLog = "I";
			$IdRegistroLog = $row["IDExposicao"];
			$NoTabelaLog = "TBExposicaoRes";
			$DsAcaoLog = str_replace("'","|",$sql2);
			$DsAcaoLog = str_replace('"','',$DsAcaoLog);
			$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$NovoIDExposicao,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
			mysql_query($SqlAcaoLog,$Conn);
		}
		//die();

?>
<form name="f" action="<?=$link?>" method="post">
	<input type="hidden" name="IDExposicao" value="<?echo("$IDExposicao");?>">
	<input type="hidden" name="IDProprietarios" value="<?echo("$IDProprietarios");?>">
</form>
<Script>
	document.f.submit();
</Script>
