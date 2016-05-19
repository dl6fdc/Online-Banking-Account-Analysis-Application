#!/usr/local/bin/php
<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Transactions Analysis</title>
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
			<li><a href="user.php"><?php echo $_SESSION["name"] ?></a></li>
        	<li><a href="accountdetails.php">Account Details</a></li>
          <li><a href="#services">About Us</a></li>
          <li><a href="#staff">Contact Us</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>

<div class="content container">
  <div class="row">

    <section class="col-md-5">
      <form class="form-horizontal" action="monthly.php" method="POST">
        <fieldset>
        <legend>Monthly Expenditure</legend>
        <div class="form-group">
  <span class="input-group-addon">Select Month</span>
  <select class="form-control" name="date" id="date">
    <option>January</option>
              <option>February</option>
              <option>March</option>
              <option>April</option>
              <option>May</option>
              <option>June</option>
              <option>July</option>
              <option>August</option>
              <option>September</option>
              <option>October</option>
              <option>November</option>
              <option>December</option>
  </select>
</div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <input type="submit" name="showmonthlyexpense" class="btn btn-default" value="submit">
        </div> 
        </fieldset>
</form>
    </section>
	<section class="col-md-2">
	</section>
    
    <section class="col-md-5">
      <form class="form-horizontal" action="showcategoryanalysis.php" method="POST">
        <fieldset>
        <legend>Category Analysis</legend>
        <div class="form-group">
  <span class="input-group-addon">CATEGORY</span>
  <select class="form-control" name="category" id="category">
    <option>Travel</option>
              <option>Education</option>
              <option>Medical</option>
              <option>Restaurants</option>
              <option>Rent</option>
              <option>Groceries</option>
              <option>Household</option>
              <option>Fuel</option>
  </select>
</div>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit">
        </div> 
        </fieldset>
</form>
    </section>
    
    
    <section class="col-md-5">
      <form class="form-horizontal" action="monthlyanalysis.php" method="POST">
        <fieldset>
        <legend>Monthly Expenditure Analysis</legend>
        </fieldset>
        <fieldset>
          <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit">
        </div> 
        </fieldset>
</form>
    </section>
  </div><!-- row -->
</div><!-- content container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
