<? 
require("Estilo/Estilo.php");
require("Funcoes/Ninhada.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["Id"];
		$DtNascimento = $_POST["DaNascimento"];
		$IdCanil = $_POST["IDCanil"];
		$NrMachos = $_POST["NrMachos"];
		$NrMachosVivos = $_POST["NrMachosVivos"];
		$NrFemeas = $_POST["NrFemeas"];
		$NrFemeasVivas = $_POST["NrFemeasVivas"];
		
		$TxConsaguinidade = $_POST["TxConsaguinidade"];
		$TxConsaguinidade = str_replace(",", "|", $TxConsaguinidade);
		
		$IDPai = $_POST["IDPai"];
		$IDMae = $_POST["IDMae"];
		$IDClube = $_POST["idClube"];
		
		$c = 1;
		do{
			$PId = "Id" . $c;
			$PNrSBCPA = "NrSBCPA" . $c;
			$PNoCachorro = "NoCachorro" . $c;
			$PTPSexo = "TPSexo" . $c;
			$PNrCBKC = "NrCBKC" . $c;
			$PNoTatuagem = "NoTatuagem" . $c;
			$PIdCor = "IdCor"  . $c;
			
			$IdCachorroV[$c] = $_POST[$PId];
			$NrSBCPA[$c] = $_POST[$PNrSBCPA];
			$NoCachorro[$c] = $_POST[$PNoCachorro];
			$TPSexo[$c] = $_POST[$PTPSexo];
			$NrCBKC[$c] = $_POST[$PNrCBKC];
			$NoTatuagem[$c] = $_POST[$PNoTatuagem];
			$IdCor[$c] = $_POST[$PIdCor];
					
			$c = $c + 1;
			$PNrSBCPA = "NrSBCPA" . $c;
			
		}while(isset($_POST[$PNrSBCPA]));
		
		/*
		$NNrSBCPA = "";
		$NNoCachorro = "";
		$NTPSexo = "";
		$NNrCBKC = "";
		$NNoTatuagem  = "";
		$NIdCor = "";
		*/
		$Filhotes = "";
		
		for ($i=1; $i<$c; $i++)
		{
			if ($NrSBCPA[$i] != "")
			{
				/*
				$NNrSBCPA = $NNrSBCPA . '|' . $NrSBCPA[$i];
				$NNoCachorro = $NNoCachorro . '|' . $NoCachorro[$i];
				$NTPSexo = $NTPSexo . '|' . $TPSexo[$i];
				$NNrCBKC = $NNrCBKC . '|' . $NrCBKC[$i];
				$NNoTatuagem = $NNoTatuagem . '|' . $NoTatuagem[$i];
				$NIdCor = $NIdCor . '|' . $IdCor[$i];
				*/
			
				$Filhotes = $Filhotes .";". "$NrSBCPA[$i]|$NoCachorro[$i]|$TPSexo[$i]|$NrCBKC[$i]|$NoTatuagem[$i]|$IdCor[$i]|$IdCachorroV[$i]";
			}
		}
		
		//die("$NNrSBCPA<br>$NNoCachorro<br>$NTPSexo<br>$NNrCBKC<br>$NNoTatuagem<br>$NIdCor");
		//die($Filhotes);
				
		/*		
		$NoCachorro = $_POST["NoCachorro"];
		$TPSexo = $_POST["TPSexo"];
		$NrCBKC = $_POST["NrCBKC"];
		$NoTatuagem = $_POST["NoTatuagem"];
		$IdCor = $_POST["IdCor"];
		
		die("-$NrSBCPA<br>-$NoCachorro<br>-$TPSexo<br>-$NrCBKC<br>-$NoTatuagem<br>-$IdCor");
		die("$Id, $DtNascimento, $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae");
		*/
		
		
		//$NumeroNinhada = 1;
		//$NumeroNinhada = $NumeroNinhada + RecuperarUltimaNinhada();
	
		if ($Action != "U")
		{CadastrarNinhadaEstrangeira($DtNascimento, $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae, $Filhotes, $IDClube);}
		else
		{AlterarNinhadaEstrangeira($Id, $DtNascimento, $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae, $Filhotes, $IDClube);}
	}
	else
	{
		$IdCanil = $_GET["Id"];
		ExcluirCanilIdCanil($IdCanil);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Ninhada_Listar.php';}


Redirect()
//setTimeout('Redirect()',2000);
</Script>
