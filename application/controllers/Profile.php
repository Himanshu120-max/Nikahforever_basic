<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function index()
    {
        // Ensure the user is signed in
        session_start();

        $this->load->helper('url');
        $this->load->model('ProfileModel');

        $user_id = $_SESSION["user_id"];

        if (!$user_id) {
            redirect('login'); // Redirect to login if not signed in
        }

        // Get user profile data
        $data['user'] = $this->ProfileModel->get_user_profile($user_id);

        $formatted_date = date('d-m-y', $data['user']['dob']);

        $data['user']['dob'] = $formatted_date;

        // echo "<pre>";
        // print_r($data['user']);

        // Load the profile view
        $this->load->view('profile_view', $data);
    }

    public function edit($id)
    {
        $this->load->helper('url');
        $this->load->library('form_validation');

        // $query = $this->db->get_where('user', ['id' => $id]);
        // echo "<pre>";
        // print_r($query->row_array());
        // die;


        $this->db->select('user.id, user.name, user.gender, user.email, user.phone, user.income, user.height, user.dob, GROUP_CONCAT(DISTINCT occupation.occupation) as occupations, GROUP_CONCAT(DISTINCT education.education) as educations');
        $this->db->from('user');
        $this->db->join('occupation', 'user.id = occupation.user_id', 'left');
        $this->db->join('education', 'user.id = education.user_id', 'left');
        $this->db->where('user.id', $id);
        $this->db->group_by('user.id'); // Group by user ID to consolidate data
        $query = $this->db->get();

        // $this->db->where('id', $userId); // Replace 'id' with your user table's primary key column
        // $query = $this->db->get('user'); // Replace 'users' with your user table name

        // echo "<pre>";
        // echo print_r($query->result_array());

        $data['user'] = $query->row_array();

        $this->load->view('profileEdit_view', $data);
    }

    public function update()
    {
        //     echo "hello";
        // return "hello";
        //     die;
        // Load necessary libraries and helpers
        $this->load->library('form_validation');
        $this->load->model('ProfileModel');
        $this->load->helper('url');

        // Validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('country_code', 'Country Code', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('occupation[]', 'Occupation', 'required');
        $this->form_validation->set_rules('education[]', 'Education', 'required');
        $this->form_validation->set_rules('income', 'Income', 'required');
        $this->form_validation->set_rules('height', 'Height', 'required');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        // Prepare data
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('country_code') . '-' . $this->input->post('phone'),
            'occupation' => implode(',', $this->input->post('occupation')),
            'education' => implode(',', $this->input->post('education')),
            'income' => $this->input->post('income'),
            'height' => $this->input->post('height'),
        ];

        // Update profile
        $result = $this->ProfileModel->updateProfile($data);
        // echo 1;

        // echo "Model response : ".$result."<br>";

        // echo base_url('profile');

        if ($result === "success") {
            echo json_encode([
                'status' => 'success',
                'redirect' => base_url('profile') // Proper redirect URL
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update profile.'
            ]);
        }
    }
}
