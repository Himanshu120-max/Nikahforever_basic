<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Interests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Arial', sans-serif;
        }

        .container {
            padding: 2rem 1rem;
        }

        h1 {
            font-size: 2.5rem;
            color: #343a40;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: #6c757d;
            color: #fff;
            font-size: 1.25rem;
            font-weight: bold;
            padding: 1rem;
            text-align: center;
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

        .action-buttons {
            margin-top: 1rem;
            text-align: center;
        }

        .action-buttons a {
            font-size: 1rem;
            font-weight: bold;
            margin: 0 5px;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
            text-decoration: none;
            display: inline-block;
        }

        .action-buttons a:hover {
            transform: translateY(-2px);
        }

        .btn-approve {
            background-color: #28a745;
            color: #fff;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-reject:hover {
            background-color: #e0a800;
        }

        .btn-block {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-block:hover {
            background-color: #c82333;
        }

        .text-danger {
            font-size: 1.2rem;
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Received Interests</h1>

        <?php if (!empty($interests)): ?>
            <div class="row mt-4">
                <?php foreach ($interests as $profile): ?>
                    <div class="col-md-4 mb-4">
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
                                <div class="action-buttons">
                                    <a href="<?= site_url('interest/approve/' . $profile['id']); ?>" class="btn-approve">Approve</a>
                                    <a href="<?= site_url('interest/reject/' . $profile['id']); ?>" class="btn-reject">Reject</a>
                                    <a href="<?= site_url('interest/block/' . $profile['id']); ?>" class="btn-block">Block</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-danger">No interests received yet.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
