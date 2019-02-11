<?php
class Comment_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getList($post_fk_Id)
    {
        $this->db->select('user.userId, comment.PK_COMMENT_ID, comment.content, comment.created_time, comment.user_fk_Id');
        $this->db->join('user', 'comment.user_fk_Id = user.PK_USER_ID', 'left');

        return $this->db->get_where('comment', array('comment.post_fk_Id'=>$post_fk_Id, 'comment.status'=>'y'))->result();
    }

    public function add($comment)
    {
        $this->db->set('created_time', 'NOW()', false);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->insert('comment', array(
            'content'=>$comment['content'],
            'post_fk_Id'=>$comment['post_fk_Id'],
            'user_fk_Id'=>$this->session->userdata('PK_USER_ID'),
        ));

        return $this->getList($comment['post_fk_Id']);
    }

    public function delete($commentId, $post_fk_Id)
    {
        $this->db->where('PK_COMMENT_ID', $commentId);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->update('comment', array('status'=>'n'));
        return $this->getList($post_fk_Id);
    }

    public function update($comment)
    {
        $this->db->where('PK_COMMENT_ID', $comment['PK_COMMENT_ID']);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->update('comment', array('content'=>$comment['content']));
        return $this->getList($comment['post_fk_Id']);
    }
}