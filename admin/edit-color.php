<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($_GET['id']))
                {

                    $id = $_GET['id'];

                    $product = getByID("seat_color", $id);

                    if(mysqli_num_rows($product) > 0)
                    {
                        $data = mysqli_fetch_array($product);
            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Seat Cover Color
                                    <a href="seat_covers.php" class="btn btn-primary float-end">Back</a>
                                    </h4>
                                </div>           
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            
                                            <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                            <div class="col-md-6">
                                                <label class="mb-0">Name</label>
                                                <input type="text" required name="color" value="<?= $data['color']; ?>" placeholder="Enter Color" class="form-control mb-2">
                                            </div>
                                       
                                            <div class="col-md-6">
                                                <label class="mb-0">Upload Image</label>
                                                <input type="hidden" name="old_image" value="<?= $data['img_src']; ?>">
                                                <input type="file" name="image" class="form-control mb-2">
                                                <label class="mb-0">Current Image</label>
                                                <img src="../uploads/<?= $data['img_src']; ?>" alt="Product Image" height="50px" width="50px">
                                            </div>

                                        <div class="row mt-4">
                                                
                                            
                                            
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" name="update_color_btn">Update</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>               
            <?php
                }
                else
                {
                    echo "Product Not found for given id";
                }
                }
                else
                {
                    echo "Id missing from url";
                }
                ?>

        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>

