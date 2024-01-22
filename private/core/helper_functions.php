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
