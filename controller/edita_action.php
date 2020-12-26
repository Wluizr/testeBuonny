<?php

require_once '../model/pedidosDAO.class.php';


$act = $_REQUEST['acao'];

switch($act){


    case 'buscaInfoPedidos':
        $idCliente = $_REQUEST['idCliente'];
        $idPedido = $_REQUEST['idPedido'];       
        
        $pd = new Pedido();
        $pedido = $pd->buscaInfoPedidos($idCliente, $idPedido);

        echo json_encode($pedido);
    break;

    case 'deletaProdutoDoPedido':
        $idProdutoNoPedido = $_REQUEST['idProdNoPedido'];
        
        $pd = new Pedido();
        $pedidos = $pd->deletaProdutoDoPedido($idProdutoNoPedido);

        echo json_encode($pedidos);
    break;

    case 'deletaPedido':
        $idPedido = $_REQUEST['idPedido'];
        
        $pd = new Pedido();
        $pedidos = $pd->deletaPedido($idPedido);

        echo json_encode($pedidos);
    break;

    
}


?>