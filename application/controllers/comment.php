<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('comment_model');
    }

    public function getList($postId)
    {
        return $this->comment_model->getList($postId);
    }

    public function add()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        $data=array(
            'userId'=>$this->session->userdata('PK_USER_ID'),
            'autor'=>$this->session->userdata('username'),
            'postId'=>$this->input->post('postId'),
            'content'=>$this->input->post('content'),
            );
        $comments=$this->comment_model->add($data);
        echo json_encode($comments);
    }

    public function update($commentId)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        $data=array(
            'postId'=>$this->input->post('postId'),
            'content'=>$this->input->post('content'),
            'PK_COMMENT_ID'=>$commentId
        );
        $comments=$this->comment_model->update($data);
        echo json_encode($comments);
    }

    public function delete($commentId)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        $postId=$this->input->post('postId');
        $comments=$this->comment_model->delete($commentId, $postId);
        echo json_encode($comments);
    }
}