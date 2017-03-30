FileUploadHandler = (function() {
    var fileUploadHandler = {};

    fileUploadHandler.Upload = function(e, img) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#" + img).attr("src", e.target.result);
        };
        reader.readAsDataURL(e.files[0]);
    };

    return fileUploadHandler;
})();
