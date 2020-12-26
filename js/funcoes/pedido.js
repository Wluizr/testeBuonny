

function pesquisar(){
    console.clear();
    var vlrIni = $("#valorIni").val() ;    
    var vlrFim = $("#valorFim").val();
    var cli = $("#clientes option:selected").val();    

    if(vlrFim == ''){
        alert('informe ao Menos o valor Final');
        return false;
    }

    if(vlrIni == ''){
        vlrIni = 0;
    }

    var objFiltro = {'clientes': cli, 'vlrIni': vlrIni, 'vlrFim' : vlrFim};

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/pedido_action.php",
        
        data: {
            acao: 'buscaPedidos',
            filtros: objFiltro
        },
        success: function(resposta){
            console.log(resposta);
            var retorno = JSON.parse(resposta);                      
            console.log(retorno);

            montaHTMLLinhaTabela(retorno);
         
        },
        error: function(){
            alert('não gravou');
        }
        
    });   

    
}

function montaHTMLLinhaTabela(objJSON){
    let _html =  [];    

    objJSON.forEach(function(aPedido, idx){
        _html.push('<tr>');
            _html.push(`<td>${aPedido.id_pedido}</td>` );
            _html.push(`<td>${aPedido.cliente}</td>` );
            _html.push(`<td>${aPedido.total_pedido}</td>` );
            _html.push(`<td><a href="editar_pedido.php?idPedido=${aPedido.id_pedido}" class="btn btn-md" >Editar</a></td>` );
            _html.push(`<td><a href="#" style='color:red' class="btn btn-md"  onclick='deletaPedido(${aPedido.id_pedido}, this)' >Excluir</a></td>` );
        _html.push('</tr>');
    });

    $("#lista_pedidos tbody").html(_html.join(''));
}

function buscaClientes(){

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/cliente_action.php",
        
        data: {
            acao: 'buscaClientes'           
        },
        success: function(resposta){
            var retorno = JSON.parse(resposta);
            
            console.log(resposta);
            console.log(retorno);

            montaHTMLOptionClientes(retorno);
        },
        error: function(){
            alert('não gravou');
        }
        
    });    
}

/** 
 * @param {Objeto JSON} objJSON 
 * Cria o Html de Option na tela, com os clientes recuperado do banco
 */ 
function montaHTMLOptionClientes(objJSON){
    let _html =  [];
    _html.push( ` <option value='all'>Todos</option> `);

    objJSON.forEach(function(item, idx){
        
        _html.push( ` <option value='${item.id}'>${item.nome} </option> `);
    });

    $("#clientes").html(_html.join(''));
}

function deletaPedido(idPedido, element){
    
    if(!confirm('Deseja Realmente o Pedido e seus Produtos?')){
        
        return false;
    }

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/edita_action.php",
        
        data: {
            acao: 'deletaPedido',
            idPedido: idPedido
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

// --- INCLUIR/EDITAR PEDIDO -------------------------------------------------------

function novoPedido(){
   
    $cliente = $("#clientes option:selected").val();

    if($cliente === 'all'){
        alert('Escolha ao menos um cliente');
        return false;
    }

    jQuery.ajax({
        type: "POST",
        async: false,
        url: "../controller/pedido_action.php",
        
        data: {
            acao: 'gravaPedidos',
            idCliente: $cliente
        },
        success: function(resposta){
            console.log(resposta);
            var retorno = JSON.parse(resposta);                      
            console.log(retorno);
            
            if(retorno['status'] == 'ERRO'){

                alert(retorno['msg']);
                return false;
            }

            location.href = 'editar_pedido.php?idCliente='+$cliente+'&idPedido='+retorno['idGerado'];
        },
        error: function(){
            alert('não gravou');
        }
        
    }); 
    
    
}




jQuery(document).ready(function(){
 
    buscaClientes();
    $("#pesquisar").click(pesquisar);
    $("#salvarPedido").click(novoPedido);

});