<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_management_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_endpoints() {
        $this->db->select('api_endpoints.*');
        $this->db->from('api_endpoints');
        // $this->db->join('api_roles', 'api_roles.id = api_endpoints.role_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_endpoints_by_role_id($role_id) {
        $this->db->select('api_role_permissions.*, api_endpoints.path as endpoint_path, api_endpoints.method as endpoint_method, api_roles.name as role_name, api_roles.id as role_id');
        $this->db->from('api_endpoints');
        $this->db->join('api_role_permissions', 'api_role_permissions.endpoint_id = api_endpoints.id', 'left');
        $this->db->join('api_roles', 'api_roles.id = api_role_permissions.role_id', 'left');
        $this->db->where('api_role_permissions.role_id', $role_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_endpoint_batch($data) {
        $this->db->insert_batch('api_endpoints', $data);
        return $this->db->affected_rows() > 0;
    }
    
    public function add_endpoint($data) {
        $this->db->insert('api_endpoints', $data);
        return $this->db->affected_rows() > 0;
    }
    public function delete_endpoint($path) {
        $this->db->where('path', $path);
        $this->db->delete('api_endpoints');
        return $this->db->affected_rows() > 0;
    }
    public function update_endpoint($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('api_endpoints', $data);
        return $this->db->affected_rows() > 0;
    }

    public function get_endpoint_matrix() {
        $sql = "
            SELECT 
                path AS path,
                MAX(CASE WHEN method = 'GET' THEN id ELSE NULL END) AS `get`,
                MAX(CASE WHEN method = 'POST' THEN id ELSE NULL END) AS `post`,
                MAX(CASE WHEN method = 'PUT' THEN id ELSE NULL END) AS `put`,
                MAX(CASE WHEN method = 'DELETE' THEN id ELSE NULL END) AS `delete`
            FROM 
                api_endpoints
            GROUP BY 
                path
            ORDER BY 
                path
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_api_roles() {
        $this->db->select('api_roles.*');
        $this->db->from('api_roles');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_api_role_permissions($role_id = null) {
        $this->db->select("
            ar.name as role,
            ar.id as role_id,
            ae.path AS endpoint,
            ae.id AS endpoint_id,
            MAX(CASE WHEN ae.method = 'GET' THEN arp.id ELSE NULL END) AS `get`,
            MAX(CASE WHEN ae.method = 'POST' THEN arp.id ELSE NULL END) AS `post`,
            MAX(CASE WHEN ae.method = 'PUT' THEN arp.id ELSE NULL END) AS `put`,
            MAX(CASE WHEN ae.method = 'DELETE' THEN arp.id ELSE NULL END) AS `delete`
        ", false);
        $this->db->from('api_endpoints ae');
        $this->db->join('api_role_permissions arp', 'ae.id = arp.endpoint_id', 'inner');
        $this->db->join('api_roles ar', 'arp.role_id = ar.id', 'inner');
        if ($role_id) {
            $this->db->where('ar.id', $role_id);
        }
        $this->db->group_by('ae.path');
        $this->db->group_by('ar.name');
        $this->db->order_by('ar.name');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_api_role_permissions($data) {
        $this->db->insert_batch('api_role_permissions', $data);
        return $this->db->affected_rows() > 0;
    }
    public function delete_api_role_permissions($id) {
        $this->db->where('id', $id);
        $this->db->delete('api_role_permissions');
        return $this->db->affected_rows() > 0;
    }
}
