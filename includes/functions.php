<?php

function secure()
{
  if(!isset($_SESSION['Id'])) 
  {
    set_message('You must login first to view this page');
    header('Location: /');
    die();
  }
};

function set_message($message)
{
  $_SESSION['message'] = $message;
};

function get_message()
{
  if(isset($_SESSION['message']))
  {
    echo '<p>'.$_SESSION['message'].'</p><br>';
    unset($_SESSION['message']);
  }
}
