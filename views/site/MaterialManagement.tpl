Create Material<br>
Material Code: <input type="text" name="material_code" value=""><br>
Material Name: <input type="text" name="material_name" value=""><br>
Material Price: <input type="text" name="material_price" value=""><br>
Material Storage: <input type="text" name="material_storage" value=""><br>
Material Description: <input type="text" name="material_description" value=""><br>
<input id="create_material" type="button" value="create material">

<div class="materials_content"></div>

<script>
    $(function () {
        $.ajax({
            url: "http://localhost/test/web/materials/get-materials",
            type: "POST",
            data: {
                "flag":"M"
            },
            dataType: 'html',
            success: function (res) {
                $('.materials_content').append(res);
            }
        });
        
        $(document).on('click', '#create_material', function () {
            $.ajax({
                url: "http://localhost/test/web/materials/create-material",
                type: "POST",
                data: {
                    "CODE": $('input[name=material_code]').val(),
                    "NAME": $('input[name=material_name]').val(),
                    "PRICE": $('input[name=material_price]').val(),
                    "STORAGE": $('input[name=material_storage]').val(),
                    "DESCRIPTION": $('input[name=material_description]').val(),
                },
                success: function (res) {
                    if(res.success == true){
                        location.reload();
                    }else{
                        alert(res.error_msg);
                    }
                }
            });
        });
        
        $(document).on('click', '#delete_material', function () {
            $.ajax({
                url: "http://localhost/test/web/materials/delete-material",
                type: "POST",
                data: {
                    "ID": $(this).attr('data')
                },
                success: function (res) {
                    if(res.success == true){
                        location.reload();
                    }else{
                        alert(res.error_msg);
                    }
                }
            });
        });
    });
</script>