<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_management extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function endpoint() {
        $this->load->model('Api_management_model', 'm_api');
        $endpoints = $this->m_api->get_endpoint_matrix();


        $data['endpoints'] = $endpoints;
        $data['content'] = 'api_management/endpoint';

        $this->load->view('main/admin/index', $data);

    }

    //add_endpoint
    public function add_endpoint() {
        $this->load->model('Api_management_model', 'm_api');
        $post_data = $this->input->post();
        foreach ($post_data['methods'] as $key => $method) {
            $data[] = [
                'path' => '/api/' . $post_data['version'] . "/" . $post_data['path'],
                'method' => $method,
            ];
        }
        

        $this->db->trans_start();
        $this->m_api->add_endpoint_batch($data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Failed to add endpoint');
        } else {
            $this->session->set_flashdata('success', 'Endpoint added successfully');
        }
        redirect('admin/Api_management/endpoint');

    }

    //delete endpoint delete_endpoint
    public function delete_endpoint($path = null) {
        if ($path == null) {
            redirect('admin/Api_management/endpoint');
        }
        $path = str_replace('~', '/', $path);
        
        $this->load->model('Api_management_model', 'm_api');
        $this->db->trans_start();
        $this->m_api->delete_endpoint($path);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Failed to delete endpoint');
        } else {
            $this->session->set_flashdata('success', 'Endpoint deleted successfully');
        }
        
        redirect('admin/Api_management/endpoint');

    }

    // access_control
    public function access_control($role_name = null) {
        $role_id = null;

        $this->load->model('Api_management_model', 'm_api');
        $endpoints = $this->m_api->get_endpoint_matrix();
        $roles = $this->db->get('api_roles')->result();
        if ($role_name !== null) {
            $role = null;
            foreach ($roles as $r) {
                if (strtolower($r->name) == strtolower($role_name)) {
                    $role = $r;
                }
            }

            if (!empty($role)) {
                $role_id = $role->id;
            }
        } 

        $role_permissions = $this->m_api->get_api_role_permissions($role_id);


        $data['endpoints'] = $endpoints;
        $data['roles'] = $roles;
        $data['role_permissions'] = $role_permissions;
        $data['content'] = 'api_management/access_control';
        
        $this->load->view('main/admin/index', $data);
    }

    public function add_access() {
        $post_data = $this->input->post();

        $this->load->model('Api_management_model', 'm_api');

        $endpoints = $this->m_api->get_all_endpoints();
        $endpointNew = [];
        foreach ($endpoints as $key => $endpoint) {
            $key = md5($endpoint->path . $endpoint->method);
            $endpoint->slug_id = md5($endpoint->id . $endpoint->method . $post_data['role']);
            $endpointNew[$key] = $endpoint;
        }

        $endpointsRole = $this->m_api->get_all_endpoints_by_role_id($post_data['role']);
        $endpointsRoleNew = [];
        $removedRoles = [];
        foreach ($endpointsRole as  $endpoint) {
            
            $key = md5($endpoint->endpoint_path . $endpoint->endpoint_method);

            if (!isset($post_data['role_permission'][$key])) {
                if(!isset($post_data['role_permission'][$key][$endpoint->endpoint_method])) {
                    $removedRoles[] = $endpoint->id;
                }
            }
            $slug = md5($endpoint->endpoint_path . $endpoint->endpoint_method );
            $endpointsRoleNew[$slug] = $endpoint;
        }

        $newRole = [];
        foreach ($post_data['role_permission'] as $key => $value) {
            if ($value == 'on') {
                $newRole[] = [
                    'role_id' => $post_data['role'],
                    'id' => $endpointNew[$key]->slug_id,
                    'endpoint_id' => $endpointNew[$key]->id,
                    'allowed_fields' => "*",
                    // 'endpoint_data' => $endpointNew[$key],
                ];
            }
        }

        // echo "<pre>";
        // print_r([
        //     'removedRoles' => $removedRoles,
        //     'newRole' => $newRole,
        //     'post_data' => $post_data,
        //     'endpoints' => $endpoints,
        //     'endpointsRole' => $endpointsRole,
        //     'endpointNew' => $endpointNew,
        //     'endpointsRoleNew' => $endpointsRoleNew,
        // ]);
        // echo "</pre>";
        // exit;

        $this->db->trans_start();
        if (!empty($removedRoles)) {
            foreach ($removedRoles as $endpoint_id) {
                $this->m_api->delete_api_role_permissions($endpoint_id, $post_data['role']);
            }
        }

        if (!empty($newRole)) {
            $this->m_api->add_api_role_permissions($newRole);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Failed to update access control');
        } else {
            $this->session->set_flashdata('success', 'Access control updated successfully');
        }
        redirect('admin/Api_management/access_control/');
        
    }
}