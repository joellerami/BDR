<link rel="stylesheet" type="text/css" href="include/style.css">
<?php
require 'config.php';
require 'functions.php';

$searchphrase = "";

if (isset($_GET["id"])) {
    $id  = preg_replace("/[^A-Za-z0-9\/]/", " ", htmlspecialchars($_GET["id"]));
    $searchphrase = " AND ( E.[ID] = '" . $id . "' )";
}


if ($searchphrase) {
    
    if (strlen($searchphrase) >= 1 && strcmp($searchphrase, ' ') != 0) {
        
        $results = odbc_exec($connection, "SELECT DISTINCT
e.[fName]
,e.[mName]
,e.[lName]
,postName
,OL.[Department]
,[Section/Office] as Office
,[title]
,officeEmail1
,officeEmail2
,officePhone1
,officePhone2
,officePhone1Ext
,officePhone2Ext
,[mobilePhone1]
,[mobilePhone2]
,[homePhone1]
,[homePhone1Ext]
,[homePhone2]
,[homePhone2Ext]
,case when [empType] = 1 then 'American' else 'Local Employee' end as EmployeeType
  FROM [BDR].[dbo].[tblEmployees] E
  JOIN [BDR].[dbo].[vw_OrgList] OL on E.organization = Ol.ID
  JOIN [BDR].[dbo].[postID] P on P.postID = E.postID
  WHERE active = 1
 " . $searchphrase);
        
        
        if (odbc_num_rows($results) != 0) {
            

            while ($row = odbc_fetch_row($results)) {
		echo '<font size="20pt"><b>';
		if(odbc_result($results, "EmployeeType") == 'American') {
			echo odbc_result($results, "fName") . '&nbsp;' . ( odbc_result($results, "mName") ? odbc_result($results, "mName") . '.&nbsp;' : '' ) . odbc_result($results, "lName");
		} else {
			echo odbc_result($results, "lName"). '&nbsp;' . odbc_result($results, "fName");
		}
		echo '</b></font><HR>';
	        echo '<table width="100%" class="detailstable">';
		//if(odbc_result($results, "fName") ) { echo '<tr><td class="headerText">Given Name</td><td class="normalText">' . odbc_result($results, "fName") . '&nbsp;</td></tr>'; }
		//if(odbc_result($results, "mName") ) { echo '<tr><td class="headerText">Middle Name</td><td class="normalText">' . odbc_result($results, "mName") . '&nbsp;</td></tr>'; }
		//if(odbc_result($results, "lName") ) { echo '<tr><td class="headerText">Surname</td><td class="normalText">' . odbc_result($results, "lName") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "postName") ) { echo '<tr><td class="headerText">Post Name</td><td class="normalText">' . odbc_result($results, "postName") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "Department") ) { echo '<tr><td class="headerText">Agency</td><td class="normalText">' . odbc_result($results, "Department") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "Office") ) { echo '<tr><td class="headerText">Office</td><td class="normalText">' . odbc_result($results, "Office") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "title") ) { echo '<tr><td class="headerText">Title</td><td class="normalText">' . odbc_result($results, "title") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "OfficeEmail1") ) { echo '<tr><td class="headerText">Office Email 1</td><td class="normalText">' . '<a href="mailto:' . odbc_result($results, "OfficeEmail1") . '?Subject=""' . ' target="_top">' . odbc_result($results, "OfficeEmail1") . '</a>&nbsp;</td></tr>'; }
		if(odbc_result($results, "OfficeEmail2") ) { echo '<tr><td class="headerText">Office Email 2</td><td class="normalText">' . '<a href="mailto:' . odbc_result($results, "OfficeEmail2") . '?Subject=""' . ' target="_top">' . odbc_result($results, "OfficeEmail2") . '</a>&nbsp;</td></tr>'; }
		if(odbc_result($results, "OfficePhone1") ) { echo '<tr><td class="headerText">Office Phone 1</td><td class="normalText">' . phonenumber(odbc_result($results, "OfficePhone1")) . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "OfficePhone1Ext") ) { echo '<tr><td class="headerText">Office Phone 1 Ext</td><td class="normalText">' . odbc_result($results, "OfficePhone1Ext") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "OfficePhone2") ) { echo '<tr><td class="headerText">Office Phone 2</td><td class="normalText">' . phonenumber(odbc_result($results, "OfficePhone2")) . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "OfficePhone2Ext") ) { echo '<tr><td class="headerText">Office Phone 2 Ext</td><td class="normalText">' . odbc_result($results, "OfficePhone2Ext") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "mobilePhone1") ) { echo '<tr><td class="headerText">Mobile Phone 1</td><td class="normalText"><a href="tel:' . phonenumber(odbc_result($results, "mobilePhone1")).'">' . phonenumber(odbc_result($results, "mobilePhone1")) . '</a>&nbsp;</td></tr>'; }
		if(odbc_result($results, "mobilePhone2") ) { echo '<tr><td class="headerText">Mobile Phone 2</td><td class="normalText"><a href="tel:' . phonenumber(odbc_result($results, "mobilePhone2")).'">' . phonenumber(odbc_result($results, "mobilePhone2")) . '</a>&nbsp;</td></tr>'; }
		if(odbc_result($results, "HomePhone1") ) { echo '<tr><td class="headerText">Home Phone 1</td><td class="normalText">' . phonenumber(odbc_result($results, "HomePhone1")) . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "HomePhone1Ext") ) { echo '<tr><td class="headerText">Home Phone 1 Ext</td><td class="normalText">' . odbc_result($results, "HomePhone1Ext") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "HomePhone2") ) { echo '<tr><td class="headerText">Home Phone 2</td><td class="normalText">' .phonenumber( odbc_result($results, "HomePhone2")) . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "HomePhone2Ext") ) { echo '<tr><td class="headerText">Home Phone 2 Ext</td><td class="normalText">' . odbc_result($results, "HomePhone2Ext") . '&nbsp;</td></tr>'; }
		if(odbc_result($results, "EmployeeType") ) { echo '<tr><td class="headerText">US or LE Staff</td><td class="normalText">' . odbc_result($results, "EmployeeType") . '&nbsp;</td></tr>'; }
	        echo '</table>';
            }
        }
    }
}
?>