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
</div>

<div id = "products-edit" class = "products">
    <div class = "items">
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
</div>
