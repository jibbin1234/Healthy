<?php
// session_start(); // Start the session 
// // Check if the user is logged in
// if (!isset($_SESSION["Business"])) {
//     // If not logged in, redirect to the login page
//     header("Location: login.php");
//     exit;
// } else {
//     $user_id = $_SESSION["BusinessId"];
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Business Dashboard</title>

</head>
<body>
    <!-- Dashboard Header -->
    <header class="dashboard-header">
        <img src="images/logo-dark.svg" alt="Council Logo" class="logo">
        <div class="profile-section">
            <i class="bi bi-person-circle profile-icon"></i>
        </div>
    </header>
    
    <!-- Dashboard Nav -->
    <nav class="dashboard-nav mt-4 d-flex justify-content-center align-items-center">
        <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="listings-tab" data-bs-toggle="tab" data-bs-target="#listings" type="button" role="tab">Products / Services</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Ratings</button>
            </li>
        </ul>
    </nav>
    
    <!-- Dashboard Content -->
    <main class="dashboard-content">
        <div class="tab-content" id="dashboardTabsContent">
            
        <!-- Products / Services -->
            <div class="tab-pane fade show active" id="listings" role="tabpanel">
                <div class="products-top mb-5">
                    <h2 class="mb-4">Products / Services</h2>
                    <button class="btn-add"><a href="create.php"> Add New Product / Service</button>  
                </div>
                
                <div class="table-responsive data-table">
                <?php session_start(); 
                        if (isset($_SESSION["create"])){?> <div class="alert alert-success"> <?php echo $_SESSION["create"];?> </div> <?php unset($_SESSION["create"]); } ?>
                        <?php if (isset($_SESSION["update"])) { ?> <div class="alert alert-success"> <?php echo $_SESSION["update"]; ?> </div> <?php unset($_SESSION["update"]); } ?>
                        <?php if(isset($_SESSION["delete"])) { ?> <div class="alert alert-success"> <?php echo $_SESSION["delete"];?> </div> <?php unset($_SESSION["delete"]);} ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Price</th>
                                <th>Votes</th>
                                <th>Availability</th>
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
                                    <td><?php echo $data['price_category']; ?></td>
                                    <td><?php echo $data['certifications']; ?></td>
                                    <td><?php echo $data['quantity']; ?></td>
                                    <td><?php echo $data['health_benefits']; ?></td>
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
                </div>
            </div>
            
            <!-- Products Ratings -->
            <div class="tab-pane fade show active" id="analytics" role="tabpanel">
                <h2 class="mb-4 mt-4">Product Ratings</h2>
                <div class="chart-container">
                    <canvas id="analyticsChart"></canvas>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('analyticsChart').getContext('2d');
        const analyticsChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Yoga Mats', 'Organic Fruits', 'Eco Cleaning', 'Sustainable Clothing', 'Mindfulness Books'],
                datasets: [{
                    data: [35, 25, 15, 15,80],
                    backgroundColor: [
                        '#00A251',
                        '#2ECC71',
                        '#3498DB',
                        '#9B59B6',
                        '#F1C40F'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Product Category Distribution',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });

        // Form submission handler
        document.querySelector('.add-area-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            alert('Area added successfully!');
        });

    </script>
</body>
</html>