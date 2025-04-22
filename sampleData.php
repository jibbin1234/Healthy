<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/healthy/databaseConnection.php";

// populate data
$sql =  "INSERT INTO user_authentication (User_type, Email_id, Password) VALUES
('Business', 'monica97@gmail.com', '1234'),
('Council', 'shawngarrett@yahoo.com', '2345'),
('Admin', 'kenneth89@hotmail.com', '3456'),
('Resident', 'marshallsarah@yahoo.com', 'Wy5XUYYqs@'),
('Resident', 'marcus05@gmail.com', 'F1sXVihu^J'),
('Business', 'williamscrystal@morris.com', 'P$9kslk6rV'),
('Resident', 'plane@gmail.com', ')10v@Pp&O'),
('Resident', 'johnsonsamuel@gmail.com', '$2O1zSb+6W'),
('Business', 'william84@hall.com', '1oNl7Avh(J'),
('Admin', 'meghanhanson@davis.com', 'hEt7FJ%j*&'),
('Council', 'emullen@taylor-lucas.net', 't!V3&X1b1&'),
('Council', 'michael37@gmail.com', 'gT9DTrdqd$'),
('Council', 'ischmidt@hotmail.com', '^Xiow7VtYZ'),
('Council', 'erika73@murphy.com', 'a27RWh2*^9'),
('Admin', 'wolfebrian@yahoo.com', 'Bb^#20Vr&p'),
('Resident', 'stephaniemorales@robinson.com', 'HTWW*<<OutputTruncated>>'),
('Council', 'dustin97@gmail.com', ')hSIt3a$9Z'),
('Business', 'vsmith@humphrey-crawford.org', '%Ox0ChjR0s'),
('Admin', 'denise33@smith.com', 'Wl75NFWm@t'),
('Council', 'kaylavaldez@hotmail.com', '_W*5^4Wh8N'),
('Resident', 'irivera@yahoo.com', '*i7Ov2Rm^j'),
('Business', 'scott53@yahoo.com', 'y&5RL)chc&'),
('Business', 'adrianhicks@gentry.com', '+vJ)2HUrA'),
('Admin', 'angelabell@gould.com', ')kDD1QBd9c'),
('Admin', 'lthomas@harvey.com', 'c@7tCBI5Od'),
('Business', 'elainehudson@yahoo.com', '(Tv*DmrvJ3'),
('Council', 'dustin30@martinez-bender.com', '*!k76Mk2b_'),
('Resident', 'lmartin@herman.com', '88Qpmxho^b'),
('Resident', 'dawsonpatricia@ferrell.com', 'SNs0KQ&sH%'),
('Admin', 'heatherclark@alvarez-gibson.com', '3s@Ounl#V'),
('Business', 'patrick02@stewart-jackson.com', 'JK%rd9SnC9')";

if(mysqli_query($conn,$sql)){
    echo "Table 'user_authentication' populated successfully";
}else{
    die("Something went wrong");
}

// Close Connection
$sql = "INSERT INTO products_and_services (product_name, product_description, product_or_service, quantity, health_benefits, price_category, certifications, product_status, votes_yes_no, product_category) VALUES
('Organic Green Tea', 'Premium quality organic green tea leaves from Darjeeling.', 'Product', 200, 'Rich in antioxidants, improves metabolism', 'Medium', 'USDA Organic', 'Available', '120/5', 'Beverages'),

('Herbal Massage Therapy', 'Full body massage using essential herbal oils.', 'Service', 50, 'Relieves stress, improves blood circulation', 'High', 'Ayurveda Certified', 'Available', '95/3', 'WellnessService'),

('Vegan Protein Bar', 'Delicious vegan protein bar made from plant-based ingredients.', 'Product', 500, 'High protein, supports muscle growth', 'Low', 'Non-GMO', 'Available', '200/10', 'Snacks'),

('Aromatherapy Session', 'Session using aromatic essential oils for therapeutic benefit.', 'Service', 30, 'Reduces anxiety, improves sleep', 'Medium', 'Certified Aromatherapist', 'Available', '60/2', 'AromaTherapy'),

('Gluten-Free Bread', 'Freshly baked gluten-free bread made from almond flour.', 'Product', 100, 'Easier digestion for gluten-sensitive people', 'Medium', 'FDA Approved', 'Available', '180/7', 'BakeryGoods'),

('Ayurvedic Health Consultation', 'One-on-one consultation with certified Ayurvedic doctor.', 'Service', 20, 'Customized diet and lifestyle advice', 'High', 'AYUSH Certified', 'Available', '45/1', 'HealthConsult'),

('Organic Honey', 'Raw and unfiltered honey sourced from local farms.', 'Product', 300, 'Boosts immunity, soothes sore throats', 'Medium', 'EcoCert', 'Available', '220/6', 'NaturalSweetener'),

