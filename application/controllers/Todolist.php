<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todolist extends User_Controller // TODO заменить на User_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('todolist_model');
    }

    public function index($group_id = NULL)
    {
        $this->data['page_title'] = 'Список задач';
        $this->data['mode'] = 'admin';
        $this->data['users'] = [];
        $this->data['selected_user'] = null;
        $this->data['date_filter'] = null;
        if($this->input->get('mode') !== null) {
            $this->data['mode'] = $this->input->get('mode');
        }
        if($this->data['mode'] == 'admin') {
            $this->data['todolist'] = $this->todolist_model->admin_list();
        }
        if($this->data['mode'] == 'director') {
            $this->data['todolist'] = [];
            if($this->input->get('user') !== null) {
                $this->data['todolist'] = $this->todolist_model->director_list($this->input->get('user'));
                $this->data['selected_user'] = $this->input->get('user');
            }
            $query = $this->db->get_where('user_profile', array('role' => '0'));
            $this->data['users'] = $query->result();

            $query = $this->db->get_where('user_profile', array('role' => $this->data['selected_user']));
            $this->data['workers'] = $query->result();

        }
        if($this->data['mode'] == 'empl') {
            $this->data['todolist'] = [];
            $this->data['selected_user'] = ($this->input->get('user')!=null)?$this->input->get('user'):null;
            $this->data['date_filter'] = ($this->input->get('date_filter')!=null)?$this->input->get('date_filter'):null;
            if($this->data['selected_user'] !== null) {
                $this->data['todolist'] = $this->todolist_model->empl_list($this->data['selected_user'], $this->data['date_filter']);
            }

            $query = $this->db->get_where('user_profile', 'role > 0');
            $this->data['users'] = $query->result();
        }

        $this->render('todolist');
	}

    public function add()
    {
        $validated_data  = $this->validate();
        $new_data = $validated_data['data'];
        $new_data['status'] = 0;

        if(count($validated_data['errors']) == 0) {
            if($this->todolist_model->new_task($new_data)) {
                $this->data['success'] = 'success';
                $this->data['redirect_to'] = base_url('/todolist/?mode=director&user='.$this->input->post('director_id'));
                return $this->render('', 'json');
            }
        } else {
            $this->data['error'] = 'error';
            $this->data['errors'] = $validated_data['errors'];
            $this->data['succeses'] = $validated_data['success'];
            return $this->render('', 'json');
        }
    }

    public function edit()
    {
        $mode = $this->input->post('mode');
        if($mode == 'empl') {
            $new_data = [];
            $new_data['status'] = $this->input->post('status');
            if($this->todolist_model->update_task($this->input->post('id'), $new_data)) {
                $this->data['success'] = 'success';
                $this->data['redirect_to'] = base_url('/todolist/?mode=empl&user='.$this->input->post('director_id'));
                return $this->render('', 'json');
            }
        } else {
            $validated_data  = $this->validate();
            $new_data = $validated_data['data'];
            $new_data['status'] = $this->input->post('status');
            if(count($validated_data['errors']) == 0) {
                if($this->todolist_model->update_task($this->input->post('id'), $new_data)) {
                    $this->data['success'] = 'success';
                    $this->data['redirect_to'] = base_url('/todolist/?mode=director&user='.$this->input->post('director_id'));
                    return $this->render('', 'json');
                }
            } else {
                $this->data['error'] = 'error';
                $this->data['errors'] = $validated_data['errors'];
                $this->data['succeses'] = $validated_data['success'];
                return $this->render('', 'json');
            }
        }
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
        redirect('todolist');
    }

    public function validate() {
        $errors = [];
        $success = [];
        $new_data = [];
        $result = [];

        if($this->input->post('title') == '') {
            $errors[] = "title";
        } else {
            $success[] = "title";
            $new_data['title'] = $this->input->post('title');
        }
        if($this->input->post('description')) {
            $new_data['description'] = $this->input->post('description');
        }
        if($this->input->post('start-date') =='' ||
            $this->input->post('end-date') == '' ||
            (strtotime($this->input->post('end-date')) <
                strtotime($this->input->post('start-date')))) {
            $errors[] = "start-date";
            $errors[] = "end-date";
        } else {
            $success[] = "start-date";
            $success[] = "end-date";
            $new_data['start_date'] = $this->input->post('start-date');
            $new_data['end_date'] = $this->input->post('end-date');
            $new_data['modify_date'] = date('Y-m-d');
        }
        if(is_numeric($this->input->post('worker'))) {
            $success[] = "worker";
            $new_data['worker_id'] = $this->input->post('worker');
            $new_data['creator_id'] = $this->input->post('director_id');
        } else {
            $errors[] = "worker";
        }
        if($this->input->post('priority') < 0 || $this->input->post('priority') > 2) {
            $errors[] = "priority";
        } else {
            $new_data['priority'] = $this->input->post('priority');
        }

        $result['errors'] = $errors;
        $result['success'] = $success;
        $result['data'] = $new_data;

        return $result;
    }
}