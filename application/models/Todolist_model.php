<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Todolist_model extends CI_Model
{
    public $table = '';
    public $users_table = '';
    public $primary_key = 'id';
    public $fields_todolist = 'todolist.id as todolist_id, todolist.title, 
        todolist.description, todolist.start_date,
        todolist.end_date, todolist.modify_date, 
        todolist.priority, todolist.status, todolist.creator_id, 
        todolist.worker_id';

    public function __construct()
    {
        $this->load->database();
        $this->table = $this->db->dbprefix('todolist');
        $this->users_table = $this->db->dbprefix('user_profile');
    }

    public function admin_list()
    {
        $sql = "SELECT {$this->fields_todolist}, users.* FROM {$this->table} as todolist, {$this->users_table} as users WHERE todolist.worker_id = users.user_id ORDER BY todolist.modify_date DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function director_list($director_id = "")
    {
        $sql = "SELECT {$this->fields_todolist}, users.* FROM {$this->table} as todolist, {$this->users_table} as users WHERE todolist.creator_id = {$director_id} AND todolist.worker_id = users.user_id ORDER BY todolist.modify_date DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function empl_list($worker_id = "", $date_filter)
    {
        $filter = null;
        if($date_filter != null) {
            switch ($date_filter) {
                case 1:
                    $filter = 'DATE(todolist.end_date) = "' . date('Y-m-d') . '" AND';
                    break;
                case 2:
                    $date1 = date('Y-m-d');
                    $date2 = date('Y-m-d', strtotime("+7 day"));
                    $filter = "(DATE(todolist.end_date) >= '{$date1}' AND DATE(todolist.end_date) <= '{$date2}') AND";
                    break;
                case 3:
                    $date = date('Y-m-d', strtotime("+7 day"));
                    $filter = "DATE(todolist.end_date) > '{$date}' AND";
                    break;
                case 0:
            }
        }
        $sql = "SELECT {$this->fields_todolist}, users.* FROM {$this->table} as todolist, {$this->users_table} as users WHERE {$filter} todolist.worker_id = {$worker_id} AND todolist.worker_id = users.user_id ORDER BY todolist.modify_date DESC";
        //die($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function update_task($task_id, $data)
    {
        $result = $this->db->update($this->table, $data, "id = " . $task_id);
        return $result;
    }

    public function new_task($data)
    {
        $result = ($this->db->insert($this->table, $data)) ? $this->db->insert_id() : false;
        return $result;
    }
}