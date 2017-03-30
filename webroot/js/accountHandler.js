AccountHandler = (function() {
    var accountHandler = {};

    accountHandler.sendAjaxRequest = function(data, callback)
    {
        AjaxHandler.request("account", data, callback);
    };

    accountHandler.login = function() {
        var email = $("#loginEmail").val();
        var password = $("#loginPassword").val();

        accountHandler.setLoginLoad(true);
        accountHandler.setLoginError("");

        accountHandler.sendAjaxRequest('[{"type":"login","options":{"email":"' + email + '","password":"' + password + '"}}]', function(data) {
            accountHandler.loginCallback(data);
        });
    };

    accountHandler.loginCallback = function(data) {
        var success = (data.login.success === 1);

        if(!success) {
            accountHandler.setLoginError("* The email and/or password you entered are incorrect.");
            $("#loginPassword").val("");
            accountHandler.setLoginLoad(false);
        }
        else {
            window.location.href = SERVER_PATH + "account";
        }
    };

    accountHandler.setLoginLoad = function(state) {
        if(state)
        {
            $("#loginButton").addClass("hidden");
            $("#loginButtonLoading").removeClass("hidden");
        }
        else
        {
            $("#loginButton").removeClass("hidden");
            $("#loginButtonLoading").addClass("hidden");
        }
    };

    accountHandler.setLoginError = function(msg) {
        if(msg.length > 0)
        {
            $("#loginError").removeClass("hidden");
            $("#loginError").html("* The email and/or password you entered are incorrect.");
        }
        else
        {
            $("#loginError").addClass("hidden");
            $("#loginError").html("");
        }
    };

    accountHandler.logout = function() {
        accountHandler.sendAjaxRequest('[{"type":"logout"}]', function(data) {
            accountHandler.logoutCallback(data);
        });
    };

    accountHandler.logoutCallback = function() {
        window.location.href = SERVER_PATH + "products";
    };

    return accountHandler;
})();
