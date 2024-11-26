<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('InterestModel');
        $this->load->helper('url');
    }

    public function received() {
        // Ensure the user is signed in
        session_start();

        $user_id = $_SESSION["user_id"];

        if (!$user_id) {
            redirect('login'); // Redirect to login if not signed in
        }

        // Get all interests received for the user
        $data['interests'] = $this->InterestModel->get_received_interests($user_id);

        // Load the interests view
        $this->load->view('interestreceived_view', $data);
    }

    public function approve($interestId)
    {
        $result = $this->InterestModel->approveInterest($interestId);

        redirect('interest/received/');
    }

    public function reject($interestId)
    {
        $result = $this->InterestModel->rejectInterest($interestId);

        redirect('interest/received/');
    }

    public function block($interestId)
    {
        session_start();

        $receiverId = $_SESSION["user_id"];

        $result = $this->InterestModel->blockInterest($interestId, $receiverId);

        redirect('interest/received/' . $receiverId);
    }
}
