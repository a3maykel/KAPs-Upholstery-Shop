$(document).ready(function () {


    $(document).on('click', '.increment-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $(document).on('click', '.decrement-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $(document).on('click', '.addToCartBtn', function (e) {
        e.preventDefault();

        var inputQty = $(this).closest('.product_data').find('.input-qty');
        var qty = parseInt(inputQty.val());
        var color = parseInt($("#color").val());
        var maxQty = parseInt(inputQty.attr('max')); // Assuming 'max' attribute is set to the available quantity
        var prodId = $(this).val();

        // Check if quantity is zero or negative
        if (qty <= 0) {
            alertify.error("Quantity must be greater than 0.");
            return;
        }

        // Check if input quantity exceeds available quantity
        if (qty > maxQty) {
            alertify.error("Available quantity: " + maxQty);
            return;
        }

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prodId,
                "prod_qty": qty,
                "color": color,
                "scope": "add"
            },
            success: function (response) {
                if (response == 201) {
                    alertify.success("Product added to cart");
                } else if (response == "existing") {
                    alertify.success("Product already in cart");
                } else if (response == 401) {
                    alertify.success("Login to continue");
                } else if (response == 500) {
                    alertify.success("Something went wrong");
                }
            }
        });
    });

    $(document).on('click', '.updateQty', function () {

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                //alert(response);
            }
        })

    })

    $(document).on('click', '.deleteItem', function () {
        var cart_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if (response == 200) {
                    alertify.success("Item deleted");
                    $('#mycart').load(location.href + " #mycart");
                }
                else {
                    alertify.success(response);
                }
            }
        })

    })


    // switch image in product view depending on color selected

    var selectedOption = $("#color option:selected");
    var image = "uploads/" + selectedOption.attr('data-img');
    $("#seat_image").attr("src", image);

    $("#color").change(function (e) {

        selectedOption = $("#color option:selected");
        image = "uploads/" + selectedOption.attr('data-img');
        $("#seat_image").attr("src", image);

    });


    $("#inquieryForm").submit(function (e) { 
        e.preventDefault();
        



        $.ajax({
            type: "post",
            url: "functions/inquiry.php",
            data: $(this).serialize(),
   
            success: function (response) {
               console.log(response);
                if (response == 200) {
                    $("#resetForm").click();

                    swal({
                        title: "Inquiry has been sent",
                        text: "You have sent an inquiry.",
                        icon: "success",
                    });

                } else {
                    swal({
                        title: "Internal Error",
                        text: "An error occured while sending your inquiry.",
                        icon: "error",
                    });

                }
            }
        });
    });

});