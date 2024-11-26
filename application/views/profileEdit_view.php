<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div id="profileForm">

        <h1 class="text-center">Edit Profile</h2>

            <?php echo form_open('#', ['id' => 'updateProfileForm']); ?>

            <!-- <?php echo print_r($user); ?> -->

            <div class="mb-3">
                <label for="name" class="form-label">
                    <h5 class="mb-0">Name</h5>
                </label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo set_value('name', isset($user['name']) ? $user['name'] : ''); ?>">

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

                                // Retrieve the selected value: either user-provided or the previously selected value.
                                $selectedGender = set_value('gender', isset($user['gender']) ? $user['gender'] : '');

                                foreach ($genders as $gender) {
                                    // Check if the current gender is selected
                                    $isChecked = ($selectedGender === $gender) ? 'checked' : '';
                                ?>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            value="<?php echo $gender; ?>"
                                            id="gender_<?php echo $gender; ?>"
                                            <?php echo $isChecked; ?>>
                                        <label class="form-check-label" for="gender_<?php echo $gender; ?>">
                                            <?php echo $gender; ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!-- Display validation error for gender -->
                            <?php if (form_error('gender')): ?>
                                <small class="text-danger"><?php echo form_error('gender'); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    <h5 class="mb-0">Email</h5>
                </label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="<?php echo set_value('email', isset($user['email']) ? $user['email'] : ''); ?>">

                <?php if (form_error('email')): ?>
                    <small class="text-danger"><?php echo form_error('email'); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">
                    <h5 class="mb-0">Phone</h5>
                </label>
                <div class="input-group">
                    <!-- Country code dropdown -->
                    <select class="form-select" id="country_code" name="country_code">
                        <option value="+1" <?php echo set_select('country_code', '+1', isset($user['phone']) && substr($user['phone'], 0, 2) == '+1'); ?>>+1 (USA)</option>
                        <option value="+1-CA" <?php echo set_select('country_code', '+1-CA', isset($user['phone']) && substr($user['phone'], 0, 4) == '+1-'); ?>>+1 (Canada)</option>
                        <option value="+52" <?php echo set_select('country_code', '+52', isset($user['phone']) && substr($user['phone'], 0, 3) == '+52'); ?>>+52 (Mexico)</option>
                        <option value="+44" <?php echo set_select('country_code', '+44', isset($user['phone']) && substr($user['phone'], 0, 3) == '+44'); ?>>+44 (UK)</option>
                        <option value="+33" <?php echo set_select('country_code', '+33', isset($user['phone']) && substr($user['phone'], 0, 3) == '+33'); ?>>+33 (France)</option>
                        <option value="+49" <?php echo set_select('country_code', '+49', isset($user['phone']) && substr($user['phone'], 0, 3) == '+49'); ?>>+49 (Germany)</option>
                        <option value="+39" <?php echo set_select('country_code', '+39', isset($user['phone']) && substr($user['phone'], 0, 3) == '+39'); ?>>+39 (Italy)</option>
                        <option value="+91" <?php echo set_select('country_code', '+91', isset($user['phone']) && substr($user['phone'], 0, 3) == '+91'); ?>>+91 (India)</option>
                        <option value="+86" <?php echo set_select('country_code', '+86', isset($user['phone']) && substr($user['phone'], 0, 3) == '+86'); ?>>+86 (China)</option>
                        <option value="+81" <?php echo set_select('country_code', '+81', isset($user['phone']) && substr($user['phone'], 0, 3) == '+81'); ?>>+81 (Japan)</option>
                        <option value="+82" <?php echo set_select('country_code', '+82', isset($user['phone']) && substr($user['phone'], 0, 3) == '+82'); ?>>+82 (South Korea)</option>
                        <option value="+61" <?php echo set_select('country_code', '+61', isset($user['phone']) && substr($user['phone'], 0, 3) == '+61'); ?>>+61 (Australia)</option>
                        <option value="+64" <?php echo set_select('country_code', '+64', isset($user['phone']) && substr($user['phone'], 0, 3) == '+64'); ?>>+64 (New Zealand)</option>
                        <option value="+55" <?php echo set_select('country_code', '+55', isset($user['phone']) && substr($user['phone'], 0, 3) == '+55'); ?>>+55 (Brazil)</option>
                        <option value="+54" <?php echo set_select('country_code', '+54', isset($user['phone']) && substr($user['phone'], 0, 3) == '+54'); ?>>+54 (Argentina)</option>
                        <option value="+27" <?php echo set_select('country_code', '+27', isset($user['phone']) && substr($user['phone'], 0, 3) == '+27'); ?>>+27 (South Africa)</option>
                        <option value="+234" <?php echo set_select('country_code', '+234', isset($user['phone']) && substr($user['phone'], 0, 4) == '+234'); ?>>+234 (Nigeria)</option>
                    </select>

                    <!-- Phone number input -->
                    <input
                        type="text"
                        class="form-control"
                        id="phone"
                        name="phone"
                        value="<?php echo set_value('phone', isset($user['phone']) ? preg_replace('/^\+\d+-/', '', $user['phone']) : ''); ?>"
                        placeholder="Enter phone number"
                    />

                </div>
                <!-- Validation errors -->
                <?php if (form_error('country_code')): ?>
                    <small class="text-danger"><?php echo form_error('country_code'); ?></small>
                <?php endif; ?>
                <?php if (form_error('phone')): ?>
                    <small class="text-danger"><?php echo form_error('phone'); ?></small>
                <?php endif; ?>
            </div>

            <!-- <label for="dob">Date of Birth:</label>
            <input type="text" id="dob" name="dob" value="1730415600">
            <br> -->

            <div class="mb-3">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Select Occupation</h5>
                        <button
                            type="button"
                            class="btn btn-link text-danger p-0"
                            id="clearOccupation"
                            onclick="clearOccupationSelection()">Clear All</button>
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

                        // Retrieve selected occupations from user data or form submission
                        $selectedOccupations = isset($user['occupations'])
                            ? explode(',', $user['occupations']) // Split comma-separated string into an array
                            : (array)set_value('occupation[]', []);

                        foreach ($occupationOptions as $value => $label) {
                            // Check if this occupation is in the selected array
                            $isChecked = in_array($value, $selectedOccupations) ? 'checked' : '';
                        ?>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="occupation[]"
                                    value="<?php echo $value; ?>"
                                    id="occupation_<?php echo $value; ?>"
                                    <?php echo $isChecked; ?>>
                                <label class="form-check-label" for="occupation_<?php echo $value; ?>">
                                    <?php echo $label; ?>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- Validation Error -->
                <?php if (form_error('occupation[]')): ?>
                    <small class="text-danger"><?php echo form_error('occupation[]'); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Select Education</h5>
                        <button
                            type="button"
                            class="btn btn-link text-danger p-0"
                            id="clearAll"
                            onclick="clearEducationSelection()">Clear All</button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Search"
                                id="educationSearch"
                                oninput="filterEducationOptions()">
                            <div id="educationOptions" class="overflow-auto" style="max-height: 300px; border: 1px solid #ddd; padding: 10px;">
                                <?php
                                $educationCategories = [
                                    "Arts/Science" => [
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
                                    ],
                                    "Computers" => [
                                        "B.C.A",
                                        "B.IT",
                                        "M.C.A"
                                    ],
                                    "Doctrate" => [
                                        "Doctor of Philosopy - Ph.D.",
                                        "M.phil.",
                                    ],
                                    "Engineering/Design" => [
                                        "B.Arch",
                                        "B.Des. / B.D.",
                                        "B.Pharm / B.Pharma.",
                                        "B.Tech / B.E.",
                                        "M.Arch.",
                                        "M.Des. / M.Design.",
                                        "M.Pharm",
                                        "M.S. (Engineering)",
                                        "M.Tech / M.E"
                                    ],
                                    "Finance/Commerce" => [
                                        "B.Com.",
                                        "CFA",
                                        "Chartered Accountant - CA",
                                        "CS",
                                        "ICWA",
                                        "M.Com.",
                                        "M.Pharm",
                                    ],
                                    "Islamic" => [
                                        "Aalim Hafiz / Alaima Hafiza"
                                    ],
                                    "Law" => [
                                        "Bachelor of Law - L.L.B",
                                        "L.L.M",
                                    ],
                                    "Management" => [
                                        "B.B.A",
                                        "BHM",
                                        "M.B.A"
                                    ],
                                    "Medicine" => [
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
                                    ],
                                    "Non-Graduate" => [
                                        "Diploma",
                                        "High School",
                                        "Intermediate (12th)",
                                        "Trade School"
                                    ],
                                    "Others" => [
                                        "Other"
                                    ],
                                ];

                                // Retrieve pre-filled selected values
                                $selectedEducations = isset($user['educations'])
                                    ? explode(',', $user['educations']) // Split comma-separated string into an array
                                    : (array)set_value('education[]', []);

                                // Loop through categories
                                foreach ($educationCategories as $category => $options) {
                                    echo "<h6>$category</h6>";
                                    foreach ($options as $education) {
                                        $isChecked = in_array($education, $selectedEducations) ? 'checked' : '';
                                        echo "<div class='form-check'>
                                <input
                                    class='form-check-input'
                                    type='checkbox'
                                    name='education[]'
                                    value='$education'
                                    id='education_$education'
                                    $isChecked>
                                <label class='form-check-label' for='education_$education'>$education</label>
                              </div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Display validation error -->
                <?php if (form_error('education[]')): ?>
                    <small class="text-danger"><?php echo form_error('education[]'); ?></small>
                <?php endif; ?>
            </div>

            <div class="mt-3">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Select Annual Income (Min.)</h5>
                        <button
                            type="button"
                            class="btn btn-link text-danger p-0"
                            id="clearAll"
                            onclick="clearIncomeSelection()">Clear All</button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Search"
                                id="incomeSearch"
                                oninput="filterIncomeOptions()">
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

                                // Retrieve pre-filled selected value
                                $selectedIncome = set_value('income', isset($user['income']) ? $user['income'] : '');

                                foreach ($incomeRanges as $income) {
                                    // Check if the current income is the selected value
                                    $isChecked = ($selectedIncome === $income) ? 'checked' : '';
                                    echo "<div class='form-check'>
                                <input 
                                    class='form-check-input' 
                                    type='radio' 
                                    name='income' 
                                    value='$income' 
                                    id='income_$income' 
                                    $isChecked>
                                <label class='form-check-label' for='income_$income'>$income</label>
                              </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Display validation error -->
                <?php if (form_error('income')): ?>
                    <small class="text-danger"><?php echo form_error('income'); ?></small>
                <?php endif; ?>
            </div>

            <div class="mt-3">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Select Height</h5>
                        <button
                            type="button"
                            class="btn btn-link text-danger p-0"
                            onclick="clearHeightSelection()">Clear All</button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Search"
                                id="heightSearch"
                                oninput="filterHeightOptions()">
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
                                    "6ft 2in",
                                    "6ft 3in",
                                    "6ft 4in",
                                    "6ft 5in",
                                    "6ft 6in",
                                    "6ft 7in",
                                    "6ft 8in",
                                    "6ft 9in"
                                ];

                                // Retrieve pre-filled selected value
                                $selectedHeight = set_value('height', isset($user['height']) ? $user['height'] : '');

                                foreach ($heights as $height) {
                                    // Check if the current height is the selected value
                                    $isChecked = ($selectedHeight === $height) ? 'checked' : '';
                                    echo "<div class='form-check'>
                                <input 
                                    class='form-check-input' 
                                    type='radio' 
                                    name='height' 
                                    value='$height' 
                                    id='height_$height' 
                                    $isChecked>
                                <label class='form-check-label' for='height_$height'>$height</label>
                              </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="updateProfileBtn" data-user-id="<?= $user['id'] ?>" class="btn btn-primary mt-3">Update Profile</button>

            <?php echo form_close(); ?>
            <!-- <div id="responseMessage"></div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#updateProfileBtn').on('click', function(e) {
                e.preventDefault();
                console.log('Button clicked');

                var userId = $(this).data('user-id');
                console.log(userId)

                const formData = $('#updateProfileForm').serializeArray();

                var url = "http://localhost/nikahforever/profile/update/" + userId;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Debugging output

                        if (response.status === 'success') {
                            // alert('Profile updated successfully!');
                            // Redirect to the specified URL
                            window.location.href = response.redirect;
                        } else {
                            alert(response.message || 'Failed to update profile.');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors properly
                        console.error("AJAX Error:", error);
                        console.error("Status:", status);
                        console.error("XHR:", xhr.responseText);
                        alert('An error occurred while updating the profile.');
                    }
                });
            });
        });


        // Clear all occupation selections
        function clearOccupationSelection() {
            const checkboxes = document.querySelectorAll('#occupationOptions input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }

        // Clear all selected checkboxes
        function clearEducationSelection() {
            const checkboxes = document.querySelectorAll('#educationOptions input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }

        // Filter education options based on search input
        function filterEducationOptions() {
            const searchValue = document.getElementById('educationSearch').value.toLowerCase();
            const options = document.querySelectorAll('#educationOptions .form-check');
            options.forEach(option => {
                const label = option.querySelector('.form-check-label').textContent.toLowerCase();
                option.style.display = label.includes(searchValue) ? 'block' : 'none';
            });
        }

        // Clear all selected radio buttons
        function clearIncomeSelection() {
            const radios = document.querySelectorAll('#incomeOptions input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
            });
        }

        // Filter income options based on search input
        function filterIncomeOptions() {
            const searchValue = document.getElementById('incomeSearch').value.toLowerCase();
            const options = document.querySelectorAll('#incomeOptions .form-check');
            options.forEach(option => {
                const label = option.querySelector('.form-check-label').textContent.toLowerCase();
                option.style.display = label.includes(searchValue) ? 'block' : 'none';
            });
        }

        // Clear all selected radio buttons
        function clearHeightSelection() {
            const radios = document.querySelectorAll('#heightOptions input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
            });
        }

        // Filter height options based on search input
        function filterHeightOptions() {
            const searchValue = document.getElementById('heightSearch').value.toLowerCase();
            const options = document.querySelectorAll('#heightOptions .form-check');
            options.forEach(option => {
                const label = option.querySelector('.form-check-label').textContent.toLowerCase();
                option.style.display = label.includes(searchValue) ? 'block' : 'none';
            });
        }
    </script>
</body>

</html>