<?php include('connect.php');
// Starting the session, necessary
// for using session variables
//session_start();

// Declaring and hoisting the variables
$first_name = "";
$last_name = "";
$username = "";
$errors = array();
$_SESSION['success'] = "";

// DBMS connection code -> hostname,
// username, password, database name
//$db = mysqli_connect('localhost', 'root', '', 'moko');

// Registration code
if (isset($_POST['reg_user'])) {

	$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
	$username = mysqli_real_escape_string($db, $_POST['username']);
	// $role_id = mysqli_real_escape_string($db, $_POST['role_id']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	// Ensuring that the user has not left any input field blank
	// error messages will be displayed for every blank input
	if (empty($first_name)) {
		array_push($errors, "First Name is required");
	}
	if (empty($last_name)) {
		array_push($errors, "Last Name is required");
	}
	if (empty($username)) {
		array_push($errors, "Email is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}

	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
		// Checking if the passwords match
	}
	$select = mysqli_query($db, "SELECT username FROM users WHERE username = '" . $_POST['username'] . "'") or exit(mysqli_error($db));
	if (mysqli_num_rows($select)) {
		header('location: login.php');
		exit('This email is already being used');
	}
	// If the form is error free, then register the user
	if (count($errors) == 0) {

		// Password encryption to increase data security
		$password = md5($password_1);

		// Inserting data into table
		$query = "INSERT INTO users (username,password,first_name,last_name)
				VALUES('$username', '$password','$first_name','$last_name')";

		mysqli_query($db, $query);

		// Storing username of the logged in user,
		// in the session variable
		$_SESSION['username'] = $username;

		// Welcome message
		$_SESSION['success'] = "You have logged in";

		// Page on which the user will be
		// redirected after logging in
		header('location: login.php');
	}
}

// User login
if (isset($_POST['login_user'])) {

	// Data sanitization to prevent SQL injection
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	// Error message if the input field is left blank
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}


	// Checking for the errors
	if (count($errors) == 0) {

		// Password matching
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username=
				'$username' AND password='$password'";
		$results = mysqli_query($db, $query);

		// $results = 1 means that one user with the
		// entered username exists
		if (mysqli_num_rows($results) > 0) {
			$row = mysqli_fetch_assoc($results);
			$cur_username = $row['username'];
			$cur_password = $row['password'];
			$cur_status = $row['status'];
			$cur_first_name = $row['first_name'];
			$cur_company_id = $row['company_id'];
			$cur_role_id = $row['role_id'];
			$cur_status = $row['status'];
			$cur_usertype = $row['user_type_id'];

			if ($cur_status == "3" && $cur_username == $username  && $cur_password == $password) {
				// Storing username in session variable
				$_SESSION['username'] = $username;

				// Welcome message
				$_SESSION['success'] = 'Welcome ' . $cur_first_name . '.';

				// Page on which the user is sent
				// to after logging in
				header('location: new.php');
			} else if ($cur_status == 1 && $cur_role_id == 5  && $cur_username == $username && $cur_password == $password) {
				// Storing username in session variable
				$_SESSION['username'] = $username;

				// Welcome message
				$_SESSION['success'] = 'Welcome ' . $cur_first_name . '.';

				// Page on which the user is sent
				// to after logging in
				header('location: sales.php');
			} else if ($cur_status == 1 && $cur_role_id == 4  && $cur_username == $username && $cur_password == $password) {
				// Storing username in session variable
				$_SESSION['username'] = $username;

				// Welcome message
				$_SESSION['success'] = 'Welcome ' . $cur_first_name . '.';

				// Page on which the user is sent
				// to after logging in
				header('location: team.php');
			}  else {
				// If the username and password doesn't match
				array_push($errors, "Username or password incorrect");
			}
		} else {
			// If the username and password doesn't match
			array_push($errors, "User does not exists");
		}
	}
}
