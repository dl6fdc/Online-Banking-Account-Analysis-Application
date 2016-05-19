#!/usr/local/bin/php
<?php
session_start();

$name = $_SESSION["name"];
$customerid = $_SESSION["customerid"];
?>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <title>Admin</title>
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
        Online Banking Application
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
			<li><a href="admin.php"><?php echo $name ?></a></li>
          <li><a href="accountdetails.php">Account Details</a></li>
            <li><a href="#services">About Us</a></li>
            <li><a href="#staff">Contact Us</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>
  <div class="container">
    <section class="col-md-12">
    <h1><?php echo "Welcome " . $name ?></h1>
      <h3>Main Menu</h3>
      <ul>
        <li><a href="admincreate.php">Create Account</a></li>
        <li><a href="adminanalysis.php">View Bank Detailed Analysis</a></li>
        <li><a href="adminsearchtransaction.php">Search Transaction</a></li>
        
      </ul>
    </section>
  </div> 

    </section>
  </div><!-- row -->   
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
