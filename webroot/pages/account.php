<div class = "account-wrapper">
    <div class = "account-header">
        <div class = "account-header-title left">
            Account
        </div>
        <div class = "account-header-nav right">
            <div class = "account-header-nav-item left">
                <a href = "<?= SERVER_PATH ?>account/orders">Orders</a>
            </div>
            <div class = "account-header-nav-item left">
                <a href = "<?= SERVER_PATH ?>account/products">Products</a>
            </div>
            <div class = "account-header-nav-item left">
                <a href = "<?= SERVER_PATH ?>account/logout" onClick = "AccountHandler.logout(); return false;">Logout</a>
            </div>
            <div class = "clear"></div>
        </div>
        <div class = "clear"></div>
    </div>

    <?php
        include(isset($subpage) ? $subpage : "webroot/pages/account/orders.php");
     ?>
</div>
