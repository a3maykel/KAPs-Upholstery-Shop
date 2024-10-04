<?php  
include('functions/userfunctions.php');
include('includes/header.php'); 
include('authenticate.php'); 
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white"> 
            <a class ="text-white" href="categories.php">
                Home / 
            </a> <a class ="text-white" href="cart.php">
                Cart
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                  <div id="mycart"> 
                <?php $items = getCartItems();

                if(mysqli_num_rows($items) > 0) {
                    ?>
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h6>Product</h6>
                        </div>
                        <div class="col-md-3">
                            <h6>Price</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Quantity</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Remove</h6>
                        </div>
                    </div>
                    <div id="">
                    <?php
                        foreach ($items as $citem)
                        {
                            ?>
                            <div class="card product_data shadow-sm mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="uploads/<?= $citem['img_src'] ?>" alt="Image" width="80px">
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?= $citem['name'] ?> ( <?= $citem['color'] ?> )</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>₱ <?= $citem['selling_price'] ?></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" class="prodId" value="<?=$citem['prod_id'] ?>">
                                        <div class="input-group mb3" style="width: 130px;">
                                            
                                            <input type="text" class="form-control text-center input-qty bg-white" min="1" value="<?= $citem['prod_qty'] ;  ?>" readonly>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger btn-sm deleteItem" value="<?=$citem['cid'] ?>">
                                        <i class="fa fa-trash me-2"></i>Remove</button>
                                    </div>
                                </div>
                            </div>

                            <?php
                            echo $citem['name'];
                        }
                        
                        ?>
                    </div>
                    <div class="float-end">
                        <a href="checkout.php" class="btn btn-outline-primary fw-bold">Proceed to Checkout</a>
                    </div>
                    <?php
                }
                else
                {
                   ?>
                   <div class="card card-body shadow text-center">
                    <h4 class="py 3 fw-bold">YOUR CART IS EMPTY</h4>
                   </div>
                   <?php
                }
                    ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>    
</div>

<!-- Optional JavaScript; choose one of the two! -->
<?php include('includes/footer.php'); ?>