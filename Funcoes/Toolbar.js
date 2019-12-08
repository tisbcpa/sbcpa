var StyleStr = "";
var ToolBar_Supported = false;
var Frame_Supported   = false;
var DoInstrumentation = false;
var JLarguraMenus = 160;

//alert(navigator.userAgent);
// if (navigator.userAgent.indexOf("MSIE")    != -1 && 
// 	navigator.userAgent.indexOf("Windows") != -1 && 
// 	navigator.appVersion.substring(0,1) > 3)
//{
	ToolBar_Supported = true;
	StyleStr =	"<STYLE type='text/css'>" +
				".MSMenu			{ font-size:11;font-family:Tahoma,Tahoma;text-decoration:none;cursor:hand;}" +
				".ICPMenu			{ font-weight:bold;font-size:11;font-family:Tahoma,Tahoma;text-decoration:none;cursor:hand;}" +
				".ICPMenu:hover			{ font-weight:bold;font-size:11;font-family:Tahoma,Tahoma;text-decoration:none;cursor:hand;}" +
				"</STYLE>";
//}

if (ToolBar_Supported)
{
	var newLineChar = String.fromCharCode(10);
	var char34 = String.fromCharCode(34);
	var LockICPMenu = false;
	var LastMSMenu = "";
	var CurICPMenu = "";
	var IsMenuDropDown = true;
	var HTMLStr;
	var x = 0;
	var y = 0;
	var x2 = 0;
	var y2 = 0;
	var MSMenuWidth;
	var ToolbarMinWidth;
	var ToolbarMenu;
	var ToolbarBGColor;
	var ToolbarLoaded = false;
	var aDefMSColor  = new Array(3);
	var aDefICPColor = new Array(3);
	var aCurMSColor  = new Array(3);
	var aCurICPColor = new Array(3);
	var MSFont;
	var ICPFont;
	var MaxMenu = 30;
	var TotalMenu = 0;
	var arrMenuInfo = new Array(30);

	// Output style sheet and toolbar ID
	document.write(StyleStr);
	document.write("<SPAN ID='StartMenu' STYLE='border:0px solid red;display:none;'></SPAN>");

	// Build toolbar template
	HTMLStr = 
		"<DIV ID='idToolbar'     STYLE='border:0px solid red; background-color:white;width:100%'>" +
		"<DIV ID='idRow1'        STYLE='border:0px solid red;position:relative;height:0;left:10;'>" +
		"<DIV ID='idICPBanner'   STYLE='border:0px solid red;position:absolute;top:0;left:0;height:0;width:250;overflow:hidden;vertical-align:top;'><!--BEG_ICP_BANNER--><!--END_ICP_BANNER--></DIV>" +
		"</DIV>" +
		"<DIV ID='idRow2'        STYLE='border:0px solid red;position:relative;left:0;height:0;'>" +
		"<DIV ID='idADSBanner'   STYLE='border:0px solid red;position:absolute;top:0;left:10;height:40;width:200;vertical-align:top;overflow:hidden;'><!--BEG_ADS_BANNER--><!--END_ADS_BANNER--></DIV>" +
		"<DIV ID='idMSCBanner'   STYLE='border:0px solid red;position:absolute;top:0;left:10;height:40;width:112;vertical-align:top;overflow:hidden;' ALIGN=RIGHT><!--BEG_MSC_BANNER--><!--END_MSC_BANNER--></DIV>" +
		"</DIV>" +
		"<DIV ID='idRow3'        STYLE='border:0x solid red;position:absolute;height:10;left:0;width:100%'>" +
		"<DIV ID='idICPMenuPane' CLASS='ICPMenuPane' STYLE='border:0px solid red;position:absolute;top:-15;left:10;width:710;height:0;background-color:black;' NOWRAP><!--ICP_MENU_TITLES--></DIV>" + 
		"</DIV>" +
		"</DIV>" +
		"<SCRIPT TYPE='text/javascript'>" + 
		"   var ToolbarMenu = StartMenu;" + 
		"</SCRIPT>" + 
		"<DIV WIDTH=100% style='border:0px solid red;'>";

	// Define event handlers
	window.onresize  = resizeToolbar;
	document.onmouseover = hideMenu;

	// Intialize global variables
	ToolbarBGColor	= "white";						// toolbar background color
	
	aDefMSColor[0]	= aCurMSColor[0]  = "black";	// bgcolor;
	aDefMSColor[1]	= aCurMSColor[1]  = "white";	// text font color
	aDefMSColor[2]  = aCurMSColor[2]  = "red";		// mouseover font color
	
	aDefICPColor[0]	= aCurICPColor[0] = "#6699CC";	// bgcolor;
	aDefICPColor[1] = aCurICPColor[1] = "white";	// text font color
	aDefICPColor[2] = aCurICPColor[2] = "red";		// mouseover font color
}

