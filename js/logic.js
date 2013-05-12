$(document).ready(function() {
    var unavailable = function(id) {
        if ($(id).children().length < 2) {
            $(id).attr("disabled", "disabled");
        } else {
            $(id).removeAttr("disabled");
        }
        return $(id).children().length;
    };
    var update_format = function() {
        var current_format = $("#format-product").val();
        var format = current_format.split("x");
        $("#format-width").val(format[1]);
        $("#format-height").val(format[0]);
        unavailable("#format-product");
    };
    var load_format = function(product) {
        $("#format-product").load("update_format.php?product=" + product, function() {
            $("#new_format").removeAttr("checked");
            $("#format-width, #format-height").attr("disabled", "disabled");
            update_format();
        });
    }
    var load_pages_and_chromacity = function(product, cover) {
        if (cover < 2) {
            $("#page").load("update_pages.php?product=" + product);
            $("#chromacity").load("update_chromacity.php?product=" + product, function() {
                unavailable("#chromacity");
            });
        } else {
            $("#cover-page").load("update_pages.php?cover&product=" + product);
            $("#cover-chromacity").load("update_chromacity.php?cover&product=" + product, function() {
                unavailable("#cover-chromacity");
            });
        }
    };
    var load_surface = function(product, cover, material) {
        if (cover < 2) {
            $("#surface").load("update_surface.php?product=" + product + "&material=" + material, function() {
                unavailable("#surface");
            });
        } else {
            $("#cover-surface").load("update_surface.php?cover&product=" + product + "&material=" + material, function() {
                unavailable("#cover-surface");
            });
        }
    };
    var load_lamination = function(product, cover, material, density) {
        if (cover < 2) {
            $("#lamination").load("update_lamination.php?product=" + product + "&material=" + material + "&density=" + density, function() {
                unavailable("#lamination");
            });
        } else {
            $("#cover-lamination").load("update_lamination.php?cover&product=" + product + "&material=" + material + "&density=" + density, function() {
                unavailable("#cover-lamination");
            });
        }
    };
    var load_density = function(product, cover, material) {
        if (cover < 2) {
            $("#density").load("update_density.php?product=" + product + "&material=" + material, function() {
                unavailable("density");
                load_lamination(product, cover, material, $(this).val());
            });
        } else {
            $("#cover-density").load("update_density.php?cover&product=" + product + "&material=" + material, function() {
                unavailable("cover-density");
                load_lamination(product, cover, material, $(this).val());
            });
        }
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
    var load_material = function(product, cover) {
        if (cover < 2) {
            $("#material").load("update_material.php?product=" + product, function() {
                unavailable("#material");
                load_surface(product, cover, $(this).val());
                load_density(product, cover, $(this).val());
            });
        } else {
            $("#cover-material").load("update_material.php?cover&product=" + product, function() {
                unavailable("#cover-material");
                load_surface(product, cover, $(this).val());
                load_density(product, cover, $(this).val());
            });
        }
    };
    var load_cover = function(product) {
        $("#cover").load("update_cover.php?product=" + product, function() {
            unavailable("#cover");
            show_cover($("#cover").val());
            if ($("#cover").val() == 2) {
                load_pages_and_chromacity(product, $("#cover").val());
                load_material(product, $("#cover").val());
            }
        });
    };
    var load_product = function() {
        var product = $("#choose-product").val();
        load_format(product);
        load_cover(product);
        load_pages_and_chromacity(product, 0);
        load_material(product, 0);
    };
    $("#choose-product").load("update_product.php", function() {
        load_product($("#choose-product").val());
    });
    $("#choose-product").change(function() {
        var product = $("#choose-product").val();
        load_format(product);
        load_cover(product);
        load_pages_and_chromacity(product, 0);
        load_material(product, 0);
    });
    $("#format-product").change(function() {
        update_format();
    });
    $("#new_format").change(function() {
        if ($("#new_format").is(":checked")) {
            $("#format-width, #format-height").removeAttr("disabled");
            $("#format-product").attr("disabled", "disabled");
        } else {
            $("#format-width, #format-height").attr("disabled", "disabled");
            $("#format-product").removeAttr("disabled");
            update_format();
        }
    });
    $("#exchange").click(function() {
        var product_width = $("#format-width").val();
        var product_height = $("#format-height").val();
        var tmp = product_height;
        product_height = product_width;
        product_width = tmp;
        $("#format-width").val(product_width);
        $("#format-height").val(product_height);
    });
    $("#cover").change(function() {
        unavailable("#cover");
        show_cover($("#cover").val());
        if ($("#cover").val() == 2) {
            load_pages_and_chromacity($("#choose-product").val(), 1);
            load_material($("#choose-product").val(), 1);
        }
    });
    $("#material").change(function() {
        load_surface($("#choose-product").val(), 0, $(this).val());
        load_density($("#choose-product").val(), 0, $(this).val());
    });
    $("#cover-material").change(function() {
        if ($("#cover").val() > 0) {
            load_surface($("#choose-product").val(), $("#cover").val(), $(this).val());
            load_density($("#choose-product").val(), $("#cover").val(), $(this).val());
        }
    });
    $("#density").change(function() {
        load_lamination($("#choose-product").val(), 0, $("#material").val(), $(this).val());
    });
    $("#cover-density").change(function() {
        if ($("#cover").val() > 0) {
            load_lamination($("#choose-product").val(), $("#cover").val(), $("#cover-material").val(), $(this).val());
        }
    });
});
