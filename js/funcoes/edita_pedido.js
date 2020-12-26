
function buscaInfoPedidos(){
    
    var cliente = $("#hdCliente").val();
    var pedido = $("#hdPedido").val();

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/edita_action.php",
        
        data: {
            acao: 'buscaInfoPedidos',
            idCliente: cliente,
            idPedido: pedido
        },
        success: function(resposta){
            console.log(resposta);
            var retorno = JSON.parse(resposta);                      
            console.log(retorno);            
            
            montaHTMLLinhaTabelaProd(retorno);
        },
        error: function(){
            alert('não gravou');
        }
        
    });        
}

function montaHTMLLinhaTabelaProd(objJSON){

    $("#nameCliente").text(objJSON[0].cliente);

    let _html =  [];    

    objJSON.forEach(function(aPedido, idx){
        _html.push('<tr>');
            _html.push(`<td>${aPedido.idProd}</td>` );
            _html.push(`<td>${aPedido.descrProd}</td>` );
            _html.push(`<td>${aPedido.preco}</td>` );
            _html.push(`<td>${aPedido.qtdProd}</td>` );
            _html.push(`<td>${aPedido.total}</td>` );
            _html.push(`<td><a href="editar_produto.php?idProduto=${aPedido.idProd}&idPedido=${aPedido.id_pedido}" class="btn btn-md" >Editar</a></td>` );
            _html.push(`<td><a href="#" style='color:red' class="btn btn-md"  onclick='deletaProdutoDoPedido(${aPedido.id_prod_no_pedido}, this)' >Excluir</a></td>` );
        _html.push('</tr>');
    });

    $("#lista_produtos tbody").html(_html.join(''));
}


function deletaProdutoDoPedido(idProdNoPedido, element){
    

    if(!confirm('Deseja Realmente Excluir o Produto do Pedido?')){
        
        return false;
    }

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/edita_action.php",
        
        data: {
            acao: 'deletaProdutoDoPedido',
            idProdNoPedido: idProdNoPedido
        },
        success: function(resposta){
            console.log(resposta);
            var retorno = JSON.parse(resposta);                      
            console.log(retorno);

            if(retorno['status'] == 'OK'){
                $(element).parent().parent().fadeOut('slow');
            }
        },
        error: function(){
            alert('não gravou');
        }
        
    });  
}



jQuery(document).ready(function(){
 
    buscaInfoPedidos();        

});