// The hard-coded numbers in functions - drawToolbar() & resizeToolbar()
// correspond to the dimension of the four gif files:
//		ICP_BANNER: 60h x 250w
//		ADS_BANNER: 40h x 200w
//		MSC_BANNER: 40h x 112w
//		Curve:	    20h x 18w

function drawToolbar()
{
	HTMLStr += "</DIV>";
	document.write(HTMLStr);
	ToolbarLoaded = true;

	idToolbar.style.backgroundColor     = ToolbarBGColor;
	idICPMenuPane.style.backgroundColor = aDefICPColor[0];
	resizeToolbar();
}

function resizeToolbar()
{
//	if (ToolBar_Supported == false) return;

//	w = Math.max(ToolbarMinWidth, document.body.clientWidth) - ToolbarMinWidth;
	
//	idMSMenuCurve.style.left  = (250+w);
//	idMSMenuPane.style.left   = (250+w+18);
//	idMSMenuPane.style.width  = MSMenuWidth;

//	idADSBanner.style.left    = (w+18);

//	idMSCBanner.style.left    = (w+18+200);
//	idMSCBanner.style.width   = (MSMenuWidth - 200);
	
//	idICPMenuPane.style.width = ToolbarMinWidth + w;
}

function setToolbarBGColor(color)
{	
	ToolbarBGColor = color;
	if (ToolbarLoaded == true)
		idToolbar.style.backgroundColor = ToolbarBGColor;
}	

function setDefaultMSMenuColor(bgColor, fontColor, mouseoverColor)
{	
	if (bgColor   != "")	  aDefMSColor[0] = bgColor;
	if (fontColor != "")	  aDefMSColor[1] = fontColor;
	if (mouseoverColor != "") aDefMSColor[2] = mouseoverColor;
}

function setDefaultICPMenuColor(bgColor, fontColor, mouseoverColor)
{	
	if (bgColor   != "")	  aDefICPColor[0] = bgColor;
	if (fontColor != "")	  aDefICPColor[1] = fontColor;
	if (mouseoverColor != "") aDefICPColor[2] = mouseoverColor;
}

function setICPMenuColor(MenuIDStr, bgColor, fontColor, mouseoverColor)
{	
	if (ToolbarLoaded == false) return;

	// Reset previous ICP Menu color if any
	if (CurICPMenu != "")
	{
		PrevID = CurICPMenu.substring(4);
		CurICPMenu = "";
		setICPMenuColor(PrevID, aDefICPColor[0], aDefICPColor[1], aDefICPColor[2]);
	}

	var	id = "AM_" + "ICP_" + MenuIDStr;
	var thisMenu = document.all(id);
	if (thisMenu != null)
	{
		CurICPMenu = "ICP_" + MenuIDStr;
		aCurICPColor[0] = bgColor;
		aCurICPColor[1] = fontColor;
		aCurICPColor[2] = mouseoverColor;

		// Change menu color
		if (bgColor != "")
			thisMenu.style.backgroundColor = bgColor;
		if (fontColor != "")
			thisMenu.style.color = fontColor;

		// Change subMenu color
		id = "ICP_" + MenuIDStr;
		thisMenu = document.all(id);
		if (thisMenu != null)
		{
			if (bgColor != "")
				thisMenu.style.backgroundColor = bgColor;
			
			if (fontColor != "")
			{
				i = 0;
				id = "AS_" + "ICP_" + MenuIDStr;
				thisMenu = document.all.item(id,i);
				while (thisMenu != null)
				{
					thisMenu.style.color = fontColor;
					i += 1;
					thisMenu = document.all.item(id,i);
				}
			}
		}
	}
}

