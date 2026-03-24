<?php
header("Content-Type:application/json");
require "server_baza.php";

switch($_SERVER["REQUEST_METHOD"]) {
  case 'GET':
    if(empty($_GET['json']) || $_GET['json']=="") {
      $json_auti = dohvatJsonSvihAuta();
      response(200,"get",$json_auti);
    } else {
      $json_auti = dohvatJsonAutaPremaBrzini($_GET['json']);
      response(200,"get",$json_auti);
    }
    break;

  case 'POST':
      // $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
      $file_content = file_get_contents('php://input');     // https://thisinterestsme.com/receiving-json-post-data-via-php/
      $json_success =  unesiJsonAuto($file_content);  
      response(200,"post", $json_success);
    break;

/*   case 'DELETE':
    response(200,"delete",NULL);
    break; */

  case 'DELETE':
      $file_content = file_get_contents('php://input');
      $json_success =  deleteJsonAuto($file_content);
      response(200,"delete", $json_success);
      break;
  
  case 'PUT':
      $file_content = file_get_contents('php://input');
      $json_success =  updateJsonAuto($file_content);
      response(200,"put", $json_success);
      break;

  default:
    response(400,"Invalid Request",NULL);
}

function response($status,$status_message,$json_data) {
  header("HTTP/1.1 ".$status);
  $response['status']=$status;
  $response['status_message']=$status_message;
  $response['json_data']=$json_data;   
  $json_response = json_encode($response);
  echo $json_response;
}
?>
