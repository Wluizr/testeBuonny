<?php
 require_once '../model/conexao/conexao.php';

class Pedido{

    public function __construct(){

    }


    public function buscaPedidos($cli, $vlrIni, $vlrFim){
        $aRetorno = [];
   
        try {
            $conn = Database::conexao();           
                  
            if($cli === 'all'){
                $filtroCli = " AND c.id <> :idCliente ";
                
            }else{
                $filtroCli = " AND c.id = :idCliente ";
            }     

            $sql = "SELECT 
                            p.id as 'id_pedido',
                            c.nome as 'cliente',
                            tot.total_pedido

                        FROM 
                            pedido p 
                        INNER JOIN 
                            cliente c ON  c.id = p.cliente_id
                        INNER JOIN 
                            pedido_item pi ON pi.pedido_id = p.id
                        INNER JOIN 
                            produto prod ON prod.id = pi.produto_id
                            INNER JOIN (
     			SELECT sub_pi.pedido_id, SUM(sub_prod.preco * sub_pi.quantidade) as 'total_pedido' FROM pedido_item sub_pi
				INNER JOIN produto sub_prod ON sub_prod.id = sub_pi.produto_id

				GROUP by sub_pi.pedido_id ) as tot ON tot.pedido_id = pi.pedido_id
                        WHERE 0=0
                        {$filtroCli}
                        AND tot.total_pedido BETWEEN :vlrIni AND :vlrFim

                    GROUP BY id_pedido";

            $stmt = $conn->prepare($sql);

                
            $stmt->bindValue(':idCliente', $cli);
            $stmt->bindValue(':vlrIni', $vlrIni);
            $stmt->bindValue(':vlrFim', $vlrFim);

            $this->log($stmt);
            $stmt->execute();
         
            $result = $stmt->fetchAll();                              

            foreach($result as $key => $value){
                              
                $aRetorno[] = [ 'id_pedido' => $value['id_pedido'], 'cliente' => $value['cliente'], 'total_pedido' => $value['total_pedido']  ];
            }

            return $aRetorno;

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
   

    function gravaPedido($idCliente){
        try {
            $conn = Database::conexao();           
            $conn->beginTransaction();

            $sql = " INSERT INTO pedido (cliente_id) VALUES (:idCliente) ";

            $stmt = $conn->prepare($sql);
                            
            $stmt->bindValue(':idCliente', $idCliente);           

            $this->log($stmt);
            

            if($stmt->execute()){
                $idGerado = $conn->lastInsertId();
                $conn->commit();
                return ['status'=>'OK', 'msg' => 'Pedido Gerado com Sucesso', 'idGerado' => $idGerado];
            }
            
            $conn->rollback();
            return ['status'=>'ERRO', 'msg' => 'Erro ao gerar pedido'] ;

        } catch(PDOException $e) {
            $conn->rollback();
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    


    function buscaInfoPedidos($idCliente, $idPedido){
        $aRetorno = [];
   
        try {
            $conn = Database::conexao();                                        

            $sql = "SELECT 
                        p.id as 'id_pedido', 
                        c.nome as 'cliente',
                        pi.id as 'id_prod_no_pedido',
                        pi.produto_id as 'idProd',
                        prod.descricao as 'descrProd', 
                        prod.preco, 
                        pi.quantidade as 'qtdProd', 
                        (prod.preco * pi.quantidade) as 'total' 
                    FROM 
                         `pedido` p 
                    INNER JOIN cliente c ON c.id = p.cliente_id
                    LEFT JOIN pedido_item pi ON pi.pedido_id = p.id
                    INNER JOIN produto prod ON prod.id = pi.produto_id
                    WHERE 0=0
                        AND p.id = :idPedido
                        
                    ORDER BY prod.descricao ASC ";

            $stmt = $conn->prepare($sql);

                #AND c.id = :idCliente
           # $stmt->bindValue(':idCliente', $idCliente);
            $stmt->bindValue(':idPedido', $idPedido);
            

            $this->log($stmt);
            $stmt->execute();
           
            $result = $stmt->fetchAll();                              

            foreach($result as $key => $value){
                              
                $aRetorno[] = [ 'id_pedido' => $value['id_pedido'], 
                                'cliente' => $value['cliente'], 
                                'id_prod_no_pedido' => $value['id_prod_no_pedido'], 
                                'idProd' => $value['idProd'], 
                                'descrProd' => $value['descrProd'], 
                                'qtdProd' => $value['qtdProd'], 
                                'preco' => $value['preco'], 
                                'total' => $value['total']  ];
            }

            return $aRetorno;

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    function deletaProdutoDoPedido($idProdPedido){
        
        try {
            $conn = Database::conexao();           
            $conn->beginTransaction();

            $sql = " DELETE FROM pedido_item WHERE id = :idProdPedido ";

            $stmt = $conn->prepare($sql);
                            
            $stmt->bindValue(':idProdPedido', $idProdPedido);           

            $this->log($stmt);
            

            if($stmt->execute()){
                
                $conn->commit();
                return ['status'=>'OK', 'msg' => 'Produto removido com Sucesso'];
            }
            
            $conn->rollback();
            return ['status'=>'ERRO', 'msg' => 'Erro ao retirar o Produto'] ;

        } catch(PDOException $e) {
            $conn->rollback();
            echo 'ERROR: ' . $e->getMessage();
        }
    }



    function deletaPedido($idPedido){
        try {
            $conn = Database::conexao();           
            $conn->beginTransaction();

            $sql = " DELETE FROM pedido WHERE id = :idPedido ";

            $stmt = $conn->prepare($sql);
                            
            $stmt->bindValue(':idPedido', $idPedido);           

            $this->log($stmt);
            

            if($stmt->execute()){

                $conn->commit();
                return ['status'=>'OK', 'msg' => 'Pedido removido com Sucesso'];
            }
            
            $conn->rollback();
            return ['status'=>'ERRO', 'msg' => 'Erro ao deletar o Pedido'] ;

        } catch(PDOException $e) {
            $conn->rollback();
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    function log($valor){
        $fp = fopen('C:/xampp/htdocs/TesteBuonny/delete_'.date(' _i_s').'.txt', 'a');
            
        fwrite($fp, print_r($valor, true));
        
        fclose($fp);
    }
  
}