<main>

    <div class="content-top">
        <!-- Search Engine -->
        <?php include 'inc/search.php'; ?>

        <!-- Add new company-->
        <button class="add" id="addCompanyBtn">
           <span>+</span> Add new company
        </button>
    </div>

      <!-- Business List-->
    <div class="table-container">
        <table id="businessTable">
            <thead>
                <tr>
                    <th>Business name</th>
                    <th>Email</th>
                    <th>Business type</th>
                    <th>Registration year</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
             <tbody>
                
                <tr>
                    <td>Amazon</td>
                    <td>user@amazon.com</td>
                    <td>Ecommerce</td>
                    <td>2025</td>
                    <td class="status-verified">Verified</td>
                    <td>
                        <button class="action-btn edit-btn" data-id="1">Edit</button>
                        <button class="action-btn delete-btn" data-id="1">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Tech Solutions</td>
                    <td>contact@tech.com</td>
                    <td>IT Services</td>
                    <td>2024</td>
                    <td class="status-pending">Pending</td>
                    <td>
                        <button class="action-btn edit-btn" data-id="2">Edit</button>
                        <button class="action-btn delete-btn" data-id="2">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Add Company Popup Form (hidden by default) -->
    <div class="popup-form" id="companyFormPopup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Add New Company</h2>
            <form id="addCompanyForm">
                <div class="form-group">
                    <label for="companyName">Business Name*</label>
                    <input type="text" id="companyName" name="companyName" required>
                </div>
                
                <div class="form-group">
                    <label for="companyEmail">Email*</label>
                    <input type="email" id="companyEmail" name="companyEmail" required>
                </div>
                
                <div class="form-group">
                    <label for="businessType">Business Type*</label>
                    <select id="businessType" name="businessType" required>
                        <option value="">Select type</option>
                        <option value="Ecommerce">Ecommerce</option>
                        <option value="Retail">Retail</option>
                        <option value="Service">Service</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="registrationYear">Registration Year</label>
                    <input type="number" id="registrationYear" name="registrationYear" 
                           min="2000" max="2099" value="<?php echo date('Y'); ?>">
                </div>
                
                <div class="form-group">
                    <label for="status">Initial Status</label>
                    <select id="status" name="status">
                        <option value="pending">Pending Verification</option>
                        <option value="verified">Verified</option>
                    </select>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Add Company</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>



   
<script src="/index.js"></script>
</main>
    
  


    