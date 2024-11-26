<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('encryption');
        // $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');

        session_start();
    }

    public function index()
    {
        $this->load->view('loginForm_view');
    }

    public function submit()
    {
        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // Check if form validation passes
        if ($this->form_validation->run() == FALSE) {
            // Reload the login view with validation errors
            $this->load->view('loginForm_view');
        } else {
            // Fetch input data
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Query the database for the user
            $this->db->where('email', $email);
            $query = $this->db->get('user'); // Assuming 'user' is your table name

            // Check if the user exists
            if ($query->num_rows() == 1) {
                $user = $query->row(); // Get user data
                $retrieved_password = $user->password;

                // Compare decrypted password with the input password
                if (password_verify($password, $user->password)) {

                    // Set session data for the logged-in user
                    // $this->session->set_userdata([
                    //     'user_id' => $user->id,
                    //     'user_gender' => $user->gender,
                    //     'email' => $user->email,
                    //     'logged_in' => TRUE
                    // ]);

                    $_SESSION["user_id"] = $user->id;
                    $_SESSION["user_gender"] = $user->gender;
                    $_SESSION["email"] = $user->email;
                    $_SESSION["logged_in"] = TRUE;


                    // Redirect to the dashboard or home page
                    redirect('home'); // Replace 'welcome' with your redirect path
                } else {
                    // Invalid password
                    $data['error'] = 'Invalid email or password.';
                    $this->load->view('loginForm_view', $data);
                }
            } else {
                // User does not exist
                $data['error'] = 'Invalid email or password.';
                $this->load->view('loginForm_view', $data);
            }
        }
    }
}
