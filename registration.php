<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">        
        <form name="registration" id="registration">
            <div class="form-group my-4">
                <select name="userType" id="userType" onChange="showSet(this.value); getProductServiceCategory(this.value);" class="form-control">
                    <option value="">Select User Type:</option>
                    <option value="Admin">Admin</option>
                    <option value="Business">Business</option>
                    <option value="Councilor">Councilor</option>
                    <option value="Resident">Resident</option>
                </select>
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="name" placeholder="Full Name:">
            </div>            
            <div class="form-elemnt my-4 userType"  name="Admin" hidden>
                <input type="text" class="form-control" name="adminKey" placeholder="Admin registration secret key:">
            </div>
            <div class="form-elemnt my-4 userType"  name="Councilor" hidden>
                <input type="text" class="form-control" name="contact" placeholder="Contact Number:">
            </div>
            <div class="form-element my-4 userType" name="Councilor" hidden>                
                <select name="region" id="region" onClick="getCounties(this.value)" class="form-control">
                    <option value="" disabled selected hidden>Select Region</option>
                    <option value="England" >England</option>
                    <option value="Scotland">Scotland</option>
                    <option value="Wales">Wales</option>
                    <option value="Northern Ireland">Northern Ireland</option>
                </select>
            </div>
            <div class="form-elemnt my-4 userType" name="Councilor" hidden>
                <select name="county" id="county"  class="form-control"> 
                </select>
            </div>
            <div class="form-element my-4 userType" name="Resident" hidden>                
                <select name="regionResident" id="regionResident" onClick="getCountiesResident(this.value)" class="form-control">
                    <option value="" disabled selected hidden>Select Region</option>
                    <option value="England" >England</option>
                    <option value="Scotland">Scotland</option>
                    <option value="Wales">Wales</option>
                    <option value="Northern Ireland">Northern Ireland</option>
                </select>
            </div>
            <div class="form-elemnt my-4 userType" name="Resident" hidden>
                <select name="countyResident" id="countyResident"  onClick="getAreasResident(this.value)" class="form-control" > 
                </select>
            </div>
            <div class="form-elemnt my-4 userType" name="Resident" hidden>
                <select name="areaResident" id="areaResident" onClick="getCategories();" class="form-control" > 
                </select>
            </div>
            <div id="checkboxResident" class="form-element my-4 userType" name="Resident" hidden>
                
            </div>
            <div class="form-elemnt my-4 userType"  name="Business" hidden>
                <input type="text" class="form-control" name="companyName" placeholder="Enter company name">
            </div>         
            <div class="form-elemnt my-4 userType"  name="Business" hidden>
                <input type="text" class="form-control" name="contactBusiness" placeholder="Contact Number:">
            </div>
            <div class="form-element my-4 userType" name="Business" hidden>                
                <select name="productServiceCategory" id="productServiceCategory" onClick="loadCheckboxes(this.value);" class="form-control">
                    <option value="" disabled selected hidden>Select product service category</option>
                </select>
            </div>
            <div id="checkboxContainer" class="form-element my-4 userType" name="Business" hidden>

            </div>
            <div class="form-group my-4">
                <input type="emamil" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group my-4">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group my-4">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn my-4">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div class="alert alert-danger" id="alertMessage" hidden> </div>
        <div>
        <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
      </div>
    </div>


    <script>
    document.getElementById('registration').addEventListener('submit', function(e) {
        e.preventDefault(); 
        const formData = new FormData(this);
        formData.append('submit', true);
        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const otputElement = document.getElementById('alertMessage');
            otputElement.textContent  = "";
            otputElement.textContent = data;
            otputElement.hidden = false;
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
    function getCategories() {
        fetch(`process.php?productServiceCategory=true`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('checkboxResident');
            container.innerHTML = ''; // clear previous checkboxes

            data.forEach(item => {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'categoriesResident[]';
                checkbox.value = item.id;
                checkbox.id = `category_${item.id}`;

                const label = document.createElement('label');
                label.htmlFor = checkbox.id;
                label.textContent = item.category;

                const wrapper = document.createElement('div');
                wrapper.appendChild(checkbox);
                wrapper.appendChild(label);

                container.appendChild(wrapper);
            });
            container.hidden = false;
        });
    }
    function loadCheckboxes(categoryID) {
        fetch(`process.php?getSubCategories=${categoryID}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('checkboxContainer');
            container.innerHTML = ''; // clear previous checkboxes

            data.forEach(item => {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'subCategories[]';
                checkbox.value = item.id;
                checkbox.id = `category_${item.id}`;

                const label = document.createElement('label');
                label.htmlFor = checkbox.id;
                label.textContent = item.subTypeName;

                const wrapper = document.createElement('div');
                wrapper.appendChild(checkbox);
                wrapper.appendChild(label);

                container.appendChild(wrapper);
            });
            container.hidden = false;
        });
    }
    function getProductServiceCategory(type){
        let productServiceCategoryDropDown = document.forms["registration"].productServiceCategory;
        if(type.trim() === "") {
            productServiceCategoryDropDown.disabled = true;
            productServiceCategoryDropDown.selectedIndex = 0;
            return false;
        } else if(type.trim() =="Business"){
            fetch(`process.php?productServiceCategory=true`)
            .then(response => response.json())
            .then(function(data) {
                let out = "";
                for(let x of data){
                    //out +=`<label><input type="checkbox" name="categories" value="${x['id']}">${x['category']}</label>`;
                    out +=`<option value="${x['id']}">${x['category']}</option>`;
                }
                productServiceCategoryDropDown.innerHTML = out;
                productServiceCategoryDropDown.disabled = false;
            });        
        }
        
    }
    function getCounties(region) {
        let countiesDropDown = document.forms["registration"].county;
        if(region.trim() === "") {
            countiesDropDown.disabled = true;
            countiesDropDown.selectedIndex = 0;
            return false;
        }
        fetch(`process.php?region=${region}`)
        .then(response => response.json())
        .then(function(data) {
            let out = `<option value="" disabled selected hidden>Select County</option>`;
            for(let x of data){
                out +=`<option value="${x['county']}">${x['county']}</option>`;
            }
            countiesDropDown.innerHTML = out;
            countiesDropDown.disabled = false;
        });
    }
    function showSet(value) {
        // hide all sections with the class "userSection" by setting the hidden attribute
        const sections = document.querySelectorAll('.userType');
        sections.forEach(function(section) {
            section.hidden = true;  // Hide all sections
        });
        // Show the relevant section based on the selected value
        if (value) {
            const elements = document.getElementsByName(value);
            elements.forEach(function(el) {
                el.hidden = false;
            });
        }        
    }

    function getCountiesResident(region) {
        let countiesDropDown = document.forms["registration"].countyResident;
        if(region.trim() === "") {
            countiesDropDown.disabled = true;
            countiesDropDown.selectedIndex = 0;
            return false;
        }
        fetch(`process.php?region=${region}`)
        .then(response => response.json())
        .then(function(data) {
            let out = `<option value="" disabled selected hidden>Select County</option>`;
            for(let x of data){
                out +=`<option value="${x['county']}">${x['county']}</option>`;
            }
            countiesDropDown.innerHTML = out;
            countiesDropDown.disabled = false;
        });
    }
    function getAreasResident(county) {
        let areasDropDown = document.forms["registration"].areaResident;
        if(county.trim() === "") {
            areasDropDown.disabled = true;
            areasDropDown.selectedIndex = 0;
            return false;
        }
        fetch(`process.php?county=${county}`)
        .then(response => response.json())
        .then(function(data) {
            let out = `<option value="" disabled selected hidden>Select area</option>`;
            for(let x of data){
                out +=`<option value="${x['id']}">${x['area']}</option>`;
            }
            areasDropDown.innerHTML = out;
            areasDropDown.disabled = false;
        });
    }
    </script>
</body>
</html>

