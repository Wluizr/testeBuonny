
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>LISTA PEDIDO</title>
  </head>
  <body>      
    <div class="container">
    
        <div class="row">
        
            <div class="col-md-12">
            <h3>PEDIDO</h3>
                <label for="clientes">Clientes:</label>
                <select name="clientes" id="clientes">
                    <option value="all">Todos</option>
                    <!--options são acresentados via JS-->
                </select>
                <label for="">Valor:</label>
                <input type="text"  id="valorIni" name="valorIni" value="">
                <label for="">até</label>
                <input type="text"  id="valorFim" name="valorFim"  value="100000">                
                <a href="#" class="btn btn-primary btn-md" id="pesquisar" type="button">Pesquisar</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12" >
                <div class="float-right" style='margin-bottom: 5px;'>
                    <a href="adicionar_pedido.php" class="btn btn-primary btn-md" type="button">Adicionar</a>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table style="border: 1px solid #000;" id='lista_pedidos' class='table'>
                    <thead>

                        <tr>
                            <th>id</th>
                            <th>cliente</th>
                            <th>Valor Total</th>
                            <th colspan=2>Ações</th>
                        </tr>
                    </thead>
                    <tbody>                   

                    </tbody>
                </table>
            </div>
        </div>
    </div>
  
    <script src="../js/jQuery_3_5_1.min.js"></script>
    <script src="../js/funcoes/pedido.js"></script>
    
  </body>
</html>

<?php

function exibe($valor){
    $h = "<br><pre>"
         .print_r($valor, true)
         ."</pre><br>";

    echo $h;
}

?>
