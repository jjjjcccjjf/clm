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
