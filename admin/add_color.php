<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Seat Cover Color</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Select Product</label>
                                <select name="category_id" class="form-select mb-2" >
                                    <option value="" selected>Select Product</option>
                                    <?php
                                       $categories = getAll("products");

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
                                <label class="mb-0">Color</label>
                                <input type="text" required name="color" placeholder="Enter Seat Color" class="form-control mb-2">
                            </div>
 

                            <div class="col-md-6">
                                <label class="mb-0">Upload Image</label>
                                <input type="file" required name="image" class="form-control mb-2">
                            </div>
                            <div class="row">
  

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_color_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>

