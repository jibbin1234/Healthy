<?php
session_start(); // Start the session 
// Check if the user is logged in
if (!isset($_SESSION["Councilor"])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit;
} else {
    $user_id = $_SESSION["CouncilorId"];
}
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
    <title>Council Dashboard</title>
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
                <button class="nav-link active" id="analytics-tab" data-bs-toggle="tab" data-bs-target="#analytics" type="button" role="tab">View Analytics</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="add-area-tab" data-bs-toggle="tab" data-bs-target="#add-area" type="button" role="tab" onclick="populateContentCouncilArea(); getAreas();" >Add Area</button>
            </li>
        </ul>
    </nav>
    
    <!-- Dashboard Content -->
    <main class="dashboard-content">
        <div class="tab-content" id="dashboardTabsContent">
            <!-- Analytics Tab -->
            <div class="tab-pane fade show active" id="analytics" role="tabpanel">
                <h2 class="mb-4 mt-4">Product Analytics</h2>
                <div class="chart-container">
                    <canvas id="analyticsChart"></canvas>
                </div>
            </div>
            
            <!-- Add Area Tab -->
            <div class="tab-pane fade" id="add-area" role="tabpanel">
                <h2 class="mb-4">Add New Area</h2>

                <form id="formAddArea" class="add-area-form d-flex flex-column justify-content-center align-items-center">
                    <div class="mb-3 w-100">  
                        <div id="submitAddArea"></div>                                          
                        <div>
                            <input type="text" class="form-control form-select" name="area" placeholder="Enter new area" required>
                        </div>
                    </div>
                    <button type="submit"  name="submitAddArea" class="btn hero-btn">Add Area</button>
                </form>
                
                <!-- Areas Table -->
                <div class="areas-table">
                    <h3 class="mb-3">Added Areas</h3>
                    <div class="alert alert-success" id="messageBox" hidden>  </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>                                    
                                    <th>Region</th><th>County</th><th>Area</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="councilorAreas">   </tbody>
                        </table>
                    </div>
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
                    data: [35, 25, 15, 15, 10],
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
        
        
        document.getElementById('formAddArea').addEventListener('submit', function(e) {
            e.preventDefault(); 
            const formData = new FormData(this);
            formData.append('submitAddArea', true);
            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log("Server response:", data);
                getAreas();
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
        
       
        function populateContentCouncilArea(){

            let user_id = <?php echo $_SESSION["CouncilorId"] ?>;

            fetch(`process.php?populateContentCouncilArea=${user_id}`)
            .then(response => response.json())
            .then(function(data) {
                let formElement = document.getElementById('submitAddArea');
                let formDiv = document.createElement('div');
                formElement.innerHTML = "";
                //formDiv.replaceChildren();
                formDiv.innerHTML = `
                    <label for="region" class="form-label">Region: ${data.region}</label>
                    <input type="text" class="form-control" name="region" value="${data.region}" hidden>                    
                    <label for="county" class="form-label">County: ${data.county}</label>
                    <input type="text" class="form-control" name="county" value="${data.county}" hidden>                    
                    <input type="text" class="form-control" name="county_id" value="${data.county_id}" hidden>
                    <input type="text" class="form-control" name="councilor_id" value="${user_id}" hidden>
                `;
                formElement.appendChild(formDiv);
            });
        }


        function getAreas() {
            let user_id = <?php echo $_SESSION["CouncilorId"] ?>;
            fetch(`process.php?councilorArea=${user_id}`)
            .then(response => response.json())
            .then(function(data) {
                const tbody = document.getElementById('councilorAreas');
                tbody.innerHTML = '';
                data.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${user.region}</td>
                    <td>${user.county}</td>
                    <td>${user.area}</td>
                    <button onclick="deleteArea(${user.id})" class="btn btn-sm btn-outline-danger">Remove</button>`;
                    tbody.appendChild(row);
                })
            });
        }


        function deleteArea(id) {
            fetch(`process.php?deleteArea=${id}`)
            .then(response => response.json())
            .then(function(data) {   
                getAreas();            
                const messageBox = document.getElementById('messageBox');
                messageBox.textContent = data; // Example: "success"                
            });
        }
    </script>
</body>
</html>