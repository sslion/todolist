<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        if(!$this->ion_auth->in_group('admin'))
        {
            $this->postal->add('Доступ запрещен','error');
            redirect('todolist');
        }
    }

    public function index($group_id = NULL)
    {
        $this->data['page_title'] = 'Пользователи';
        $query = $this->db->get('user_profile');
        $this->data['users'] = $query->result();

        //$this->data['users'] = $this->ion_auth->users(array(1,'members'))->result();
        $this->render('admin/users/index_view');
	}

    public function create()
    {
        $this->data['page_title'] = 'Создать пользователя';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name','First name','trim');
        $this->form_validation->set_rules('last_name','Last name','trim');
        $this->form_validation->set_rules('middle_name','Middle name','trim');
        //$this->form_validation->set_rules('company','Company','trim');
        //$this->form_validation->set_rules('phone','Phone','trim');
        $this->form_validation->set_rules('username','Username','trim|required');
        //$this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');
        $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
        //$this->form_validation->set_rules('groups[]','Groups','required|integer');

        if($this->form_validation->run()===FALSE)
        {
            $this->data['groups'] = $this->ion_auth->groups()->result();
            $query = $this->db->get_where('user_profile', array('role' => '0'));
            $this->data['directors'] = $query->result();
            $this->load->helper('form');
            $this->render('admin/users/create_view');
        }
        else
        {
            $username = $this->input->post('username');
            $email = '';
            $password = $this->input->post('password');
            $group_ids = $this->input->post('groups');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => '',
                'phone'      => ''
            );
            $id = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
            $data['user_id'] = $id;
            $data['firstname'] = $this->input->post('first_name');
            $data['lastname'] = $this->input->post('last_name');
            $data['middlename'] = $this->input->post('middle_name');
            if($this->input->post('role') === 'director') {
                $data['role'] = '0';
            } else {
                $data['role'] = $this->input->post('directorList');
            }

            $result = ($this->db->insert('user_profile', $data)) ? $this->db->insert_id() : false;
            $this->postal->add($this->ion_auth->messages(),'success');
            redirect('users');
        }
    }

    public function edit($user_id = NULL)
    {

    }

    public function delete($user_id = NULL)
    {
        if(is_null($user_id))
        {
            $this->postal->add('Нечего удалять','error');
        }
        else
        {
            $this->ion_auth->delete_user($user_id);
            $this->postal->add($this->ion_auth->messages(),'success');
        }
        redirect('users');
    }
}