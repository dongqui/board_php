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
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }

        $this->load->view('head');
        $this->load->view('writePost');
        $this->load->view('footer');
	}

	public function add()
    {
        $data=array(
            'title'=> $this->input->post('title'),
            'subtitle'=> $this->input->post('subtitle'),
            'content'=> $this->input->post('content'),
            'author'=> $this->session->userdata('username'),
            'userId'=>  $this->session->userdata('PK_USER_ID'));
        $post_id = $this->post_model->add($data);

        redirect('/post/get/'.$post_id);
    }
	public function get($postId)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        $post=$this->post_model->get($postId);
        $commentList=$this->comment_model->getList($postId);
        $this->load->view('head');
        $this->load->view('post', array('post'=>$post, 'commentList'=>$commentList));
        $this->load->view('footer');
    }

    public function update($postId)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        if (!$this->input->post()) {
            $post = $this->post_model->get($postId);
            $this->load->view('head');
            $this->load->view('updatePost', array('post'=>$post));
            $this->load->view('footer');
        } else {
            $data=array(
                'title'=> $this->input->post('title'),
                'subtitle'=> $this->input->post('subtitle'),
                'content'=> $this->input->post('content'),
                'PK_POST_ID'=>$postId);
            $this->post_model->update($data);
            redirect('/post/get/'.$postId);
        }
    }

    public function delete($postid)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        $this->post_model->delete($postid);
        redirect('/main');
    }
}
