$(function() {
    // Add event listener for update button
    $('.btn_update').on("click", function() {
        let id = $(this).parents("tr").attr('id');
        let name = $(this).parents("tr").find('.td_name').text().trim();
        let desc = $(this).parents("tr").find('.td_desc').text().trim(); 
        let price = $(this).parents("tr").find('.td_price').val(); // Use .val() to get the input value
        let currency = $(this).parents("tr").find('.currency_select').val(); // Get the selected currency

        // AJAX request to update the product
        $.ajax({
            url: "../controller/add_product.php",
            method: "post",
            data: {
                id: id,
                name: name,
                desc: desc,
                price: price,
                currency: currency, // Send the currency along with the update
                action: "update_prod"
            },
            success: function(res) {
                $(".mess").text(res); // Display success message
            },
            error: function(xhr, status, error) {
                console.log("AJAX request failed: ", error); // Log error
            }
        });
    });

    // Add event listener for delete button
    $('.btn_delete').on("click", function() {
        let id = $(this).parents("tr").attr('id');
        if (confirm("Are you sure you want to delete this product?")) {
            // AJAX request to delete the product
            $.ajax({
                url: "../controller/add_product.php",
                method: "post",
                data: {
                    id: id,
                    action: "delete_prod"
                },
                success: function(res) {
                    $(".mess").text(res); // Display success message
                    // Remove the product row from the table
                    $(`#${id}`).remove();
                },
                error: function(xhr, status, error) {
                    console.log("AJAX request failed: ", error); // Log error
                }
            });
        }
    });
});
