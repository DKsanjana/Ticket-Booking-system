 <?php
  
  $seat=$_GET['box'];

  $name=$_GET['box'];
  $i=0;
  echo "NILNU CINEMA <br/>" ;
  echo "------------------ <br/><br/>";
  echo "Booked Seats: <br/>";
  foreach ($name as $seat){
    
    echo $seat."<br/>";
    
    $i++;
  }
  $price=$i*200;
  echo "<br/>";
  echo "Date :".date("y/m/d")."<br/><br/>";
  echo "Time :".date("h:i:sa")."<br/><br/>";
  echo "Ticket Price:".$price."RS/=<br/><br/>";
 
  
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="Ticket.css">
</head>
<body>
<header>
<form name="paypalForm" action="paypal.php" method="post">
<input type="hidden" name="id" value="123">
<input type="hidden" name="CatDescription" value="Payment">
                       <input type="hidden" name="payment" value="10">  
                       <input type="hidden" name="key" value="<? echo md5(date("Y-m-d:").rand()); ?>">
<p>Do your payment here!</p>        
<input class="img" TYPE="image" SRC="paypal.png" name="paypal"  value="Payment via Paypal" >
</form>
</header>
</body>
</html>