/**** Banner functions ****
 ****/
function setAds(Gif,Url,AltStr)
{	setBanner(Gif,Url,AltStr,"<!--BEG_ADS_BANNER-->","<!--END_ADS_BANNER-->");
}

function setICPBanner(Gif,Url,AltStr)
{	setBanner(Gif,Url,AltStr,"<!--BEG_ICP_BANNER-->","<!--END_ICP_BANNER-->");
}

function setMSBanner(Gif,Url,AltStr)
{	tempGif = "images/" + Gif;
	setBanner(tempGif,Url,AltStr,"<!--BEG_MSC_BANNER-->","<!--END_MSC_BANNER-->");
}

function setBanner(BanGif, BanUrl, BanAltStr, BanBegTag, BanEndTag)
{
	begPos = HTMLStr.indexOf(BanBegTag);
	endPos = HTMLStr.indexOf(BanEndTag) + BanEndTag.length;
	
	SubStr = HTMLStr.substring(begPos, endPos);
	SrcStr = "";
	if (BanUrl != "")
		SrcStr += "<A Target='_self' HREF='" + formatURL(BanUrl, BanGif) + "'>";
	SrcStr += "<IMG SRC='" + BanGif + "' ALT='" + BanAltStr + "' BORDER=0>";
	if (BanUrl != "")
		SrcStr += "</A>";
	SrcStr = BanBegTag + SrcStr + BanEndTag;
	HTMLStr = HTMLStr.replace(SubStr, SrcStr);	
}

/**** Add Menu Function ***
 ****/
function addICPMenu(MenuIDStr, MenuDisplayStr, MenuHelpStr, MenuURLStr)
{ 	
	if (LockICPMenu == true) return;

	if (addICPMenu.arguments.length > 4)
		TargetStr = addICPMenu.arguments[4];
	else
		TargetStr = "_self";
	tempID = "ICP_" + MenuIDStr;
	addMenu(tempID, MenuDisplayStr, MenuHelpStr, MenuURLStr, TargetStr, true); 
}

function addMSMenu(MenuIDStr, MenuDisplayStr, MenuHelpStr, MenuURLStr)
{	
	if (LockICPMenu == true) return;
	TargetStr = "_self";
	tempID = "MS_" + MenuIDStr;
	addMenu(tempID, MenuDisplayStr, MenuHelpStr, MenuURLStr, TargetStr, false); 
	LastMSMenu = tempID;
}

