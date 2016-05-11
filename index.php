<?php require_once('Connections/cnKloAgogo.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "viewPatients.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_cnKloAgogo, $cnKloAgogo);
  
  $LoginRS__query=sprintf("SELECT userid, password FROM users WHERE userid=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $cnKloAgogo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Bethel Maternity Home - User Log in</title>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="css/ie6_or_less.css" />
<![endif]-->
<script type="text/javascript" src="js/common.js"></script>
</head>
<body id="type-a">
<div id="wrap">

	<div id="header">
	  <div id="site-name">Bethel Maternity Home</div>
		<ul id="nav">
		<li class="first"><a href="#">Log In</a></li>
		
	  </ul>
	</div>
	
	<div id="content-wrap">
	
		<div id="content">
		
		  <div id="breadcrumb">
			<!--<a href="homepage.cfm">Home</a> / <a href="devtodo">Section Name</a> / <strong>Page Name</strong></div>-->
			<form name="login_form" action="<?php echo $loginFormAction; ?>" method="POST" class="f-wrap-1">
			
			<div class="req"><b>*</b> Indicates required field</div>
			
			<fieldset>
			
			<h3>User Log in</h3>
			
			<label for="username"><b><span class="req">*</span>Username:</b>
			<input id="username" name="username" type="text" class="f-name" tabindex="1" /><br />
			</label>
			
			<label for="password"><b><span class="req">*</span>Password:</b>
			<input id="password" name="password" type="password" class="f-name" tabindex="2" /><br />
			</label>
			
			<div class="f-submit-wrap">
			<input type="submit" value="Submit" class="f-submit" tabindex="12" /> 
            <input name="Reset" type="reset" class="f-submit" tabindex="12" value="Clear" />
			<br />
			</div>
			</fieldset>
			</form>
		
			<div id="footer">
			<p>&copy; Bethel Maternity Home, Klo Agogo			</p>
			</div>
		
		</div>
		
		<div id="poweredby"><a href=""></a></div>
		
	</div>

</div>
</body>
</html>
