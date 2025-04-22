<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <title>Business</title>
</head>
<body class="py-4">
    <!-- Side Nav -->
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column flex-shrink-0 p-0" style="width: 250px;">
            <div class="logo">
                <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>Business Panel</h4>
            </div>
            <ul class="nav flex-column mb-auto mt-3">
                <li class="nav-item">
                    <a href="#" class="nav-link active py-3">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link py-3">
                        <i class="fas fa-list"></i>
                        All Listings
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link py-3">
                        <i class="fas fa-clock"></i>
                        Ratings
                    </a>
                </li>
                <li class="nav-item business-setting">
                    <a href="#" class="nav-link py-3">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                </li>
            </ul>
            <div class="logout-btn p-3">
                <a href="#" class="btn btn-outline-light w-100">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>
        <!-- Main Content -->
         <main class="main-content flex-grow-1">
            <div class="container-fluid w-100">
                <h1 class="mb-4">Overview</h1>
                <div class="card admin-table w-100 shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Product Listings</h5>
                            <div class="d-flex w-100 justify-content-between">
                                <!-- Search Engine -->
                                <?php include 'inc/search.php'; ?>
                                <button class="btn add-new-btn">
                                <a href="create.php" class="nav-link py-3">
                                    <i class="fas fa-plus me-1"></i> Add New Product / Service
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <?php session_start(); 
                        if (isset($_SESSION["create"])){?> <div class="alert alert-success"> <?php echo $_SESSION["create"];?> </div> <?php unset($_SESSION["create"]); } ?>
                        <?php if (isset($_SESSION["update"])) { ?> <div class="alert alert-success"> <?php echo $_SESSION["update"]; ?> </div> <?php unset($_SESSION["update"]); } ?>
                        <?php if(isset($_SESSION["delete"])) { ?> <div class="alert alert-success"> <?php echo $_SESSION["delete"];?> </div> <?php unset($_SESSION["delete"]);} ?>
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Certification</th>
                                        <th>Quantity Available</th>
                                        <th>Health Benefits</th>
                                        <th>Ratings</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                include('databaseConnection.php');
                                $sqlSelect = "SELECT * FROM products_and_services";
                                $result = mysqli_query($conn,$sqlSelect);
                                while($data = mysqli_fetch_array($result)){  
                                  ?>                             
                                    <tr>
                                    <td><?php echo $data['product_name']; ?></td>
                                    <td><?php echo $data['product_category']; ?></td>
                                    <td><?php echo $data['price_category']; ?></td>
                                    <td><?php echo $data['certifications']; ?></td>
                                    <td><?php echo $data['quantity']; ?></td>
                                    <td><?php echo $data['health_benefits']; ?></td>
                                    <td><?php echo $data['votes_yes_no']; ?></td>
                                        <td>
                                        <a href="view.php?id=<?php echo $data['product_id']; ?>" class="btn btn-info">More info</a>
                                        <a href="edit.php?id=<?php echo $data['product_id']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="delete.php?id=<?php echo $data['product_id']; ?>" class="btn btn-danger">Delete</a>
                                      </td>
                                    </tr>
                                  <?php
                                  }
                                  ?>  
                                </tbody>
                            </table>
                            <input type="submit" value="Submit" name="login" class="btn admin-submit-btn p-2 float-end">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
      
  