function addMenu(MenuIDStr, MenuDisplayStr, MenuHelpStr, MenuURLStr, TargetStr, bICPMenu)
{
	cStyle  = bICPMenu? "ICPMenu"        : "MSMenu";
	cColor0 = bICPMenu? aDefICPColor[0] : aDefMSColor[0];
	cColor1 = bICPMenu? aDefICPColor[1] : aDefMSColor[1];
	cColor2 = bICPMenu? aDefICPColor[2] : aDefMSColor[2];
	tagStr  = bICPMenu? "<!--ICP_MENU_TITLES-->" : "<!--MS_MENU_TITLES-->";

	MenuStr = newLineChar;
	if (bICPMenu == false && LastMSMenu != "")
		MenuStr += "<SPAN CLASS='" + cStyle + "' STYLE='color:" + cColor1 + "'>|</SPAN>"; 
	MenuStr += "<A TARGET='" + TargetStr + "' TITLE='" + MenuHelpStr + "'" +
			   "   ID='AM_" + MenuIDStr + "'" +
			   "   CLASS='" + cStyle + "'" +
			   "   STYLE='background-color:" + cColor0 + ";color:" + cColor1 + ";'";
	if (MenuURLStr != "")
	{
		if (bICPMenu)
			MenuStr += " HREF='" + formatURL(MenuURLStr, ("ICP_" + MenuDisplayStr)) + "'";
		else
			MenuStr += " HREF='" + formatURL(MenuURLStr, ("MS_" + MenuDisplayStr)) + "'";
	}
	MenuStr += 	" onmouseout="  + char34 + "mouseMenu('out' ,'" + MenuIDStr + "');" + char34 + 
				" onmouseover=" + char34 + "mouseMenu('over','" + MenuIDStr + "'); doMenu('"+ MenuIDStr + "');" + char34 + ">" +
				"&nbsp;" + MenuDisplayStr + "&nbsp;</a>";
	if (bICPMenu)
		MenuStr += "<SPAN CLASS='" + cStyle + "' STYLE='color:" + cColor1 + "'>|</SPAN>";
	MenuStr += tagStr;
	
	HTMLStr = HTMLStr.replace(tagStr, MenuStr);	
}

/**** Add SubMenu Function ****
 ****/
function addICPSubMenu(MenuIDStr, SubMenuStr, SubMenuURLStr)
{	
	if (addICPSubMenu.arguments.length > 3)
		TargetStr = addICPSubMenu.arguments[3];
	else
		TargetStr = "_self";
	tempID = "ICP_" + MenuIDStr;
	addSubMenu(tempID,SubMenuStr,SubMenuURLStr,TargetStr,true); 
}

function addSubMenu(MenuIDStr, SubMenuStr, SubMenuURLStr, TargetStr, bICPMenu)
{
	cStyle  = bICPMenu? "ICPMenu"       : "MSMenu";
	cColor0 = bICPMenu? aDefICPColor[0] : aDefMSColor[0];
	cColor1 = bICPMenu? aDefICPColor[1] : aDefMSColor[1];
	cColor2 = bICPMenu? aDefICPColor[2] : aDefMSColor[2];
	
	var MenuPos = MenuIDStr.toUpperCase().indexOf("MENU");
	if (MenuPos == -1) { MenuPos = MenuIDStr.length; }
	InstrumentStr = MenuIDStr.substring(0 , MenuPos) + "|" + SubMenuStr;;
	URLStr        = formatURL(SubMenuURLStr, InstrumentStr);

	var LookUpTag  = "<!--" + MenuIDStr + "-->";
	var sPos = HTMLStr.indexOf(LookUpTag);
	if (sPos <= 0)
	{

		HTMLStr += newLineChar + newLineChar +
				"<SPAN ID='" + MenuIDStr + "'" +
				" STYLE='border:0px solid blue;display:none;position:absolute;width:190;background-color:" + cColor0 + ";padding-top:0;padding-left:0;padding-bottom:15;z-index:9;'" +
				" onmouseover='keepMenu();'>";
				//AQUI NA LINHA ACIMA NA TAG WIDTH FICA O TAMANHO DA CÉLULA ONDE FICAM OS SUB MENUS.
		if (Frame_Supported == false || bICPMenu == false)
		{
			HTMLStr +=
				"<HR  STYLE='position:absolute;left:0;top:0;color:" + cColor1 + "' SIZE=1>";
		}
		HTMLStr +=
				"<DIV STYLE='position:relative;left:0;top:8;border:0px solid red;'>" +
				"<A ID='AS_" + MenuIDStr + "'" +
				"   CLASS='" + cStyle + "'" + 
				"   STYLE='color:" + cColor1 + "'" +
				"   HREF='" + URLStr + "' TARGET='" + TargetStr + "'" +
				" onmouseout="  + char34 + "mouseMenu('out' ,'" + MenuIDStr + "');" + char34 + 
				" onmouseover=" + char34 + "mouseMenu('over','" + MenuIDStr + "');" + char34 + ">" +
				"&nbsp;" + SubMenuStr + "</A><BR>" + LookUpTag +
				"</DIV>" +
				"</SPAN>";
	}
	else
	{
		TempStr = newLineChar +
				"<A ID='AS_" + MenuIDStr + "'" +
				"   CLASS='" + cStyle + "'" + 
				"   STYLE='color:" + cColor1 + "'" +
				"   HREF='" + URLStr + "' TARGET='" + TargetStr + "'" +
				" onmouseout="  + char34 + "mouseMenu('out' ,'" + MenuIDStr + "');" + char34 + 
				" onmouseover=" + char34 + "mouseMenu('over','" + MenuIDStr + "');" + char34 + ">" +
				"&nbsp;" + SubMenuStr + "</A><BR>" + LookUpTag;
		HTMLStr = HTMLStr.replace(LookUpTag, TempStr);	
	}
}

