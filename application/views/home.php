<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Cards</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
	<style>
		body {
			background: linear-gradient(135deg, #e9ecef, #dee2e6);
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
			padding: 0rem 0.5rem;
		}

		.profile-card {
			width: 22rem;
			border: 1px solid #ddd;
			border-radius: 12px;
			overflow: hidden;
			background-color: #ffffff;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
			transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
		}

		.profile-card:hover {
			transform: scale(1.05);
			box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
		}

		.profile-card img {
			width: 100%;
			height: 200px;
			object-fit: cover;
			border-bottom: 2px solid #ddd;
		}

		.profile-card .card-body {
			padding: 1.5rem;
			text-align: left;
		}

		.profile-card .card-title {
			color: #1d3557;
			font-size: 1.4rem;
			font-weight: bold;
			margin-bottom: 0.5rem;
		}

		.profile-card .card-text {
			color: #495057;
			font-size: 1rem;
			margin: 0.4rem 0;
		}

		.card-list {
			list-style: none;
			padding: 0;
			margin: 0.5rem 0;
		}

		.card-list li {
			margin: 0.2rem 0;
		}

		.btn {
			font-weight: bold;
			width: 100%;
			padding: 0.75rem;
			border-radius: 8px;
			transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
		}

		.btn-send-interest {
			background-color: #e63946;
			color: #ffffff;
		}

		.btn-send-interest:hover {
			background-color: #d62828;
			transform: translateY(-2px);
		}

		.btn-secondary {
			background-color: #adb5bd;
			color: #ffffff;
			cursor: not-allowed;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="container">
			<a class="navbar-brand" href="#">NikahForever</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link" href="home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="interest/received">Interest Received</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile">Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Main Content -->
	<div class="container mt-5">
		<!-- User Cards -->
		<div class="row justify-content-center">
			<?php foreach ($users as $user): ?>
				<?php $occupations = explode(',', $user['occupations']); ?>
				<?php $educations = explode(',', $user['educations']); ?>
				<div class="col-md-4 d-flex justify-content-center mb-4">
					<div class="profile-card">
						<img src="<?php echo !empty($user['img']) ? base_url($user['img']) : 'https://placehold.co/600x400'; ?>" alt="Profile Picture">
						<div class="card-body">
							<h5 class="card-title"><?php echo htmlspecialchars($user['name']); ?></h5>
							<p class="card-text"><strong>Income:</strong> <?php echo htmlspecialchars($user['income']); ?></p>
							<p class="card-text"><strong>Height:</strong> <?php echo htmlspecialchars($user['height']); ?></p>
							<p class="card-text"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
							<p class="card-text"><strong>Occupations:</strong></p>
							<ul class="card-list">
								<?php foreach ($occupations as $occupation): ?>
									<li><?php echo htmlspecialchars($occupation); ?></li>
								<?php endforeach; ?>
							</ul>
							<p class="card-text"><strong>Educations:</strong></p>
							<ul class="card-list">
								<?php foreach ($educations as $education): ?>
									<li><?php echo htmlspecialchars($education); ?></li>
								<?php endforeach; ?>
							</ul>
							<?php if ($user['interest_exists']): ?>
								<button class="btn btn-secondary" disabled>Interest Already Sent</button>
							<?php else: ?>
								<button class="btn btn-send-interest" data-user-id="<?php echo htmlspecialchars($user['id']); ?>">
									Send Interest <i class="bi bi-send-fill"></i>
								</button>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.btn-send-interest').click(function() {
				var userId = $(this).data('user-id');
				var button = $(this);

				$.ajax({
					url: "http://localhost/nikahforever/submitInterest/" + userId,
					method: "GET",
					success: function(response) {
						var data = JSON.parse(response);

						if (data.status === 'success') {
							button.text('Interest Already Sent');
							button.prop('disabled', true);
							button.removeClass('btn-send-interest').addClass('btn-secondary');
						} else if (data.status === 'exists') {
							button.text('Interest Already Sent');
							button.prop('disabled', true);
							button.removeClass('btn-send-interest').addClass('btn-secondary');
						} else {
							alert(data.message);
						}
					},
					error: function(xhr, status, error) {
						console.error("Error sending interest: " + error);
					},
				});
			});
		});
	</script>
</body>

</html>
