<?php

declare(strict_types=1);

include_once 'includes/header.php';

$pdo = new PDO('sqlite:includes/databas.sql');

  if (isset($_POST['first'], $_POST['last'], $_POST['email'], $_POST['pwd'])) {
    $first = filter_var($_POST['first'], FILTER_SANITIZE_STRING);
    $last = filter_var($_POST['last'], FILTER_SANITIZE_STRING);
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $username = filter_var($_POST['uid'], FILTER_SANITIZE_STRING);
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare('INSERT INTO users (user_firstname, user_lastname, user_email, user_username, user_password)
    VALUES (:user_firstname, :user_lastname, :user_email, :user_username, :user_password)');

    $result = $statement->execute(array(
      ':user_firstname' => $first,
      ':user_lastname' => $last,
      ':user_email' => $email,
      ':user_username' => $username,
      ':user_password' => $pwd
    ));

    if ($result) {
      echo "Your account has been added successfully!";
    } else {
      echo "Account could not be created.";
    }

    header('Location: /index.php');
}

?>

<section class="bodyContainer">
  <div class="bodyWrapper">
    <h2>Signup</h2>
    <form class="signupForm" action="signup.php" method="POST">
      <input type="text" name="first" placeholder="Firstname" autocomplete="on">
      <input type="text" name="last" placeholder="Lastname" autocomplete="on">
      <input type="text" name="email" placeholder="E-mail" autocomplete="on">
      <input type="text" name="uid" placeholder="Username" autocomplete="on">
      <input type="password" name="pwd" placeholder="Password" autocomplete="off">
      <button type="submit" name="submit">Sign Up</button>
    </form>
  </div>
</section>


<?php
include_once 'includes/footer.php';
?>