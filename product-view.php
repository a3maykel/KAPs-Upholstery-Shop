<?php 
include('functions/userfunctions.php');
include('includes/header.php'); 

if(isset($_GET['product']))
{
$product_slug = $_GET['product'];
$product_data = getSlugActive("products",$product_slug);
$product = mysqli_fetch_array($product_data);

if($product)
{
    ?>
    <div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white"> 
        <a class ="text-white" href="index.php">
            Home / 
        </a>
        <a class ="text-white" href="categories.php">
            Collections / 
        </a>
            <?= $product['name'] ?> 
        </h6>
    </div>
</div>
    <div class="bg-light py-4">
    <div class="container product_data mt-3">
        <div class="row">
            <div class="col-md-4">
              <div class="shadow"> 
                <img src="uploads/<?= $product ['image']; ?>" alt="Product Image" class="w-100" id="seat_image" height="350">
                </div> 
            </div>
            <div class="col-md-8">
                 <h4 class="fw-bold"><?= $product ['name'];  ?>
                <span class="float-end text-danger"> <?php if($product ['trending']) {echo "Trending"; } ?></span>
                </h4>
                 <hr>
                 <p><?= $product ['small_description'];  ?></p>
                 <div class="row">
                 <div class="col-md-6">
                        <h4>PHP <span class="text-success fw-bold"> <?= $product['selling_price']; ?> </span> </h4>
                    </div>
                 <div class="col-md-6">
                        <h5>PHP <s class="text-danger"> <?= $product['original_price']; ?> </s> </h5>
                    </div>
                    
                 </div>
                 <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3" style="width: 130px;">
                            <button class="input-group-text decrement-btn updateQty">-</button>
                            <input type="number" class="form-control text-center input-qty bg-white" value="1" min="1" max="<?= $product['qty']; ?>">
                            <button class="input-group-text increment-btn updateQty">+</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="color">Select Color Variant</label>
                        <select name="color" id="color" class="form-control" required>
                            <?php
                                $colors = getColorByProdID($product['id']);

                                if (mysqli_num_rows($colors) > 0) {
                                    foreach ($colors as $color) {
                            ?>
                            <option value="<?= $color['id']; ?>" data-img="<?= $color['img_src']; ?>"><?= $color['color']; ?></option>

                            <?php
                                    }
                                }
                            ?>
                            
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <button class="btn btn-primary px-4 addToCartBtn" min="1" value="<?= $product['id']; ?>"> <i class= "fa fa-shopping-cart me-2"></i>Add to Cart</buttoon>
                    </div>
                </div>

                 <hr>
                 <h6>Product Description:</h6>
                 <p><?= $product ['description'];  ?></p>
            </div>
        </div>
    </div>
</div>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const decrementBtn = document.querySelector('.decrement-btn');
    const incrementBtn = document.querySelector('.increment-btn');
    const inputQty = document.querySelector('.input-qty');
    const addToCartBtn = document.querySelector('.addToCartBtn');

    decrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(inputQty.value);
        if (currentValue > 1) {
            inputQty.value = currentValue - 1;
        }
    });

    incrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(inputQty.value);
        let maxQuantity = parseInt(inputQty.getAttribute('max'));
        if (currentValue < maxQuantity) {
            inputQty.value = currentValue + 1;
        }
    });

    addToCartBtn.addEventListener('click', function() {
        let productId = this.getAttribute('data-productid');
        let quantity = parseInt(inputQty.value);
        let maxQuantity = parseInt(inputQty.getAttribute('max'));

        if (quantity > maxQuantity) {
            alert("Cannot add more than available quantity.");
            return;
        }

        // Add your logic here to add the product to the cart
    });
});

</script>
    <?php
}
else
{
    echo "Product Not Found";
}

}
else
{
    echo "Something Went Wrong";
}




include('includes/footer.php'); ?>