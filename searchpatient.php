<?php require_once('Connections/cnKloAgogo.php'); ?>
<?php
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

$colname_rsSearchPatient = "-1";
if (isset($_POST['search_query'])) {
  $colname_rsSearchPatient = $_POST['search_query'];
}
mysql_select_db($database_cnKloAgogo, $cnKloAgogo);
$query_rsSearchPatient = sprintf("SELECT patientID, surname, firstname FROM patient WHERE surname = %s", GetSQLValueString($colname_rsSearchPatient, "text"));
$rsSearchPatient = mysql_query($query_rsSearchPatient, $cnKloAgogo) or die(mysql_error());
$row_rsSearchPatient = mysql_fetch_assoc($rsSearchPatient);
$totalRows_rsSearchPatient = mysql_num_rows($rsSearchPatient);$colname_rsSearchPatient = "-1";
if (isset($_POST['search_query'])) {
  $colname_rsSearchPatient = $_POST['search_query'];
}
mysql_select_db($database_cnKloAgogo, $cnKloAgogo);
$query_rsSearchPatient = sprintf("SELECT patientID, surname, firstname FROM patient WHERE surname LIKE %s", GetSQLValueString("%" . $colname_rsSearchPatient . "%", "text"));
$rsSearchPatient = mysql_query($query_rsSearchPatient, $cnKloAgogo) or die(mysql_error());
$row_rsSearchPatient = mysql_fetch_assoc($rsSearchPatient);
$totalRows_rsSearchPatient = mysql_num_rows($rsSearchPatient);
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
<script src="js/jquery-1.9.1.min.js"></script>
</head>
<body id="type-b">
<div id="wrap">

	<div id="header">
		<div id="site-name">Bethel Maternity Home</div>
		<!--<div id="search">
			<form action="">
			<label for="searchsite">Site Search:</label>
			<input id="searchsite" name="searchsite" type="text" />
			<input type="submit" value="Go" class="f-submit" />
			</form>
		</div>-->
		<ul id="nav">
		<li class="active"><a href="viewPatients.php">Home</a>
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
			<li class="last"><a href="#">Search Patient</a></li>
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
             
             <p></p>
        <form method="post" action="" class="f-wrap-1">
                
                <div class="req"><b>*</b> Indicates required field</div>
			
			<fieldset>
			
			<h3>Search Patient Record</h3>
        			<p>
    					<label for="search"><b><span class="req">*</span>Search for :</b>
    					  <input type="text" id="search_query" name="search_query" />
    					  <input type="submit" value="Search" />
  					  </label>
    					<br/>
                        <br/>
                        Search By: 
                        <select name="filter">
                          <option value="Firstname">Firstname</option>
                          <option value="Surname">Surname</option>
                        </select>
                    </p>
              </form>
	    <?php
			   	if(isset($_POST['search_query']) && $_POST['search_query'] !="" && !(empty($_POST['search_query'])))
			   {
				   
               		
                	
					echo "<table class='table1' border='0'>
            <thead>
				<tr>
				<th colspan='6'>Search Results</th>
				</tr>
			</thead>
              <tr>
                <th>ID</th>
                <th>Surname</th>
                <th>First Name</th>
              </tr>";
               do { 
               echo " <tr>";
                 echo "<th class='sub'>";
				 echo $row_rsSearchPatient['patientID'];
				echo  "</th>";
                echo  "<th class='sub'>";
				echo $row_rsSearchPatient['surname'];
                	echo "</th>";
                echo  "<th class='sub'>";
				echo $row_rsSearchPatient['firstname']; 
                echo "</th>";
              echo   "</tr>"; 
                 } while ($row_rsSearchPatient = mysql_fetch_assoc($rsSearchPatient)); 
            echo "</table>";
				
                
					//echo "</div>";
			   }
			   
			   else if( $_POST['search_query']=" " || empty($_POST['search_query']))
			   {
				   echo "<script type='text/javascript'>alert('Please Enter a search term');</script>";
			   }
   			?>
	  </div>
			
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
mysql_free_result($rsSearchPatient);
?>
