<?php
class Comment_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getList($postId)
    {
        return $this->db->get_where('comment', array('postId'=>$postId, 'status_cd'=>'y'))->result();
    }

    public function add($comment)
    {
        $this->db->set('created_time', 'NOW()', false);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->insert('comment', array(
            'content'=>$comment['content'],
            'userId'=>$comment['userId'],
            'postId'=>$comment['postId']
        ));
        log_message('debug', print_r($this->getList($comment['postId']), true));
        return $this->getList($comment['postId']);
    }

    public function delete($commentId, $postId)
    {
        $this->db->where('PK_COMMENT_ID', $commentId);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->update('comment', array('status_cd'=>'n'));
        return $this->getList($postId);
    }

    public function update($comment)
    {
        $this->db->where('PK_COMMENT_ID', $comment['PK_COMMENT_ID']);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->update('comment', array('content'=>$comment['content']));
        return $this->getList($comment['postId']);
    }
}