<?php
require('db.php');
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $username === '' || $email === '' || $password === '') {
        $error = 'Please fill in all fields.';
    } elseif (!preg_match('/^[A-Za-z0-9_.]{3,30}$/', $username)) {
        $error = 'Username must be 3 to 30 letters, numbers, dots or underscores.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        $stmt = mysqli_prepare($con, "SELECT id FROM users WHERE username = ? OR email = ?");
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        if (mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))) {
            $error = 'That username or email is already registered.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $now  = date("Y-m-d H:i:s");
            $ins  = mysqli_prepare($con, "INSERT INTO users (name, username, email, password, create_datetime) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($ins, "sssss", $name, $username, $email, $hash, $now);
            if (mysqli_stmt_execute($ins)) {
                header("Location: login.php?registered=1");
                exit();
            }
            $error = 'Could not create the account. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Click And Sip Cafe | Registration Form</title>
        <link rel="stylesheet" href="../assets/css/login.css"/>
    </head>
    <body>
        <form class="form" action="" method="post">
            <center>
                <img src="../assets/images/logo.jpg" alt="Click And Sip Cafe logo" class="img img-fluid">
            </center>
            <hr />
            <h1 class="login-title">Registration</h1>
            <?php if ($error): ?><p class="error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
            <input type="text" class="login-input" name="name" placeholder="Name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" />
            <input type="text" class="login-input" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" />
            <input type="email" class="login-input" name="email" placeholder="Email Address" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            <input type="password" class="login-input" name="password" placeholder="Password (at least 6 characters)" required>
            <input type="submit" name="submit" value="Register" class="login-button">
            <p class="link">Already have an account? <a href="login.php">Login here!</a></p>
        </form>
    </body>
</html>
