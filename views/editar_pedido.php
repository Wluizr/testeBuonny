
<!DOCTYPE html>
<html lang="pt-br">
  <head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>EDITAR PEDIDO</title>
  </head>
  <body>      
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Editar Pedido
                </h3>
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="hdCliente" id="hdCliente" value='<?= $_REQUEST['idCliente']?>' >
                        <input type="hidden" name="hdPedido" id="hdPedido" value='<?= $_REQUEST['idPedido']?>' >
                        <label> Cliente: <span id='nameCliente'></span> </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-4 ">
                                <label >Produtos</label>
                            </div>
                            <div class="col-md-4">
                                <a href="adicionar_produto.php?idPedido=<?= $_REQUEST['idPedido']?>" class="btn btn-primary btn-md" type="button">Adicionar</a>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            
                            <table style="border: 1px solid #000;" id='lista_produtos' class='table'>
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Produto</th>
                                        <th>Valor Unitário</th>
                                        <th>Qtde</th>
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
                <div class="row">
                    <div class="col-md-4">
                        <a href="lista_pedidos.php" class="btn btn-secondary btn-md" type="button">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../js/jQuery_3_5_1.min.js"></script>
    <script src="../js/funcoes/edita_pedido.js"></script>    
  </body>
</html>
