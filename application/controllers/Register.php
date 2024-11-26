<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->helper('date');
	}

	public function index()
	{
		$this->load->view('registrationForm_view');
	}

	// public function submit()
	// {
	// 	$this->form_validation->set_rules('name', 'Name', 'required|trim|alpha');
	// 	$this->form_validation->set_rules('gender', 'Gender, required');
	// 	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[user.email]');
	// 	$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[16]');
	// 	$this->form_validation->set_rules('country_code', 'Country Code', 'required');
	// 	$this->form_validation->set_rules('phone', 'Phone', 'required|trim|regex_match[/^[0-9]{10}$/]', [
	// 		'regex_match' => 'The phone number must be 10 digits.'
	// 	]);		
	// 	$this->form_validation->set_rules('occupation[]', 'Occupation', 'required');
	// 	$this->form_validation->set_rules('education[]', 'Education', 'required');
	// 	$this->form_validation->set_rules('income', 'Income', 'required');
	// 	$this->form_validation->set_rules('height', 'Height', 'required');
	// 	$this->form_validation->set_rules('dob', 'Date of Birth', 'required');

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$this->load->view('registrationForm_view.php');
	// 	} else {
	// 		$form_data = array(
	// 			'name' => $this->input->post('name'),
	// 			'gender' => $this->input->post('gender'),
	// 			'email' => $this->input->post('email'),	
	// 			'password' => $this->input->post('password'),
	// 			'country_code' => $this->input->post('country_code'),
	// 			'phone' => $this->input->post('phone'),
	// 			'occupation' => $this->input->post('occupation'),
	// 			'education' => $this->input->post('education'),
	// 			'income' => $this->input->post('income'),
	// 			'height' => $this->input->post('height'),
	// 			'dob' => $this->input->post('dob')  // Unix timestamp for DOB
	// 		);

	// 		echo "<pre>";
	// 		print_r($form_data);

	// 		$hashed_password = password_hash($form_data['password'], PASSWORD_BCRYPT);

	// 		$insertData = [
	// 			'name' => $form_data['name'],
	// 			'gender' => $form_data['gender'],
	// 			'email' => $form_data['email'],	
	// 			// 'password' => $this->encryption->encrypt($form_data['password']),
	// 			'password' => $hashed_password,
	// 			'phone' => $form_data['country_code'] . '-' . $form_data['phone'],
	// 			'occupation' => implode(',', $form_data['occupation']),
	// 			'education' => implode(',', $form_data['education']),
	// 			'income' => $form_data['income'],
	// 			'height' => $form_data['height'],
	// 			'dob' => strtotime($form_data['dob'])
	// 		];

	// 		$this->db->where('email', $insertData['email']);
	// 		$query = $this->db->get('user');

	// 		if ($query->num_rows() > 0) {
	// 			echo "The email address is already registered.";
	// 		} 
	// 		else {
	// 			if ($this->db->insert('user', $insertData)) {
	// 				echo "User data inserted successfully!";
	// 			} else {
	// 				echo "Failed to insert user data.";
	// 			}
	// 		};
	// 		echo "<pre>";
	// 		print_r($insertData);
	// 	}
	// }

	public function file_check()
	{
		if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
			$allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
			$file_type = mime_content_type($_FILES['img']['tmp_name']);

			if (!in_array($file_type, $allowed_types)) {
				$this->form_validation->set_message('file_check', 'Please upload only JPEG or PNG images.');
				return FALSE;
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('file_check', 'The Image field is required.');
			return FALSE;
		}
	}



	// public function submit()
	// {

	// 	$this->form_validation->set_rules('name', 'Name', 'required|trim|alpha');
	// 	$this->form_validation->set_rules('gender', 'Gender, required');
	// 	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[user.email]');
	// 	$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[16]');
	// 	$this->form_validation->set_rules('country_code', 'Country Code', 'required');
	// 	$this->form_validation->set_rules('phone', 'Phone', 'required|trim|regex_match[/^[0-9]{10}$/]', [
	// 		'regex_match' => 'The phone number must be 10 digits.'
	// 	]);
	// 	$this->form_validation->set_rules('occupation[]', 'Occupation', 'required');
	// 	$this->form_validation->set_rules('education[]', 'Education', 'required');
	// 	$this->form_validation->set_rules('income', 'Income', 'required');
	// 	$this->form_validation->set_rules('height', 'Height', 'required');
	// 	$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
	// 	$this->form_validation->set_rules('img', 'Image', 'callback_file_check');


	// 	if ($this->form_validation->run() == FALSE) 
	// 	{
	// 		$this->load->view('registrationForm_view');
	// 	} 
	// 	else 
	// 	{
	// 		$config['upload_path'] = './uploads/';
	// 		$config['allowed_types'] = 'jpg|jpeg|png';
	// 		$config['file_name'] = time() . '_' . $_FILES['image']['name'];

	// 		$this->load->library('upload', $config);

	// 		$this->upload->initialize($config);

	// 		if($this->upload->do_upload('img')){

	// 			$uploadData = $this->upload->data();
	// 			$imageName = $uploadData['file_name'];
	// 		}

	// 		$userData = [
	// 			'name' => $this->input->post('name'),
	// 			'gender' => $this->input->post('gender'),
	// 			'email' => $this->input->post('email'),
	// 			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
	// 			'phone' => $this->input->post('country_code') . '-' . $this->input->post('phone'),
	// 			'income' => $this->input->post('income'),
	// 			'height' => $this->input->post('height'),
	// 			'dob' => strtotime($this->input->post('dob')),
	// 			'img' => $this->input->post('img'),
	// 		];

	// 		$occupationData = [
	// 			'occupation' => $this->input->post('occupation'),
	// 		];

	// 		$educationData = [
	// 			'education' => $this->input->post('education'),
	// 		];

	// 		$this->load->model('RegisterModel');

	// 		// Insert data using the model
	// 		$userId = $this->RegisterModel->insertUserData($userData, $occupationData, $educationData);

	// 		if ($userId) {
	// 			echo "User created successfully with ID: $userId";
	// 		} else {
	// 			echo "Failed to create user.";
	// 		}
	// 	}
	// }

	public function submit()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim|alpha');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('country_code', 'Country Code', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim|regex_match[/^[0-9]{10}$/]', [
			'regex_match' => 'The phone number must be 10 digits.'
		]);
		$this->form_validation->set_rules('occupation[]', 'Occupation', 'required');
		$this->form_validation->set_rules('education[]', 'Education', 'required');
		$this->form_validation->set_rules('income', 'Income', 'required');
		$this->form_validation->set_rules('height', 'Height', 'required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
		// $this->form_validation->set_rules('img', 'Image', 'callback_file_check');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('registrationForm_view');
		} else {
			// Configure upload
			$config['upload_path'] = './uploads';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_name'] =  time() . '_' . $_FILES['img']['name'];

			$this->load->library('upload', $config);	

			// $this->upload->do_upload('img');

			if ($this->upload->do_upload('img')) {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['raw_name'].$uploadData['file_ext'];
			} 
			else {
				$this->load->view('registrationForm_view', ['error' => $this->upload->display_errors()]);
				return;
			}

			$userData = [
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'phone' => $this->input->post('country_code') . '-' . $this->input->post('phone'),
				'income' => $this->input->post('income'),
				'height' => $this->input->post('height'),
				'dob' => strtotime($this->input->post('dob')),
				'img' => $imagePath, // Save uploaded image name
			];

			$occupationData = [
				'occupation' => $this->input->post('occupation'),
			];

			$educationData = [
				'education' => $this->input->post('education'),
			];

			$this->load->model('RegisterModel');

			// Insert data using the model
			$userId = $this->RegisterModel->insertUserData($userData, $occupationData, $educationData);

			if ($userId) {
				echo "User created successfully with ID: $userId";
			} else {
				echo "Failed to create user.";
			}
		}
	}
}