/**** Add SubMenuLine Functions ****
 ****/
function addICPSubMenuLine(MenuIDStr)
{	
	tempID = "ICP_" + MenuIDStr;
	addSubMenuLine(tempID,true);
}

function addSubMenuLine(MenuIDStr, bICPMenu)
{
	var LookUpTag = "<!--" + MenuIDStr + "-->";
	var sPos = HTMLStr.indexOf(LookUpTag);
	if (sPos > 0)
	{
		cColor  = bICPMenu? aDefICPColor[1] : aDefMSColor[1];
		TempStr = newLineChar + "<HR STYLE='color:" + cColor + "' SIZE=1>" + LookUpTag;
		HTMLStr = HTMLStr.replace(LookUpTag, TempStr);
	}
}

/**** Event Functions ****
 ****/

// Change menu mouseover / mouseout color
function mouseMenu(id, MenuIDStr) 
{
	IsMSMenu   = (MenuIDStr.toUpperCase().indexOf("MS_") != -1);
	IsMouseout = (id.toUpperCase().indexOf("OUT") != -1);

	if (IsMouseout)
	{
		color = IsMSMenu? aDefMSColor[1] : aDefICPColor[1];
		if (MenuIDStr == CurICPMenu && aCurICPColor[1] != "") 
			color = aCurICPColor[1];
	}
	else
	{
		color = IsMSMenu? aDefMSColor[2] : aDefICPColor[2];
		if (MenuIDStr == CurICPMenu && aCurICPColor[2] != "") 
			color = aCurICPColor[2];
	}
	window.event.srcElement.style.color = color;
}

function doMenu(MenuIDStr) 
{
	var thisMenu = document.all(MenuIDStr);
	if (ToolbarMenu == null || thisMenu == null || thisMenu == ToolbarMenu) 
	{
		window.event.cancelBubble = true;
		return false;
	}

	// Reset dropdown menu
	window.event.cancelBubble = true;
	ToolbarMenu.style.display = "none";
	showElement("SELECT");
	showElement("OBJECT");
	ToolbarMenu = thisMenu;
	IsMSMenu = (MenuIDStr.toUpperCase().indexOf("MS_") != -1);

	// Set dropdown menu display position
	x  = window.event.srcElement.offsetLeft +
	 	 window.event.srcElement.offsetParent.offsetLeft;
	if (MenuIDStr == LastMSMenu)
	{
		x += (window.event.srcElement.offsetWidth - 60);
		x2 = x + 160;
	}
	else
	{
		x2 = x + window.event.srcElement.offsetWidth;
	}
	y  = (IsMSMenu)? 
		 (idRow1.offsetHeight) :
		 (idRow1.offsetHeight + idRow2.offsetHeight + idRow3.offsetHeight);
	thisMenu.style.top  = 20;//y;
	thisMenu.style.width = JLarguraMenus; 
	thisMenu.style.left = x;
	thisMenu.style.clip = "rect(0 0 0 0)";
	thisMenu.style.display = "block";

	// delay 2 millsecond to allow the value of ToolbarMenu.offsetHeight be set
	window.setTimeout("showMenu()", 2);
	return true;
}

