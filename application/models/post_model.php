<?php
class Post_model extends CI_Model {

    function __construct()
    {    	
        parent::__construct();
    }

    function get($postId)
    {
        $this->db->select('user.userId, post.PK_POST_ID, post.title, post.subtitle, post.content, post.created_time, post.user_fk_Id');
        $this->db->join('user', 'post.user_fk_Id = user.PK_USER_ID', 'left');
    	return $this->db->get_where('post', array('PK_POST_ID'=>$postId))->row();
    }

    function getList($limit, $offset)
    {
        $this->db->select('user.userId, post.PK_POST_ID, post.title, post.subtitle, post.content, post.created_time, post.user_fk_Id, COUNT(comment.post_fk_Id) AS CommentCount');
        $this->db->join('user', 'post.user_fk_Id = user.PK_USER_ID', 'left');
        $this->db->join('comment', 'post.PK_POST_ID = comment.post_fk_Id', 'left');
        $this->db->group_by('post.PK_POST_ID');
        $this->db->order_by('post.created_time','desc');
        return $this->db->get_where('post', array('post.status'=>'y'), $limit, $offset)->result();
    }

    function getCount()
    {
        return $this->db->count_all_results('post');
    }
    function add($post)
    {
        $this->db->set('created_time', 'NOW()', false);
        $this->db->set('updated_time', 'NOW()', false);
        $this->db->insert('POST', array(
            'title'=>$post['title'],
            'subtitle'=>$post['subtitle'],
            'content'=>$post['content'],
            'user_fk_Id'=>$post['user_fk_Id'],
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
        $this->db->update('post', array('status'=>'n'));
    }
}