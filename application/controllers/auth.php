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
        $this->load->helper('url');
        if ($user && password_verify($password, $user->password)) {
            $sessionData = array(
                'userId'  => $user->userId,
                'is_login' => true
            );
            $this->session->set_userdata($sessionData);
            redirect('/main');
        } else {
            redirect('/auth/login');
        }

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
            $this->user_model->register($data);
            $this->load->helper('url');
            redirect('/main');
        }

    }
}