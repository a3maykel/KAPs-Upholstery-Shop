<?php 

include('includes/header.php'); 
include('../middleware/adminMiddleware.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger">
                    <h4 class= "text-white">Product</h4>
                </div>
                <div class="card-body" id="product_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Quantity</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $products = getAll("products");
                                
                                updateProductStatusBasedOnQuantity("products");

                                if(mysqli_num_rows($products) > 0)
                                {
                                    foreach($products as $item)
                                    {
                                        ?>
                                            <tr>
                                                <td><?= $item['id']; ?></td>
                                                <td><?= $item['qty'] <= 0 ? "Not Enough Stock" : $item['qty'] . ' pcs'; ?></td>
                                                <td><?= $item['name']; ?></td>
                                                <td>
                                                    <img src="../uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                </td>
                                                <td>
                                                    <?= $item['status'] == '0' 
                                                        ? '<span style="color: green;">&#9679;</span> Active' 
                                                        : '<span style="color: red;">&#9679;</span> Inactive'; ?>
                                                </td>
                                                <td>
                                                <a href="edit-product.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                        <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= $item['id']; ?>">Delete</button>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else   
                                {
                                    echo "No records found";
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>

