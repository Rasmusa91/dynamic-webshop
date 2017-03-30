var ProductItem = function(data) {
    this.data = data;
    this.tempData = jQuery.extend(true, {}, this.data);

};

ProductItem.prototype = {
    render : function(edit) {
        $("#product-item-" + this.data.id).html(this.getInnerHTML(edit));
    },
    getHTML : function(edit) {
        var html = '';

        html += '<div id = "product-item-' + this.data.id + '" class = "item">';
        html += this.getInnerHTML(edit);
        html += '</div>';

        return html;
    },
    getInnerHTML : function(edit) {
        var html = '';

        html +=     '<div class = "image left">';
        html +=         '<img id = "product-item-image-' + this.data.id + '" src = "' + SERVER_PATH + 'webroot/img/placeholder.png">';

        if(edit)
        {
            html +=         '<div class = "edit hidden">';
            html +=             '<input id = "product-item-image-upload-' + this.data.id + '" class = "file" type = "file" onChange = "FileUploadHandler.Upload(this, \'product-item-image-' + this.data.id + '\');" accept="image/*">';
            html +=             '<div class = "upload" onClick = "$(\'#product-item-image-upload-' + this.data.id + '\').click();">';
            html +=                 '<i class="fa fa-cloud-upload" aria-hidden="true"></i>';
            html +=             '</div>';
            html +=         '</div>';
        }

        html +=     '</div>';
        html +=     '<div class = " info left">';
        html +=         '<div class = "name">';

        if(edit)
        {
            html +=             '<div class = "not-edit">';
            html +=                     this.data.name;
            html +=             '</div>';
            html +=             '<div class = "edit hidden">';
            html +=                 '<input onKeyUp = "Webshop.Products.getItem(' + this.data.id + ').editField(\'name\', this);" value = "' + this.data.name + '"> Name';
            html +=             '</div>';
        }
        else
        {
            html +=                     this.data.name;
        }

        html +=         '</div>';
        html +=         '<div class = "rest">';

        if(edit)
        {
            html +=             '<div class = "not-edit">';
            html +=                 this.data.category;
            html +=             '</div>';
            html +=             '<div class = "edit hidden">';
            html +=                 '<input onKeyUp = "Webshop.Products.getItem(' + this.data.id + ').editField(\'category\', this);" value = "' + this.data.category + '"> Category';
            html +=             '</div>';
        }
        else
        {
            html +=                 this.data.category;
        }

        html +=         '</div>';
        html +=         '<div class = "rest">';

        if(edit)
        {
            html +=             '<div class = "not-edit">';
            html +=                 this.data.unit;
            html +=             '</div>';
            html +=             '<div class = "edit hidden">';
            html +=                 '<input onKeyUp = "Webshop.Products.getItem(' + this.data.id + ').editField(\'unit\', this);" value = "' + this.data.unit + '"> Unit';
            html +=             '</div>';
        }
        else
        {
            html +=                 this.data.unit;
        }

        html +=         '</div>';
        html +=     '</div>';
        html +=     '<div class = "price right">';
        html +=         '<div class = "name">';

        if(edit)
        {
            html +=             '<div class = "not-edit">';
            html +=                 '$' + this.data.priceCost;
            html +=             '</div>';
            html +=             '<div class = "edit hidden">';
            html +=                 'Price $<input onKeyUp = "Webshop.Products.getItem(' + this.data.id + ').editField(\'priceCost\', this);" value = "' + this.data.priceCost + '">';
            html +=             '</div>';
        }
        else
        {
            html +=                 '$' + this.data.priceCost;
        }

        html +=         '</div>';
        html +=         '<div class = "rest">';

        if(edit)
        {
            html +=             '<div class = "not-edit">';
            html +=                 'Sell for: $' + this.data.priceSales;
            html +=             '</div>';
            html +=             '<div class = "edit hidden">';
            html +=                 'Sell for $<input onKeyUp = "Webshop.Products.getItem(' + this.data.id + ').editField(\'priceSales\', this);" value = "' + this.data.priceSales + '">';
            html +=             '</div>';
        }
        else
        {
            html +=                 'Sell for: $' + this.data.priceSales;
        }

        html +=         '</div>';
        html +=         '<div id = "product-item-image-profit-' + this.data.id + '" class = "rest">';
        html +=             'Profit: $' + (this.data.priceSales - this.data.priceCost).toFixed(2);
        html +=         '</div>';
        html +=     '</div>';
        html +=     '<div class = "clear"></div>';
        html +=     '<div>';

        if(edit)
        {
            html +=             '<div class = "not-edit">';
            html +=                 '<div class = "right">';
            html +=                     '<div class = "button red" onClick = "">Remove</a> &nbsp;<i class="fa fa-times"></i></div>';
            html +=                 '</div>';
            html +=                 '<div class = "right">';
            html +=                     '<div class = "button yellow" onClick = "Webshop.Products.getItem(' + this.data.id + ').edit(true);">Edit</a> &nbsp;<i class="fa fa-pencil-square-o"></i></div>';
            html +=                 '</div>';
            html +=             '</div>';
            html +=             '<div class = "edit hidden">';
            html +=                 '<div class = "right">';
            html +=                     '<div class = "button red" onClick = "Webshop.Products.getItem(' + this.data.id + ').cancelEdit();">Cancel</a></div>';
            html +=                 '</div>';
            html +=                 '<div class = "right">';
            html +=                     '<div class = "button green" onClick = "">Save</a></div>';
            html +=                 '</div>';
            html +=             '</div>';
        }
        else
        {
            html +=         '<div class = "right">';
            html +=             '<div class = "button green" onClick = "Webshop.Cart.add(\'' + (JSON.stringify(this.data)).split("\"").join("&quot;") + '\'); return false;">Add to cart</a> &nbsp;<i class="fa fa-plus"></i></div>';
            html +=         '</div>';
        }

        html +=         '<div class = "clear"></div>';
        html +=     '</div>';

        return html;
    },
    edit : function(p_State)
    {
        if(p_State)
        {
            $("#product-item-" + this.data.id).addClass("edit");
        }
        else
        {
            $("#product-item-" + this.data.id).removeClass("edit");
        }

        $("#product-item-" + this.data.id + " .edit").each(function(index) {
            if(p_State)
            {
                $(this).removeClass("hidden");
            }
            else
            {
                $(this).addClass("hidden");
            }
        });
        $("#product-item-" + this.data.id + " .not-edit").each(function(index) {
            if(p_State)
            {
                $(this).addClass("hidden");
            }
            else
            {
                $(this).removeClass("hidden");
            }
        });
    },
    editField : function(p_Field, p_Value) {
        this.tempData[p_Field] = p_Value.value;

        if(p_Field === "priceCost" || p_Field === "priceSales") {
            this.updateProfitField();
        }
    },
    updateProfitField : function() {
        var val = (this.tempData.priceSales - this.tempData.priceCost).toFixed(2);

        if(!isNaN(val)) {
            $("#product-item-image-profit-" + this.data.id).removeClass("error-small");
            $("#product-item-image-profit-" + this.data.id).html("Profit: $" + val);
        }
        else {
            $("#product-item-image-profit-" + this.data.id).addClass("error-small");
            $("#product-item-image-profit-" + this.data.id).html("* Enter a valid number!");
        }
    },
    cancelEdit : function() {
        this.edit(false);
        this.tempData = jQuery.extend(true, {}, this.data);
        this.render(true);
    }
};
