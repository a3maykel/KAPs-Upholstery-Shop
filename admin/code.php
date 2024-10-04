<?php 

include('../config/dbcon.php');
include('../functions/myfunctions.php');

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0' ;
    $popular = isset($_POST['popular']) ? '1':'0' ;

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $cate_query = "INSERT INTO categories 
    (name,slug,description,meta_title,meta_description,meta_keywords,status,popular,image) 
    VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

        redirect("add-category.php", "Category Added Successfully");
    }
    else
    {
        redirect("add-category.php", "Someting Went Wrong");
    }


}
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['$category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0' ;
    $popular = isset($_POST['popular']) ? '1':'0' ;

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', 
    meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', 
    status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully");
    }
    else
    {
        redirect("edit-category.php?id=$category_id", "Something Went Wrong");
    }

}
else if(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        
        //redirect("category.php", "Category deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("category.php", "Something went wrong");
        echo 500;
    }
}

else if(isset($_POST['add_product_btn']))
{
   $category_id = $_POST['category_id'];
   $name = $_POST['name'];
   $slug = $_POST['slug'];
   $small_description = $_POST['small_description'];
   $description = $_POST['description'];
   $original_price = $_POST['original_price'];
   $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : 0;
   $selling_price = $_POST['selling_price'];
   $qty= $_POST['qty'];
   $meta_title = $_POST['meta_title'];
   $meta_description = $_POST['meta_description'];
   $meta_keywords = $_POST['meta_keywords'];
   $status = isset($_POST['status']) ? '1':'0' ;
   $trending = isset($_POST['trending']) ? '1':'0' ;

   $selling_price = $original_price - ($original_price * ($discount / 100));
   $image = $_FILES['image']['name'];

   $path = "../uploads";

   $image_ext = pathinfo($image, PATHINFO_EXTENSION);
   $filename = time().'.'.$image_ext;

   if($name != "" && $slug != "" && $description != "") {

    $product_query = "INSERT INTO products (category_id,name,slug,small_description,description,original_price,selling_price,
    qty,meta_title,meta_description,meta_keywords,status,trending,image, discount) VALUES 
    ('$category_id','$name','$slug','$small_description','$description','$original_price','$selling_price','$qty','$meta_title',
    '$meta_description',' $meta_keywords','$status',' $trending','$filename','$discount')";

       $product_query_run = mysqli_query($con, $product_query);

       if($product_query)
       {
          move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

          redirect("add-product.php", "Product Added Successfully");
       }
       else
       {
          redirect("add-product.php", "Something went wrong");
       }
    }
   else
    {
          redirect("add-product.php", "All fields are mandatory");
    }
}
else if(isset($_POST['update_product_btn']))
{  
    $product_id = $_POST['product_id'];

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : 0;
    $selling_price = $_POST['selling_price'];
    $qty= $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0' ;
    $trending = isset($_POST['trending']) ? '1':'0' ;
 
    $selling_price = $original_price - ($original_price * ($discount / 100));
    $image = $_FILES['image']['name'];
 
    $path = "../uploads";
 
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE products SET category_id='$category_id',name='$name',slug='$slug',small_description='$small_description',description='$description',original_price='$original_price'
    ,selling_price='$selling_price',qty='$qty',meta_title='$meta_title',meta_description='$meta_description',meta_keywords='$meta_keywords',status='$status',
    trending='$trending',image='$update_filename', discount='$discount' WHERE id='$product_id' ";

        $update_product_query_run = mysqli_query($con, $update_product_query);
    if($update_product_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "Product Updated Successfully");
    }
    else
    {
        redirect("edit-product.php?id=$product_id", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_product_btn']))
{
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id' ";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        
       // redirect("product.php", "Product deleted Successfully");

        echo 200;
    }
    else
    {
        ///redirect("product.php", "Something went wrong");
        echo 500;
    }

}
else if(isset($_POST['update_order_btn'])){
    $track_no = $_POST['tracking_no'];
    $phone = $_POST['phoneNum'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no' ";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);


    switch ($order_status) {
        case '0':
            $message = "Your order with tracking number: $track_no  is currently in Queue, Thank you.";
            sendSMS($phone, $message);
            break;
        
        case '1':
            $message = "Your order with tracking number: $track_no  is currently in Process, Thank you.";
            sendSMS($phone, $message);
            break;
        
        case '2':
            $message = "Your order with tracking number: $track_no  has been Finished, Thank you.";
            sendSMS($phone, $message);
            break;
        
        case '3':
            $message = "Your order with tracking number: $track_no  has been Cancelled.";
            sendSMS($phone, $message);
            break;
        
        default:
            $message = "This message was sent due to error please disregard, Thank You.";
            
            break;
    }

    

    redirect("view-order.php?trackingno=$track_no", "Order has been Updated Successfully!");
}

else if(isset($_POST['delete_color_btn']))
{
    $color_id = mysqli_real_escape_string($con, $_POST['color_id']);

    $category_query = "SELECT * FROM seat_color WHERE id='$color_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['img_src'];

    $delete_query = "DELETE FROM seat_color WHERE id='$color_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        
        //redirect("category.php", "Category deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("category.php", "Something went wrong");
        echo 500;
    }
}

else if(isset($_POST['update_color_btn']))
{  
    $id = $_POST['id'];
    $color = $_POST['color'];
 
    $image = $_FILES['image']['name'];
 
    $path = "../uploads";
 
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE seat_color SET color='$color', img_src='$update_filename' WHERE id='$id' ";
    
    $update_product_query_run = mysqli_query($con, $update_product_query);

    if($update_product_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-color.php?id=$id", "Seat Cover Color Updated Successfully");
    }
    else
    {
        redirect("edit-color.php?id=$id", "Something Went Wrong");
    }
}

else if(isset($_POST['add_color_btn'])){
    $product_id = $_POST['category_id'];
    $color = $_POST['color'];
 
    $image = $_FILES['image']['name'];
 
    $path = "../uploads";
 
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if ($product_id != "") {

        $color_query = "INSERT INTO seat_color 
        (color, img_src, product_id) 
        VALUES ('$color', '$filename', $product_id)";
    
        $color_query = mysqli_query($con, $color_query);
    
        if($color_query)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
    
            redirect("add_color.php", "Seat Cover Color Added Successfully");
        }
        else
        {
            redirect("add_color.php", "Someting Went Wrong");
        }
        // redirect("view-order.php?trackingno=$track_no", "Order Status Updated Successfully");
    }
    else
        {
            redirect("add_color.php", "Someting Went Wrong");
        }
    
}
else
{
    header('Location: ../index.php');
}
?>
