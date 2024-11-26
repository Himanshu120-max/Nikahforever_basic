<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegisterModel extends CI_Model
{
    public function insertUserData($userData, $occupations, $educations)
    {
        $this->db->trans_start(); // Start a transaction

        // Insert user data
        $this->db->insert('user', $userData);
        $userId = $this->db->insert_id(); // Get the last inserted user ID

        if (!$userId) {
            log_message('error', 'Failed to insert user data.');
            return false;
        }

        log_message('debug', 'User inserted with ID: ' . $userId);

        // Extract the inner occupation array
        $occupationList = isset($occupations['occupation']) ? $occupations['occupation'] : [];
        if (is_array($occupationList)) {
            foreach ($occupationList as $occupation) {
                if (!is_string($occupation)) {
                    log_message('error', 'Invalid occupation value: ' . print_r($occupation, true));
                    continue; // Skip invalid entries
                }

                $this->db->insert('occupation', [
                    'user_id' => $userId,
                    'occupation' => $occupation,
                ]);

                if (!$this->db->affected_rows()) {
                    log_message('error', 'Failed to insert occupation: ' . $occupation);
                }
            }
        }

        // Extract the inner education array (if similar structure exists)
        $educationList = isset($educations['education']) ? $educations['education'] : [];
        if (is_array($educationList)) {
            foreach ($educationList as $education) {
                if (!is_string($education)) {
                    log_message('error', 'Invalid education value: ' . print_r($education, true));
                    continue; // Skip invalid entries
                }

                $this->db->insert('education', [
                    'user_id' => $userId,
                    'education' => $education,
                ]);

                if (!$this->db->affected_rows()) {
                    log_message('error', 'Failed to insert education: ' . $education);
                }
            }
        }

        $this->db->trans_complete(); // Commit or rollback the transaction

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Transaction failed. Rolling back.');
            return false;
        }

        return $userId; // Return the user ID
    }

    public function getAllUsersExceptSignedIn($signedInUserId)
    {

        $user_gender = $_SESSION["user_gender"];

        $this->db->select('user.id, user.name, user.gender, user.email, user.phone, user.income, user.height, user.dob, user.img, GROUP_CONCAT(DISTINCT occupation.occupation) as occupations, GROUP_CONCAT(DISTINCT education.education) as educations');
        $this->db->from('user');
        $this->db->join('occupation', 'user.id = occupation.user_id', 'left');
        $this->db->join('education', 'user.id = education.user_id', 'left');
        $this->db->where('user.id !=', $signedInUserId); // Exclude the signed-in user
        $this->db->where('gender !=', $user_gender);
        $this->db->group_by('user.id'); // Group by user ID to consolidate data
        $query = $this->db->get();
        return $query->result_array(); // Return as an array of results
    }


    public function checkInterestExists($senderId, $receiverId)
    {
        $this->db->select('id');
        $this->db->from('interests');
        $this->db->where('sender_id', $senderId);
        $this->db->where('receiver_id', $receiverId);
        $query = $this->db->get();
        return $query->num_rows() > 0; // Return true if an interest exists
    }
}

