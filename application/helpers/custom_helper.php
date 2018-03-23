<?php


/**
* returns the api url
* @param  object $class    the `$this` object
* @return string           example: http://localhost/restigniter-crud/api/crud/27
*
* @author: @jjjjcccjjf
*/
function api_url($class)
{
  return base_url() . "api/" . strtolower(get_class($class)) . "/";
}

function custom_response($status, $response, $class)
{
  $class->output
  ->set_status_header($status)
  ->set_content_type('application/json', 'utf-8')
  ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
  ->_display();
  exit;
}

######### Beyond this line are loader stuffs ##########
function createLoader($options){
  $loader = initializeLoader($options['type']);
  if (@$options['wrap']) {
    $loader = wrapLoader($options, $loader);
  }

  return $loader;
}

function wrapLoader($options, $loader)
{
  switch ($options['wrap']) {
    case 'table':
    $loader = "<tr><td colspan='{$options['colspan']}'>"
    . $loader . "</td></tr>";
    break;

    default:
    // code...
    break;
  }

  return $loader;
}

function initializeLoader($type)
{
  $loader = '<center><img src="';

  switch ($type) {
    case 'other':
    // other loaders
    break;

    case 'gear':
    default:
    $loader .= base_url('public/admin/img/gear-loader.gif');
    // code...
    break;
  }
  $loader .= '" height="25px" alt=""></center>';

  return $loader;
}
