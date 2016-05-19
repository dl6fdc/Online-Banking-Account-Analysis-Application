#!/usr/local/bin/php
<?php
session_start();

$name = $_SESSION["name"];
$customerid = $_SESSION["customerid"];

$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the statement
$stid = oci_parse($conn, "SELECT * FROM USERS JOIN CUSTOMER ON CUSTOMER.SSN=USERS.SSN WHERE CUSTOMER.CUSTOMERID='$customerid'");

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$row = oci_fetch_object($stid);
$count=oci_num_rows($stid);

if($count == 1){
	$lname = $row->LASTNAME;
	$dob=$row->DOB;
	$phone=$row->PHONENUMBER;
	$email=$row->EMAIL;
	$gender=$row->GENDER;
	$ssn=$row->SSN;
	$address=$row->BILLINGADD;
}
else{
	$stid1 = oci_parse($conn, "SELECT * FROM USERS JOIN ADMIN ON ADMIN.SSN=USERS.SSN WHERE ADMIN.ADMINID='$customerid'");
	// Perform the logic of the query
	$r1 = oci_execute($stid1);
	if (!$r1) {
		$e = oci_error($stid1);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$row1 = oci_fetch_object($stid1);
	$lname = $row1->LASTNAME;
	$dob=$row1->DOB;
	$phone=$row1->PHONENUMBER;
	$email=$row1->EMAIL;
	$gender=$row1->GENDER;
	$ssn=$row1->SSN;
}
	oci_free_statement($stid);
	oci_free_statement($stid1);
?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>User</title>
	<link rel="stylesheet" href="/CSS/styles.css">
</head>
<body>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index1.php">Online Banking Application</a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
			<li><a href="user.php"><?php echo $name ?></a></li>
        	<li><a href="signout.php">Signout</a></li>
          	<li><a href="#services">About Us</a></li>
          	<li><a href="#staff">Contact Us</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>

<div class="content container">
  <div class="row">

    <section class="col-md-12">
<h2>
	<?php echo "Welcome " . $name ?>
</h2>
    </section>
    <section class="col-md-12">
      <h3>Account Details</h3>
      <div class="rowi">
        <section class="col-md-6"><p>ID</p></section>
        <section class="col-md-6"><p><?php echo $customerid; ?></p></section>
        <section class="col-md-6"><p>SSN</p></section>
        <section class="col-md-6"><p><?php echo $ssn; ?></p></section>
        <?php
			if($count == 1){
				$stid2 = oci_parse($conn, "SELECT * FROM ACCOUNT WHERE CUSTOMERID='$customerid'");
				// Perform the logic of the query
				$r2 = oci_execute($stid2);
				if (!$r2) {
					$e = oci_error($stid2);
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				$row2 = oci_fetch_object($stid2);
				$accid=$row2->ACCOUNTNUM;
				
				
				print"<section class=\"col-md-6\"><p>Account Number</p></section>";
				print "<section class=\"col-md-6\"><p>" . $accid . "</p></section>";
				oci_free_statement($stid2);
			}
        ?>
        <section class="col-md-6"><p>First Name</p></section>
        <section class="col-md-6"><p><?php echo $name; ?></p></section>
        <section class="col-md-6"><p>Last Name</p></section>
        <section class="col-md-6"><p><?php echo $lname; ?></p></section>
        <section class="col-md-6"><p>Date of Birth</p></section>
        <section class="col-md-6"><p><?php echo $dob; ?></p></section>
        <section class="col-md-6"><p>Gender</p></section>
        <section class="col-md-6"><p><?php  
			if($gender == 'M'){
				echo "Male";
			}
			else{
				echo "Female";
			}
        ?></p></section>
        <section class="col-md-6"><p>Phone Number</p></section>
        <section class="col-md-6"><p><?php echo $phone; ?></p></section>
        <section class="col-md-6"><p>Email</p></section>
        <section class="col-md-6"><p><?php echo $email; ?></p></section>
        <?php
			if($count == 1){
				print"<section class=\"col-md-6\"><p>Billing Address</p></section>";
				print "<section class=\"col-md-6\"><p>" . $address . "</p></section>";
			}
			oci_close($conn);
        ?>
      </div>
    </section> 
  </div><!-- row --> 
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
