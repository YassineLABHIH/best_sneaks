<?php

class Login extends Controller
{
    public function index()
    {
        $data['page_title'] = "Login";

        show($_POST);
        $this->view("login",$data);
    }

}