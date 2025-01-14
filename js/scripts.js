function SelecionaEstoque(event, id_pedido) {

    event.preventDefault();

 
}

document.addEventListener("DOMContentLoaded", () => {
    //listarTodos2();
});


function listarTodos2() {


    // Obtém o select do produto
    let selectKits = document.getElementsByClassName('selectKits');
   
   
    Array.from(selectKits).forEach(function(selectKit) {
        
    
    
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

function cadastrar_itens_saida(event, id_pedido) {
    event.preventDefault(); // Impede o comportamento padrão do formulário
    
    // Obtém o tbody da tabela do pedido específico
    let tbody = document.getElementById('cesta_basica-' + id_pedido);
    let rows = tbody.getElementsByTagName('tr'); // Obtém todas as linhas da tabela
    
    // Inicializa um array para armazenar os dados dos itens
    let itens = [];

    // Percorre as linhas da tabela para obter as informações
    Array.from(rows).forEach(function(row) {
        let produto = row.querySelector('input[name="produto[]"]').value;  // Obtém o nome do produto
        let estoque = row.querySelector('input[name="estoque[]"]').value;  // Obtém o estoque selecionado
        // console.log(estoque);
        let quantidade = row.querySelector('input[name="quantidade[]"]').value;  // Obtém a quantidade

        // Adiciona os dados ao array
        itens.push({
            produto: produto,
            estoque: estoque,
            quantidade: quantidade
        });
    });

    // Envia os dados para o backend via fetch
    fetch('crud/cadastrar_itens_saida.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({
            id_pedido: id_pedido,
            itens: itens  // Envia os itens no corpo da requisição
        })
    })
    .then(() => {
        // Após o envio, recarrega a página
        location.reload();
    })
    .catch(error => {
        console.error('Erro ao enviar os dados:', error);
        alert("Erro na comunicação com o servidor.");
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
    )

    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na resposta da rede');
        }
        return response.json(); // Aqui, chamamos o .json() corretamente para processar o JSON da resposta
    })
    .then(produtos => {
        inserirProdutos(produtos, idPedido); // Chama a função inserindo os produtos e o idPedido
    })
    ///.then(Response => Response.json())
        
    
    //.then(produtos => inserirProdutos(produtos, idPedido ))
        // erro no http
    .catch(error => console.log(error));
 


    }

    function inserirProdutos(produtos, idPedido) {
        let selectEstoque = document.getElementById('selectEstoque-' + idPedido); 
        
        selectEstoque.innerHTML = ''; // Remove todas as opções
        
        for (const produto of produtos) {
            let dataSelecionada = produto.edata ? produto.edata.toString().split("-") : null;
            
            // Se a dataSelecionada não for nula ou indefinida, formate-a
            if (dataSelecionada) {
                dataSelecionada = dataSelecionada[2] + "/" + dataSelecionada[1] + "/" + dataSelecionada[0];
            } else {
                dataSelecionada = ''; // Se for nula, deixe em branco
            }
    
            let option = document.createElement('option');
            option.value = produto.id_estoque;
    
            // Se a dataSelecionada estiver vazia, apenas exiba o saldo
            if (dataSelecionada) {
                option.innerHTML = dataSelecionada + " Saldo: " + produto.resultado;
            } else {
                option.innerHTML = "Saldo: " + produto.resultado; // Não mostra a data
            }
    
            selectEstoque.appendChild(option);
        }
    }
    
