<?php 
include('functions/userfunctions.php');
include('includes/header.php'); 
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white"> Home / Collections </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>CAR TYPE CATEGORY</h1>
                <hr>
                <div class="row">

                <?php 
                    $categories = getAllActive("categories");

                    if(mysqli_num_rows($categories) > 0)
                    {
                        foreach($categories as $item)
                        {
                            ?>
                                <div class="col-md-3 mb-2">
                                    <a href="products.php?category=<?= $item['slug'];?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                        <img src="uploads/<?= $item['image'];?>" alt="Category Image" class="w-100">  
                                        <h5 class="text-center text-black fw-bold ">CAR MODEL<br><?=$item['name']; ?> </h5>
                                        </div>
                                    </div>
                                     </a>
                                </div>
                                
                            <?php
                        }
                    }
                    else
                    {
                        echo "No data available";
                    }
                ?>
                </div>
            </div>
        </div>
    </div>    
</div>

    <!-- Optional JavaScript; choose one of the two! -->
    <?php include('includes/footer.php'); ?>

    