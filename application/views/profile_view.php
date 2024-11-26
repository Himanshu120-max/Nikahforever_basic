<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Arial', sans-serif;
        }

        .navbar {
			background-color: #343a40;
		}

		.navbar-brand {
			font-size: 1.5rem;
			font-weight: bold;
			color: #fff !important;
		}

		.navbar-nav .nav-link {
			color: #adb5bd !important;
			font-size: 1rem;
			font-weight: bold;
			margin: 0 0.5rem;
			transition: color 0.3s ease-in-out;
		}

		.navbar-nav .nav-link:hover {
			color: #f8f9fa !important;
		}

        .container {
            max-width: 600px;
            margin: auto;
            padding: 2rem 1rem;
        }

        h1 {
            font-size: 2.5rem;
            color: #343a40;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #495057;
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            padding: 1rem;
        }

        .card-body {
            padding: 1.5rem;
            background-color: #ffffff;
        }

        .card-body p {
            font-size: 1.1rem;
            margin: 0.5rem 0;
            color: #495057;
        }

        .card-body p strong {
            color: #212529;
        }

        .card-footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 1rem;
        }

        .btn-primary, .btn-danger {
            border-radius: 30px;
            font-size: 1rem;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn-danger:hover {
            background-color: #b71c1c;
            transform: translateY(-2px);
        }

        .text-danger {
            color: #e63946;
            text-align: center;
            font-weight: bold;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            font-size: 1rem;
            color: #495057;
        }

        img {
            width: 100%;
            height: auto;
            max-height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="d-flex justify-content-between w-100 px-4">
            <div>
                <a class="navbar-brand" href="home">NikahForever</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="interest/received">Interest Received</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-2">
        <?php if (!empty($user)): ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Profile Information</h3>
                </div>
                <!-- Display Image -->
                <img src="<?php echo !empty($user['img']) ? base_url($user['img']) : 'https://placehold.co/600x400'; ?>" alt="Profile Picture">

                <?php if (!empty($user['img'])): ?>
                    <button id="deleteImageBtn" data-user-id="<?= $user['id']; ?>" class="btn btn-danger my-2">Delete Image</button>
                <?php else: ?>
                    <form id="uploadImageForm" enctype="multipart/form-data">
                        <input type="file" class="form-control" id="imageFile" name="image" accept="image/*" required>
                    <form>
                    <button id="uploadImageBtn" data-user-id="<?= $user['id']; ?>" class="btn btn-primary my-2">Upload Image</button>
                <?php endif; ?>
                
                <div class="card-body">
                    <p><strong>Name:</strong> <?= htmlspecialchars($user['name']); ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
                    <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']); ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']); ?></p>
                    <p><strong>Date of Birth:</strong> <?= htmlspecialchars($user['dob']); ?></p>
                    <p><strong>Income:</strong> <?= htmlspecialchars($user['income']); ?></p>
                    <p><strong>Height:</strong> <?= htmlspecialchars($user['height']); ?></p>

                    <p><strong>Occupations:</strong></p>
                    <ul>
                        <?php 
                        $occupations = explode(',', $user['occupations']);
                        foreach ($occupations as $occupation): ?>
                            <li><?= htmlspecialchars($occupation); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <p><strong>Educations:</strong></p>
                    <ul>
                        <?php 
                        $educations = explode(',', $user['educations']);
                        foreach ($educations as $education): ?>
                            <li><?= htmlspecialchars($education); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-footer justify-content-between">
                    <a href="<?= site_url('profile/edit/'.$user['id']); ?>" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger">User profile information is not available.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#uploadImageForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "<?= site_url('profile/uploadImage'); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            window.location.replace("http://localhost/nikahforever/profile");
                            // location.reload();
                        } else {
                            alert(result.message);
                        }
                    },
                    error: function () {
                        alert('An error occurred while uploading the image.');
                    }
                });
            });

            $('#deleteImageBtn').on('click', function () {
                if (confirm('Are you sure you want to delete this profile image?')) {
                    var userId = $(this).data('user-id');

                    $.ajax({
                        url: "<?= site_url('profile/deleteImage/'); ?>" + userId,
                        type: 'POST',
                        success: function (response) {
                            var result = JSON.parse(response);
                            if (result.status === 'success') {
                                window.location.replace("http://localhost/nikahforever/profile");
                                // location.reload();
                            } else {
                                alert(result.message);
                            }
                        },
                        error: function () {
                            alert('An error occurred while deleting the profile image.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
