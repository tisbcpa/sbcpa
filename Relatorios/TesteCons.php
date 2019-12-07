<html>
<title>Teste</title>
<script language="JavaScript" src="../Funcoes/FuncoesXML.js"></script>
<script>
var ArrayVisto = new Array(31);

function VarrerArray(vl)
{
	var retorno = false;
	
	for(var i=0; i<31; i++)
	{
		if (ArrayVisto[i] == vl)	
		{
			retorno = true;
		}
	}
	
	return retorno;
}
	
function VerificarConsaguinidade()
{
	var Taxa = "";
	var Pagina = 'DadosCaesXML.php?IdPai=27330&IdMae=26775';
	CarregarXml('IlhaXml',Pagina);
	Path = "/ROOT/row";
	TBRetorno = MontarTabela('IlhaXml',Path);
	c = 0;

	for (i=0;!TBRetorno.atEnd();TBRetorno.moveNext())
	{
		jNome = LerAtributo(TBRetorno,"Nome");
		jId = LerAtributo(TBRetorno,"Id");
		jTipo = LerAtributo(TBRetorno,"Tipo");
		jGrau = LerAtributo(TBRetorno,"Grau");				
		//Msg.innerHTML = Msg.innerHTML +"**"+ jId +"-"+ jNome + '<br>';
		
		Path = "/ROOT/row[@Nome = '"+ jNome +"']";
		TBRetorno2 = MontarTabela('IlhaXml',Path);

		for (i=0;!TBRetorno2.atEnd();TBRetorno2.moveNext())
		{
			jNome2 = LerAtributo(TBRetorno2,"Nome");
			jId2 = LerAtributo(TBRetorno2,"Id");
			jTipo2 = LerAtributo(TBRetorno2,"Tipo");
			jGrau2 = LerAtributo(TBRetorno2,"Grau");				

			if ((jId != jId2) && (!VarrerArray(jId)))
			{
				ArrayVisto[c] = jId2;
				c++;
				
				if (jTipo == jTipo2)
				{Taxa = Taxa + jNome + " " + jGrau +","+ jGrau2 +"; ";}
				
				if (jTipo != jTipo2)
				{Taxa = Taxa + jNome + " " + jGrau +"/"+ jGrau2 +"; ";}
			}
		}
	}

	Taxa = Taxa.substr(0,Taxa.length-2);
	Msg.innerHTML = Taxa;
}
</script>

<body>
<xml id="IlhaXml"></xml>

<div id="Msg"></div>
</body>

<script>VerificarConsaguinidade()</script>
</html>