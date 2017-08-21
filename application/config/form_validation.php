<?php

$config = array(
    'create_account' => array(
        array(
            'field' => 'fname',
            'label' => 'First Name',
            'rules' => 'required|min_length[2]'
        ),
        array(
            'field' => 'lname',
            'label' => 'Last Name',
            'rules' => 'required|min_length[2]'
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|min_length[5]|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[8]'
        )
    ),
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    )
);