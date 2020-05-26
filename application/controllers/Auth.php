<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index()
    {
        return $this->render('layouts/loginform', 'public_master');
    }

    public function login()
    {

        if ($this->ion_auth->logged_in()) {
            $this->data['success'] = 'success';
            $this->data['redirect_to'] = base_url('todolist');
            return $this->render('', 'json');
        }

        $redirect_to = $this->session->flashdata('redirect_to');
        if (!isset($redirect_to) && isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = $_SERVER['HTTP_REFERER'];
            if (strpos($redirect_to, base_url(), 0) === FALSE) $redirect_to = base_url();
        } elseif (!isset($redirect_to)) {
            $redirect_to = base_url('todolist');
        }
        $this->data['redirect_to'] = $redirect_to;
        $this->data['page_title'] = 'Вход в личный каюинет';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('remember', 'Remember me', 'integer');
        $this->form_validation->set_rules('redirect_to', 'Redirect to', 'valid_url');

        if ($this->form_validation->run() === TRUE) {
            if (!$this->ion_auth->username_check($this->input->post('identity'))) {
                $this->session->set_flashdata('redirect_to', $this->input->post('redirect_to'));
                return $this->render($this->data['error'] = "<p>Такой пользователь не существует</p>", 'json');
            }

            //$remember = (bool)$this->input->post('remember');
            $remember = true;
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                $this->data['success'] = 'success';
                $this->data['redirect_to'] = base_url('todolist');
                return $this->render('', 'json');
            } else {
                $this->session->set_flashdata('redirect_to', $this->input->post('redirect_to'));
                return $this->render($this->data['error'] = "<p>Неверный пароль</p>", 'json');
            }
        }
        $this->data['error'] = 'error';
        $this->data['redirect_to'] = base_url('');
        return $this->render('', 'json');
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect(base_url());
    }
}