<? 
$menu = false;
require("Estilo/Estilo.php");?>
<? require("Funcoes/Exposicoes.php");?>
<? require("Funcoes/Cachorro.php");?>

<?
		$IdExposicao = 0;
		$IdCategoria = 0;
		$IDCachorro = 0;
		$IdQualificacaoCao  = 0;
		$InQualificacao = 0;
		$IdClassificacao  = 0;
		
		if (isset($_GET["IdExposicao"]))
		{
			$IdExposicao = $_GET["IdExposicao"];
			$IDCachorro = $_GET["IdCachorro"];
			$InCategoria  = $_GET["InCategoria"];
			

			$sql = "select * from tbexposicaoresultado Where IdExposicao = $IdExposicao and IDCachorro = $IDCachorro and InCategoria = $InCategoria";
			$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
			while ($row = mysql_fetch_array($sql_result))
			{
				$IdExposicao = $row["IdExposicao"];
				$IdCategoria  = $row["InCategoria"];
				$IDCachorro = $row["IDCachorro"];
				$IdClassificacao  = $row["InClassificacao"];
				$IdQualificacaoCao = $row["InQualificacao"];
			}
			mysql_close($Conn);
		}
	
		if (isset($_POST["IdExposicao"]))
		{
			
			$IDCategoriaPK = $_POST["IDCategoriaPK"];
			$IdExposicao = $_POST["IdExposicao"];
			$IDCachorro = $_POST["IDCachorro"];
			$InCategoria = $_POST["IdCategoria"];
			$InClassificacao  = $_POST["IdClassificacao"];
			$IdQualificacao = $_POST["IdQualificacaoCao"];
			$NrPonto = 0;//$_POST["NrPontos"];
			
			AlterarResultadoExposicao($IdExposicao,$IDCachorro,$InCategoria,$InClassificacao,$IdQualificacao,$NrPonto,$IDCategoriaPK);
			
			?>
			<script>
			function Atualizar()
			{		
				opener.location.href = "Exposicoes_ListarCachorros.php?Id=<?echo($IdExposicao);?>";
			}
	
			function Fechar()
			{
				window.close();
			}
			setTimeout(Atualizar,100);
			setTimeout(Fechar,200);
			</script>
	
			<?
		}
	
?>

<head>
<script>
function AbrirPopUp(obj)
{
	window.open('ConsultarPreenchimento_Corpo.php?Obj='+obj,'Pesquisar','width=500, height=260');
}

</script>
<title>Cadastrar Filhotes</title></head>


<body>
<Form name="Formulario" method="post">
<input type="hidden" name="IdExposicao" value="<?echo($IdExposicao);?>">


  <table>
    <tr> 
      <td><h3>Resultado Individual na Exposi&ccedil;&atilde;o</h3></td>
    </tr>
    <tr> 
      <td>

	  </legend>
	  	<input type="hidden" name="IDCategoriaPK">
		<input type="hidden" name="IDCachorro" value="<?echo($IDCachorro);?>">
        <table class="SemBorda">
          <tr> 
            <td width="80">Categoria</td>
            <td width="177"><? echo(MontarCombo("Categoria",250))?> </td>
          </tr>
        </table>
        <table class="SemBorda">
          <tr> 
            <td width="80">Qualifica&ccedil;&atilde;o</td>
            <td width="178"><? echo(MontarCombo("QualificacaoCao",250))?> </td>
          </tr>
        </table>

        <table width="383" class="SemBorda">
          <tr> 
            <td width="80">Classifica&ccedil;&atilde;o</td>
            <td width="128"><select name="IdClassificacao">
                <option></option>
				<?
					for ($i=0; $i<=100; $i++)
					{
						echo("<option value='". $i ."'>". $i ."</option>");
					}			
				?>
              </select>
            </td>
          </tr>
        </table>

        <br>
  </td>
    </tr>
    <tr> 
      <td> <div align="center"><br>
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <input type="reset" value="Limpar Dados">
        </div></td>
    </tr>
  </table>
</Form>

<script>
	document.Formulario.IDCategoriaPK.value = <?echo($IdCategoria)?>;
	document.Formulario.IdCategoria.value = <?echo($IdCategoria)?>;
	document.Formulario.IdClassificacao.value = <?echo($IdClassificacao)?>;
	document.Formulario.IdQualificacaoCao.value = <?echo($IdQualificacaoCao)?>;
</script>


</body>
</html>
