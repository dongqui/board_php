<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('comment_model');
        $this->load->model('post_model');
        $this->load->model('user_model');
    }

	public function index()
	{
        $this->load->view('head');
        if (!$this->input->post()) {
            $this->load->view('writePost');
        } else {
            $data=array(
                'title'=> $this->input->post('title'),
                'description'=> $this->input->post('description'),
                'content'=> $this->input->post('content'),
                'userId'=>'1');
            $post_id = $this->post_model->add($data);
            $this->load->helper('url');
            redirect('/post/get/'.$post_id);
        }

        $this->load->view('footer');
	}

	public function get($postId)
    {
        $post=$this->post_model->get($postId);
        $commentList=$this->comment_model->getList($postId);
        $this->load->view('head');
        $this->load->view('post', array('post'=>$post, 'commentList'=>$commentList));
        $this->load->view('footer');
    }

    public function update($postId)
    {
        if (!$this->input->post()) {
            $post = $this->post_model->get($postId);
            $this->load->view('head');
            $this->load->view('updatePost', array('post'=>$post));
            $this->load->view('footer');
        } else {
            $data=array(
                'title'=> $this->input->post('title'),
                'description'=> $this->input->post('description'),
                'content'=> $this->input->post('content'),
                'PK_POST_ID'=>$postId);
            $this->post_model->update($data);
            $this->load->helper('url');
            redirect('/post/get/'.$postId);
        }
    }
}
