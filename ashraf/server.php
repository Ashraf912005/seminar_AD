<?php
require_once('server.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$errors = array();

// Database configuration
$db = mysqli_connect('localhost', 'root', '', 'ashraf');
// REGISTER USER
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // Validate form (check for empty fields, password match, etc.)
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) { array_push($errors, "Passwords do not match"); }

  // Check if user exists
  $user_check = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // If no errors, register the user
  if (count($errors) == 0) {
    $password = password_hash($password_1, PASSWORD_DEFAULT); // Securely hash password
    
    $query = "INSERT INTO users (username, email, password) 
              VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);

    // Set session variables and redirect
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "Registration successful!";
    header('Location: index.php'); // Redirect to index.php
    exit();
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password); // Consider using password_hash() instead
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('Location: index.php'); // Redirect to index.php
            exit();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Your existing server.php code...
?>