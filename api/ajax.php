<?php
/*****
This handles all the POST request from the client, using the functions in main.php.
*****/

require("main.php");

$result = array();

switch($_POST['functionname']) {
    case 'createStockObject':
       $result['result'] = createStockObject($_POST['arguments'][0]);
       break;
    case 'updateData':
       $result['result'] = updateData();
       break;
    default:
       $result['error'] = 'Not found function '.$_POST['functionname'].'!';
       break;
}
echo json_encode($result['result']);
?>
