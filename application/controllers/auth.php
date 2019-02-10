<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    function login()
    {
    	$this->load->view('head');
        $this->load->view('login');
        $this->load->view('footer');
    }

    function loginCheck()
    {
        $userId = $this->input->post('userId');
        $password = $this->input->post('password');
        $user = $this->user_model->getByUserId($userId);

        if ($user && password_verify($password, $user->password)) {
            $this->_setLoginSession($user);
        } else {
            redirect('/auth/login');
        }

    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('/main');
    }

    function register()
    {
        if (!$this->input->post()) {
            $this->load->view('head');
            $this->load->view('register');
            $this->load->view('footer');
        } else {
            $password_bycrypted = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $data=array(
                'userId'=> $this->input->post('userId'),
                'email'=> $this->input->post('email'),
                'password'=> $password_bycrypted,
                );
            $user = $this->user_model->register($data);
            $this->_setLoginSession($user);
        }

    }

    function _setLoginSession($user)
    {
        $sessionData = array(
            'username'  => $user->userId,
            'PK_USER_ID' => $user->PK_USER_ID,
            'is_login' => true
        );
        $this->session->set_userdata($sessionData);

        redirect('/main');
    }
}