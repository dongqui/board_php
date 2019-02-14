<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function register($user)
    {
        $this->db->set('created_time', 'NOW()', false);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->insert('USER', array(
            'userId'=>$user['userId'],
            'password'=>$user['password'],
            'email'=>$user['email']
        ));
        $PK_USER_ID = $insert_id = $this->db->insert_id();
        $user = $this->db->get_where('USER', array('PK_USER_ID' => $PK_USER_ID))->row();

        return $user;
    }

    public function getByUserId($userId)
    {
        $this->db->select('userId, password, PK_USER_ID');
        $user = $this->db->get_where('USER', array('userId' => $userId))->row();
        return $user;
    }


}