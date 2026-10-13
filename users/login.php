<?php
require('db.php');
session_start();
if (isset($_SESSION['user_id'])) { header("Location: index.php"); exit(); }

$error = '';
$notice = isset($_GET['registered']) ? 'Account created. You can log in now.' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') {
        $error = 'Please enter your username and password.';
    } else {
        $stmt = mysqli_prepare($con, "SELECT id, username, password FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        if ($row && password_verify($password, $row['password'])) {
            session_regenerate_id(true);
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id']  = (int)$row['id'];
            header("Location: index.php");
            exit();
        }
        $error = 'Incorrect username or password.';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Click And Sip Cafe | Login Form</title>
        <link rel="stylesheet" href="../assets/css/login.css"/>
    </head>
    <body>
        <form class="form" method="post" name="login" autocomplete="on">
            <center>
                <img src="../assets/images/logo.jpg" alt="Click And Sip Cafe logo" class="img img-fluid">
            </center>
            <hr />
            <h1 class="login-title">Login</h1>
            <?php if ($notice): ?><p class="notice"><?php echo htmlspecialchars($notice); ?></p><?php endif; ?>
            <?php if ($error): ?><p class="error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
            <input type="text" class="login-input" name="username" placeholder="Username" autofocus required
                   value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"/>
            <input type="password" class="login-input" name="password" placeholder="Password" required/>
            <input type="submit" value="Login" name="submit" class="login-button"/>
            <p class="link">Don't have an account? <a href="registration.php">Register here!</a></p>
            <p class="link"><a href="../index.php">Back to the shop</a></p>
        </form>
    </body>
</html>
