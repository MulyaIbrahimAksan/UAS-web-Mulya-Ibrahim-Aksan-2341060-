<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$content = "
<h2>Dashboard</h2>
<p>Selamat datang, <strong>{$_SESSION['username']}</strong></p>

<ul>
    <li><a href='index.php'>Daftar Produk</a></li>
    <li><a href='cart.php'>Keranjang</a></li>
    <li><a href='logout.php'>Logout</a></li>
</ul>
";

$template = file_get_contents('template.html');
echo str_replace(['{{title}}','{{content}}'], ['Dashboard', $content], $template);
