<html>
<style>
body
{
    border-style: solid;
    border-width: 15px;
}
</style>
<body bgcolor="#666699">
<center>
<?php
session_start();
if (isset($_SESSION['userSession'])!="") {
 header("Location: home_reception.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])) {
 
 $rname = strip_tags($_POST['rname']);
 $email = strip_tags($_POST['email']);
 $upass = strip_tags($_POST['password']);
 $rgender=strip_tags($_POST['rgender']);
 $rid=strip_tags($_POST['rid']);

 $rname = $DBcon->real_escape_string($rname);
 $email = $DBcon->real_escape_string($email);
 $upass = $DBcon->real_escape_string($upass);
  $rid = $DBcon->real_escape_string($rid);
 $rgender = $DBcon->real_escape_string($rgender);
  
echo $rname.'<br/>';
echo  $email.'<br/>';
echo $upass.'<br/>';
echo $rid.'<br/>';
echo $rgender.'<br/>';
 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
 
 $check_email = $DBcon->query("SELECT R_email FROM reception WHERE  R_email='$email'");
 $count=$check_email->num_rows;
 
 
 echo 'Count'.$count.'<br/>';
  if ($count==0) {
  
  //$query = "INSERT INTO patient(id,email_id,password,Name,Age,Hospital Admitted in,Doctor treating,Room No.,Medicine required,Bill to be paid,Appointment timings) VALUES('$uid' ,'$email', '$hashed_password'  ,'$uname','$uage','$uhospital','$udoctor','$uroom','$umedicine','$ubill','$uappointment')";
  $query="INSERT INTO `reception` (`Rec_id`, `R_email`, `R_password`, `R_name`, `R_gender`) VALUES ('$rid', '$email', '$upass', '$rname', '$rgender')"; 
   
  if ($DBcon->query($query)) {
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
     </div>";
  }else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
     </div>";
  }
  
 } else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken query!
    </div>";
   
 }
 $DBcon->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        
        <?php
  if (isset($msg)) {
   echo $msg;
  }
  ?>
          
        <div class="form-group">
        <input type="text" class="form-control" placeholder="R_id" name="rid" required  />
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="email" required  />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required  />
        </div>
        
       
        <div class="form-group">
        <input type="text" class="form-control" placeholder="R_name" name="rname" required  />
        </div>

        <div class="form-group">
        <input type="text" class="form-control" placeholder="R_gender" name="rgender" required  />
        </div>
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-signup">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
   </button> 
            <a href="index_reception.php" class="btn btn-default" style="float:right;">Log In Here</a>
        </div> 
      
      </form>

    </div>
    
</div>

</body>
</html>


<?php
  $username = 'root';
  $password = '';
  $hostname ='127.0.0.1';
  $sqldb='hospital_management';
  $con=mysqli_connect($hostname,$username,$password ,$sqldb);
// Check connection
  if (mysqli_connect_errno())
  {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  // Change database to "test"
  @mysqli_select_db($con,$sqldb);
    echo 'connected to mysqli_select_db function';

// ...some PHP code for database "test"...
   function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
	echo '<br/>Inside mysqli_result';
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
echo '<br/>this is set';
  
// Perform queries 
if($query_sql=mysqli_query($con,"SELECT * FROM reception"))
{
	echo '<br/>connected';
}
else
{echo '<br/>not connected';}
//mysqli_query($con,"INSERT INTO Persons (FirstName,LastName,Age) 
//VALUES ('Glenn','Quagmire',33)");

  //to fetch the data from the database
  
  echo '<br/>the data in the table is<br/>';
  
  if(mysqli_num_rows($query_sql) == NULL)
  {echo 'No query provided so far';}
 else
 {
echo "<table border='1'>";
echo "<tr> <th>'Rec_id'</th> <th>'R_email'</th> <th>'R_password'</th> <th>'R_name'</th>     <th>'R_gender'</th></tr>";
// keeps getting the next row until there are no more to get
while($row =mysqli_fetch_assoc($query_sql)) {

// Print out the contents of each row into a table
    echo "<tr><td>"; 
    echo $row['Rec_id'];
    echo "</td><td>"; 
    echo $row['R_email'];
    echo "</td><td>";
    echo $row['R_password'];
    echo "</td><td>";
    echo $row['R_name'];
    echo "</td><td>";
    echo $row['R_gender'];
echo "</td></tr>";        
} 
echo "</table>";
 }
mysqli_close($con); 
?></center></body></html>