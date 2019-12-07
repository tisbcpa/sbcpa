<? 
$menu = false;
require("Estilo/Estilo.php");?>
<? require("Funcoes/Exposicoes.php");?>
<? require("Funcoes/Cachorro.php");?>

<?
	if (isset($_POST["IdExposicao"]))
	{
		$IdExposicao = $_POST["IdExposicao"];
		$IDCachorro = $_POST["IDCachorro"];
		$InCategoria = $_POST["IdCategoria"];
		$InClassificacao = $_POST["InClassificacao"];
		$InQualificacao = $_POST["IdQualificacaoCao"];
		$NrPonto = $_POST["NrPontos"];
		
		CadastrarResultadoExposicao($IdExposicao,$IDCachorro,$InCategoria,$InClassificacao,$InQualificacao,$NrPonto);

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
		die();
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
<input type="hidden" name="IdExposicao">


  <table>
    <tr> 
      <td><h3>Resultado Individual na Exposi&ccedil;&atilde;o</h3></td>
    </tr>
    <tr> 
      <td>

	  </legend>
        <table class="SemBorda">
          <tr> 
            <td width="80">Cachorro</td>
			<input type="hidden" name="IDCachorro">
            <td width="384"><input name="NoCachorro" type="text" id="NuRegistroNacional" size="55"> <a href="javascript: AbrirPopUp('Cachorro')"><img src="Imagens/Escolher.gif" border="0"></a>
            </td>
          </tr>
        </table>
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
            <td width="128"><select name="InClassificacao">
                <option></option>
				<?
					for ($i=0; $i<=100; $i++)
					{
						echo("<option value='". $i ."'>". $i ."</option>");
					}			
				?>
              </select>
            </td>
            <td width="65"><div align="right">Ponto</div></td>
            <td width="90"><select name="NrPontos">
                <?
					for ($i=0; $i<=300; $i++)
					{
						echo("<option value='". $i ."'>". $i ."</option>");
					}			
				?>
              </select> </td>
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
	document.Formulario.IdExposicao.value = opener.parent.Formulario.IdExposicao.value;
</script>


</body>
</html>
