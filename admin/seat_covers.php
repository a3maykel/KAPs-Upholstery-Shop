<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger">
                    <h4 class= "text-white">Seat Cover Colors</h4>
                </div>
                <div class="card-body" id="category_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Color</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $seat_cover = getSeatCoverColor("products", "seat_color");

                                if(mysqli_num_rows($seat_cover) > 0)
                                {
                                    foreach($seat_cover as $item)
                                    {
                                        ?>
                                            <tr>
                                                <td><?= $item['id']; ?></td>
                                                <td><?= $item['name']; ?></td>
                                                <td><?= $item['color']; ?></td>
                                                <td>
                                                    <img src="../uploads/<?= $item['img_src']; ?>" width="50px" height="50px" alt="<?= $item['color']; ?>">
                                                </td>

                                                
                                                <td>
                                                    <a href="edit-color.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                                                      
                                                    <button type="button" class="btn btn-sm btn-danger delete_color_btn" value="<?= $item['id']; ?>">Delete</button>
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

