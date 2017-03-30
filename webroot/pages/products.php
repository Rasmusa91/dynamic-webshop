<?php
    $categories = $controllers->get("products")->getCategories();
    $units = $controllers->get("products")->getUnits();
 ?>

<div class = "filter">
    <div id = "prod-filter-search" class = "search">
        <div class = "icon left">
            <i class="fa fa-search"></i>
        </div>
        <div class = "input left">
            <input id = "searchInput" placeholder = "Search..." onKeyUp = "Webshop.Products.filterSearch(this.value);" onFocus = "$('#prod-filter-search').addClass('focus');" onBlur = "$('#prod-filter-search').removeClass('focus');">
        </div>
        <div class = "clear"></div>
    </div>

    <div class = "categories">
        <div class = "top">
            <div class = "title left">Categories</div>
            <div class = "expand right"><i class="fa fa-filter"></i></div>
            <div class = "clear"></div>
        </div>
        <div class = "bottom">
            <?php foreach($categories as $cat): ?>
                <div class = "cat left">
                    <div class = "left cat-check">
                        <input type = "checkbox" onChange = "Webshop.Products.filterCategory('<?= $cat->id; ?>', this.checked)">
                    </div>
                    <div class = "left cat-name">
                        <?= $cat->name; ?>
                    </div>
                    <div class = "clear"></div>
                </div>
            <?php endforeach; ?>
            <div class = "clear"></div>
        </div>
    </div>

    <div class = "categories">
        <div class = "top">
            <div class = "title left">Units</div>
            <div class = "expand right"><i class="fa fa-filter"></i></div>
            <div class = "clear"></div>
        </div>
        <div class = "bottom">
            <?php foreach($units as $cat): ?>
                <div class = "cat left">
                    <div class = "left cat-check">
                        <input type = "checkbox" onChange = "Webshop.Products.filterUnit('<?= $cat->id; ?>', this.checked)">
                    </div>
                    <div class = "left cat-name">
                        <?= $cat->name; ?>
                    </div>
                    <div class = "clear"></div>
                </div>
            <?php endforeach; ?>
            <div class = "clear"></div>
        </div>
    </div>
</div>

<div id = "products" class = "products">
    <div class = "items left">
        <div class = "header">
            <div class = "products-header-title left">
                Items
            </div>
            <div id = "productsLoading" class = "status right hidden">
                <i class="fa fa-spinner rotate"></i>
            </div>
            <div id = "productsStatus" class = "status right">
                Showing 0 out of 10 found items
            </div>
            <div class = "clear"></div>
        </div>
        <div id = "products-content" class = "content">
        </div>
        <div id = "productsLoadMore" class = "load hidden" onClick = "Webshop.Products.loadMore();">
            <div id = "productsLoadMoreText">
                Load more products
            </div>
            <div id = "productsLoadingMoreIcon" class = "hidden">
                <i class="fa fa-spinner rotate"></i>
            </div>
        </div>
    </div>

    <div id = "cart" class = "cart right">
        <div class = "header">
            <div class = "products-header-title left">
                Cart
            </div>
            <div id = "cartLoading" class = "status right">
                <i class="fa fa-spinner rotate"></i>
            </div>
            <div id = "cartIcon" class = "status right">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <div class = "clear"></div>
        </div>
        <div id = "minicart-content" class = "content"></div>
    </div>

    <div class = "clear"></div>
</div>
