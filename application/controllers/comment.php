<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('comment_model');
    }

    public function getList($post_fk_Id)
    {
        return $this->comment_model->getList($post_fk_Id);
    }

    public function add()
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        $data=array(
            'user_fk_Id'=>$this->session->userdata('PK_USER_ID'),
            'post_fk_Id'=>$this->input->post('post_fk_Id'),
            'content'=>$this->input->post('content'),
            );
        $comments=$this->comment_model->add($data);
        echo json_encode($comments);
    }

    public function getCount()
    {

    }

    public function update($commentId)
    {
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login');
        }
        $data=array(
            'post_fk_Id'=>$this->input->post('post_fk_Id'),
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
        $post_fk_Id=$this->input->post('post_fk_Id');
        $comments=$this->comment_model->delete($commentId, $post_fk_Id);

        echo json_encode($comments);
    }
}