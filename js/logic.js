$(document).ready(function() {
    var unavailable = function(id) {
        if ($(id).children().length < 2) {
            $(id).attr("disabled", "disabled");
        } else {
            $(id).removeAttr("disabled");
        }
    };
    var update_lamination = function(product, material, density, cover) {
        var lamination;
        if (cover == "")
            lamination = $("#lamination");
        else
            lamination = $("#cover-lamination");
//        alert(product + " " + material + " " + density + " " + cover);
        $(lamination).load("update_lamination.php?product=" + product + "&material=" + material + "&density=" + density + cover, function() {
            unavailable(lamination);
        });
    };
    var update_formats = function() {
        var current_format = $("#format-product").val();
        var format = current_format.split("x");
        $("#format-width").val(format[1]);
        $("#format-height").val(format[0]);
        unavailable("#format-product");
    };
    var update_surface = function(surface, cover, product) {
        var material;
        if (cover == "")
            material = $("#material").val();
        else
            material = $("#cover-material").val();
        $(surface).load("update_surface.php?product=" + product + "&material=" + material + cover, function() {
            unavailable(surface);
        });
    };
    var update_density = function(density, cover, product) {
        var material;
        if (cover == "")
            material = $("#material").val();
        else
            material = $("#cover-material").val();
        $(density).load("update_density.php?product=" + product + "&material=" + material + cover, function() {
            unavailable(density);
            update_lamination(product, material, $(density).val(), cover);
        });
    };
    var update_material = function(product, cover) {
        var material, surface, density;
        if (cover == "") {
            material = "#material";
            surface = "#surface";
            density = "#density";
        } else {
            material = "#cover-material";
            surface = "#cover-surface";
            density = "#cover-density";
        }
        unavailable($(material));
        update_surface(surface, cover, product);
        update_density(density, cover, product);
        $(density).change(function() {
            update_lamination(product, $(material).val(), $(density).val(), cover);
        });
    };
    var show_cover = function(value) {
        if (value == 0 || value == 1) {
            $('.postprint').toggleClass("span6");
            $('.postprint').toggleClass("span10");
            $('.fourth').hide();
            $('.sixth').hide();
        }
        if (value == 2) {
            $('.postprint').toggleClass("span6");
            $('.postprint').toggleClass("span10");
            $('.fourth').show();
            $('.sixth').show();
        }
    };
    var update_cover = function(product) {
        $("#cover-page").load("update_pages.php?product=" + product + "&cover");
        $("#cover-chromacity").load("update_chromacity.php?product=" + product + "&cover", function() {
            unavailable("#cover-chromacity");
        });
        $("#cover-material").load("update_material.php?product=" + product + "&cover", function() {
            update_material(product, "&cover");
        });
        $("#cover-material").change(function() {
            update_material(product, "&cover");
        });
    };
    var update_select_cover = function(product) {
        if ($("#cover").val() == 0) {
            show_cover(0);
        }
        if ($("#cover").val() == 1) {
            show_cover(1);
        }
        if ($("#cover").val() == 2) {
            show_cover(2);
            update_cover(product);
        }
    };
    var update_product = function() {
        var current_product = $("#choose-product").val();
        alert(current_product);
        $("#format-product").load("update_format.php?product=" + current_product, function() {
            $("#new_format").removeAttr("checked");
            $("#format-width, #format-height").attr("disabled", "disabled");
            update_formats();
        });
        $("#page").load("update_pages.php?product=" + current_product);
        $("#material").load("update_material.php?product=" + current_product, function() {
            update_material(current_product, "");
        });
        $("#material").change(function() {
            update_material(current_product, "");
        });
        $("#chromacity").load("update_chromacity.php?product=" + current_product, function() {
            unavailable($("#chromacity"));
        });
        $("#cover").load("update_cover.php?product=" + current_product, function() {
            update_select_cover(current_product);
            unavailable($("#cover"));
        });
        $("#cover").change(function() {
            update_select_cover(current_product);
            unavailable($("#cover"));
        });
    };
    $("#choose-product").load("update_product.php", function() {
        update_product();
    });
    $("#choose-product").change(function() {
        update_product();
    });
    $("#format-product").change(function() {
        update_formats();
    });
    $("#new_format").change(function() {
        if ($("#new_format").is(":checked")) {
            $("#format-width, #format-height").removeAttr("disabled");
            $("#format-product").attr("disabled", "disabled");
        } else {
            $("#format-width, #format-height").attr("disabled", "disabled");
            $("#format-product").removeAttr("disabled");
            update_formats();
        }
    });
    $('#exchange').click(function() {
        var product_width = $('#format-width').val();
        var product_height = $('#format-height').val();
        if (($.isNumeric(product_width)) && ($.isNumeric(product_height))) {
            var tmp = product_height;
            product_height = product_width;
            product_width = tmp;
            $('#format-width').val(product_width);
            $('#format-height').val(product_height);
        } else {
            alert('Неверный формат продукта');
        }
    });
});