('Yoga Classes', 'Group yoga sessions for all experience levels.', 'Service', 100, 'Improves flexibility, reduces stress', 'Low', 'Certified Yoga Instructor', 'Available', '150/2', 'YogaService'),

('Almond Milk', 'Plant-based milk made from organic almonds.', 'Product', 250, 'Lactose-free, rich in Vitamin E', 'Low', 'USDA Organic', 'Out of Stock', '130/4', 'DairyAlternatives'),

('Detox Juice Cleanse', '3-day detox plan with nutrient-packed juices.', 'Product', 80, 'Cleanses liver, boosts energy', 'High', 'Cold-Pressed Certified', 'Available', '90/5', 'DetoxPlan'),

('Turmeric Capsules', 'Natural turmeric extract in capsule form, used for joint pain and inflammation.', 'Product', 150, 'Anti-inflammatory, boosts immunity', 'Medium', 'GMP Certified', 'Available', '87/3', 'Supplements'),

('Reiki Healing Session', 'Energy healing session focused on emotional and spiritual well-being.', 'Service', 40, 'Balances energy, reduces stress', 'High', 'Certified Reiki Master', 'Available', '45/2', 'EnergyHealing'),

('Keto Meal Plan', 'Weekly subscription meal plan designed for ketogenic diets.', 'Service', 25, 'Supports weight loss, improves metabolism', 'High', 'Nutritionist Verified', 'Available', '75/5', 'MealPlanning'),

('Herbal Toothpaste', 'Fluoride-free toothpaste with neem and clove extracts.', 'Product', 300, 'Fights cavities, freshens breath', 'Low', 'ISO Certified', 'Available', '150/6', 'OralCare'),

('Essential Oil Diffuser', 'Electric diffuser for essential oils with auto shut-off.', 'Product', 120, 'Improves mood, purifies air', 'Medium', 'CE Certified', 'Available', '98/4', 'AromaDevices'),

('Chiropractic Adjustment', 'Spinal alignment therapy for back and neck pain relief.', 'Service', 60, 'Improves posture, relieves chronic pain', 'High', 'Licensed Chiropractor', 'Available', '40/1', 'ChiroCare'),

('Organic Face Cream', 'Natural moisturizer made with aloe vera and jojoba oil.', 'Product', 180, 'Hydrates skin, reduces wrinkles', 'Medium', 'Dermatologically Tested', 'Out of Stock', '134/2', 'Skincare'),

('Keto Granola Mix', 'Crunchy mix of seeds, nuts, and coconut for keto-friendly snacking.', 'Product', 150, 'Supports low-carb diet, boosts energy', 'Medium', 'Non-GMO', 'Available', '98/4', 'KetoSnacks'),

('Therapeutic Spa Session', 'Full-body therapeutic massage with essential oils.', 'Service', 40, 'Relieves muscle tension, improves relaxation', 'High', 'SpaCertified', 'Available', '76/2', 'TherapySpa'),

('Organic Turmeric Powder', 'Pure turmeric powder rich in curcumin, perfect for cooking or supplements.', 'Product', 300, 'Anti-inflammatory, boosts immunity', 'Low', 'USDA Organic', 'Available', '142/3', 'SpicesHealth'),

('Dietary Coaching', 'One-on-one coaching session with a certified dietitian.', 'Service', 25, 'Improves eating habits, aids weight loss', 'High', 'NutritionBoard', 'Available', '65/1', 'DietSupport'),

('Natural Lip Balm', 'Moisturizing balm made with beeswax and shea butter.', 'Product', 400, 'Prevents chapped lips, hydrates naturally', 'Low', 'EcoFriendly', 'Available', '112/2', 'lipCare'),

('Cold Pressed Coconut Oil', 'Versatile and organic coconut oil ideal for cooking and skincare.', 'Product', 200, 'Improves heart health, nourishes skin', 'Medium', 'OrganicIndia', 'Available', '121/3', 'CookingOils'),

('Online Meditation Program', 'Guided 21-day mindfulness and meditation program.', 'Service', 100, 'Reduces stress, enhances mental clarity', 'Low', 'CertifiedTrainer', 'Available', '99/1', 'Mindfulness'),

('Herbal Tea Assortment', 'Collection of caffeine-free herbal teas for various health benefits.', 'Product', 180, 'Aids digestion, improves sleep', 'Medium', 'HerbalMark', 'Available', '134/5', 'TeaBlends'),

('Natural Deodorant Stick', 'Aluminum-free deodorant with lavender and tea tree oil.', 'Product', 350, 'Neutralizes odor, gentle on skin', 'Low', 'DermatologistTested', 'Out of Stock', '102/6', 'BodyCare')";

if(mysqli_query($conn,$sql)){
    echo "Table 'user_authentication' populated successfully";
}else{
    die("Something went wrong");
}