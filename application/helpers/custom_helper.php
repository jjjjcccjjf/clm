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
  $loader .= '" style="width:25px" alt=""></center>';

  return $loader;
}

function formatPrice($n)
{
	if ($n < 1000000) {
		// Anything less than a million
		$f = round(number_format($n / 1000, 3), 2);
		$f .= 'K';
	} else if ($n < 1000000000) {
		// Anything less than a billion
		$f = round(number_format($n / 1000000, 3), 2);
		$f .= 'M';
	} else {
		// At least a billion
		$f = round(number_format($n / 1000000000, 3), 2);
		$f .= 'B';
	}
	return $f;
}

/**
* Compute the start and end date of some fixed o relative quarter in a specific year.
* @param mixed $quarter  Integer from 1 to 4 or relative string value:
*                        'this', 'current', 'previous', 'first' or 'last'.
*                        'this' is equivalent to 'current'. Any other value
*                        will be ignored and instead current quarter will be used.
*                        Default value 'current'. Particulary, 'previous' value
*                        only make sense with current year so if you use it with
*                        other year like: get_dates_of_quarter('previous', 1990)
*                        the year will be ignored and instead the current year
*                        will be used.
* @param int $year       Year of the quarter. Any wrong value will be ignored and
*                        instead the current year will be used.
*                        Default value null (current year).
* @param string $format  String to format returned dates
* @return array          Array with two elements (keys): start and end date.
*/
function get_dates_of_quarter($quarter = 'current', $year = null, $format = null)
{
    if ( !is_int($year) ) {
       $year = (new DateTime)->format('Y');
    }
    $current_quarter = ceil((new DateTime)->format('n') / 3);
    switch (  strtolower($quarter) ) {
    case 'this':
    case 'current':
       $quarter = ceil((new DateTime)->format('n') / 3);
       break;

    case 'previous':
       $year = (new DateTime)->format('Y');
       if ($current_quarter == 1) {
          $quarter = 4;
          $year--;
        } else {
          $quarter =  $current_quarter - 1;
        }
        break;

    case 'first':
        $quarter = 1;
        break;

    case 'last':
        $quarter = 4;
        break;

    default:
        $quarter = (!is_int($quarter) || $quarter < 1 || $quarter > 4) ? $current_quarter : $quarter;
        break;
    }
    if ( $quarter === 'this' ) {
        $quarter = ceil((new DateTime)->format('n') / 3);
    }
    $start = new DateTime($year.'-'.(3*$quarter-2).'-1 00:00:00');
    $end = new DateTime($year.'-'.(3*$quarter).'-'.($quarter == 1 || $quarter == 4 ? 31 : 30) .' 23:59:59');

    return array(
        'start' => $format ? $start->format($format) : $start,
        'end' => $format ? $end->format($format) : $end,
    );
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
