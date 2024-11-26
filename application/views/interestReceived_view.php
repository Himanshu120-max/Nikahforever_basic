<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Interests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Poppins', sans-serif;
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
            padding: 0rem 0.5rem;
        }

        h1 {
            font-size: 3rem;
            color: #343a40;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.15);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(145deg, #ffffff, #f3f4f6);
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 1rem;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body p {
            font-size: 1.1rem;
            margin: 0.5rem 0;
            color: #495057;
        }

        .card-body p strong {
            color: #343a40;
        }

        .action-buttons {
            margin-top: 1rem;
            text-align: center;
        }

        .action-buttons a {
            font-size: 1rem;
            font-weight: bold;
            margin: 0 8px;
            padding: 0.5rem 1.4rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .action-buttons a:hover {
            transform: translateY(-3px);
        }

        .btn-approve {
            background: linear-gradient(90deg, #28a745, #4caf50);
            color: #fff;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.4);
        }

        .btn-approve:hover {
            background: #218838;
        }

        .btn-reject {
            background: linear-gradient(90deg, #ffc107, #ff9800);
            color: #212529;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
        }

        .btn-reject:hover {
            background: #e0a800;
        }

        .btn-block {
            background: linear-gradient(90deg, #dc3545, #ff6f61);
            color: #fff;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
        }

        .btn-block:hover {
            background: #c82333;
        }

        .no-interests {
            font-size: 1.5rem;
            color: #dc3545;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">NikahForever</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Interest Received</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">

        <h1 class="text-center mb-4">Received Interests</h1>

        <?php if (!empty($interests)): ?>
            <div class="row g-4">
                <?php foreach ($interests as $profile): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <?= htmlspecialchars($profile['name']); ?>
                            </div>
                            <div class="card-body">
                                <p><strong>Gender:</strong> <?= htmlspecialchars($profile['gender']); ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($profile['email']); ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($profile['phone']); ?></p>
                                <p><strong>Date of Birth:</strong> <?= date('d-m-Y', $profile['dob']); ?></p>
                                <p><strong>Interest Status:</strong> <?= htmlspecialchars($profile['status']); ?></p>
                                <div class="action-buttons d-flex gap-1">
                                    <a href="<?= site_url('interest/approve/' . $profile['id']); ?>" class="btn-approve">Approve</a>
                                    <a href="<?= site_url('interest/reject/' . $profile['id']); ?>" class="btn-reject">Reject</a>
                                </div>
                                <div class="action-buttons">
                                    <a href="<?= site_url('interest/block/' . $profile['id']); ?>" class="btn-block">Block</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center no-interests">No interests received yet.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
