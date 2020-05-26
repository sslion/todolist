<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('postal');
    }

    public function toggle_favorite()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->data['success'] = 'error';
            return $this->render('', 'json');
        }
        $this->load->model("mailbox_model");
        $mail_id = $this->input->post('id');
        $value = $this->input->post('n');

        if ($this->mailbox_model->toggle_favorite($mail_id, $value)) {
            $this->data['success'] = 'success';
            return $this->render('', 'json');
        } else {
            $this->data['error'] = 'error';
            return $this->render('', 'json');
        }
    }

    public function menu_item_save()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->data['success'] = 'error';
            return $this->render('', 'json');
        }
        $this->load->model("menu_model");
        $data = [];
        $data['title'] = $this->input->post('title');
        $data['url'] = $this->input->post('url');
        $data['url_params'] = $this->input->post('params');
        $data['class'] = $this->input->post('class');
        $data['position'] = ($this->input->post('position')) ? $this->input->post('position') : 0;
        $data['parent_id'] = ($this->input->post('parent_id')) ? $this->input->post('parent_id') : 0;
        $data['menu_id'] = $this->input->post('current_menu_id');

        if($this->input->post('new_menu_item') == "true") {
            $res = $this->menu_model->new_menu_item($data);
        }else {
            $data['id'] = $this->input->post('id');
            $res = $this->menu_model->update_menu_item($this->input->post('id'), $data);
        }

        if ($res) {
            $this->data['success'] = 'success';
            return $this->render('', 'json');
        } else {
            $this->data['error'] = 'error';
            return $this->render('', 'json');
        }
    }

    public function menu_caption_save()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->data['success'] = 'error';
            return $this->render('', 'json');
        }
        $this->load->model("menu_model");
        $data = [];
        $data['caption'] = $this->input->post('caption');
        $data['name'] = $this->input->post('name');

        if ($this->menu_model->update_menu_caption($this->input->post('id'), $data)) {
            $this->data['success'] = 'success';
            return $this->render('', 'json');
        } else {
            $this->data['error'] = 'error';
            return $this->render('', 'json');
        }
    }

    public function new_menu_save()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->data['success'] = 'error';
            return $this->render('', 'json');
        }


        $this->load->model("menu_model");
        $data = [];
        $data['caption'] = $this->input->post('caption');
        $data['name'] = $this->input->post('name');

        if ($res = $this->menu_model->new_menu($data)) {
            $this->data['success'] = 'success';
            $this->data['id'] = $res;
            return $this->render('', 'json');
        } else {
            $this->data['error'] = 'error';
            return $this->render('', 'json');
        }
    }
}