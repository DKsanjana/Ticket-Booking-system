<?php  

 $userName = $_POST['Cname'];
 $password = $_POST['pass'];
 
 $hashed_password=sha1($password);
//database connection

 
 if(!empty($userName) ||!empty($password) )
  {


      $con =mysqli_connect('localhost','root','','theater');
      if(mysqli_connect_error())
       {
   			die('Connection Failed:'.mysqli_connect_error());

 		}
 	  else{

 	 			$query=" SELECT * FROM registration WHERE userName='$userName' and password='$hashed_password' ";
     			$result= mysqli_query($con,$query);
          $check = mysqli_fetch_array($result);
          //$active=$row['active'];
          //$count=mysqli_num_rows($result);

    			if(isset($check)){

                  include 'Dashbord.html';
    						}
    			else{ 

    					echo "incorect password or username";

       				} 
       }

     mysqli_close($con);
}
else{
  echo "Please fill the form";
}


?>