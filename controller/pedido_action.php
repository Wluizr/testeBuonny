<?php

require_once '../model/pedidosDAO.class.php';

$act = $_REQUEST['acao'];

switch($act){


    case 'gravaPedidos':
        $idCliente = $_REQUEST['idCliente'];
        
        $pd = new Pedido();
        $retorno = $pd->gravaPedido($idCliente);
        

        echo json_encode($retorno);
    break;

    case 'buscaPedidos':
        $filtro = $_REQUEST['filtros'];
        
        $pd = new Pedido();
        $pedidos = $pd->buscaPedidos($filtro['clientes'], $filtro['vlrIni'], $filtro['vlrFim']);

        echo json_encode($pedidos);
    break;

    

    
}


?>