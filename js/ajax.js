function send()
{
    // common
    var data = $('#choose-product').attr('name') + "=" + $('#choose-product').val() + "&";
    data += $('#circulation').attr('name') + "=" + $('#circulation').val() + "&";
    data += $('#format-width').attr('name') + "=" + $('#format-width').val() + "&";
    data += $('#format-height').attr('name') + "=" + $('#format-height').val() + "&";
    // part : block
    data += $('#pages').attr('name') + "=" + $('#pages').val() + "&";
    data += $('#chromacity').attr('name') + "=" + $('#chromacity').val() + "&";
    data += $('#material').attr('name') + "=" + $('#material').val() + "&";
    data += $('#surface').attr('name') + "=" + $('#surface').val() + "&";
    data += $('#density').attr('name') + "=" + $('#density').val() + "&";
    data += $('#vd').attr('name') + "=" + $('#vd').val() + "&";
    data += $('#lamination').attr('name') + "=" + $('#lamination').val() + "&";
    data += $('#uf').attr('name') + "=" + $('#uf').val() + "&";
    // part : cover
    data += $('#cover').attr('name') + "=" + $('#cover').val() + "&";
    if ($("#cover").val() == 2) {
        data += $('#cover-pages').attr('name') + "=" + $('#cover-pages').val() + "&";
        data += $('#cover-chromacity').attr('name') + "=" + $('#cover-chromacity').val() + "&";
        data += $('#cover-material').attr('name') + "=" + $('#cover-material').val() + "&";
        data += $('#cover-surface').attr('name') + "=" + $('#cover-surface').val() + "&";
        data += $('#cover-density').attr('name') + "=" + $('#cover-density').val() + "&";
        data += $('#cover-vd').attr('name') + "=" + $('#cover-vd').val() + "&";
        data += $('#cover-lamination').attr('name') + "=" + $('#cover-lamination').val() + "&";
        data += $('#cover-uf').attr('name') + "=" + $('#cover-uf').val() + "&";
    }
    // comment
    data += $('#comment').attr('name') + "=" + $('#comment').val() + "";
    $.ajax({
        url: "calc.php",
        type: "post",
        data: data,
        beforeSend: function()
        {
            var circulation = document.forms[0].circulation.value;
            if (circulation == 0)
            {
                alert("Тираж должен быть больше нуля");
                document.forms[0].circulation.focus();
                return false;
            }

            var product_width = $('#format-width').val();
            var product_height = $('#format-height').val();
            if (product_width == "" || product_height == "")
            {
                alert("Неверный формат");
                return false;
            }
            var pages = document.forms[0].pages.value;
            var product = $('#choose-product').val();
            if (pages == 0)
            {
                alert("Количество полос в блоке должно быть больше нуля");
                document.forms[0].pages.focus();
                return false;
            }
            if (pages % 4 != 0 && product == "Booklet_(brace)")
            {
                alert("Количество полос в блоке данного продукта должно быть кратно четырём");
                document.forms[0].pages.focus();
                return false;

            }
            if (pages % 2 != 0)
            {
                alert("Количество полос в блоке данного продукта должно быть кратно двум");
                document.forms[0].pages.focus();
                return false;
            }
            if ($("#cover").val() == 2) {
                var cover_pages = document.forms[0].cover_pages.value;
                if (cover_pages % 4 != 0)
                {
                    alert("Количество полос в обложке данного продукта должно быть кратно четырём");
                    document.forms[0].cover_pages.focus();
                    return false;

                }
            }
            return true;
        },
        success: function(html)
        {
            $("#result").empty();
            $("#result").append(html);
        }
    });
}
