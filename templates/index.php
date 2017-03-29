<?php
require_once '_header.php';
?>
<h1>My Great Shop</h1>

<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>(add to cart)</th>
    </tr>
    <?php
    //-----------------------------
    foreach($products as $product):
//-----------------------------
        ?>
        <tr>
            <td><?= $product['description'] ?></td>
            <td>&euro; <?= $product['price'] ?></td>
            <td><a href="/index.php?action=addToCart&id=<?= $product['id'] ?>">(add to cart)</a></td>
        </tr>

        <?php
//-----------------------------
    endforeach;
    //-----------------------------
    ?>
</table>
