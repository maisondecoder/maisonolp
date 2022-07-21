<?php

class Post_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('date');
    }
    
    public function add_post($pa_title, $pa_slug, $pa_category, $pa_tag, $pa_cover, $pa_body, $pa_author, $pa_status, $is_deleted, $date_created, $date_publish)
    {
        $data = array(
            'pa_title' => $pa_title,
            'pa_slug' => $pa_slug,
            'pa_category' => $pa_category,
            'pa_tag' => $pa_tag,
            'pa_cover' => $pa_cover,
            'pa_body' => $pa_body,
            'pa_author' => $pa_author,
            'pa_status' => $pa_status,
            'is_deleted' => $is_deleted,
            'date_created' => $date_created,
            'date_publish' => $date_publish
        );

        $add = $this->db->insert('pa_post', $data);
        return $add;
    }

    public function get_all_post($is_deleted){
        $this->db->select('*');
        $this->db->where('is_deleted', $is_deleted);
        $this->db->order_by('pa_id', 'DESC');
        $get_single = $this->db->get('pa_post')->result_array();
        
        return $get_single;
    }

    public function get_single_post($slug){
        $this->db->select('*');
        $this->db->where('pa_slug', $slug);
        $get_single = $this->db->get('pa_post')->row_array();
        
        return $get_single;
    }

    public function get_latest_post($qty_post, $exclude_id){
        $this->db->select('*');
        $this->db->not_like('pa_id', $exclude_id);
        $this->db->limit($qty_post);
        $this->db->where('pa_status', 1);
        $this->db->where('date_publish <=', now());
        $this->db->order_by('pa_id', 'DESC');
        $get_latest_post = $this->db->get('pa_post')->result_array();
        
        return $get_latest_post;
    }

    public function delete_post($pa_id){
        $data = array(
            'pa_status' => 0,
            'is_deleted' => 1
        );

        $this->db->where('pa_id', $pa_id);
        $this->db->update('pa_post', $data);
        $delete = $this->db->affected_rows();
        return $delete;
    }

    public function restore_post($pa_id){
        $data = array(
            'is_deleted' => 0
        );
        
        $this->db->where('pa_id', $pa_id);
        $this->db->update('pa_post', $data);
        $restore = $this->db->affected_rows();
        return $restore;
    }

}