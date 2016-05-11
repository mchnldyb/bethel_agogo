<?php include('Connections/cnKloAgogo.php');
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rsPatientDetail = "-1";
if (isset($_GET['patientID'])) {
  $colname_rsPatientDetail = $_GET['patientID'];
}
mysql_select_db($database_cnKloAgogo, $cnKloAgogo);
$query_rsPatientDetail = sprintf("SELECT * FROM patient WHERE patientID = %s", GetSQLValueString($colname_rsPatientDetail, "int"));
$rsPatientDetail = mysql_query($query_rsPatientDetail, $cnKloAgogo) or die(mysql_error());
$row_rsPatientDetail = mysql_fetch_assoc($rsPatientDetail);
$totalRows_rsPatientDetail = mysql_num_rows($rsPatientDetail);
?>
<?php include('Connections/cnKloAgogo.php'); ?>
<?php 
if(!isset($_SESSION))
{
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Bethel Maternity Home - Klo Agogo</title>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="css/ie6_or_less.css" />
<![endif]-->
<script type="text/javascript" src="js/common.js"></script>
</head>
<body id="type-b">
<div id="wrap">

	<div id="header">
		<div id="site-name">Bethel Maternity Home</div>
	
		<ul id="nav">
		<li class="active"><a href="#">Home</a>
        <!--<ul>
				<li class="first"><a href="#">Announcements</a></li>
				<li class=""><a href="#">About Us</a></li>
				<li class="last"><a href="#">Contact Us</a></li>		
			</ul>-->
        </li>
		<li><a href="#">Registration</a>
			<ul>
				<li class="first"><a href="addpatient.php">Register Patients</a></li>
				<li class="last"><a href="viewPatients.php">View Patient List</a></li>
			</ul>
		</li>
		<li><a href="#">Check Up</a>
			<ul>
			</ul>
		</li>
		<li><a href="#">Patients Records</a>
			<ul>
			<li class="first"><a href="viewPatients.php">View Patient Records</a></li>
			<li class="last"><a href="searchpatient.php">Search Patient</a></li>
			</ul>
		</ul>
	</div>
	
	<div id="content-wrap">
	
		<div id="utility">

			<ul id="nav-secondary">
			<li class="first"><a href="<?php echo $logoutAction ?>">Log Out</a></li>
			</ul>
		</div>
		
		<div id="content">
			
			<div align="right"><strong> Username :<?php echo strtoupper($_SESSION['MM_Username']); ?></strong>
             <br/>Logged in: <?php echo date('Y/m/d H:i:s'); ?></div>
			<table class="table1">
			<thead>
				<tr>
				<th colspan="2">User Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<th width="29%" class="sub">Patient ID</th>
				<td width="71%"><?php echo $row_rsPatientDetail['patientID']; ?></td>
				</tr>
				<tr>
				<th class="sub">Surname</th>
				<td><?php echo $row_rsPatientDetail['surname']; ?></td>
				</tr>
				<tr>
				<th class="sub">Firstname</th>
				<td><?php echo $row_rsPatientDetail['firstname']; ?></td>
				</tr>
                <tr>
				<th class="sub">Middle Name</th>
				<td><?php echo $row_rsPatientDetail['middlename']; ?></td>
				</tr>
                <tr>
				<th class="sub">Date of Birth</th>
				<td><?php echo $row_rsPatientDetail['dob']; ?></td>
				</tr>
                <tr>
				<th class="sub">Marital Status</th>
				<td><?php echo $row_rsPatientDetail['maritalstatus']; ?></td>
				</tr>
                <tr>
				<th class="sub">Gender</th>
				<td><?php echo $row_rsPatientDetail['sex']; ?></td>
				</tr>
                <tr>
				<th class="sub">Profession</th>
				<td><?php echo $row_rsPatientDetail['occupation']; ?></td>
				</tr>
                <tr>
				<th class="sub">Religion</th>
				<td><?php echo $row_rsPatientDetail['religion']; ?></td>
				</tr>
                <tr>
				<th height="53" class="sub">Postal Address</th>
				<td><?php echo $row_rsPatientDetail['postaladdress']; ?></td>
			  </tr>
                <tr>
				<th height="60" class="sub">Home Address</th>
				<td><?php echo $row_rsPatientDetail['homeaddress']; ?></td>
			  </tr>
                <tr>
				<th class="sub">Nearest Relative</th>
				<td><?php echo $row_rsPatientDetail['nearestrelative']; ?></td>
				</tr>
                <tr>
				<th class="sub">Nearest Relative Contact</th>
				<td><?php echo $row_rsPatientDetail['nearestrelativecontact']; ?></td>
				</tr>
                <tr>
				<th class="sub">District</th>
				<td><?php echo $row_rsPatientDetail['district']; ?></td>
				</tr>
                 <tr>
				<th class="sub">Sub District</th>
				<td><?php echo $row_rsPatientDetail['subdistrict']; ?></td>
				</tr>
                 <tr>
				<th class="sub">Health Facility</th>
				<td><?php echo $row_rsPatientDetail['healthfacility']; ?></td>
				</tr>
                 <tr>
				<th class="sub">Folder</th>
				<td><?php echo $row_rsPatientDetail['folder']; ?></td>
				</tr>
                 <tr>
				<th class="sub">Health Insurance Number</th>
				<td><?php echo $row_rsPatientDetail['healthinsurance']; ?></td>
				</tr>
			</tbody>
			</table>
			
			<hr />
			<div id="footer">
			<p>&copy; Bethel Maternity Home - Klo Agogo			</p>
			</div>
			
		</div>
		
		<div id="poweredby"><a href=""></a></div>
		
	</div>
	
</div>
</body>
</html>
<?php
mysql_free_result($rsPatientDetail);
?>
