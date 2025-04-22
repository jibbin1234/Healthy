<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Book Details</title>
    <style>
        .product-details{
            background-color:#f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1>Product Details</h1>
            <div>
            <a href="business.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="product-details p-5 my-4">
            <?php
            include("databaseConnection.php");
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT * FROM products_and_services WHERE product_id = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                 ?>
                 <h3>Product name:</h3> <p><?php echo $row["product_name"]; ?></p>
                 <h3>Description:</h3> <p><?php echo $row["product_description"]; ?></p>
                 <h3>Type:</h3> <p><?php echo $row["product_or_service"]; ?></p>
                 <h3>Available qunatity:</h3> <p><?php echo $row["quantity"]; ?></p>
                 <h3>Health benefits:</h3> <p><?php echo $row["health_benefits"]; ?></p>
                 <h3>Price Category:</h3> <p><?php echo $row["price_category"]; ?></p>
                 <h3>Certifications:</h3> <p><?php echo $row["certifications"]; ?></p>
                 <h3>Status:</h3> <p><?php echo $row["product_status"]; ?></p>
                 <h3>Votes:</h3> <p><?php echo $row["votes_yes_no"]; ?></p>
                 <h3>Product category:</h3> <p><?php echo $row["product_category"]; ?></p>
                 <?php
                }
            }
            else{
                echo "<h3>No products or services found</h3>";
            }
            ?>            
        </div>
    </div>
</body>
</html>