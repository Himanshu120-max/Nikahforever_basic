<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileModel extends CI_Model {

    public function get_user_profile($userId) {
        $this->db->select('user.id, user.name, user.gender, user.email, user.phone, user.income, user.height, user.dob, user.img, GROUP_CONCAT(DISTINCT occupation.occupation) as occupations, GROUP_CONCAT(DISTINCT education.education) as educations');
        $this->db->from('user');
        $this->db->join('occupation', 'user.id = occupation.user_id', 'left');
        $this->db->join('education', 'user.id = education.user_id', 'left');
        $this->db->where('user.id', $userId);
        $this->db->group_by('user.id'); // Group by user ID to consolidate data
        $query = $this->db->get();

        // $this->db->where('id', $userId); // Replace 'id' with your user table's primary key column
        // $query = $this->db->get('user'); // Replace 'users' with your user table name

        // echo "<pre>";
        // echo print_r($query->result_array());

        return $query->row_array(); // Return the user's data as an associative array
    }


    public function updateProfile($data)
    {
        session_start();

        $userId = $_SESSION["user_id"]; 

        // echo "<pre>";
        // echo print_r($data);

        // $this->db->where('id', $user_id); // Assuming user_id is stored in session
        // return $this->db->update('user', $data);

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'income' => $data['income'],
            'height' => $data['height']
        ];
        
        $this->db->where('id', $userId);
        $this->db->update('user', $userData);

        // Delete existing occupations and educations for the user
        $this->db->where('user_id', $userId)->delete('occupation');
        $this->db->where('user_id', $userId)->delete('education');

        // Insert new occupations
        if (!empty($data['occupation'])) {
            $occupations = explode(',', $data['occupation']);
            foreach ($occupations as $occupation) {
                $this->db->insert('occupation', [
                    'user_id' => $userId,
                    'occupation' => trim($occupation)
                ]);
            }
        }

        // Insert new educations
        if (!empty($data['education'])) {
            $educations = explode(',', $data['education']);
            foreach ($educations as $education) {
                $this->db->insert('education', [
                    'user_id' => $userId,
                    'education' => trim($education)
                ]);
            }
        }

       return "success";
    }

    public function updateUser($userId, $data)
    {
        return $this->db->where('id', $userId)->update('user', $data);
    }
}
