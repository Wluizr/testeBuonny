
<!DOCTYPE html>
<html lang="pt-br">
  <head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>ADICIONAR PEDIDO</title>
  </head>
  <body>      
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Acionar Pedido
                </h3>
                <div class="row">
                    <div class="col-md-12">
                        <select name="clientes" id="clientes">
                            <option value="all">Todos</option>
                            <!--options são acresentados via JS-->
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    
                    <div class="col-md-12">

                        <a id="salvarPedido" class="btn btn-primary btn-md" type="button">Salvar</a>
                        <a href="lista_pedidos.php" class="btn btn-secondary btn-md" type="button">Voltar</a>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="../js/jQuery_3_5_1.min.js"></script>
    <script src="../js/funcoes/pedido.js"></script>    
  </body>
</html>
