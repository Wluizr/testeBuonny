
<!DOCTYPE html>
<html lang="pt-br">
  <head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Alterar Produto</title>
  </head>
  <body>      
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">
                    Alterar Produto <?= $_REQUEST['idProduto']?>
                </h3>
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="idProduto" id="idProduto" value='<?= $_REQUEST['idProduto']?>' >
                        <label for="produtos">Produtos:</label>
                        <select name="produtos" id="produtos">
                            <!--options são acresentados via JS-->
                            
                        </select>
                        <br>
                        <label for="">Valor: R$ </label><span id='valorProd'>0,00</span>
                        <br>
                        <label for="">Qtde: </label><input  type="number" name="qtde" id="qtde" value='0'>
                        <br>
                        <label for="">Total: R$ </label><span id='valorTotal'>0,00</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    
                    <div class="col-md-4">

                        <a id="salvarProdnoPedido" class="btn btn-primary btn-md" type="button">Salvar</a>
                        <a href="editar_pedido.php?idPedido=<?= $_REQUEST['idPedido']?>" class="btn btn-secondary btn-md" type="button">Voltar</a>

                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../js/jQuery_3_5_1.min.js"></script>
    <script src="../js/funcoes/produto.js"></script>    
  </body>
</html>
