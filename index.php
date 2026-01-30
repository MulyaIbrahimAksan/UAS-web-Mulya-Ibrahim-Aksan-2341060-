<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$products = [
    1 => ['name'=>'iPhone 13','price'=>8000000,'image'=>'images/iphone13.jpg'],
    2 => ['name'=>'iPhone 11','price'=>3500000,'image'=>'images/iphone11.jpg'],
    3 => ['name'=>'iPhone 12','price'=>6000000,'image'=>'images/iphone12.jpg'],
];

if (isset($_POST['product_id'])) {
    $id = (int)$_POST['product_id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header('Location: index.php');
    exit;
}

$content = "<div class='product-list'>";
foreach ($products as $id => $p) {
    $content .= "
    <div class='product-card'>
        <img src='{$p['image']}'>
        <h3>{$p['name']}</h3>
        <p>Rp ".number_format($p['price'])."</p>
        <form method='post'>
            <input type='hidden' name='product_id' value='$id'>
            <button type='submit'>Tambah ke Keranjang</button>
        </form>
    </div>";
}
$content .= "</div>
<a href='cart.php'>Lihat Keranjang (".array_sum($_SESSION['cart']).")</a>
";

$template = file_get_contents('template.html');
echo str_replace(['{{title}}','{{content}}'], ['Produk', $content], $template);
