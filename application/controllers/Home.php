<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		session_start();

		$this->load->model('RegisterModel');
		$this->load->helper('url');

		$signedInUserId = $_SESSION['user_id']; // Replace with your session user ID key

		// Fetch all users except the signed-in user
		$users = $this->RegisterModel->getAllUsersExceptSignedIn($signedInUserId);

		// Check if an interest already exists for each user
		foreach ($users as &$user) {
			$interestExists = $this->RegisterModel->checkInterestExists($signedInUserId, $user['id']);
			$user['interest_exists'] = $interestExists; // Add the interest status to the user data
		}

		$data['users'] = $users;

		// echo "<pre>";
		// print_r($data['users']);

		for ($i = 0; $i < count($data['users']); $i++) {
			$data['users'][$i]['dob'] = date('d-m-y', $data['users'][$i]['dob']);
		}

		$this->load->view('logout');

		// Load the view with the user data
		$this->load->view('home', $data);
	}


	public function submitInterest($userId)
	{
		// Load necessary helpers and start session
		$this->load->helper('url');
		session_start();

		$receiver_id = $userId;
		$user_id = $_SESSION["user_id"];

		// Check if interest already exists
		$existingInterest = $this->db->get_where('interests', [
			'sender_id' => $user_id,
			'receiver_id' => $receiver_id
		])->row();

		if ($existingInterest) {
			// Return a JSON response for existing interest
			echo json_encode([
				'status' => 'exists',
				'message' => 'Interest already exists.',
			]);
			return;
		}

		// Prepare data for insertion
		$insertData = array(
			'sender_id' => $user_id,
			'receiver_id' => $receiver_id,
			'status' => 'pending',
		);

		// Insert new interest
		if ($this->db->insert('interests', $insertData)) {
			// Return success response with interest data
			echo json_encode([
				'status' => 'success',
				'message' => 'Interest submitted successfully.',
				'interest' => $insertData, // Include inserted data
			]);
		} else {
			// Return error response
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to submit interest.',
			]);
		}
	}
}
