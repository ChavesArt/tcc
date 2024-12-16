function SelecionaEstoque(event, id_pedido) {

    event.preventDefault();


}

document.addEventListener("DOMContentLoaded", () => {
    listarTodos2();
});


function listarTodos2() {


    // Obtém o select do produto
    let selectKits = document.getElementsByClassName('selectKits');
   
   
    Array.from(selectKits).forEach(function(selectKit) {
        console.log(kit); // Exemplo de ação: exibindo o elemento no console
    
    
         // Adiciona um ouvinte de evento para o evento 'change'
        selectKit.addEventListener('change', function () {
            // Obtém o valor selecionado
            let produtoId = selectKit.value;
    
            // Se não houver valor selecionado, retorna
            if (!produtoId) {
                return;
            }
    
            fetch('crud/listar.php?id_produto=' + produtoId, {
                method: "GET",
                headers: { 'Content-Type': "application/json; charset=UTF-8" }
            }
            ).then(Response => Response.json())
                .then(produtos => inserirProdutos(produtos))
                // erro no http
                .catch(error => console.log(error));
        });
    
    
    });

   

}

function listarTodos() {


    // Obtém o select do produto
    let selectKit = document.getElementById('kit');
   
   
    // Adiciona um ouvinte de evento para o evento 'change'
    selectKit.addEventListener('change', function () {
        // Obtém o valor selecionado
        let produtoId = selectKit.value;

        // Se não houver valor selecionado, retorna
        if (!produtoId) {
            return;
        }

        fetch('crud/listar.php?id_produto=' + produtoId, {
            method: "GET",
            headers: { 'Content-Type': "application/json; charset=UTF-8" }
        }
        ).then(Response => Response.json())
            .then(produtos => inserirProdutos(produtos))
            // erro no http
            .catch(error => console.log(error));
    });

}


function preencherSelectDoEstoque( idPedido){


    let select = document.getElementById('selectProduto-' + idPedido);
    let produtoIdEscolhido = select.value;

    // Se não houver valor selecionado, retorna
    if (!produtoIdEscolhido) {
        return;
    }

    fetch('crud/listar.php?id_produto=' + produtoIdEscolhido, {
        method: "GET",
        headers: { 'Content-Type': "application/json; charset=UTF-8" }
    }
    ).then(Response => Response.json())
        .then(produtos => inserirProdutos(produtos, idPedido ))
        // erro no http
        .catch(error => console.log(error));

}



function inserirProdutos(produtos, idPedido) {
    let selectEstoque = document.getElementById('selectEstoque-' + idPedido); 
    selectEstoque.innerHTML = ''; // Remove todas as opções



    for (const produto of produtos) {

        let dataSelecionada = produto.data_validade.toString().split("-");
        dataSelecionada =  dataSelecionada[2] + "/" +   dataSelecionada[1]  + "/" + dataSelecionada[0] 
    
        let option = document.createElement('option');
        option.value = produto.id_estoque;
        option.innerHTML = dataSelecionada;
        selectEstoque.appendChild(option);

    }
}

function inserirProduto(produto) {
    let select = document.getElementById('estoque');
    let option = document.createElement('option');
    option.value = produto.id_estoque;
    option.innerHTML = produto.data_validade;
    select.appendChild(option);
}

function AdicionaLinha(event) {

    event.preventDefault();


}


function AdicionaLinha(id_pedido) {
    let tbody = document.getElementById('cesta_basica');

    let tr = document.createElement('tr');

    // Select the <select> element
    let select = document.querySelector('select[name="produto"]');

    // Get the selected <option>
    let selectedOption = select.options[select.selectedIndex];

    // Get the innerHTML of the selected option
    let selectedOptionText = selectedOption.innerHTML;

    let tdItem = document.createElement('td');
    tdItem.innerHTML = selectedOptionText;

    // Estoque
    // let estoque = document.querySelector('input[name="quantidade"');
    let selectEstoque = document.querySelector('select[name="estoque"]');

    let selectedEstoqueOption = selectEstoque.options[selectEstoque.selectedIndex];
    
    // Get the innerHTML of the selected option
    let selectedEstoqueOptionText = selectedEstoqueOption.innerHTML;

    let tdItemEstoque = document.createElement('td');
    tdItemEstoque.innerHTML = selectedEstoqueOptionText;
    
    
    let inputQuantidade = document.getElementById('quantidade-' + id_pedido);
    let Quantidade = inputQuantidade.value;


    let tdQuantidade = document.createElement('td');
    // let inputQuantidade = document.createElement('input');
    // inputQuantidade.type = 'number';
    tdQuantidade.innerHTML = Quantidade;

    /*let tdExcluir = document.createElement('td');
    let btnExcluir = document.createElement('button');
    btnExcluir.addEventListener("click", deleteRow(button), false);
    btnExcluir.id_produto = produto.id_produto;
    btnExcluir.innerHTML = "Excluir";
    tdExcluir.appendChild(btnExcluir);
*/
    tr.appendChild(tdItem);
    tr.appendChild(tdItemEstoque);
    tr.appendChild(tdQuantidade);
    //tr.appendChild(tdExcluir);
    tbody.appendChild(tr);
}

function deleteRow(button) {
    // A linha (tr) é o elemento pai do botão clicado
    let row = button.closest('tr');
    row.remove(); // Remove a linha da tabela
  } 
