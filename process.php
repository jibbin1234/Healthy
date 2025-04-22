<?php
session_start();
include('databaseConnection.php');

if (isset($_GET["productServiceCategory"])) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM productServiceCategory");    
    if ($stmt) {              
        mysqli_stmt_execute($stmt);// Execute the statement        
        $result = mysqli_stmt_get_result($stmt);// Get the result
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }        
        echo json_encode($categories);// Return JSON response
    }
}

if (isset($_GET["getSubCategories"])) {
    $category_id = $_GET["getSubCategories"]; 
    $stmt = mysqli_prepare($conn, "SELECT * FROM productServiceSubType WHERE category_id = $category_id AND business_id = 0");    
    if ($stmt) {              
        mysqli_stmt_execute($stmt);// Execute the statement        
        $result = mysqli_stmt_get_result($stmt);// Get the result
        $subCategories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $subCategories[] = $row;
        }        
        echo json_encode($subCategories);
    } else {
        echo "failed to execute";
    }
}

if (isset($_POST["submitAddArea"])) {
    $county = $_POST["county"];
    $area = $_POST["area"];;
    $county_id = $_POST["county_id"];
    $region = $_POST["region"];
    $councilor_id = $_SESSION["CouncilorId"];                
    $errors = array();
    $sql = "INSERT INTO areaTable (county, area, county_id, region, councilor_id) VALUES ( ?, ?, ?, ?, ? )";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ssisi",$county, $area, $county_id, $region, $councilor_id);
    if(mysqli_stmt_execute($stmt)){
        echo "Success";
        die();
    } else {
        echo "Failed";
        die();
    }
}

if (isset($_GET["populateContentCouncilArea"])) {
    $id = $_GET['populateContentCouncilArea'];
    $stmt = mysqli_prepare($conn, "SELECT county_id FROM councilor WHERE id = $id");    
    if ($stmt) {              
        mysqli_stmt_execute($stmt);// Execute the statement        
        $result = mysqli_stmt_get_result($stmt);// Get the result
        $row = mysqli_fetch_assoc($result);
        $output = [];
        $output["county_id"] = $row["county_id"];  
        $stmt = mysqli_prepare($conn, "SELECT * FROM countyTable WHERE id = ?"); 
        mysqli_stmt_bind_param($stmt,"i",$output["county_id"]);
        if ($stmt) {
            mysqli_stmt_execute($stmt);// Execute the statement        
            $result = mysqli_stmt_get_result($stmt);// Get the result
            $row = mysqli_fetch_assoc($result);
            $output["region"] = $row["region"];
            $output["county"] = $row["county"];
        }
        echo json_encode($output);// Return JSON response
    }
}


if (isset($_GET["deleteArea"])) {
    $id = $_GET['deleteArea'];
    $sql = "DELETE FROM areaTable WHERE id='$id'";
    $response = "";
    if(mysqli_query($conn,$sql)){
        $response = "Area deleted";
        echo json_encode($response);

    }else{
        $response = "Failed to delete area";
        echo json_encode($response);
    }
}

if (isset($_GET["region"])) {
    $region = $_GET["region"];
    $stmt = mysqli_prepare($conn, "SELECT * FROM countyTable WHERE region = ?");    
    if ($stmt) {        
        mysqli_stmt_bind_param($stmt, "s", $region);// Bind the parameter (s = string)        
        mysqli_stmt_execute($stmt);// Execute the statement        
        $result = mysqli_stmt_get_result($stmt);// Get the result
        $counties = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $counties[] = $row;
        }        
        echo json_encode($counties);// Return JSON response
    }
}

if (isset($_GET["county"])) {
    $county = $_GET["county"];
    $stmt = mysqli_prepare($conn, "SELECT * FROM areaTable WHERE county = ?");    
    if ($stmt) {        
        mysqli_stmt_bind_param($stmt, "s", $county);// Bind the parameter (s = string)        
        mysqli_stmt_execute($stmt);// Execute the statement        
        $result = mysqli_stmt_get_result($stmt);// Get the result
        $areas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $areas[] = $row;
        }        
        echo json_encode($areas);// Return JSON response
    }
}

if (isset($_GET["councilorArea"])) {
    $user_id = $_GET["councilorArea"];
    $stmt = mysqli_prepare($conn, "SELECT * FROM areaTable WHERE councilor_id = ?");    
    if ($stmt) {        
        mysqli_stmt_bind_param($stmt, "s", $user_id);// Bind the parameter (s = string)        
        mysqli_stmt_execute($stmt);// Execute the statement        
        $result = mysqli_stmt_get_result($stmt);// Get the result
        $areas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $areas[] = $row;
        }        
        echo json_encode($areas);// Return JSON response
    }
}

