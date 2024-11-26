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

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 30px;
            font-size: 1rem;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">User Profile</h1>

        <?php if (!empty($user)): ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Profile Information</h3>
                </div>
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
                <div class="card-footer">
                    <a href="<?= site_url('profile/edit/'.$user['id']); ?>" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger">User profile information is not available.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
