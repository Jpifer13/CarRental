<?php include("header.php");
	  include("connection.php"); //Establishing connection with our database

$username = "";
$email    = "";
$errors = array(); 
$_SESSION['success'] = "";

session_start();


// REGISTER USER
if (isset($_POST['submit'])) {
	// receive all input values from the form
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password_1"]) || empty($_POST["password_2"])) {
		array_push($errors, "Missing info");
		echo "Missing info";
	}

	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
		echo "Passwords do not match";
	}
	
		$usernameSQL=mysqli_query($db,"SELECT username FROM users WHERE username='$username'");	
		$emailSQL=mysqli_query($db,"SELECT username FROM users WHERE email='$email'");

	if (mysqli_num_rows($usernameSQL) == 1){
		echo "Username '$username' is already taken";
		array_push($errors, "Username taken");
	}

	if (mysqli_num_rows($emailSQL) == 1){
		echo "Email '$email' is already taken";
		array_push($errors, "Email taken");
	}
			
	
			

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//$password = md5($password_1);//encrypt the password before saving in the database
		
		$query = "INSERT INTO users (username, email, password) 
				  VALUES('$username', '$email', '$password_1')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		
		echo "You're a member now!";
	}

}
?>

<style>
body
{
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
	min-width: 1000px;
	min-height: 600px;
		
	background-image: url(); 
	background-repeat:no-repeat;
	background-size: cover;
	
}	
	
 #table{
	 margin-top: 50px; 
	 margin-left: 5% ;
	 border: 4px solid black; 
	 border-radius: 25px;
	 border-collapse: separate;
	}
 #boxc1{
	background-color: ghostwhite; 
	opacity: 1;
	border-top-left-radius: 20px;
	border-top-right-radius: 20px;
	}

 #boxc2{
	background-color: lightgray; 
	opacity: 0.9;

	}
	
 #boxc3{
	background-color: palegreen; 
	border-bottom-left-radius: 15px;
	border-bottom-right-radius: 15px;
	}
	
	
</style>

<form method="post" action="">
<table id="table" width="500" height="400" border="1" style="margin-top: 50px; margin-left: auto; margin-right: auto; border-radius: 20px">
  <tbody>
    <tr>
       <td id="boxc1" colspan="3" style="border:none; font-family: Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'"><font size="7" color="red" align="center">Register</td>
    </tr>
    <tr>
      <td id="boxc2" align="center"><strong>Username</strong></td>
      <td id="boxc2"><input type="text" id="username" name="username"></td>
    </tr>
    <tr>
      <td id="boxc2" align="center"><strong>Email</strong></td>
      <td id="boxc2"><input type="text" id="email" name="email"></td>
    </tr>
    <tr>
      <td id="boxc2" align="center"><strong>Password</strong></td>
      <td id="boxc2"><input type="password" id="password_1" name="password_1"></td>
    </tr>
    <tr>
      <td id="boxc2" align="center"><strong>Confirm password</strong></td>
      <td id="boxc2"><input type="password" id="password_2" name="password_2"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="submit" id="submit" value="Register" style="background-color: white; font-size: 20px; width: 100px; color: blue"></td>
    </tr>
    <tr>
      <td colspan="2" id="boxc3"><font> Already a member? </font><a href="login.php">Sign in</a></td>
    </tr>
  </tbody>
</table>
</form>


