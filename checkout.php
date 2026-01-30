<?php
session_start();
if (!isset($_SESSION['login']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

$total = 0;
$prices = [1=>8000000,2=>3500000,3=>6000000];
foreach ($_SESSION['cart'] as $id=>$qty) {
    $total += $prices[$id]*$qty;
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $_SESSION['cart']=[];
    $content="<h3>Pembayaran berhasil!</h3>
    <p>Total: Rp ".number_format($total)."</p>
    <a href='index.php'>Belanja Lagi</a>";
} else {
    $content="<p>Total Bayar: <strong>Rp ".number_format($total)."</strong></p>
    <form method='post'><button>Bayar</button></form>";
}

$template=file_get_contents('template.html');
echo str_replace(['{{title}}','{{content}}'],['Checkout',$content],$template);
