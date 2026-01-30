<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'ibra' && $_POST['password'] === '123') {
        $_SESSION['login'] = true;
        $_SESSION['username'] = 'admin';
        $_SESSION['cart'] = [];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau Password salah!';
    }
}

$content = "
<h2>Login</h2>
<form method='post'>
    <input type='text' name='username' placeholder='Username' required><br><br>
    <input type='password' name='password' placeholder='Password' required><br><br>
    <button type='submit'>Login</button>
</form>
<p style='color:red'>$error</p>
";

$template = file_get_contents('template.html');
echo str_replace(['{{title}}','{{content}}'], ['Login', $content], $template);
