<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function register($user)
    {
        $this->db->set('created_tiem', 'NOW()', false);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->insert('USER', array(
            'userId'=>$user['userId'],
            'password'=>$user['password'],
            'email'=>$user['email']
        ));
    }

    public function getByUserId($userId)
    {
        $this->db->select('userId, password');
        $user = $this->db->get_where('USER', array('userId' => $userId))->row();
        return $user;
    }
}