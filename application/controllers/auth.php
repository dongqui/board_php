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
            redirect('/main');
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

        $this->load->library('form_validation');
        $this->form_validation->set_rules('userId', '아이디', 'required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('email', '이메일 주소', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[passwordCheck]');
        $this->form_validation->set_rules('passwordCheck', '비밀번호 확인', 'required');

        if ($this->form_validation->run()) {
            $password_bycrypted = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $data=array(
                'userId'=> $this->input->post('userId'),
                'email'=> $this->input->post('email'),
                'password'=> $password_bycrypted,
            );
            $user = $this->user_model->register($data);
            $this->_setLoginSession($user);
            redirect('/main');
        } else {
            $this->load->view('head');
            $this->load->view('register');
            $this->load->view('footer');
        }

    }



    function IDcheck()
    {
        $userId = $this->input->post('userId');
        $user = $this->user_model->getByUserId($userId);
        if ($user) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }

    }

    function _setLoginSession($user)
    {
        $sessionData = array(
            'userId'  => $user->userId,
            'PK_USER_ID' => $user->PK_USER_ID,
            'is_login' => true
        );
        $this->session->set_userdata($sessionData);

    }
}