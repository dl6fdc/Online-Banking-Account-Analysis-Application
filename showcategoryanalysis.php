#!/usr/local/bin/php
<?php
session_start();

$name = $_SESSION["name"];
$category=$_POST['category'];
$customerid = $_SESSION["customerid"];
$date= $_POST["date"];
$conn = oci_connect('asaxena', 'DataXAsh007', '//oracle.cise.ufl.edu/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$jan=0;
$feb=0;
$mar=0;
$apr=0;
$may=0;
$jun=0;
$jul=0;
$aug=0;
$sep=0;
$oct=0;
$nov=0;
$dec=0;


if($category == 'Travel'){
	$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Travel' GROUP BY EXTRACT(MONTH FROM DOT) ");
}

else if($category == 'Education'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH  FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Education' GROUP BY EXTRACT(MONTH FROM DOT)");
}
else if($category == 'Medical'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Medical' GROUP BY EXTRACT(MONTH FROM DOT)");
}
else if($category == 'Restaurants'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH  FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Restaurants' GROUP BY EXTRACT(MONTH FROM DOT)");
}
else if($category == 'Household'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH  FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Household' GROUP BY EXTRACT(MONTH FROM DOT)");
}
else if($category == 'Rent'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH  FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Rent' GROUP BY EXTRACT(MONTH FROM DOT)");
}
else if($category == 'Fuel'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH  FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Fuel' GROUP BY EXTRACT(MONTH FROM DOT)");
}
else if($category == 'Groceries'){
$stid1 = oci_parse($conn, "SELECT SUM(AMOUNT) AS AMT, EXTRACT(MONTH FROM DOT) AS MONTH  FROM TRANSACTION WHERE CUSTOMERID='$customerid' AND CATEGORY='Groceries' GROUP BY EXTRACT(MONTH FROM DOT)");
}

else{
}
$r = oci_execute($stid1);
if (!$r) {
    $e = oci_error($stid1);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//$i=0;
while (($row = oci_fetch_array($stid1, OCI_BOTH)) != false) {
	if($row['MONTH'] == 1){
		$jan += $row['AMT'];
	}
	if($row['MONTH'] == 2){
		$feb += $row['AMT'];
	}
	if($row['MONTH'] == 3){
		$mar += $row['AMT'];
	}
	if($row['MONTH'] == 4){
		$apr += $row['AMT'];
	}
	if($row['MONTH'] == 5){
		$may+= $row['AMT'];
	}
	if($row['MONTH'] == 6){
		$jun += $row['AMT'];
	}
	if($row['MONTH'] == 7){
		$jul += $row['AMT'];
	}
	if($row['MONTH'] == 8){
		$aug += $row['AMT'];
	}
	if($row['MONTH'] == 9){
		$sep += $row['AMT'];
	}
	if($row['MONTH'] == 10){
		$oct += $row['AMT'];
	}
	if($row['MONTH'] == 11){
		$nov += $row['AMT'];
	}
	if($row['MONTH'] == 12){
		$dec += $row['AMT'];
	}
//	$i += 1;

}
oci_free_statement($stid1);
oci_close($conn);
?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Category Analysis</title>
	<link rel="stylesheet" href="/CSS/styles.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Total amount Spend'],
          ['JANUARY',   <?php echo $jan; ?>],
          ['FEBUARY', <?php echo $feb; ?>],
          ['MARCH',  <?php echo $mar; ?>],
          ['APRIL', <?php echo $apr; ?>],
          ['MAY',    <?php echo $may; ?>],
          ['JUNE',       <?php echo $jun; ?>],
          ['JULY', <?php echo $jul; ?>],
          ['AUGUST',    <?php echo $aug; ?>     ],
          ['SEPTEMBER',    <?php echo $sep; ?>     ],
          ['OCTOBER',    <?php echo $oct; ?>     ],
          ['NOVEMBER',    <?php echo $nov; ?>     ],
          ['DECEMBER',    <?php echo $dec; ?>     ]
        ]);

        var options = {
          title: 'My <?php echo $date; ?> Expenditures Pie Chart',
          is3D: true,
        };
		
		var data
		
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
	
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
    <section class="col-md-6">
      <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    <form action="analysis.php" method="POST">
    <input type="submit" value="Back">
    </form>
        
    </section>

  </div><!-- row -->
</div><!-- content container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/JavaScript/script.js"></script>
</body>
</html>
