<?php  
 $NicNo = $_POST['nicNo'];
 $userName = $_POST['Cname'];
 $e_mail = $_POST['EMail'];
 $password = $_POST['pass'];
 
 $hashed_password=sha1($password);
//database connection
 
 if(!empty($NicNo)|| !empty($userName) || !empty($e_mail) || !empty($password) )
  {


      $con =mysqli_connect('localhost','root','','theater');
      if(mysqli_connect_error())
       {
   			die('Connection Failed:'.mysqli_connect_error());

 		}
 	  else{

 	 			$query=" INSERT INTO registration(NicNo,userName,e_mail,password) VALUES('{$NicNo}','{$userName}','{$e_mail}','{$hashed_password}') ";
     			$result= mysqli_query($con,$query);

    			if($result){

    							echo "1 Recoard addedd";
    						}
    			else{ 

    					echo "error";

       				} 
           }

     mysqli_close($con);
}



?>