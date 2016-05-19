#!/usr/local/bin/php
<?php
session_start();

$name = $_SESSION["name"];
$customerid = $_SESSION["customerid"];
$transactionid=$_POST["transactionid"];
$idate=$_POST["idate"];
$fdate=$_POST["fdate"];
$category=$_POST["category"];
$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$flag = 0;

if($transactionid != NULL){
	$stid1 = oci_parse($conn, "SELECT * FROM TRANSACTION WHERE TRANSACTIONID='$transactionid'");
}
else{
	if($idate != NULL && $fdate != NULL){
		if($category != NULL){
			$stid1 = oci_parse($conn, "SELECT * FROM TRANSACTION WHERE CATEGORY='$category' AND DOT BETWEEN '$idate' AND '$fdate' ");
		}
		else{
			$stid1 = oci_parse($conn, "SELECT * FROM TRANSACTION WHERE DOT BETWEEN '$idate' AND '$fdate'");
		}
	}
	else{
		if($category != NULL){
			$stid1 = oci_parse($conn, "SELECT * FROM TRANSACTION WHERE CATEGORY='$category' AND CUSTOMERID='$customerid'");
		}
		else{
			echo "No input";
			$flag = 1;
		}
	}
}

if($flag == 0){
	$r = oci_execute($stid1);
	if (!$r) {
		$e = oci_error($stid1);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
}
else{
	$_SESSION["noinputtransaction"]="There is no input in transaction. Please enter at least one request.";
	header('location: searchtransaction.php');
}

?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Transactions</title>
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
        	<li><a href="accountdetails.php">Account Details</a></li>
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
      <h3>Transaction Details</h3>
      <div class="rowi">
        <section class="col-md-3"><p>Transaction ID</p></section>
        <section class="col-md-3"><p>Date of Transaction</p></section>
        <section class="col-md-3"><p>Category</p></section>
        <section class="col-md-3"><p>Amount</p></section>
        <?php
			while (($row = oci_fetch_array($stid1, OCI_BOTH)) != false) {				
				print ("<section class=\"col-md-3\"><p>" . $row['TRANSACTIONID'] . "</p></section>");
				print ("<section class=\"col-md-3\"><p>" . $row['DOT'] . "</p></section>");
				print ("<section class=\"col-md-3\"><p>" . $row['CATEGORY'] . "</p></section>");
				print ("<section class=\"col-md-3\"><p>$" . $row['AMOUNT'] . "</p></section>");
			}
			oci_free_statement($stid1);
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
