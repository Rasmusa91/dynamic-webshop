AjaxHandler = (function() {
    var ajaxHandler = {};

    ajaxHandler.request = function(file, data, callback)
    {
        console.log("https://lazy-devs.com/dynamicShop/webroot/ajax/" + file + ".php?data=" + data);
        $.ajax({
            type: "post",
            url: "https://lazy-devs.com/dynamicShop/webroot/ajax/" + file + ".php?data=" + data,
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

    return ajaxHandler;
})();
