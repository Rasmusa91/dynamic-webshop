Webshop = (function() {
    var private, Webshop = {};

    Webshop.sendAjaxRequest = function(data, callback)
    {
        console.log("webroot/ajax/webshop.php?data=" + data);
        $.ajax({
            type: "post",
            url: "webroot/ajax/webshop.php?data=" + data,
            dataType: "json",
            success: function(data) {
                //console.log(data);
                callback(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log("Ajax request failed: " + textStatus + ", " + errorThrown);
            },
        });
    };

    Webshop.getProductsAndCart = function()
    {
        Webshop.Products.setLoadingActive(true);
        Webshop.Cart.setLoadingActive(true);

        var prodJson = Webshop.Products.getQuery();
        var cartJson = Webshop.Cart.getQuery();

        Webshop.sendAjaxRequest('[' + cartJson + ',' + prodJson + ']', function(data) {
            Webshop.Products.productsRetrievedCallback(data.products);
            Webshop.Cart.fill(data.cart);
        });
    };

    Webshop.getCart = function()
    {
        Webshop.Cart.setLoadingActive(true);

        var cartJson = Webshop.Cart.getQuery();

        Webshop.sendAjaxRequest('[' + cartJson + ']', function(data) {
            Webshop.Cart.fill(data.cart);
        });
    };

    Webshop.Products = (function()
    {
        var private, Products = {};

        Products.page = 1;
        Products.retrievedItems = 0;
        Products.totalItems = 0;
        Products.filters = {
            query : "",
            categories : [],
            units : []
        };

        Products.filter = function()
        {
            Products.get({
                query : Products.filters.query,
                reset : true,
                page : 1,
                cats : Products.filters.categories,
                units : Products.filters.units
            });
        };

        Products.filterSearch = function(query)
        {
            Products.filters.query = query;
            Products.filter();
        };

        Products.filterCategory = function(id, value)
        {
            var index = Products.filters.categories.indexOf(id);

            if(value)
            {
                if(index === -1) {
                    Products.filters.categories.push(id);
                }
            }
            else
            {
                if(index !== -1) {
                    Products.filters.categories.splice(index, 1);
                }
            }

            Products.filter();
        };

        Products.filterUnit = function(id, value)
        {
            var index = Products.filters.units.indexOf(id);

            if(value)
            {
                if(index === -1) {
                    Products.filters.units.push(id);
                }
            }
            else
            {
                if(index !== -1) {
                    Products.filters.units.splice(index, 1);
                }
            }

            Products.filter();
        };

        Products.loadMore = function() {
            Products.get({
                page : Products.page
            });
        };

        Products.get = function(options)
        {
            Products.setLoadingActive(true);

            var q = '[' + Products.getQuery(options) + ']';
            Webshop.sendAjaxRequest(q, function(data) {
                Products.productsRetrievedCallback(data.products, options.reset);
            });
        };

        Products.getQuery = function(options)
        {
            if(typeof(options) === "undefined") {
                options = {};
            }

            var defaults = {
                query : "",
                reset : false,
                page : 1,
                cats : [],
                units : []
            };

            for(var k in defaults)
            {
                if(typeof(options[k]) === "undefined") {
                    options[k] = defaults[k];
                }
            }

            return '{"type":"products","options":' + JSON.stringify(options) + '}';
        };

        Products.productsRetrievedCallback = function(data, reset)
        {
            Products.fill(data.items, reset);

            if(!reset) {
                Products.page += 1;
            }
            else {
                Products.page = 2;
            }

            Products.totalItems = data.total;

            $("#productsStatus").html("Showing <b>" + Products.retrievedItems + "</b> out of <b>" + Products.totalItems + "</b> found items");

            if(Products.retrievedItems == Products.totalItems) {
                $("#productsLoadMore").addClass("hidden");
            }
            else {
                $("#productsLoadMore").removeClass("hidden");
            }
        };

        Products.fill = function(data, reset)
        {
            var html = $("#products-content").html();

            if(reset) {
                html = "";
                Products.retrievedItems = 0;
            }

            data.forEach(function(d) {
                html += Products.getItemHTML(d);
                Products.retrievedItems++;
            });

            $("#products-content").html(html);

            Products.setLoadingActive(false);
        };

        Products.getItemHTML = function(data)
        {
            var html = '';

            html += '<div class = "item">';
            html +=     '<div class = "image left">';
            html +=         '<img src = "webroot/img/placeholder.png">';
            html +=     '</div>';
            html +=     '<div class = " info left">';
            html +=         '<div class = "name">';
            html +=             data.name;
            html +=         '</div>';
            html +=         '<div class = "rest">';
            html +=             data.category;
            html +=         '</div>';
            html +=         '<div class = "rest">';
            html +=             data.unit;
            html +=         '</div>';
            html +=     '</div>';
            html +=     '<div class = "price right">';
            html +=         '<div class = "name">';
            html +=             '$' + data.priceCost;
            html +=         '</div>';
            html +=         '<div class = "rest">';
            html +=             'Sell for: $' + data.priceSales;
            html +=         '</div>';
            html +=         '<div class = "rest">';
            html +=             'Profit: $' + (data.priceSales - data.priceCost).toFixed(2);
            html +=         '</div>';
            html +=     '</div>';
            html +=     '<div class = "clear"></div>';
            html +=     '<div class = "add">';
            html +=         '<div class = "right">';
            html +=             '<div class = "button" onClick = "Webshop.Cart.add(\'' + (JSON.stringify(data)).split("\"").join("&quot;") + '\'); return false;">Add to cart</a> &nbsp;<i class="fa fa-plus"></i></div>';
            //html +=             '<a href = "#" onClick = "Webshop.Cart.add(\'' + (JSON.stringify(data)).split("\"").join("&quot;") + '\'); return false;">Add to cart</a> &nbsp;<i class="fa fa-plus"></i>';
            html +=         '</div>';
            //html +=         '<div class = "right">';
            //html +=             '<a href = "">Add to favorites</a> &nbsp;<i class="fa fa-star-o"></i>';
            //html +=         '</div>';
            html +=         '<div class = "clear"></div>';
            html +=     '</div>';
            html += '</div>';

            return html;
        };

        Products.setLoadingActive = function(p_State)
        {
            if(p_State)
            {
                $("#productsLoading").removeClass("hidden");
                $("#productsStatus").addClass("hidden");

                $("#productsLoadingMoreIcon").removeClass("hidden");
                $("#productsLoadMoreText").addClass("hidden");
            }
            else
            {
                $("#productsStatus").removeClass("hidden");
                $("#productsLoading").addClass("hidden");

                $("#productsLoadingMoreIcon").addClass("hidden");
                $("#productsLoadMoreText").removeClass("hidden");
            }
        };

        return Products;
    })();

    Webshop.Cart = (function()
    {
        var private, Cart = {};

        Cart.add = function(data)
        {
            Cart.setLoadingActive(true);

            Webshop.sendAjaxRequest('[{"type":"cart","options":{"action":"add","item":' + data + '}}]', function(data) {
                Cart.fill(data.cart);
            });
        };

        Cart.remove = function(id) {
            Cart.setLoadingActive(true);

            Webshop.sendAjaxRequest('[{"type":"cart","options":{"action":"remove","id":' + id + '}}]', function(data) {
                Cart.fill(data.cart);
            });
        };

        Cart.reset = function() {
            Cart.setLoadingActive(true);

            Webshop.sendAjaxRequest('[{"type":"cart","options":{"action":"reset"}}]', function(data) {
                Cart.fill(data.cart);
            });
        };

        Cart.get = function()
        {
            Cart.setLoadingActive(true);

            Webshop.sendAjaxRequest('[' + Cart.getQuery() + ']', function(data) {
                Cart.fill(data.cart);
            });
        };

        Cart.getQuery = function() {
            return '{"type":"cart","options":{"action":"get"}}';
        };

        Cart.fill = function(data) {
            if($("#cart-content").length) {
                Cart.fillCart(data);
            }
            if($("#minicart-content").length) {
                Cart.fillMiniCart(data);
            }
        };

        Cart.fillCart = function(data)
        {
            var html = "";
            var total = 0;
            var amount = 0;

            for (var key in data)
            {
                var prod = data[key].data;

                html += "<div class = \"webshop-cart-items webshop-cart-row\">";
                html +=     "<div class = \"webshop-cart-items-item webshop-cart-cell qty\">";
                html +=         "<input>";
                html +=     "</div>";
                html +=     "<div class = \"webshop-cart-items-item webshop-cart-cell item\">";
                html +=         "Beer";
                html +=     "</div>";
                html +=     "<div class = \"webshop-cart-items-item webshop-cart-cell u-price\">";
                html +=         "2";
                html +=     "</div>";
                html +=     "<div class = \"webshop-cart-items-item webshop-cart-cell t-price\">";
                html +=         "20";
                html +=     "</div>";
                html += "</div>";


/*
                html += "<div class = \"item\">";

                html +=     "<div class = \"left\">";
                html +=        "<span class = \"quantity\">" + data[key].qty + "</span> " + prod.name;
                html +=     "</div>";

                html +=     "<div class = \"right remove\" onClick = \"Webshop.Cart.remove(" + prod.id + ");\">";
                html +=        "<i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i>"
                html +=     "</div>";

                html +=     "<div class = \"right price\">";
                html +=        "$" + prod.priceCost;
                html +=     "</div>";

                html +=     "<div class = \"clear\"></div>";

                html += "</div>";
*/
                total += prod.priceCost * data[key].qty;
                amount++;
            }

            $("#cart-content").html(html);
            $("#header-cart-amount").html(amount);

            Cart.setLoadingActive(false);
        };

        Cart.fillMiniCart = function(data)
        {
            console.log("asd");
            var html = "";
            var total = 0;
            var amount = 0;

            for (var key in data)
            {
                var prod = data[key].data;

                html += "<div class = \"item\">";

                html +=     "<div class = \"left\">";
                html +=        "<span class = \"quantity\">" + data[key].qty + "</span> " + prod.name;
                html +=     "</div>";

                html +=     "<div class = \"right remove\" onClick = \"Webshop.Cart.remove(" + prod.id + ");\">";
                html +=        "<i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i>"
                html +=     "</div>";

                html +=     "<div class = \"right price\">";
                html +=        "$" + prod.priceCost;
                html +=     "</div>";

                html +=     "<div class = \"clear\"></div>";

                html += "</div>";

                total += prod.priceCost * data[key].qty;
                amount++;
            }

            html += "<div class = \"item total\">";
            html +=     "<div class = \"right\">";
            html +=         "Total: $" + total.toFixed(2);
            html +=     "</div>";
            html +=     "<div class = \"clear\"></div>";
            html += "</div>";

            html += "<div class = \"item total\">";
            html +=     "<div class = \"left\">";
            html +=         "<div class = \"button red\" onClick = \"Webshop.Cart.reset(); return false;\">Reset</div>";
            html +=     "</div>";
            html +=     "<div class = \"right\">";
            html +=         "<div class = \"button\">Checkout</div>";
            html +=     "</div>";
            html +=     "<div class = \"clear\"></div>";

            html += "</div>";

            $("#minicart-content").html(html);
            $("#header-cart-amount").html(amount);

            Cart.setLoadingActive(false);
        };

        Cart.setLoadingActive = function(p_State)
        {
            if(p_State) {
                $("#cartIcon").addClass("hidden");
                $("#cartLoading").removeClass("hidden");
            }
            else {
                $("#cartIcon").removeClass("hidden");
                $("#cartLoading").addClass("hidden");
            }
        };

        return Cart;
    })();

    return Webshop;
})();