if (isset($_POST["create"])) {
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $description = mysqli_real_escape_string($conn, $_POST["product_description"]);
    $type = mysqli_real_escape_string($conn, $_POST["product_or_service"]);
    $available_qunatity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $health_benefits = mysqli_real_escape_string($conn, $_POST["health_benefits"]);
    $price_category = mysqli_real_escape_string($conn, $_POST["price_category"]);
    $certifications = mysqli_real_escape_string($conn, $_POST["certifications"]);
    $status = mysqli_real_escape_string($conn, $_POST["product_status"]);
    $votes = mysqli_real_escape_string($conn, $_POST["votes_yes_no"]);
    $product_category = mysqli_real_escape_string($conn, $_POST["product_category"]);

    $sqlInsert = "INSERT INTO products_and_services (product_name, product_description, product_or_service, quantity, health_benefits, price_category, certifications, product_status, votes_yes_no, product_category) 
                    VALUES('$product_name', '$description', '$type', '$available_qunatity', '$health_benefits', '$price_category', '$certifications', '$status', '$votes', '$product_category')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Added Successfully!";
        header("Location:business.php");
    }else{
        die("Something went wrong");
    }
}
if (isset($_POST["edit"])) {
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $description = mysqli_real_escape_string($conn, $_POST["product_description"]);
    $type = mysqli_real_escape_string($conn, $_POST["product_or_service"]);
    $available_qunatity = $_POST["quantity"];
    $health_benefits = mysqli_real_escape_string($conn, $_POST["health_benefits"]);
    $price_category = mysqli_real_escape_string($conn, $_POST["price_category"]);
    $certifications = mysqli_real_escape_string($conn, $_POST["certifications"]);
    $status = mysqli_real_escape_string($conn, $_POST["product_status"]);
    $votes = mysqli_real_escape_string($conn, $_POST["votes_yes_no"]);
    $product_category = mysqli_real_escape_string($conn, $_POST["product_category"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE products_and_services 
                    SET product_name = '$product_name', 
                    product_description = '$description', 
                    product_or_service = '$type', 
                    quantity = '$available_qunatity', 
                    health_benefits = '$health_benefits', 
                    price_category = '$price_category', 
                    certifications = '$certifications', 
                    product_status = '$status', 
                    votes_yes_no = '$votes', 
                    product_category = '$product_category' 
                    WHERE product_id='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Updated Successfully!";
        header("Location:business.php");
    }else{
        die("Something went wrong");
    }
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];           
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $userType = $_POST["userType"];
    
    if (empty($name) OR empty($email) OR empty($password) OR empty($passwordRepeat) ) {
        echo "All fields are required";
        die();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo  "Email is not valid";
        die();
    }
    if (strlen($password)<8) {
        echo "Password must be at least 8 charactes long";
        die();
    }
    if ($password!==$passwordRepeat) {
        echo "Password does not match";
        die();
    }
    if (empty($userType)) {
        echo "Please select user type";
        die();
    }
    $sql = "SELECT * FROM user_authentication WHERE email_id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);    
    mysqli_stmt_bind_param($stmt,"s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        echo "Email already exists!";
        die();
    }

    mysqli_begin_transaction($conn); // Start transaction

    $success = true; // Flag to track insert success
    $error = "Error: ";
    $sql = "INSERT INTO user_authentication (user_name, email_id, password,  user_type) VALUES ( ?, ?, ?, ? )";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt,$sql)){
        mysqli_stmt_bind_param($stmt,"ssss",$name, $email, $passwordHash, $userType);
        if(mysqli_stmt_execute($stmt)){   
            $inserted_id = mysqli_insert_id($conn);
            if ($userType == "Admin"){
                $adminKey = $_POST["adminKey"];
                if ( empty($adminKey) OR ($adminKey != "aforapple")) {
                    $error .= "\nInvalid admin key: please enter the correct admin key to register as admin";
                    $success = false;
                } 
            } else if ($userType == "Business"){
                $companyName = $_POST["companyName"];
                $contactBusiness = $_POST["contactBusiness"];
                $category = $_POST["productServiceCategory"];
                $subCategory = $_POST["subCategories"];
                if ( empty($companyName) OR empty($contactBusiness) OR empty($category)) {
                    $error .= "\nInvalid values: please enter the correct values and try again";
                    $success = false;
                } else {
                    $sql = mysqli_prepare($conn, "INSERT INTO business(id, companyName, contactInfo, category_id) VALUES (?,?,?,?)");                     
                    mysqli_stmt_bind_param($sql, "issi", $inserted_id, $companyName, $contactBusiness, $category);    // Bind the parameter (s = string)
                    if(mysqli_stmt_execute($sql)){    // Execute the statement 
                        foreach($subCategory as $subCatId){
                            $sql = mysqli_prepare($conn, "UPDATE productServiceSubType SET business_id=? WHERE id=?");
                            mysqli_stmt_bind_param($sql, "ii", $inserted_id, $subCatId);
                            if(!mysqli_stmt_execute($sql)){
                                $error .= "\nFailed to add sub category, try again";
                                $success = false;
                            }
                        }
                    } else {
                        $error .= "\nIFailed to add business: please enter the correct values and try again";
                        $success = false;
                    }
                }        
            } else if ($userType == "Councilor"){
                $county = $_POST["county"];
                $contact = $_POST["contact"];
                $region = $_POST['region'];
                if ( empty($county) OR empty($contact) OR empty($region)) {
                    echo "Business registration unsuccessful";
                    $error .= "\nEmpty or invalid input, try again";
                    $success = false;
                } else {
                    $sqlVerify = mysqli_prepare($conn, "SELECT * FROM countyTable WHERE region=? AND county=?");
                    mysqli_stmt_bind_param($sqlVerify, "ss", $region, $county);    // Bind the parameter (s = string)
                    mysqli_stmt_execute($sqlVerify);    // Execute the statement            
                    $resultVerify = mysqli_stmt_get_result($sqlVerify);
                    $dataVerify = mysqli_fetch_assoc($resultVerify);
                    $county_id = $dataVerify["id"];

                    $sqlCheckCouncilor = mysqli_prepare($conn, "SELECT * FROM councilor WHERE county_id=?");
                    mysqli_stmt_bind_param($sqlCheckCouncilor, "s", $county_id);    // Bind the parameter (s = string)
                    mysqli_stmt_execute($sqlCheckCouncilor);    // Execute the statement            
                    $sqlCheckCouncilor = mysqli_stmt_get_result($sqlCheckCouncilor);
                    $dataVerify = mysqli_fetch_assoc($resultVerify);
        
                    if (mysqli_num_rows($sqlCheckCouncilor) == 0) {
                        // Councilor does not exist - create councilor
                        $sqlInsert = mysqli_prepare($conn, "INSERT INTO councilor(id, name, contact_number, county_id) VALUES (?,?,?,?)"); 
                        mysqli_stmt_bind_param($sqlInsert, "issi", $inserted_id, $name, $contact, $county_id);    // Bind the parameter (s = string)
                        if(!mysqli_stmt_execute($sqlInsert)){    // Execute the statement 
                            $error .= "\n Failed to add councilor, contact Admin"; 
                            $success = false;
                        }
                    } else {
                        $error .= "\nFailed to add user: Councilor for the county already exists"; 
                        $success = false;
                    }                                  
                }                   
            } else if ($userType == "Resident"){

                $areaId = $_POST['areaResident'];
                $residentCategories = $_POST['categoriesResident'];

                if (!isset($residentCategories) OR empty($areaId)) {
                    $error .= "\nAll fields are required"; 
                    $success = false;
                } else {                    
                    foreach($residentCategories as $subCatId){
                        $sql = mysqli_prepare($conn, "INSERT INTO resident(id, area_id, category_id) VALUES (?,?,?)"); 
                        mysqli_stmt_bind_param($sql, "iii", $inserted_id, $areaId, $subCatId);
                        if(!mysqli_stmt_execute($sql)){
                            $error .= "\nFailed to add sub category, try again";
                            $success = false;
                        }
                    }                
                }                    
            }          
        }else {
            $error .= "\nFailed to add user: contact admin";
            $success = false;
        }
    } else {
        $error .= "\nFailed to add user: Check input fields and try again";
    }
    // Check if all inserts were successful
    if ($success) {
        mysqli_commit($conn); // Commit transaction if all inserts succeed
        echo "New user added successfully";
    } else {
        mysqli_rollback($conn);
        echo nl2br($error);
    }
    mysqli_close($conn);
}



if (isset($_POST["login"])) {            
    $email = $_POST["email"];
    $password = $_POST["password"];
    $userType = $_POST["userType"];
    $sql = "SELECT * FROM user_authentication WHERE email_id = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        if (password_verify($password, $user["password"])) {
            session_start();
            if($userType == "Admin"){
                $_SESSION["Admin"] = "yes";
                $_SESSION["AdminId"] = $user["user_id"];
                header("Location: admin.php");
                die();
            }
            if($userType == "Resident"){
                $_SESSION["Resident"] = "yes";
                $_SESSION["ResidentId"] = $user["user_id"];
                header("Location: resident.php");
                die();
            }
            if($userType == "Councilor"){
                $_SESSION["Councilor"] = "yes";
                $_SESSION["CouncilorId"] = $user["user_id"];
                header("Location: council.php");
                die();
            }
            if($userType == "Business"){
                $_SESSION["Business"] = "yes";
                $_SESSION["BusinessId"] = $user["user_id"];
                header("Location: business.php");
                die();
            }
        }else{
            echo "Password does not match";
        }
    }else{
        echo "Email does not match";
    }
}
?>