<?php


function esc($var)
{
  return htmlspecialchars($var);
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
function viewsPathInc($view)
{
  if (file_exists("../private/views/" . $view . ".inc.php")) {
    return "../private/views/" . $view . ".inc.php";
  } else {
    return "../private/views/404.inc.php";
  }
}
function isSignIn(){
  if(isset($_SESSION['user'])){
    return true;
  }
    return false;
 
}

function randomString($length=30)
{
  $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'A', 'B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'Z', 'X', 'C', 'V', 'B', 'N', 'M');
  $text = "";
  for ($x = 0; $x < $length; $x++) {
    $random = rand(0, 61);
    $text .= $array[$random];
  }
  return $text;
}