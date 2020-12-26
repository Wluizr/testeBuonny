<?php

require_once '../model/ClienteDAO.class.php';

$act = $_REQUEST['acao'];

switch($act){

    case 'buscaClientes':
        
        $pd = new Cliente();
        $clis = $pd->BuscaCli();
        
        echo json_encode($clis);

    break;

}


?>