function inserirProduto(produto) {
    console.log(produto + ' chegou');
    let select = document.getElementById('estoque');
    let option = document.createElement('option');
    option.value = produto.id_estoque;
    option.innerHTML = produto.data_validade;
    select.appendChild(option);
}
function AdicionaLinha(id_pedido) {
    // Seleciona o tbody do pedido específico
    let tbody = document.getElementById('cesta_basica-' + id_pedido);
    let tr = document.createElement('tr');


    // Select the <select> element for produto
    let select = document.getElementById('selectProduto-' + id_pedido);
    let selectedOption = select.options[select.selectedIndex];
    let selectedOptionText = selectedOption.innerHTML;

    let tdItem = document.createElement('td');
    tdItem.innerHTML = selectedOptionText;

    // Create hidden input for produto
    let inputProduto = document.createElement('input');
    inputProduto.type = 'hidden';
    inputProduto.name = 'produto[]';
    inputProduto.value = selectedOptionText;
    tr.appendChild(inputProduto); // Append the hidden input to the row

    // Select the <select> element for estoque
    //let selectEstoque = document.querySelector('select[name="estoque"]');
    let selectEstoque = document.getElementById('selectEstoque-' + id_pedido);
    
    let selectedEstoqueOption = selectEstoque.options[selectEstoque.selectedIndex];
    let selectedEstoqueOptionText = selectedEstoqueOption.innerHTML;

    let tdItemEstoque = document.createElement('td');
    tdItemEstoque.innerHTML = selectedEstoqueOptionText;

    // Create hidden input for estoque
    let inputEstoque = document.createElement('input');
    inputEstoque.type = 'hidden';
    inputEstoque.name = 'estoque[]';
    inputEstoque.value = selectedEstoqueOptionText;
    tr.appendChild(inputEstoque); // Append the hidden input to the row


    // Extraímos o saldo de estoque da opção selecionada
    let saldoEstoqueText = selectedEstoqueOptionText.split("Saldo: ");
    let saldoEstoque = parseInt(saldoEstoqueText[1], 10);  // O número após "Saldo:"

    // Obtém a quantidade do campo input
    let inputQuantidade = document.getElementById('quantidade-' + id_pedido);
    if (!inputQuantidade) {
        console.error("Elemento quantidade-" + id_pedido + " não encontrado.");
        return;
    }
    let quantidade = parseInt(inputQuantidade.value, 10);  // A quantidade inserida

    // Verifica se a quantidade não ultrapassa o estoque
    if (quantidade > saldoEstoque) {
        alert('Quantidade maior do que o saldo disponível!');
        return;
    }

    // Atualiza o saldo de estoque
    saldoEstoque -= quantidade;
    let updatedEstoqueText = saldoEstoqueText[0] + " Saldo: " + saldoEstoque;
    tdItemEstoque.innerHTML = updatedEstoqueText;

    // Cria a célula para a quantidade
    let tdQuantidade = document.createElement('td');
    tdQuantidade.innerHTML = quantidade;

    // Cria a célula para o botão de excluir
    let tdExcluir = document.createElement('td');
    let btnExcluir = document.createElement('button');
    btnExcluir.innerHTML = 'Excluir';
    btnExcluir.classList.add('btn', 'btn-danger');  // Bootstrap classes

    // Evento para excluir a linha
    btnExcluir.addEventListener("click", function() {
        tbody.removeChild(tr);
    });

    tdExcluir.appendChild(btnExcluir);

    // Cria um input hidden com os dados do item
    let inputHiddenProduto = document.createElement('input');
    inputHiddenProduto.type = 'hidden';
    inputHiddenProduto.name = 'produto[]';
    inputHiddenProduto.value = selectedOption.value;

    let inputHiddenEstoque = document.createElement('input');
    inputHiddenEstoque.type = 'hidden';
    inputHiddenEstoque.name = 'estoque[]';
    inputHiddenEstoque.value = selectedEstoqueOption.value;

    let inputHiddenQuantidade = document.createElement('input');
    inputHiddenQuantidade.type = 'hidden';
    inputHiddenQuantidade.name = 'quantidade[]';
    inputHiddenQuantidade.value = quantidade;

    // Adiciona os inputs hidden à linha
    tr.appendChild(inputHiddenProduto);
    tr.appendChild(inputHiddenEstoque);
    tr.appendChild(inputHiddenQuantidade);

    // Adiciona as células na nova linha
    tr.appendChild(tdItem);
    tr.appendChild(tdItemEstoque);
    tr.appendChild(tdQuantidade);
    tr.appendChild(tdExcluir);

    // Adiciona a nova linha na tabela
    tbody.appendChild(tr);

    // Limpa o campo de quantidade
    inputQuantidade.value = '';

    // Reseta o <select> de estoque
    selectEstoque.selectedIndex = 0;

    // Exibe o cabeçalho da tabela se ainda não estiver visível
    let tabelaCabecalho = document.getElementById('tabela-cabecalho-' + id_pedido);
    if (tabelaCabecalho) {
        tabelaCabecalho.style.display = 'table-header-group';
    }

    // Exibe a tabela
    let tabela = document.getElementById('tabela-' + id_pedido);
    if (tabela) {
        tabela.style.display = 'table';  // Torna a tabela visível
    }

    // Exibe o botão "Enviar" após a adição de pelo menos uma linha
    let submitBtn = document.getElementById('submitBtn-' + id_pedido);
    if (submitBtn) {
        submitBtn.style.display = 'inline-block';
    }
}

