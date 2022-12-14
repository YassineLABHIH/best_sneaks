<?php

function show($data)
{

    echo "<pre>";
    print_r($data);
    echo "<pre>";
}

//check error and display
function check_error()
{
    if (isset($_SESSION['error']) && $_SESSION['error'] != "") 
    {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
} 

//check signup message and display
function check_signup_message()
{
    if (isset($_SESSION['signup_message'])) 
    {
        echo $_SESSION['signup_message'];
        unset ($_SESSION['signup_message']);
    }
} 