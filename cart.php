<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$products = [
    1 => ['name'=>'iPhone 13','price'=>8000000],
    2 => ['name'=>'iPhone 11','price'=>3500000],
    3 => ['name'=>'iPhone 12','price'=>6000000],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['qty'] as $id => $qty) {
        if ($qty <= 0) unset($_SESSION['cart'][$id]);
        else $_SESSION['cart'][$id] = $qty;
    }
}

$total = 0;
$content = "<form method='post'><table>
<tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>";

foreach ($_SESSION['cart'] as $id => $qty) {
    $subtotal = $products[$id]['price'] * $qty;
    $total += $subtotal;
    $content .= "
    <tr>
        <td>{$products[$id]['name']}</td>
        <td>Rp ".number_format($products[$id]['price'])."</td>
        <td><input type='number' name='qty[$id]' value='$qty' min='0'></td>
        <td>Rp ".number_format($subtotal)."</td>
    </tr>";
}

$content .= "
<tr>
    <td colspan='3'><strong>Total</strong></td>
    <td><strong>Rp ".number_format($total)."</strong></td>
</tr>
</table>
<button type='submit'>Update</button>
</form>
<a href='checkout.php'>Checkout</a>
";

$template = file_get_contents('template.html');
echo str_replace(['{{title}}','{{content}}'], ['Keranjang', $content], $template);
