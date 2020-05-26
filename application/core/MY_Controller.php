<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $website;
    protected $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['before_head'] = '';
        $this->data['before_body'] = '';
    }

    protected function render($the_view = NULL, $template = 'master')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } elseif (is_null($template)) {
            $this->load->view($the_view, $this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
}

class Admin_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('postal');
        $this->load->helper('url');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')) {
            redirect('auth/login', 'refresh');
        }
        $current_user = $this->ion_auth->user()->row();
        $this->user_id = $current_user->id;
        $this->data['current_user'] = $current_user;
        $this->data['current_user_menu'] = '';

        $this->data['page_title'] = 'Панель администратора';
    }

    protected function render($the_view = NULL, $template = 'public_master')
    {
        parent::render($the_view, $template);
    }
}

class User_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        if ($this->ion_auth->in_group('admin')) {
            $this->data['is_admin'] = true;
        }
        $current_user = $this->ion_auth->user()->row();
        $this->user_id = $current_user->id;
        $this->data['current_user'] = $current_user;
        $this->data['page_title'] = 'Список задач';
    }

    protected function render($the_view = NULL, $template = 'public_master')
    {
        parent::render($the_view, $template);
    }
}

class Public_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    protected function render($the_view = NULL, $template = 'public_master')
    {
        parent::render($the_view, $template);
    }
}

class Ajax_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    protected function render()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }
}
