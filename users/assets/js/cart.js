$(function () {
    $(".btn_add").click(function () {
        let id = $(this).attr('data-id');
        console.log("Sending product ID:", id);

        $.ajax({
            url: "../controller/add_to_cart.php",
            method: "post",
            dataType: "json",
            data: {
                id,
                action: 'add'
            },
            success: function (res) {
                if (!res.success) {
                    location.href = "../view/login_form.php";
                } else {
                    console.log(res);
                }
            }
        });
    });

    $('.plus').on("click", function () {
        let $row = $(this).closest("tr");
        let price = parseFloat($row.find('.td_price').text());
        let quant = parseInt($row.find('.td_quant').text());
        let id = $row.attr("id");

        quant++;
        $row.find(".td_quant").text(quant);
        let newSum = quant * price;
        $row.find(".sum").text(newSum.toFixed(2));
        updateTotal();

        $.ajax({
            url: "../controller/add_to_cart.php",
            method: "post",
            data: {
                quant,
                id,
                action: 'update'
            },
            success: function () {
                console.log('Quantity updated');
            }
        });
    });

    $('.minus').on("click", function () {
        let $row = $(this).closest("tr");
        let price = parseFloat($row.find('.td_price').text());
        let quant = parseInt($row.find('.td_quant').text());
        let id = $row.attr("id");

        if (quant > 1) {
            quant--;
            $row.find(".td_quant").text(quant);
            let newSum = quant * price;
            $row.find(".sum").text(newSum.toFixed(2));
            updateTotal();

            $.ajax({
                url: "../controller/add_to_cart.php",
                method: "post",
                data: {
                    quant,
                    id,
                    action: 'update'
                },
                success: function () {
                    console.log('Quantity updated');
                }
            });
        }
    });

    $(document).on('click', '.btn_remove', function () {
        const id = $(this).data('id'); // Get the product ID from data-id attribute
        const row = $(this).closest('tr'); // Get the closest row
    
        $.ajax({
            url: "../controller/add_to_cart.php",
            type: 'POST',
            data: { action: 'remove', id: id },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Remove the row from the cart
                    row.remove();
                    // Optionally, update the total and show a success message
                    $('.success').text(response.message).show(); 
                } else {
                    $('.error').text(response.message).show();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                $('.error').text('An error occurred while removing the item.').show();
            }
        });
    });
    
    $(document).on('click', '.order', function () {
        $.ajax({
            url: '../controller/buy.php',
            method: 'post',
            dataType: 'json',
            data: {
                action: 'order-item'
            },
            success: function (data) {
                if (data.action === "1") {
                    $('.success').text(data.message).show();
                    $('table tbody').empty();
                    $('.td_total').text('0.00');
                } else {
                    $('.error').text(data.message).show();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                $('.error').text('An error occurred while processing your order.').show();
            }
        });
    });

    function updateTotal() {
        let total = 0;
        $(".sum").each(function () {
            total += parseFloat($(this).text());
        });
        $(".td_total").text(total.toFixed(2));
    }
});
