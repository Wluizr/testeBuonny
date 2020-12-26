<?php

require_once '../model/produtosDAO.class.php';

$act = $_REQUEST['acao'];

switch($act){

    case 'buscaProdutos':        
        
        $pd = new Produto();
        $retorno = $pd->buscaProd();        

        echo json_encode($retorno);
    break;

    case 'buscaInfoProd':
        $idProd = $_REQUEST['idProd'];

        $pd = new Produto();
        $retorno = $pd->buscaInfoProd($idProd);        

        echo json_encode($retorno);
    break;

    case 'salvarProdPedido':
        $idProd = $_REQUEST['idProd'];
        $qtde = $_REQUEST['qtde'];
        $idPedido = $_REQUEST['idPedido'];
      
        $pd = new Produto();
        $retorno = $pd->salvarProdPedido($idProd, $qtde, $idPedido);

        echo json_encode($retorno);
    break;
    
}


?>