<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Bethel Maternity Home - Klo Agogo</title>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="css/dateStyle.css"
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="css/ie6_or_less.css" />
<![endif]-->
<script type="text/javascript" src="js/common.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/script.js"></script>
<script src="js/datepickr.js"></script>
</head>
<body id="type-b">
<div id="wrap">

	<div id="header">
		<div id="site-name">Bethel Maternity Home</div>

		<ul id="nav">
		<li class="active"><a href="#">Home</a>
        <ul>
				<li class="first"><a href="#">Announcements</a></li>
				<li class=""><a href="#">About Us</a></li>
				<li class="last"><a href="#">Contact Us</a></li>		
			</ul>
        </li>
		<li><a href="#">Registration</a>
			<ul>
				<li class="first"><a href="#">Register Patients</a></li>
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
             
 <form action="<?php echo $editFormAction; ?>" method="POST" class="f-wrap-1" name="addPatient_form">
			
			<div class="req"><b>*</b> Indicates required field</div>
			
			<fieldset>
			
			<h3>Register New Patient</h3>
			
			
<table width="812" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="425"><label for="firstname"><b><span class="req">*</span>First name:</b>
			<input id="firstname" name="firstname" type="text" class="f-name" tabindex="1" /><br />
			</label></td>
    <td width="380"><label for="middlename"><b><span class=""></span>Middle Name:</b>
			<input id="middlename" name="middlename" type="text" class="f-name" tabindex="2" /><br />
			</label></td>
  </tr>
  <tr>
    <td><label for="lastname"><b><span class="req">*</span>Last name:</b>
			<input id="lastname" name="lastname" type="text" class="f-name" tabindex="3" /><br />
			</label></td>
    <td><label for="dob"><b><span class="req">*</span>Date of Birth:</b>
			<input id="dob" name="dob" type="text" class="f-email" tabindex="4" /><br />
			</label> </td>
			<script type="text/javascript">
			
			new datepickr('dob', {
				'dateFormat': 'Y/m/d'
			});
		</script>
  </tr>
  <tr>
    <td><label for="maritalstatus"><b>Marital Status:</b>
			<select id="maritalstatus" name="maritalstatus" tabindex="5">
			<option>Select...</option>
			<option>Single</option>
			<option>Married</option>
			<option>Divorced</option>
            <option>Widowed</option>
			</select>
			<br />
			</label></td>
    <td><label for="gender"><b><span class="req">*</span>Gender:</b>
			<select id="gender" name="gender" tabindex="6">
			<option>Select...</option>
			<option>Male</option>
			<option>Female</option>
			</select>
			<br />
			</label></td>
  </tr>
  <tr>
    <td><label for="occupation"><b><span class="req">*</span>Occupation:</b>
			<input id="occupation" name="occupation" type="text" class="f-email" tabindex="7" /><br />
			</label></td>
    <td><label for="religion"><b><span class="req">*</span>Religion:</b>
			<select id="religion" name="religion" tabindex="8">
			<option>Select...</option>
			<option>Christian</option>
			<option>Muslim</option>
            <option>Bhuddist</option>
            <option>Traditionalist</option>
			</select>
			<br />
			</label></td>
  </tr>
  <tr>
    <td><label for="postaladdress"><b>Postal Address:</b>
			<textarea id="postaladdress" name="postaladdress" class="f-comments" rows="3" cols="30" tabindex="9"></textarea><br />
			</label></td>
    <td><label for="homeaddress"><b>Home Address:</b>
			<textarea id="homeaddress" name="homeaddress" class="f-comments" rows="3" cols="30" tabindex="9"></textarea><br />
			</label></td>
  </tr>
  <tr>
    <td><label for="emailaddress"><b><span class=""></span>Email Address:</b>
			<input id="emailaddress" name="emailaddress" type="text" class="f-email" tabindex="10" /><br />
			</label></td>
    <td><label for="nearestrelative"><b><span class="req">*</span>Nearest Relative Name:</b>
			<input id="nearestrelative" name="nearestrelative" type="text" class="f-name" tabindex="11" /><br />
			</label></td>
  </tr>
  <tr>
    <td><label for="nearestrelativecontact"><b><span class="req">*</span>Nearest Relative Contact:</b>
			<input id="nearestrelativecontact" name="nearestrelativecontact" type="text" class="f-name" tabindex="12" /><br />
			</label></td>
    <td><label for="district"><b><span class=""></span>District:</b>
			<input id="district" name="district" type="text" class="f-name" tabindex="11" /><br />
			</label></td>
  </tr>
  <tr>
    <td><label for="sub_district"><b><span class=""></span>Sub District:</b>
			<input id="sub_district" name="sub_district" type="text" class="f-name" tabindex="12" /><br />
			</label></td>
    <td><label for="health_facility"><b><span class=""></span>Health Facility:</b>
      <select name="healthFacility" id="healthFacility">
        <?php
do {  
?>
        <option value="<?php echo $row_rsHealthFacility['facilitynumber']?>"><?php echo $row_rsHealthFacility['facilityname']?></option>
        <?php
} while ($row_rsHealthFacility = mysql_fetch_assoc($rsHealthFacility));
  $rows = mysql_num_rows($rsHealthFacility);
  if($rows > 0) {
      mysql_data_seek($rsHealthFacility, 0);
	  $row_rsHealthFacility = mysql_fetch_assoc($rsHealthFacility);
  }
?>
      </select>
      <br />
			</label></td>
  </tr>
  <tr>
  <td> <fieldset class="f-radio-wrap">
		
			<b>Do you have Health Insurance? :</b>
			
				<fieldset>
				
				<label for="health_insurance_yes">
				<input id="health_insurance_yes" type="radio" name="radio_insurance" value="Yes" class="f-radio" tabindex="14" />
				Yes</label>
				
				<label for="health_insurance_no">
				<input id="health_insurance_no" type="radio" name="radio_insurance" value="No" class="f-radio" tabindex="15" />
				No</label>
	
				</fieldset>
         </td>
         <td></td>
  </tr>
 
  <tr id="disappear"> 
  	<td height="50"><label for="health_insurance_number"><b><span class="req">*</span>Insurance Number:</b>
			<input id="health_insurance_number" name="health_insurance_number" type="text" class="f-name" tabindex="16" /><br />
			</label></td>
  	<td>
<label for="scheme_name"><b><span class="req">*</span>Scheme Name:</b>
			<input id="scheme_name" name="scheme_name" type="text" class="f-name" tabindex="17" /><br />
			</label>
    </td>
        </tr>

  <tr>
  	<td><div class="f-submit-wrap">
			<input type="submit" value="Submit" class="f-submit" tabindex="116" />
            <input name="Reset" type="reset" class="f-submit" tabindex="12" value="Reset" /><br />
			</div>
            </td>
    <td></td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="addPatient_form" />
 </form>

<p>&nbsp;</p>
            
            
		    <div id="footer">
			<p>&copy; Bethel Maternity Home - Klo Agogo			</p>
			</div>
			
		</div>
		
		<div id="poweredby"><a href=""></a></div>
		
	</div>