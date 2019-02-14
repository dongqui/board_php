<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

    private $limitPerPage = 5;
    function __construct()
    {
        parent::__construct();

        $this->load->model('post_model');
    }

	public function index()
    {

        $postList = $this->post_model->getList($this->limitPerPage, 0);
        $count = $this->post_model->getCount(0);
		$this->load->view('head');
        $this->load->view('main', array('postList'=>$postList, 'count'=>$count / $this->limitPerPage));
        $this->load->view('footer');
	}

	public function getList()
    {
        $offsetPage = $this->input->post('offsetPage');
        $offset = $this->limitPerPage * $offsetPage;
        $postList = $this->post_model->getList($this->limitPerPage, $offset);

        echo json_encode($postList);
    }
}
