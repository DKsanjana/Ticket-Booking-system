<?php
require_once('paypal.class.php');  
$p = new paypal_class;             
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   
     
            

$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];


if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) {
    
   case 'process':      
      
      $CatDescription = $_REQUEST['CatDescription'];
      $payment = $_REQUEST['payment'];
      $id = $_REQUEST['id'];
      $key = $_REQUEST['key'];

      $p->add_field('business', 'hb@supertec.com');
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $CatDescription);
      $p->add_field('amount', $payment);
      $p->add_field('key', $key);
      $p->add_field('item_number', $id);
      

      $p->submit_paypal_post(); 
      break;
      
   case 'success':      

      echo "<br/><p><b>Thank you for your Donation. </b><br /></p>";
      
      foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      
      
      
      break;
      
   case 'cancel':       
 
 
      echo "<br/><p><b>The order was canceled!</b></p><br />";
    foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
      
      break;
      
   case 'ipn':          
      
      if ($p->validate_ipn()) { 
          
         
         $dated = date("D, d M Y H:i:s", time()); 
         
         $subject = 'Instant Payment Notification - Recieved Payment';
         $to = 'hb@supertec.com';    
         $body =  "An instant payment notification was successfully recieved\n";
         $body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
         $body .= " at ".date('g:i A')."\n\nDetails:\n";
         $headers = "";
         $headers .= "From: Test Paypal \r\n";
         $headers .= "Date: $dated \r\n";
        
        $PaymentStatus =  $p->ipn_data['payment_status']; 
        $Email        =  $p->ipn_data['payer_email'];
        $id           =  $p->ipn_data['item_number'];
        
        if($PaymentStatus == 'Completed' or $PaymentStatus == 'Pending'){
            $PaymentStatus = '2';
        }else{
            $PaymentStatus = '1';
        }
       
        foreach ($p->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
        fopen("http://www.virtualphoneline.com/admins/TestHMS.php?to=".urlencode($to)."&subject=".urlencode($subject)."&message=".urlencode($body)."&headers=".urlencode($headers)."","r");         
  } 
      break;
 }     

?>