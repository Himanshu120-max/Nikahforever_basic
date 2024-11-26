<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function index()
    {
        session_start();

        // $this->load->library('session');
        $this->load->helper('url');

        // $this->session->unset_userdata([
        //     'user_id',
        //     'email',
        //     'logged_in'
        // ]);

        session_unset();
        // destroy the session
        session_destroy();

        redirect('login');
    }
}
