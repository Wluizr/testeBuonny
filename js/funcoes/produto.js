
function formataDinheiroExibicao(strValor){
    
    return strValor.toLocaleString('pt-BR',{
                                                // Ajustando casas decimais
                                                minimumFractionDigits: 2,  
                                                maximumFractionDigits: 2
                                                })
}
function buscaProdutos(){
       
    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/produto_action.php",
        
        data: {
            acao: 'buscaProdutos',
            
        },
        success: function(resposta){
            console.log(resposta);
            var retorno = JSON.parse(resposta);                      
            console.log(retorno);            

            montaHTMLOptionProdutos(retorno);
        },
        error: function(){
            alert('não gravou');
        }
        
    }); 
        
}

function montaHTMLOptionProdutos(objJSON){
    let _html =  [];
    _html.push( ` <option value=''>-- Selecione --</option> `);

    objJSON.forEach(function(item, idx){
        
        _html.push( ` <option value='${item.idProd}'>${item.descricao} </option> `);
    });

    $("#produtos").html(_html.join(''));
}


function buscaInfoProd(){
    var idProd = $("#produtos option:selected").val();

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/produto_action.php",
        
        data: {
            acao: 'buscaInfoProd',
            idProd: idProd
        },
        success: function(resposta){            
            var retorno = JSON.parse(resposta);
            console.log(retorno);

            var _preco = retorno.preco;

            $("#valorProd").text( _preco );

        },
        error: function(){
            alert('não gravou');
        }
        
    }); 
}


function salvarProdPedido(){
    var idProd = $("#produtos option:selected").val();
    var qtde = $("#qtde").val();
    var idPedido = $("#hdPedido").val();

    if( idProd == ''){
        alert('Escolha um Produto! ');
        return false;
    }

    if(qtde < 0){
        alert('informe a Quantidade! ');
        return false;
    }
    

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/produto_action.php",
        
        data: {
            acao: 'salvarProdPedido',
            idProd: idProd,
            qtde: qtde,
            idPedido: idPedido
        },
        success: function(resposta){            
            var retorno = JSON.parse(resposta);
            console.log(retorno);

            if(retorno['status'] == "ERRO"){
                alert(retorno['msg']);
            }

            location.href = 'editar_pedido.php?idPedido='+idPedido;
        },
        error: function(){
            alert('não gravou');
        }
        
    }); 
}



jQuery(document).ready(function(){
 
    buscaProdutos();
    
    $("#salvarProdnoPedido").click(salvarProdPedido);
    $("#produtos").change(buscaInfoProd);
    
    $("#qtde").blur(function(){
        var total = $("#qtde").val() * parseFloat($("#valorProd").text());

        $("#valorTotal").text(formataDinheiroExibicao(total));
    });
});