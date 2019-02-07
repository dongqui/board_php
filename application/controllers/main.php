<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('post_model');
    }

	public function index()
    {
        // login?
        $postList = $this->post_model->getList('post');
		$this->load->view('head');
        $this->load->view('main', array('postList'=>$postList));
        $this->load->view('footer');
	}
}
