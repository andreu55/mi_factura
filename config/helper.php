<?php

function sqlToHuman($date) {

  $dtemp = strtotime($date);
  return date('d/m/Y', $dtemp);
}

function humanToSql($date) {

  $dtemp = DateTime::createFromFormat('d/m/Y', $date);
  return $dtemp->format('Y-m-d');
}

function trimestre($datetime)
{
  $mes = date("m",strtotime($datetime));
  $mes = is_null($mes) ? date('m') : $mes;
  $trim = floor(($mes-1) / 3)+1;
  return $trim;
}

// Simulamos la funcion url()
function url($url) {
  return "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/')) . $url;
}
