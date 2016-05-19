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
  <title>Sign In</title>
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
        <a class="navbar-brand" href="index.html">Online Banking Application</a>
      </div><!-- navbar-header -->
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#services">Sign In/Sign Up</a></li>
            <li><a href="#services">About Us</a></li>
            <li><a href="#staff">Contact Us</a></li>
        </ul>
      </div><!-- collapse navbar-collapse -->
    </div><!-- container -->
  </nav>

<div class="container">
  <div class="row">
    <section class="col-md-5">
      <h1>Already Registered?</h1>
      <h5><?php echo $_SESSION["incorrect"]; ?></h5>
      <form class="form-horizontal" action="dl.php" method="POST">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Customer ID</span>
            <input class="form-control" name="username" type="text" id="username" placeholder="Customer ID">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Password</span>
            <input class="form-control" name="password" type="password" id="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit">
        </div>
      </form>
    </section>
    <section class="col-md-2"></section>
    <section class="col-md-5">
    <h1>New User?</h1>
    <h5>Fill the following form. All fields are mandatory.</h5>
<form class="form-horizontal" action="insert.php" method="POST">
        <fieldset>
        <legend>Basic Information</legend>
        <h5><?php echo $_SESSION["exist"]; ?></h5>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">SSN/Passport</span>
            <input class="form-control" name="inputSSN" type="text" id="inputSSN" placeholder="SSN/Passport">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Password</span>
            <input class="form-control" name="inputPassword" type="password" id="inputPassword" placeholder="Password">
          </div>
        </div>
        </fieldset>
        <fieldset>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">First Name</span>
            <input class="form-control" name="inputFirstName" type="text" id="inputFirstname" placeholder="First Name">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Last Name</span>
            <input class="form-control" name="inputLastName" type="text" id="inputLastName" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
  <span class="input-group-addon">Gender</span>
  <select class="form-control" name="inputGender" id="inputGender">
    <option>Male</option>
    <option>Female</option>
  </select>
</div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Date of Birth</span>
            <input class="form-control" name="inputDOB" type="date" id="inputDOB" placeholder="MM/DD/YYYY">
          </div>
        </div>
        </fieldset>
        <fieldset>
        <legend>Contact Information</legend>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Phone Number</span>
            <input class="form-control" name="inputPhoneNumber" type="text" id="inputPhoneNumber" placeholder="Phone Number">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Address</span>
            <input class="form-control" name="inputAddress" type="text" id="inputAddress" placeholder="Address">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Email</span>
            <input class="form-control" name="inputEmail" type="text" id="inputEmail" placeholder="Email">
          </div>
        </div>
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
