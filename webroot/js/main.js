$(document).ready(function()
{
    if($("#products").length && $("#cart").length) {
        Webshop.getProductsAndCart();
    }
    else if($("#cart")) {
        Webshop.getCart();
    }
});
