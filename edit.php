<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit Product or Service</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Edit Product / Service</h1>
            <div>
            <a href="business.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <?php 
            
            if (isset($_GET['id'])) {
                include("databaseConnection.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM products_and_services WHERE product_id=$id";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                ?>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="product_name" placeholder="Product/Service Name:" value="<?php echo $row["product_name"]; ?>">
            </div>
            
            <div class="form-element my-4">
                <textarea name="product_description" id="" class="form-control" placeholder="Description:"><?php echo $row["product_description"]; ?></textarea>
            </div>
            <div class="form-elemnt my-4">
                <select name="product_or_service" id="" class="form-control">
                    <option value="">Select Type:</option>
                    <option value="Product" <?php if($row["product_or_service"]=="Product"){echo "selected";} ?>>Product</option>
                    <option value="Service" <?php if($row["product_or_service"]=="Service"){echo "selected";} ?>>Service</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="health_benefits" placeholder="Health benefits:" value="<?php echo $row["health_benefits"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <input type="number" class="form-control" name="quantity" placeholder="Available quantity:" value="<?php echo $row["quantity"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <select name="price_category" id="" class="form-control">
                    <option value="">Select price category:</option> 
                    <option value="Affordable" <?php if($row["price_category"]=="Affordable"){echo "selected";} ?>>Affordable</option>
                    <option value="Moderate" <?php if($row["price_category"]=="Moderate"){echo "selected";} ?>>Moderate</option>
                    <option value="Premium" <?php if($row["price_category"]=="Premium"){echo "selected";} ?>>Premium</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="certifications" placeholder="Certifications:" value="<?php echo $row["certifications"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <select name="product_status" id="" class="form-control">
                    <option value="">Select Type:</option>
                    <option value="Available" <?php if($row["product_status"]=="Available"){echo "selected";} ?>>Available</option>
                    <option value="Unavailabale" <?php if($row["product_status"]=="Unavailabale"){echo "selected";} ?>>Unavailabale</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="votes_yes_no" placeholder="Votes:" value="<?php echo $row["votes_yes_no"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="product_category" placeholder="Product category:" value="<?php echo $row["product_category"]; ?>">
            </div>            
            <input type="hidden" value="<?php echo $row["product_id"]; ?>" name="id">
            <div class="form-element my-4">
                <input type="submit" name="edit" value="Edit Product / Service" class="btn btn-primary">
            </div>
                <?php
            }else{
                echo "<h3>Does Not Exist</h3>";
            }
            ?>
           
        </form>
        
        
    </div>
</body>
</html>