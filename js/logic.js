$(document).ready(function() {
    var pred_cover = 0;
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
    };
    var load_surface = function(product, cover, material) {
        if (cover == 0) {
            $("#surface").load("update_surface.php?product=" + product + "&material=" + material, function() {
                unavailable("#surface");
            });
        } else {
            $("#cover-surface").load("update_surface.php?cover&product=" + product + "&material=" + material, function() {
                unavailable("#cover-surface");
            });
        }
    };
    var load_vd = function(product, cover, chromacity, material, density, lamination) {
        if (lamination != "0") {
            var tmp = lamination.split(" ");
            lamination = tmp[0] + "_" + tmp[1];
        }
        if (cover == 0) {
            $("#vd").load("update_vd.php?product=" + product + "&chromacity=" + chromacity + "&material=" + material + "&density=" + density + "&lamination=" + lamination, function() {
                unavailable("#vd");
            });
        } else {
            $("#cover-vd").load("update_vd.php?cover&product=" + product + "&chromacity=" + chromacity + "&material=" + material + "&density=" + density + "&lamination=" + lamination, function() {
                unavailable("#cover-vd");
            });
        }
    };
    var load_uf = function(product, cover, chromacity, material, density, lamination) {
        if (lamination != "0") {
            var tmp = lamination.split(" ");
            lamination = tmp[0] + "_" + tmp[1];
        }
        if (cover == 0) {
            $("#uf").load("update_uf.php?product=" + product + "&chromacity=" + chromacity + "&material=" + material + "&density=" + density + "&lamination=" + lamination, function() {
                unavailable("#uf");
            });
        } else {
            $("#cover-uf").load("update_uf.php?cover&product=" + product + "&chromacity=" + chromacity + "&material=" + material + "&density=" + density + "&lamination=" + lamination, function() {
                unavailable("#cover-uf");
            });
        }
    };
    var load_lamination = function(product, cover, material, density, chromacity) {
        if (cover == 0) {
            $("#lamination").load("update_lamination.php?product=" + product + "&material=" + material + "&density=" + density + "&chromacity=" + chromacity, function() {
                unavailable("#lamination");
                load_vd(product, cover, chromacity, material, density, $(this).val());
                load_uf(product, cover, chromacity, material, density, $(this).val());
            });
        } else {
            $("#cover-lamination").load("update_lamination.php?cover&product=" + product + "&material=" + material + "&density=" + density + "&chromacity=" + chromacity, function() {
                unavailable("#cover-lamination");
                load_vd(product, cover, chromacity, material, density, $(this).val());
                load_uf(product, cover, chromacity, material, density, $(this).val());
            });
        }
    };
    var load_density = function(product, cover, material, chromacity) {
        if (cover == 0) {
            $("#density").load("update_density.php?product=" + product + "&material=" + material, function() {
                unavailable("#density");
                load_lamination(product, cover, material, $(this).val(), chromacity);
            });
        } else {
            $("#cover-density").load("update_density.php?cover&product=" + product + "&material=" + material, function() {
                unavailable("#cover-density");
                load_lamination(product, cover, material, $(this).val(), chromacity);
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
    var load_material = function(product, cover, chromacity) {
        if (cover == 0) {
            $("#material").load("update_material.php?product=" + product, function() {
                unavailable("#material");
                load_surface(product, cover, $(this).val());
                load_density(product, cover, $(this).val(), chromacity);
            });
        } else {
            $("#cover-material").load("update_material.php?cover&product=" + product, function() {
                unavailable("#cover-material");
                load_surface(product, cover, $(this).val());
                load_density(product, cover, $(this).val(), chromacity);
            });
        }
    };
    var load_pages_and_chromacity = function(product, cover) {
        if (cover == 0) {
            $("#page").load("update_pages.php?product=" + product);
            $("#chromacity").load("update_chromacity.php?product=" + product, function() {
                unavailable("#chromacity");
                load_material(product, cover, $(this).val());
            });
        } else {
            $("#cover-page").load("update_pages.php?cover&product=" + product);
            $("#cover-chromacity").load("update_chromacity.php?cover&product=" + product, function() {
                unavailable("#cover-chromacity");
                load_material(product, cover, $(this).val());
            });
        }
    };
    var display_cover = function(cover) {
        var new_cover;
        if (cover == 0 || cover == 1)
            new_cover = 0;
        else
            new_cover = 1;
        if (pred_cover != new_cover) {
            show_cover($("#cover").val());
            pred_cover = new_cover;
        }
    };
    var load_cover = function(product) {
        $("#cover").load("update_cover.php?product=" + product, function() {
            unavailable("#cover");
            display_cover($("#cover").val());
            if ($("#cover").val() == 2) {
                load_pages_and_chromacity(product, 1);
            }
        });
    };
    var load_product = function() {
        var product = $("#choose-product").val();
        load_format(product);
        load_cover(product);
        load_pages_and_chromacity(product, 0);
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
        display_cover($("#cover").val());
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
        load_lamination($("#choose-product").val(), 0, $("#material").val(), $(this).val(), $("#chromacity").val());
    });
    $("#cover-density").change(function() {
        if ($("#cover").val() > 0) {
            load_lamination($("#choose-product").val(), $("#cover").val(), $("#cover-material").val(), $(this).val(), $("#cover-chromacity").val());
        }
    });
    $("#chromacity").change(function() {
        load_vd($("#choose-product").val(), 0, $(this).val(), $("#material").val(), $("#density").val(), $("#lamination").val());
        load_uf($("#choose-product").val(), 0, $(this).val(), $("#material").val(), $("#density").val(), $("#lamination").val());
    });
    $("#cover-chromacity").change(function() {
        load_vd($("#choose-product").val(), 1, $(this).val(), $("#cover-material").val(), $("#cover-density").val(), $("#cover-lamination").val());
        load_uf($("#choose-product").val(), 1, $(this).val(), $("#cover-material").val(), $("#cover-density").val(), $("#cover-lamination").val());
    });
    $("#lamination").change(function() {
        load_vd($("#choose-product").val(), 0, $("#chromacity").val(), $("#material").val(), $("#density").val(), $(this).val());
        load_uf($("#choose-product").val(), 0, $("#chromacity").val(), $("#material").val(), $("#density").val(), $(this).val());
    });
    $("#cover-lamination").change(function() {
        load_vd($("#choose-product").val(), 1, $("#cover-chromacity").val(), $("#cover-material").val(), $("#cover-density").val(), $(this).val());
        load_uf($("#choose-product").val(), 1, $("#cover-chromacity").val(), $("#cover-material").val(), $("#cover-density").val(), $(this).val());
    });
});
