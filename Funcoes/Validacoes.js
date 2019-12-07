var tentativas = 0;

function ValidarCamposGlobal(ArrayCampos,ArrayMsg)
{
	var msg = "Para realizar essa operação você deve:\n";
	var primeiro = 0;

	if (tentativas > 0)
	{
		msg = "Para realizar essa operação AINDA falta:\n";
	}
	var nmsg = msg;

	for(var i=1; i<ArrayCampos.length; i++)
	{
		if (ArrayCampos[i].value == "")
		{
			msg	= msg + ArrayMsg[i];
			if (primeiro == 0)
			{primeiro = i;}
		}
	}
	
	if (msg != nmsg)
	{
		alert(msg);
		if ((ArrayCampos[primeiro].type != 'hidden') && (ArrayCampos[primeiro].disabled != true) && (ArrayCampos[primeiro].readonly != true))
		{
			ArrayCampos[primeiro].focus();
		}
		tentativas++;
		return false;
	}
	else
	{
		return true;
	}
}


function FormatarData(obj)
{
	tam = obj.value.length;
	if (tam == 2){obj.value = obj.value.substr(0,2) + '/';}
	if (tam == 5){obj.value = obj.value.substr(0,5) + '/';}
}


