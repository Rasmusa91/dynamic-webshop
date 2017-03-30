<?php
    $cart = (isset($_SESSION["cart"]) ? $_SESSION["cart"] : []);
?>

<div class = "header">
    <div class = "title left">
        <span class = "color">Dynamic</span>Shop
    </div>

    <div class = "nav right">
        <div class = "left">
            <a href = "<?= SERVER_PATH; ?>products">Products</a>
        </div>
        <div class = "cart left hidden">
            <div class = "left">
                <a href = "<?= SERVER_PATH; ?>cart">Cart</a>
            </div>

            <div class = "amount">
                <div class = "amount-left left">&nbsp;</div>
                <div id = "header-cart-amount" class = "amount-center left"><?= count($cart); ?></div>
                <div class = "amount-right left">&nbsp;</div>
                <div class = "clear"></div>
            </div>
        </div>
        <div class = "left">
            <?php if(!$controllers->get("account")->isLoggedIn()): ?>
                <a href = "<?= SERVER_PATH; ?>login">Login <i class="fa fa-lock" aria-hidden="true"></i></a>
            <?php else: ?>
                <a href = "<?= SERVER_PATH; ?>account">Account</i></a>
            <?php endif; ?>
        </div>
        <div class = "clear"></div>
    </div>

    <div class = "clear"></div>
</div>
