<?php


function esc($var)
{
  return htmlspecialchars($var);
}

function viewsPath($view)
{

  if (file_exists("../private/views/" . $view . ".inc.php")) {
    return "../private/views/" . $view . ".inc.php";
  } else {
    return "../private/views/404.inc.php";
  }
}

function getVar($key, $default = "")
{

  if (isset($_POST[$key])) {
    return $_POST[$key];
  }
  return $default;
}
function getUserInformation($key, $default = "")
{

  if (isset($_SESSION['user']->$key)) {
    return $_SESSION['user']->$key;
  }
  return $default;
}
function getRole(){
  $role=null;
  if(isset($_SESSION['user'])){
    $role=$_SESSION['user']->role;
  }
  return $role;
}

function isSignIn(){
  if(isset($_SESSION['user'])){
    return true;
  }
    return false;
 
}

