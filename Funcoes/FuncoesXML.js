function CarregarXml(XmlId,pagina)
{
	var IlhaJs = eval("document.getElementById('"+ XmlId +"')")
	IlhaJs.async = false;
	IlhaJs.src = pagina;
}

function MontarTabela(XmlId,path)
{
	var IlhaJs = eval("document.getElementById('"+ XmlId +"')");
	IlhaJs.setAttribute("SelectionLanguage", "XPath");
	console.log(IlhaJs);
	console.log(path);
	console.log(IlhaJs.documentElement.selectNodes(path));
	var Tb = new Enumerator(IlhaJs.documentElement.selectNodes(path));
	return Tb;
}


function LerAtributo(TbXml,Campo)
{
	return TbXml.item().Attributes.getNamedItem(Campo).text;
}

function CriarOption(ObjForm,id,valorId,valorNo)
{
	ObjForm.options[id] = new Option(valorNo,valorId);
}

function ExcluirOption(ObjForm,OptionInicial)
{
	if (ObjForm.length != 0)
	{
		ObjForm.options[OptionInicial] = null;
		var nQtde = OptionInicial ++;
		ExcluirOption(ObjForm,nQtde)
	}
}

function MontarSelect(ObjForm,TbXml,Valor,Legenda,Option1)
{
	var i=0;
	ExcluirOption(ObjForm,0);

	if (Option1 != ''){
		CriarOption(ObjForm,i,'',Option1);
		i++;}

	do{
		ValorJs = LerAtributo(TbXml,Valor);
		NomeJs = LerAtributo(TbXml,Legenda);					
		CriarOption(ObjForm,i,ValorJs,NomeJs);
		i++
		TbXml.moveNext();
	}while(!TbXml.atEnd());
}