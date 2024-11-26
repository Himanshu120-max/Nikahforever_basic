    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Example</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <h1 class="text-center">Create New Account</h2>

                <?php echo form_open_multipart('Register/submit'); ?>

                <div class="mb-3">
                    <label for="name" class="form-label">
                        <h5 class="mb-0">Name</h5>
                    </label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">

                    <?php if (form_error('name')): ?>
                        <small class="text-danger"><?php echo form_error('name'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Select Gender</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div id="genderOptions" class="overflow-auto" style="max-height: 300px; border: 1px solid #ddd; padding: 10px;">
                                    <?php
                                    $genders = [
                                        "Male",
                                        "Female",
                                    ];

                                    $selectedGender = set_value('gender', '');

                                    foreach ($genders as $gender) {

                                        $isChecked = ($selectedGender === $gender) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='gender' value='$gender' id='gender_$gender' $isChecked>
                                                <label class='form-check-label' for='gender_$gender'>$gender</label>
                                            </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        <h5 class="mb-0">Email</h5>
                    </label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">

                    <?php if (form_error('email')): ?>
                        <small class="text-danger"><?php echo form_error('email'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        <h5 class="mb-0">Password</h5>
                    </label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">

                    <?php if (form_error('password')): ?>
                        <small class="text-danger"><?php echo form_error('password'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">
                        <h5 class="mb-0">Phone</h5>
                    </label>
                    <div class="input-group">
                        <select class="form-select" id="country_code" name="country_code" value="<?php echo set_value('country_code'); ?>">
                            <option value="+1" <?php echo set_select('country_code', '+1'); ?>>+1 (USA)</option>
                            <option value="+1-CA" <?php echo set_select('country_code', '+1-CA'); ?>>+1 (Canada)</option>
                            <option value="+52" <?php echo set_select('country_code', '+52'); ?>>+52 (Mexico)</option>
                            <option value="+44" <?php echo set_select('country_code', '+44'); ?>>+44 (UK)</option>
                            <option value="+33" <?php echo set_select('country_code', '+33'); ?>>+33 (France)</option>
                            <option value="+49" <?php echo set_select('country_code', '+49'); ?>>+49 (Germany)</option>
                            <option value="+39" <?php echo set_select('country_code', '+39'); ?>>+39 (Italy)</option>
                            <option value="+91" <?php echo set_select('country_code', '+91'); ?>>+91 (India)</option>
                            <option value="+86" <?php echo set_select('country_code', '+86'); ?>>+86 (China)</option>
                            <option value="+81" <?php echo set_select('country_code', '+81'); ?>>+81 (Japan)</option>
                            <option value="+82" <?php echo set_select('country_code', '+82'); ?>>+82 (South Korea)</option>
                            <option value="+61" <?php echo set_select('country_code', '+61'); ?>>+61 (Australia)</option>
                            <option value="+64" <?php echo set_select('country_code', '+64'); ?>>+64 (New Zealand)</option>
                            <option value="+55" <?php echo set_select('country_code', '+55'); ?>>+55 (Brazil)</option>
                            <option value="+54" <?php echo set_select('country_code', '+54'); ?>>+54 (Argentina)</option>
                            <option value="+27" <?php echo set_select('country_code', '+27'); ?>>+27 (South Africa)</option>
                            <option value="+234" <?php echo set_select('country_code', '+234'); ?>>+234 (Nigeria)</option>
                        </select>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Enter phone number" value="<?php echo set_value('country_code'); ?>">
                        <?php if (form_error('country_code')): ?>
                            <small class="text-danger"><?php echo form_error('country_code'); ?></small>
                        <?php endif; ?>
                    </div>
                    <?php if (form_error('phone')): ?>
                        <small class="text-danger"><?php echo form_error('phone'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Select Occupation</h5>
                            <button type="button" class="btn btn-link text-danger p-0" id="clearOccupation" onclick="clearOccupationSelection()">Clear All</button>
                        </div>
                        <div id="occupationOptions" class="overflow-auto" style="max-height: 300px; border: 1px solid #ddd; padding: 10px;">
                            <?php
                            $occupationOptions = [
                                "self_employed" => "Business/Self Employed",
                                "private_sector" => "Private Sector",
                                "government" => "Government/PSU Sector",
                                "defence" => "Defence",
                                "civil_services" => "Civil Services",
                                "politician" => "Politician",
                                "social_workers" => "Social Workers",
                                "not_working" => "Not Working",
                                "retired" => "Retired",
                                "passed_away" => "Passed Away"
                            ];

                            // Retrieve previously selected values from form submission
                            $selectedOccupations = (array)set_value('occupation[]', []); // Default to empty array if none selected
                            // $selectedOccupations = is_array($selectedOccupations) ? $selectedOccupations : [$selectedOccupations]; // Ensure it's an array

                            foreach ($occupationOptions as $value => $label) {
                                // Check if this occupation is in the previously selected array
                                $isChecked = in_array($value, $selectedOccupations) ? 'checked' : '';

                                echo "<div class='form-check'> 
                                    <input class='form-check-input' type='checkbox' name='occupation[]' value='$value' id='occupation_$value' $isChecked>   
                                    <label class='form-check-label' for='occupation_$value'>$label</label>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php if (form_error('occupation[]')): ?>
                        <small class="text-danger"><?php echo form_error('occupation[]'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Select Education</h5>
                            <button type="button" class="btn btn-link text-danger p-0" id="clearAll" onclick="clearEducationSelection()">Clear All</button>
                        </div>
                        <div class="card-body">
                            <!-- <form method="POST" action="save_education_preferences.php"> -->
                            <div class="mb-3">
                                <input type="text" class="form-control mb-3" placeholder="Search" id="educationSearch" oninput="filterEducationOptions()">
                                <div id="educationOptions" class="overflow-auto" style="max-height: 300px; border: 1px solid #ddd; padding: 10px;">
                                    <h6>Arts/Science</h6>
                                    <?php
                                    $educationOptions = [
                                        "B.A.",
                                        "B.Ed",
                                        "B.M.C. / B.M.M. / B.J.M.C.",
                                        "B.Sc.",
                                        "B.Sc. - Bachelor of Science",
                                        "Bachelor of Fine Arts - BFA / BVA",
                                        "Bachelor of Library Science",
                                        "Bachelor of Physical Education",
                                        "Bachelor of Social Work",
                                        "M.M.C / M.M.M / M.J.M.C",
                                        "M.Sc",
                                        "M.Sc (Agriculture)",
                                        "Master of Arts - M.A",
                                        "Master of Education - M.Ed.",
                                        "Master of Fine Arts - MFA / MVA",
                                        "Master of Library Science",
                                        "Master of Physical Education",
                                        "Master of Social Work / M.A. Social Work",
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []); // Ensure it's always an array

                                    foreach ($educationOptions as $education) {
                                        // Check if this education is in the selected array
                                        $isChecked = in_array($education, $selectedEducations) ? 'checked' : '';
                                        echo "<div class='form-check'>
                                                <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                <label class='form-check-label' for='education_$education'>$education</label>
                                            </div>";
                                    }
                                    ?>

                                    <h6>Computers</h6>
                                    <?php
                                    $educationOptions = [
                                        "B.C.A",
                                        "B.IT",
                                        "M.C.A"
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Doctrate</h6>
                                    <?php
                                    $educationOptions = [
                                        "Doctor of Philosopy - Ph.D.",
                                        "M.phil.",
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Engineering/Design</h6>
                                    <?php
                                    $educationOptions = [
                                        "B.Arch",
                                        "B.Des. / B.D.",
                                        "B.Pharm / B.Pharma.",
                                        "B.Tech / B.E.",
                                        "M.Arch.",
                                        "M.Des. / M.Design.",
                                        "M.Pharm",
                                        "M.S. (Engineering)",
                                        "M.Tech / M.E"
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Finance/Commerce</h6>
                                    <?php
                                    $educationOptions = [
                                        "B.Com.",
                                        "CFA",
                                        "Chartered Accountant - CA",
                                        "CS",
                                        "ICWA",
                                        "M.Com.",
                                        "M.Pharm",
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Islamic</h6>
                                    <?php
                                    $educationOptions = [
                                        "Aalim Hafiz / Alaima Hafiza"
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Law</h6>
                                    <?php
                                    $educationOptions = [
                                        "Bachelor of Law - L.L.B",
                                        "L.L.M",
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Management</h6>
                                    <?php
                                    $educationOptions = [
                                        "B.B.A",
                                        "BHM",
                                        "M.B.A"
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Medicine</h6>
                                    <?php
                                    $educationOptions = [
                                        "B.A.M.S.",
                                        "B.D.S.",
                                        "B.H.M.S",
                                        "B.P.T.",
                                        "B.U.M.S",
                                        "Bachelor of Nursing",
                                        "BVSc.",
                                        "D.Pharma",
                                        "Doctor of Medicine - D.M.",
                                        "M.B.B.S.",
                                        "M.D (Homeopathy)",
                                        "M.D.S",
                                        "M.P.T.",
                                        "M.V.Sc.",
                                        "Master of Chirurgiae - M.Ch.",
                                        "Master of Surgery - M.S."
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Non-Graduate</h6>
                                    <?php
                                    $educationOptions = [
                                        "Diploma",
                                        "High School",
                                        "Intermediate (12th)",
                                        "Trade School"
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>

                                    <h6>Others</h6>
                                    <?php
                                    $educationOptions = [
                                        "Other"
                                    ];

                                    $selectedEducations = (array)set_value('education[]', []);

                                    foreach ($educationOptions as $education) {

                                        $isChecked = in_array($value, $selectedEducations) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='education[]' value='$education' id='education_$education' $isChecked>
                                                    <label class='form-check-label' for='education_$education'>$education</label>
                                                </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- <div class="d-grid">
                                <button type="submit" class="btn btn-danger">Done</button>
                            </div> -->
                            <!-- </form> -->
                        </div>
                    </div>

                    <?php if (form_error('education[]')): ?>
                        <small class="text-danger"><?php echo form_error('education[]'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Select Annual Income (Min.)</h5>
                            <button type="button" class="btn btn-link text-danger p-0" id="clearAll" onclick="clearIncomeSelection()">Clear All</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" class="form-control mb-3" placeholder="Search" id="incomeSearch" oninput="filterIncomeOptions()">
                                <div id="incomeOptions" class="overflow-auto" style="max-height: 300px; border: 1px solid #ddd; padding: 10px;">
                                    <?php
                                    $incomeRanges = [
                                        "No Income",
                                        "Rs. 0 - 1 Lakh",
                                        "Rs. 1 - 2 Lakh",
                                        "Rs. 2 - 3 Lakh",
                                        "Rs. 3 - 4 Lakh",
                                        "Rs. 4 - 5 Lakh",
                                        "Rs. 5 - 7 Lakh",
                                        "Rs. 7 - 10 Lakh",
                                        "Rs. 10 - 12 Lakh",
                                        "Rs. 12 - 15 Lakh",
                                        "Rs. 15 - 20 Lakh",
                                        "Rs. 20 - 35 Lakh",
                                        "Rs. 35 - 50 Lakh",
                                        "Rs. 50 - 75 Lakh",
                                        "Rs. 75 - 100 Lakh",
                                        "Rs. 1 Crore & Above",
                                    ];

                                    $selectedIncome = set_value('income', ''); // Retrieve the selected income value

                                    foreach ($incomeRanges as $income) {
                                        // Check if the current income matches the selected income
                                        $isChecked = ($selectedIncome === $income) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                <input class='form-check-input' type='radio' name='income' value='$income' id='income_$income' $isChecked>
                                <label class='form-check-label' for='income_$income'>$income</label>
                            </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (form_error('income')): ?>
                        <small class="text-danger"><?php echo form_error('income'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Select Height</h5>
                            <button type="button" class="btn btn-link text-danger p-0" onclick="clearHeightSelection()">Clear All</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" class="form-control mb-3" placeholder="Search" id="heightSearch" oninput="filterHeightOptions()">
                                <div id="heightOptions" class="overflow-auto" style="max-height: 300px; border: 1px solid #ddd; padding: 10px;">
                                    <?php
                                    $heights = [
                                        "4ft 5in",
                                        "4ft 6in",
                                        "4ft 7in",
                                        "4ft 8in",
                                        "4ft 9in",
                                        "4ft 10in",
                                        "4ft 11in",
                                        "5ft",
                                        "5ft 1in",
                                        "5ft 2in",
                                        "5ft 3in",
                                        "5ft 4in",
                                        "5ft 5in",
                                        "5ft 6in",
                                        "5ft 7in",
                                        "5ft 8in",
                                        "5ft 9in",
                                        "5ft 10in",
                                        "5ft 11in",
                                        "6ft",
                                        "6ft 1in",
                                        "6 ft 2in",
                                        "6ft 3in",
                                        "6ft 4in",
                                        "6ft 5in",
                                        "6ft 6in",
                                        "6ft 7in",
                                        "6ft 8in",
                                        "6ft 9in"
                                    ];

                                    $selectedHeight = set_value('height', '');

                                    foreach ($heights as $height) {

                                        $isChecked = ($selectedHeight === $height) ? 'checked' : '';

                                        echo "<div class='form-check'>
                                                <input class='form-check-input' type='radio' name='height' value='$height' id='height_$height' $isChecked>
                                                <label class='form-check-label' for='height_$height'>$height</label>
                                            </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob'); ?>" required>
                    <!-- <?php echo form_error('dob'); ?> -->
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                    <?php if (form_error('img')): ?>
                        <small class="text-danger"><?php echo form_error('img'); ?></small>
                    <?php endif; ?>
                    <?php if (isset($error)): ?>
                        <small class="text-danger"><?php echo $error; ?></small>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

                <?php echo form_close(); ?>
        </div>


        <script>
            function filterHeightOptions() {
                const search = document.getElementById("heightSearch").value.toLowerCase();
                const options = document.querySelectorAll("#heightOptions .form-check");

                options.forEach(option => {
                    const label = option.querySelector("label").innerText.toLowerCase();
                    if (label.includes(search)) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    }
                });
            }

            function clearHeightSelection() {
                const checkboxes = document.querySelectorAll("#heightOptions .form-check-input");
                checkboxes.forEach(checkbox => checkbox.checked = false);
            }


            function clearOccupationSelection() {
                const checkboxes = document.querySelectorAll("#occupationOptions .form-check-input");
                checkboxes.forEach(checkbox => checkbox.checked = false);
            }

            function filterEducationOptions() {
                const search = document.getElementById("educationSearch").value.toLowerCase();
                const options = document.querySelectorAll("#educationOptions .form-check");

                options.forEach(option => {
                    const label = option.querySelector("label").innerText.toLowerCase();
                    if (label.includes(search)) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    }
                });
            }

            function clearEducationSelection() {
                const checkboxes = document.querySelectorAll("#educationOptions .form-check-input");
                checkboxes.forEach(checkbox => checkbox.checked = false);
            }

            function filterIncomeOptions() {
                const search = document.getElementById("incomeSearch").value.toLowerCase();
                const options = document.querySelectorAll("#incomeOptions .form-check");

                options.forEach(option => {
                    const label = option.querySelector("label").innerText.toLowerCase();
                    if (label.includes(search)) {
                        option.style.display = "block";
                    } else {
                        option.style.display = "none";
                    }
                });
            }

            function clearIncomeSelection() {
                const checkboxes = document.querySelectorAll("#incomeOptions .form-check-input");
                checkboxes.forEach(checkbox => checkbox.checked = false);
            }
        </script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    </body>

    </html>