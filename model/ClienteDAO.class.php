<?php
 require_once '../model/conexao/conexao.php';

class Cliente{

    public function __construct(){

    }
  

    public function BuscaCli(){
        try {
            $conn = Database::conexao();
        
            #$stmt = $conn->prepare('SELECT * FROM cliente WHERE id = :id');
            $stmt = $conn->prepare('SELECT id, nome FROM cliente');
            #$stmt->execute(array('id' => $id));
            $stmt->execute();
            $result = $stmt->fetchAll();                              

            foreach($result as $key => $value){
                              
                $aRetorno[] = [ 'id' => $value['id'], 'nome' => $value['nome'] ];
            }

            return $aRetorno;

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }


    }

    function log($valor){
        $fp = fopen('C:/xampp/htdocs/TesteBuonny/LOG'.date('d_m_Y _i_s').'.txt', 'a');
            
        fwrite($fp, print_r($valor, true));
        
        fclose($fp);
    }
  
}