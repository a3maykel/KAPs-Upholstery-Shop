<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Car Seat Product</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold">Select Car Type</label>
                                <select name="category_id" class="form-select mb-2" >
                                    <option selected>Select Car Type</option>
                                    <?php
                                       $categories = getAll("categories");

                                       if(mysqli_num_rows($categories) > 0)
                                       {
                                           foreach ($categories as $item) {
                                               ?>
                                                   <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                                <?php
                                            }
                                       }
                                       else
                                       {
                                            echo"No category available";
                                       }
                                       
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold">Name</label>
                                <input type="text" required name="name" placeholder="Enter Product Name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold">Slug</label>
                                <input type="text" required name="slug" placeholder="Enter Slug" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold">Small Description</label>
                                <textarea rows="3" required name="small_description" placeholder="Enter Small Description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold">Description</label>
                                <textarea rows="3" required name="description" placeholder="Enter Description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold">Original Price</label>
                                <input type="number" required name="original_price" placeholder="Enter Original Price" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold">Percent Discount</label>
                                <input type="number" required name="discount" placeholder="Enter Discount" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold">Selling Price</label>
                                <input type="number" required name="selling_price" placeholder="Selling Price" class="form-control mb-2" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold">Upload Image</label>
                                <input type="file" required name="image" class="form-control mb-2">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <label class="mb-0 fw-bold">Quantity</label>
                                     <input type="number" required name="qty" placeholder="Enter Quantity" class="form-control mb-2">
                                </div>
                                <div class="col-md-3">
                                     <label class="mb-0 fw-bold">Inactive</label> <br>
                                     <input type="checkbox" name="status">
                                </div>
                                <div class="col-md-3">
                                     <label class="mb-0 fw-bold">What's New?</label> <br>
                                     <input type="checkbox" name="trending">
                                </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold">Meta Title</label>
                                <input type="text" required name="meta_title" placeholder="Enter meta title" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold">Meta Description</label>
                                <textarea rows="3" required name="meta_description" placeholder="Enter Meta Description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold">Meta Keywords</label>
                                <textarea rows="3" required name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control mb-2"></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary fw-bold" name="add_product_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>

