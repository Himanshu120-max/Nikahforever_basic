<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InterestModel extends CI_Model
{
    public function get_received_interests($receiverId)
    {

        $this->db->select('user.id, user.name, user.gender, user.dob, user.phone, user.email, interests.status',);
        $this->db->from('interests');
        $this->db->join('user', 'interests.sender_id = user.id');
        $this->db->where('interests.receiver_id', $receiverId);
        $query = $this->db->get();

        return $query->result_array(); // Return the list of sender profiles
    }

    public function approveInterest($interestId)
    {
        session_start();

        $receiverId = $_SESSION["user_id"]; // Logged-in user's ID
        $this->db->set('status', 'approved');
        $this->db->where('sender_id', $interestId);
        $this->db->where('receiver_id', $receiverId);
        return $this->db->update('interests');
    }

    public function rejectInterest($interestId)
    {
        session_start();

        $receiverId = $_SESSION["user_id"]; // Logged-in user's ID
        $this->db->set('status', 'rejected');
        $this->db->where('sender_id', $interestId);
        $this->db->where('receiver_id', $receiverId);
        return $this->db->update('interests');
    }

    public function blockInterest($interestId, $receiverId)
    {
        session_start();

        $receiverId = $_SESSION["user_id"];

        $this->db->set('status', 'blocked');
        $this->db->where('sender_id', $interestId);
        $this->db->where('receiver_id', $receiverId);

        return $this->db->update('interests');
    }
}
