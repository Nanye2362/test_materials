ProductDesign<br>
Name: <input type="text" name="product_name" value=""><br>
Product Description: <input type="text" name="product_description" value=""><br>
<div class="materials_content"></div><br>

<input id="create_product" type="button" value="create_product">
<script>
    $(function () {
        $.ajax({
            url: "http://localhost/test/web/materials/get-materials",
            type: "POST",
            data: {
                "flag": "P"
            },
            dataType: 'html',
            success: function (res) {
                $('.materials_content').append(res);
            }
        });

        $(document).on('click', '#create_product', function () {
            var materials_id = '';
            var consumed = '';
            var consumed_materials = [];
            var product_price = 0;
            $('input:checkbox[name=m_select]:checked').each(function (i) {
                materials_id = $(this).attr('id');
                consumed = $('#m_count_' + materials_id).val();
                var consumed_material = {
                    "consumed": materials_id + ':' + ($(this).attr('data-storage') - consumed)
                };
                consumed_materials.push(consumed_material);
                product_price += +($(this).attr('data-price') * consumed);
            });
            console.log(consumed_materials);
            console.log(product_price);

            $.ajax({
                url: "http://localhost/test/web/products/create-product",
                type: "POST",
                data: {
                    "NAME": $('input[name=product_name]').val(),
                    "PRICE": product_price,
                    "DESCRIPTION": $('input[name=product_description]').val(),
                    "consumed_materials": consumed_materials,
                },
                success: function (res) {
                    console.log(res);
                    if (res.success == true) {
                        location.reload();
                    } else {
                        alert(res.error_msg);
                    }
                }
            });
        });
    });
</script>