function showMenu() 
{
	if (ToolbarMenu != null) 
	{ 
		IsMenuDropDown = (Frame_Supported && IsMSMenu == false)? false : true;
		if (IsMenuDropDown == false)
		{
			y = (y - ToolbarMenu.offsetHeight - idRow3.offsetHeight);
			if (y < 0) y = 0;
			ToolbarMenu.style.top = y;
		}
		y2 = y + ToolbarMenu.offsetHeight;

		ToolbarMenu.style.clip = "rect(auto auto auto auto)";
		hideElement("SELECT");
		hideElement("OBJECT");
	}
}

function hideMenu()
{
	if (ToolbarMenu != null && ToolbarMenu != StartMenu) 
	{
		// Don't hide the menu if the mouse move between the menu and submenus
		cY = event.clientY + document.body.scrollTop;
		if ( (event.clientX >= x && event.clientX <= x2 && event.clientX != (x+1)) &&
			 ((IsMenuDropDown == true  && cY > (y-10) && cY <= y2)      ||
			  (IsMenuDropDown == false && cY >= y     && cY <= (y2+10)) ))
		{
			window.event.cancelBubble = true;
			return; 
		}

		ToolbarMenu.style.display = "none";
		ToolbarMenu = StartMenu;
		window.event.cancelBubble = true;

		showElement("SELECT");
		showElement("OBJECT");
	}
}

function keepMenu()
{
	window.event.cancelBubble = true;
}

function hideElement(elmID)
{
	// Hide any element that overlaps with the dropdown menu
	for (i = 0; i < document.all.tags(elmID).length; i++)
	{
		obj = document.all.tags(elmID)[i];
		if (! obj || ! obj.offsetParent)
			continue;

		// Find the element's offsetTop and offsetLeft relative to the BODY tag.
		objLeft   = obj.offsetLeft;
		objTop    = obj.offsetTop;
		objParent = obj.offsetParent;
		while (objParent.tagName.toUpperCase() != "BODY")
		{
			objLeft  += objParent.offsetLeft;
			objTop   += objParent.offsetTop;
			objParent = objParent.offsetParent;
		}
		// Adjust the element's offsetTop relative to the dropdown menu
		objTop = objTop - y;

		if (x > (objLeft + obj.offsetWidth) || objLeft > (x + ToolbarMenu.offsetWidth))
			;
		else if (objTop > ToolbarMenu.offsetHeight)
			;
		else if (IsMSMenu && (y + ToolbarMenu.offsetHeight) <= 80)
			;
		else
		{
			obj.style.visibility = "hidden";
		}
	}
}

function showElement(elmID)
{
	// Display any element that was hiddend
	for (i = 0; i < document.body.getElementsByTagName(elmID).length; i++)
	{
		obj = document.all.tags(elmID)[i];
		if (! obj || ! obj.offsetParent)
			continue;
		obj.style.visibility = "";
	}
}

function formatURL(URLStr, InstrumentStr)
{
	var tempStr = URLStr;

	if (DoInstrumentation && URLStr != "" )
	{
		var ParamPos1 = URLStr.indexOf("?");
		var ParamPos2 = URLStr.lastIndexOf("?");
		var ParamPos3 = URLStr.toLowerCase().indexOf("target=");

		if (ParamPos1 == -1)
			tempStr = "?MSCOMTB=";
		else if (ParamPos1 == ParamPos2 && ParamPos3 == -1)	
			tempStr = "&MSCOMTB=";
		else if (ParamPos1 == ParamPos2 && ParamPos3 != -1)	
			tempStr = "?MSCOMTB=";
		else if (ParamPos1 < ParamPos2)
			tempStr = "&MSCOMTB=";

		tempStr = URLStr + tempStr + InstrumentStr;
	}
	return tempStr;
}

function Lock(FunctionName )
{
	var FName = FunctionName.toUpperCase();
	if ( FName == "ADDICPMENU" )
	{
		LockICPMenu = true;
	}
	else if ( FName == "ADDMSMENU" )
	{
		LockMSMenu = true;	
	}
}
