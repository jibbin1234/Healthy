<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Add New Book</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Add New Product / Service</h1>
            <div>
            <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="process.php" method="post">
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="product_name" placeholder="Product/Service Name:">
            </div>            
            <div class="form-element my-4">
                <textarea name="product_description" id="" class="form-control" placeholder="Description:"> </textarea>
            </div>
            <div class="form-elemnt my-4">
                <select name="product_or_service" id="" class="form-control">
                    <option value="">Select Type:</option>
                    <option value="Product">Product</option>
                    <option value="Service" >Service</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="health_benefits" placeholder="Health benefits:">
            </div>
            <div class="form-elemnt my-4">
                <input type="number" class="form-control" name="quantity" placeholder="Available quantity:" >
            </div>
            <div class="form-elemnt my-4">
                <select name="price_category" id="" class="form-control">
                    <option value="">Select price category:</option> 
                    <option value="Affordable" >Affordable</option>
                    <option value="Moderate" >Moderate</option>
                    <option value="Premium" >Premium</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="certifications" placeholder="Certifications:" >
            </div>
            <div class="form-elemnt my-4">
                <select name="product_status" id="" class="form-control">
                    <option value="">Select Type:</option>
                    <option value="Available" >Available</option>
                    <option value="Unavailabale">Unavailabale</option>
                </select>
            </div>
            <div class="form-elemnt my-4">
                <input type="hidden" value="0" class="form-control" name="votes_yes_no" placeholder="Votes:" >
            </div>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="product_category" placeholder="Product category:" >
            </div>         
            <div class="form-element my-4">
                <input type="submit" name="create" value="Add Product / Service" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>