<?php 
include  'dbconnection.php';
$error= $succmsg=NULL;
if(isset($_POST['submit'])){
$fname = $_POST['fname'];
$email = $_POST['email'];
$institute = $_POST['institute'];
$lname = $_POST['lname'];
$password=$_POST['password'];
$pass=md5($password);
$confrmpss = $_POST['confirmpassword'];

$usermatch=$dbconnection->prepare("SELECT email, institute  FROM users  WHERE (email=:email || institute=:institu)");
$usermatch->execute(array(':usreml'=>$email,':mblenmbr'=>$institute)); 
while($row=$usermatch->fetch(PDO::FETCH_ASSOC))
{
$usrdbeml= $row['email'];
$usrdbinst=$row['institute'];

}
if(empty($fname))
 {
  $error="Please Enter Your First  Name";
 }

if(empty($lname))
 {
  $error="Please Enter Your Last  Name";
 }
else if(empty($email))
 {
  
   $error="Please Enter valid email id!";
 }
 else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
 {
  
   $error="'Email not valid!!', {timeOut: 5000})</script>";
 }
 
else if(empty($institute))
 {
  
   $error="Please enter your Institute";
 }
 

else if($email==$usrdbeml || $institute==$usrdbinst)
 {
  $error="Email Id or Contact Number Already Exists!";
 }

 
else if($password="" || $confrmpss=="")
 {
	 

   $error="Password And Confirm Password Not Empty!";
 
 }
 else if($_POST['password'] != $_POST['confirmpassword'])
 {
  
   $error="Password And Confirm Password Not Matched";
 }
	else if (preg_match('/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',$password))
	{
	
		 $error="You did not enter valid  password";
	}
	else{

$sql="INSERT INTO users (fname,lname,email,institute,password) 
values(:fnames,:lnames,:emailid,:institutes,:passwords)";
$query = $dbconnection -> prepare($sql);
$query->bindParam(':fnames',$fname,PDO::PARAM_STR);
$query->bindParam(':lnames',$lname,PDO::PARAM_STR);
$query->bindParam(':emailid',$email,PDO::PARAM_STR);
$query->bindParam(':institutes',$institute,PDO::PARAM_STR);
$query->bindParam(':passwords',$pass,PDO::PARAM_STR);
$query -> execute();
$lastInsertId = $dbconnection->lastInsertId();
if($lastInsertId>0)
{
$succmsg= "Data insert Successfully";
}
else {

$succmsg= "Data not insert successfully";
}
}
      
}

?>
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<div class="container">
        <div class="row centered-form">
        <div class="col-sm-4 ">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Registration and Login</h3>
			 			</div>
			 			<div class="panel-body">
			 				<p style="color: red;"><?php echo $error;?></p>
			 					<p style="color: green;"><?php echo $succmsg;?></p>
			    		<form method="POST">
			    			
                            <div class="form-group">
			    				<label for="name"> FirstName</label>
			    				<input type="text" name="fname" id="fname" class="form-control input-sm" placeholder="First Name">
			    			</div>
<div class="form-group">
                                                        <label for="name"> Last Name</label>
                                                        <input type="text" name="lname" id="lname" class="form-control input-sm" placeholder="Last Name">
                                                </div>

			    			<div class="form-group">
			    				<label for="email">Email</label>
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>
			    			<div class="form-group">
			    				<label for="institute">Institute</label>
			    				<input type="text" name="institute" id="institute" class="form-control input-sm" placeholder="Institute"  maxlength="10">
			    			</div>
			    			
			    			<div class="form-group">
			    				<label for="password">Password</label>
			    				<input type="Password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					
			    			</div>
			    			<div class="form-group">
			    				<label for="name">Confirm Password</label>
			    				<input type="password" name="confirmpassword" id="confirmpassword" class="form-control input-sm" placeholder="Confirm Password">
			    			</div>
			    			  <div class="col-sm-6 ">
                               <input type="submit" name="submit" value="Registration" class="btn btn-info btn-block">
                              
			    		      </div>
			    		       <div class="col-sm-6 ">
                               <a href="index.php"><p class="btn btn-info btn-block">Login</p></a>
                               
			    		      </div>
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
    <style type="text/css">
    	body{
    background-color: #fff;
}
.centered-form{
	margin-top: 60px;
}

.centered-form .panel{
	background: rgba(255, 255, 255, 0.8);
	box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
}
    </style>
