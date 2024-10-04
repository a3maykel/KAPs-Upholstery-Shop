<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('functions/userfunctions.php');
include('includes/header.php');
include('includes/slider.php');
?>


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 shadow ">
                <h4>WHAT'S NEW?</h4>
                <hr>
                <div class="underline mb-2"></div>
                <div class="owl-carousel">
                    <?php
                    $trendingProducts = getAllTrending();
                    if (mysqli_num_rows($trendingProducts) > 0) {
                        foreach ($trendingProducts as $item) {
                    ?>
                            <div class="item">
                                <a href="product-view.php?product=<?= $item['slug']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
                                            <h6 class="text-center"><?= $item['name']; ?> </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="py-5 bg-f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>ABOUT US</h4>
                <div class="underline mb-2"></div>
                <p class="fw-bold">
                    Welcome to KAP’s Upholstery Services! We are a team of skilled professionals specializing in high-quality vehicle upholstery. Our goal is to transform the interiors of your cars attention to detail.
                </p>
                <br>
                <p>With years of experience in the industry, we understand the importance of comfort and aesthetics in your vehicle. Whether you need a complete interior overhaul or minor repairs, we use only the best materials and techniques to ensure your satisfaction. Our service include custom seat covers.</p>
                <br>
                <p>At KAP’s Upholstery Services, we pride ourselves on our commitment to customer satisfaction. Our friendly staff is always ready to assist you with your upholstery needs and provide expert advice to enhance the look and feel of your vehicle’s interior. Trust us to give your vehicle the stylish and comfortable upgrade it deserves.</p>
                <br>
                <p class="fw-bold">Visit us today and experience the difference with KAP’s Upholstery Services!</p>
                <br>
            </div>
        </div>
    </div>
</div>

<div class="px-5 bg-f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>CONTACT US</h4>
                <div class="underline mb-2"></div>
                <p class="fw-bold">
                    Do you have some questions? feel free to reach us out via contacts and also we have the Inquiry Form.
                </p>
 
            </div>
        </div>
    </div>
</div>

<div class="bg-f2f2f2 p-5 mx-auto">
    <div class="container mx-auto bg-white rounded p-0 shadow-sm row overflow-hidden"> 
        <div class="col p-0">
            <img src="assets/images/contact-img.jpg" style="width: 100%; height: 100%;" alt="contacts-seat-image">
        </div>
        <div class="col p-5">
            <h3 class="mb-4 text-uppercase">Inquiry Form</h3>

            <form class="row p-3" id="inquieryForm">
                
                <div class="col-12">
                    <input type="email" class="form-control mb-4" name="email" placeholder="Email Address" required>
                </div>
                <div class="col-12">
                    <input type="text" class="form-control mb-4" name="name" placeholder="Full Name" required>
                </div>
                <div class="col-12">
                    <input type="text" class="form-control mb-4" name="subject" placeholder="Subject" required>
                </div>
                <div class="col-12">
                    <textarea class="form-control mb-4" name="message" placeholder="Message" rows="6" required></textarea>
                </div>
                
                <div class="col-12">
                    <input type="submit" value="Send Inquiry" class="btn btn-primary w-100">
                </div>

                <input type="reset" id="resetForm" class="d-none">
                
            </form>
        </div>
    </div>

</div>

<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white fw-bold">KAP's Upholstery Shop</h4>
                <div class="underline mb-2"></div>
                <a href="index.php" class="text-white"> <i class="fa fa-angle-right"></i> Home </a> <br>
                <a href="index.php" class="text-white"> <i class="fa fa-angle-right"></i> About Us </a><br>
                <a href="cart.php" class="text-white"> <i class="fa fa-angle-right"></i> My Cart </a><br>
                <a href="categories.php" class="text-white"> <i class="fa fa-angle-right"></i> Our Collections </a><br>
            </div>
            <div class="col-md-3">
                <h4 class="text-white">Address</h4>
                <p class="text-white">
                    #52 Sunshine <br>
                    Tuyo Balanga
                    City, Bataan
                </p>
                <a href="tel: 09556423222" class="text-white"><i class="fa fa-phone "></i> 09556423222</a> <br>
                <a href="Email: kaps@gmail.com" class="text-white"><i class="fa fa-envelope "></i> kaps@gmail.com</a>
            </div>
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d405.6487452583946!2d120.53774228673377!3d14.701109617406207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339640235b6b793d%3A0xf1aeae6abb94b9f0!2sSunshine%20Subdivision%2C%20National%20Rd%2C%20Balanga%2C%20Bataan!5e0!3m2!1sen!2sph!4v1716289018631!5m2!1sen!2sph" class="w-100" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="py-2 bg-success">
    <div class="text-center">
        <p class="mb-0 text-white">All rights reserved. Copyright @ KAP's Upholstery Shop - <?= date('Y') ?> </p>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->
<?php include('includes/footer.php'); ?>

<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    });
</script>
<style>
    .underline {
        height: 5px;
        width: 150px;
        background-color: blue;
        border-radius: 20px;
    }

    .bg-f2f2f2 {
        background-color: #f2f2f2;
    }
</style>