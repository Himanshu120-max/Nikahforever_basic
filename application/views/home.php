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
			background: linear-gradient(135deg, #f8f9fa, #e9ecef);
			font-family: 'Arial', sans-serif;
		}

		.container {
			padding: 2rem 1rem;
		}

		.profile-card {
			width: 20rem;
			border: 1px solid #ddd;
			border-radius: 12px;
			overflow: hidden;
			background-color: #ffffff;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
			transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
		}

		.profile-card:hover {
			transform: scale(1.05);
			box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
		}

		.profile-card img {
			width: 100%;
			height: 180px;
			object-fit: cover;
			border-bottom: 2px solid #ddd;
		}

		.profile-card .card-body {
			padding: 1.5rem;
			text-align: left;
		}

		.profile-card .card-title {
			color: #1d3557;
			font-size: 1.25rem;
			font-weight: bold;
			margin-bottom: 0.5rem;
		}

		.profile-card .card-text {
			color: #495057;
			font-size: 0.95rem;
			margin: 0.3rem 0;
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
	<div class="container mt-5">

		<!-- Links for View Profile and Interests Received -->
		<div class="mb-4 text-center">
			<a href="profile" class="btn btn-primary me-3">View Profile</a>
			<a href="interest/received" class="btn btn-success">Interests Received</a>
		</div>

		<!-- User Cards -->
		<div class="row justify-content-center">
			<!-- <?php echo "<pre>";
			// print_r($users);
			 ?> -->
			<?php foreach ($users as $user): ?>
				<?php $occupations = explode(',', $user['occupations']); ?>
				<?php $educations = explode(',', $user['educations']); ?>
				<div class="col-md-4 d-flex justify-content-center mb-4">
					<div class="profile-card">
						<img src="<?php echo base_url($user['img']); ?>" alt="Profile Picture">
						<div class="card-body">
							<h5 class="card-title"><?php echo htmlspecialchars($user['name']); ?></h5>
							<p class="card-text"><strong>Income:</strong> <?php echo htmlspecialchars($user['income']); ?></p>
							<p class="card-text"><strong>Height:</strong> <?php echo htmlspecialchars($user['height']); ?></p>
							<p class="card-text"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
							<p class="card-text"><strong>Occupations:</strong></p>
							<ul>
								<?php foreach ($occupations as $occupation): ?>
									<li><?php echo htmlspecialchars($occupation); ?></li>
								<?php endforeach; ?>
							</ul>
							<p class="card-text"><strong>Educations:</strong></p>
							<ul>
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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>