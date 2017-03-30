Cart = (function()
{
    var private, Cart = {};

    Cart.addItemToCart = function(data)
    {
        $.ajax({
            type: "post",
            url: "webroot/ajax/cart.php?action=add&data=" + data,
            dataType: "json",
            success: function(data) {
                Cart.fillMiniCart(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log("Ajax request failed: " + textStatus + ", " + errorThrown);
            },
        });
    };

    Cart.fillMiniCart = function(data)
    {
        var html = "";
        var total = 0;

        for (var key in data)
        {
            var prod = JSON.parse(data[key].data);

            html += "<div class = \"item\">";

            html +=     "<div class = \"left\">";
            html +=        "<span class = \"quantity\">" + data[key].qty + "</span> " + prod.name;
            html +=     "</div>";

            html +=     "<div class = \"right price\">";
            html +=        "$" + prod.priceCost;
            html +=     "</div>";

            html +=     "<div class = \"clear\"></div>";

            html += "</div>";

            total += prod.priceCost * data[key].qty;
        }

        html += "<div class = \"item total\">";
        html +=     "Total: $" + total.toFixed(2);
        html += "</div>";
        html += "<div class = \"clear\"></div>";

        $("#mini-cart").html(html);
    };

    return Cart;
})();
