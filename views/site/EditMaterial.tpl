<table border="1" cellspacing="0" cellpadding="0" id="userList" align="center">
    <tr>
        <th>ID</th>
        <th>CODE</th>
        <th>NAME</th>
        <th>PRICE</th>
        <th>STORAGE</th>
        <th>DESCRIPTION</th>
        <th>ACTION</th>
    </tr>
    <tr>
        <td id="material_id">{$ID}</td>
        <td><input type="text" name="material_code" value="{$CODE}"></td>
        <td><input type="text" name="material_name" value="{$NAME}"></td>
        <td><input type="text" name="material_price" value="{$PRICE}"></td>
        <td><input type="text" name="material_storage" value="{$STORAGE}"></td>
        <td><input type="text" name="material_description" value="{$DESCRIPTION}"></td>
        <td><input id="update" type="button" value="Confirm"></td>
    </tr>
</table>

<script>
    $(function () {
        $(document).on('click', '#update', function () {
            $.ajax({
                url: "http://localhost/test/web/materials/update-material",
                type: "POST",
                data: {
                    "ID": $('#material_id').text(),
                    "CODE": $('input[name=material_code]').val(),
                    "NAME": $('input[name=material_name]').val(),
                    "PRICE": $('input[name=material_price]').val(),
                    "STORAGE": $('input[name=material_storage]').val(),
                    "DESCRIPTION": $('input[name=material_description]').val(),
                },
                success: function (res) {
                    if (res.success == true) {
                        window.location.href = 'http://localhost/test/web/site/material-management';
                    } else {
                        alert(res.error_msg);
                    }
                }
            });
        });
    });
</script>