<?php
 require_once '../model/conexao/conexao.php';

class Produto{

    public function __construct(){

    }
  
   
    public function buscaProd(){
        $aRetorno = [];
   
        try {
            $conn = Database::conexao();           
          
            $sql = "SELECT 
                            prod.id as 'idProd',
                            prod.descricao
                        FROM                          
                            produto prod
                    ";

            $stmt = $conn->prepare($sql);
        
            $stmt->execute();

            $result = $stmt->fetchAll();                              

            foreach($result as $key => $value){
                              
                $aRetorno[] = [ 'idProd' => $value['idProd'], 'descricao' => $value['descricao'] ];
            }

            return $aRetorno;

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    function buscaInfoProd($idProd){
        $aRetorno = [];
   
        try {
            $conn = Database::conexao();           
          
            $sql = "SELECT 
                            prod.id as 'idProd',
                            prod.descricao,
                            prod.preco
                        FROM                          
                            produto prod
                        where 
                            prod.id = :idProd
                    ";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idProd', $idProd);
            $stmt->execute();

            $result = $stmt->fetchAll();                              

            foreach($result as $key => $value){
                              
                $aRetorno = [ 'idProd' => $value['idProd'],
                                'descricao' => $value['descricao'],
                                'preco' => $value['preco']
                            ];
            }

            return $aRetorno;

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    function salvarProdPedido($idProd, $qtde, $idPedido){
        try {
            $conn = Database::conexao();           
            $conn->beginTransaction();

            $sql = " INSERT INTO pedido_item (pedido_id, produto_id, quantidade) VALUES (:idPedido, :idProd, :qtde) ";

            $stmt = $conn->prepare($sql);
                            

            $stmt->bindValue(':idPedido', $idPedido);
            $stmt->bindValue(':idProd', $idProd);
            $stmt->bindValue(':qtde', $qtde);

            $this->log($qtde);

            if($stmt->execute()){
                
                $conn->commit();
                return ['status'=>'OK', 'msg' => 'Produto adicionado com Sucesso'];
            }
            
            $conn->rollback();
            return ['status'=>'ERRO', 'msg' => 'Erro ao Adicionar o produto no pedido'] ;

        } catch(PDOException $e) {
            $conn->rollback();
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    function log($valor){
        $fp = fopen('C:/xampp/htdocs/TesteBuonny/LOG_produtoDAO_'.date('_i_s').'.txt', 'a');
            
        fwrite($fp, print_r($valor, true));
        
        fclose($fp);
    }
  
}