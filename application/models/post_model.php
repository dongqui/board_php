<?php
class Post_model extends CI_Model {

    function __construct()
    {    	
        parent::__construct();
    }

    function get($postId)
    {
    	return $this->db->get_where('post', array('PK_POST_ID'=>$postId))->row();
    }

    function getList()
    {
        return $this->db->get_where('post', array('status_cd'=>'y'))->result();
    }

    function add($post)
    {
        $this->db->set('created_time', 'NOW()', false);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->insert('POST', array(
            'title'=>$post['title'],
            'subtitle'=>$post['subtitle'],
            'content'=>$post['content'],
            'userId'=>$post['userId'],
            'author'=>$post['author']
        ));        
        return $this->db->insert_id();
    }

    function update($post)
    {
        $this->db->where('PK_POST_ID', $post['PK_POST_ID']);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->update('POST', array(
            'title'=>$post['title'],
            'subtitle'=>$post['subtitle'],
            'content'=>$post['content'],
        ));
    }

    function delete($post_id)
    {
        $this->db->where('PK_POST_ID', $post_id);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->update('post', array('status_cd'=>'n'));
    }
}