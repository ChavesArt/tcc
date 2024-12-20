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

        let dataSelecionada = produto.edata.toString().split("-");
        dataSelecionada =  dataSelecionada[2] + "/" +   dataSelecionada[1]  + "/" + dataSelecionada[0] 
    
        let option = document.createElement('option');
        option.value = produto.id_estoque;
        option.innerHTML = dataSelecionada + " Saldo: " + produto.resultado;
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

    // Select the <select> element for produto
    let select = document.querySelector('select[name="produto"]');
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
    let selectEstoque = document.querySelector('select[name="estoque"]');
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

    // Extract the stock balance from the selected option (e.g., "12/11/1200 Saldo: 63")
    let saldoEstoqueText = selectedEstoqueOptionText.split("Saldo: ");
    let saldoEstoque = parseInt(saldoEstoqueText[1], 10);  // Get the number after "Saldo: "

    // Get the input for quantidade
    let inputQuantidade = document.getElementById('quantidade-' + id_pedido);
    let quantidade = parseInt(inputQuantidade.value, 10);  // Get the quantity from the input

    // Ensure that quantity does not exceed the stock available
    if (quantidade > saldoEstoque) {
        alert('Quantidade maior do que o saldo disponível!');
        return;
    }

    // Update stock balance by subtracting the quantity
    saldoEstoque -= quantidade;

    // Update the "Saldo" in the stock info
    let updatedEstoqueText = saldoEstoqueText[0] + " Saldo: " + saldoEstoque;
    tdItemEstoque.innerHTML = updatedEstoqueText;

    // Create the td for the quantity
    let tdQuantidade = document.createElement('td');
    tdQuantidade.innerHTML = quantidade;

    // Create hidden input for quantidade
    let inputQuantidadeHidden = document.createElement('input');
    inputQuantidadeHidden.type = 'hidden';
    inputQuantidadeHidden.name = 'quantidade[]';
    inputQuantidadeHidden.value = quantidade;
    tr.appendChild(inputQuantidadeHidden); // Append the hidden input to the row

    // Create the td for the delete button
    let tdExcluir = document.createElement('td');
    let btnExcluir = document.createElement('button');
    btnExcluir.innerHTML = 'Excluir';

    // Add Bootstrap classes to the button for styling
    btnExcluir.classList.add('btn', 'btn-danger');  // Bootstrap classes for styling

    // Event listener for delete button
    btnExcluir.addEventListener("click", function() {
        tbody.removeChild(tr);  // Remove the row from the table
    });

    tdExcluir.appendChild(btnExcluir);

    // Append all the created elements to the new row
    tr.appendChild(tdItem);
    tr.appendChild(tdItemEstoque);
    tr.appendChild(tdQuantidade);
    tr.appendChild(tdExcluir);  // Add the delete button column to the row

    // Append the row to the table body
    tbody.appendChild(tr);

    // Clear the input fields after adding the row
    inputQuantidade.value = '';  // Clear the quantity input field

    // Reset the estoque select element (deselect the current option)
    selectEstoque.selectedIndex = 0;  // Reset to the first option (or you can set it to a default one)

    // Show the submit button after the first row is added
    let submitBtn = document.getElementById('submitBtn');
    submitBtn.style.display = 'block';  // Show the submit button

    // Show the table header after the first row is added
    let tabelaCabecalho = document.getElementById('tabela-cabecalho');
    tabelaCabecalho.style.display = 'table-header-group';  // Show the table header

    // Add the table to a form if not already present
    let form = document.getElementById('formTabela');
    if (!form) {
        // Create a form if not exists
        form = document.createElement('form');
        form.id = 'formTabela';
        
        // Add the table to the form
        let tabelaWrapper = document.createElement('div');
        tabelaWrapper.appendChild(document.getElementById('tabela-wrapper'));

        form.appendChild(tabelaWrapper);
        
        // Create and add submit button
        let btnSubmit = document.createElement('input');
        btnSubmit.type = 'submit';
        btnSubmit.value = 'Enviar';
        btnSubmit.classList.add('btn', 'btn-primary', 'mt-3');  // Bootstrap classes for styling the submit button
        
        form.appendChild(btnSubmit);
        
        // Add the form to the body or a specific section
        document.body.appendChild(form);
    }
}


// function AdicionaLinha(id_pedido) {
//     let tbody = document.getElementById('cesta_basica');
//     let tr = document.createElement('tr');

//     // Select the <select> element for produto
//     let select = document.querySelector('select[name="produto"]');
//     let selectedOption = select.options[select.selectedIndex];
//     let selectedOptionText = selectedOption.innerHTML;

//     let tdItem = document.createElement('td');
//     tdItem.innerHTML = selectedOptionText;

//     // Select the <select> element for estoque
//     let selectEstoque = document.querySelector('select[name="estoque"]');
//     let selectedEstoqueOption = selectEstoque.options[selectEstoque.selectedIndex];
//     let selectedEstoqueOptionText = selectedEstoqueOption.innerHTML;
    
//     // Extract the stock balance from the selected option (e.g., "12/11/1200 Saldo: 63")
//     let saldoEstoqueText = selectedEstoqueOptionText.split("Saldo: ");  // Split by "Saldo: "
//     let saldoEstoque = parseInt(saldoEstoqueText[1], 10);  // Get the number after "Saldo: "

//     let tdItemEstoque = document.createElement('td');
//     tdItemEstoque.innerHTML = selectedEstoqueOptionText;

//     // Get the input for quantidade
//     let inputQuantidade = document.getElementById('quantidade-' + id_pedido);
//     let quantidade = parseInt(inputQuantidade.value, 10);  // Get the quantity from the input

//     // Ensure that quantity does not exceed the stock available
//     if (quantidade > saldoEstoque) {
//         alert('Quantidade maior do que o saldo disponível!');
//         return;
//     }

//     // Update stock balance by subtracting the quantity
//     saldoEstoque -= quantidade;

//     // Update the "Saldo" in the stock info
//     let updatedEstoqueText = saldoEstoqueText[0] + " Saldo: " + saldoEstoque;
//     tdItemEstoque.innerHTML = updatedEstoqueText;

//     // Create the td for the quantity
//     let tdQuantidade = document.createElement('td');
//     tdQuantidade.innerHTML = quantidade;

//     // Create the td for the delete button
//     let tdExcluir = document.createElement('td');
//     let btnExcluir = document.createElement('button');
//     btnExcluir.innerHTML = 'Excluir';

//     // Add Bootstrap classes to the button for styling
//     btnExcluir.classList.add('btn', 'btn-danger');  // Bootstrap classes for styling

//     // Event listener for delete button
//     btnExcluir.addEventListener("click", function() {
//         tbody.removeChild(tr);  // Remove the row from the table
//     });

//     tdExcluir.appendChild(btnExcluir);

//     // Append all the created elements to the new row
//     tr.appendChild(tdItem);
//     tr.appendChild(tdItemEstoque);
//     tr.appendChild(tdQuantidade);
//     tr.appendChild(tdExcluir);  // Add the delete button column to the row

//     // Append the row to the table body
//     tbody.appendChild(tr);

//     // Clear the input fields after adding the row
//     inputQuantidade.value = '';  // Clear the quantity input field

//     // Reset the estoque select element (deselect the current option)
//     selectEstoque.selectedIndex = 0;  // Reset to the first option (or you can set it to a default one)
// }


// function AdicionaLinha(id_pedido) {
//     let tbody = document.getElementById('cesta_basica');

//     let tr = document.createElement('tr');

//     // Select the <select> element
//     let select = document.querySelector('select[name="produto"]');

//     // Get the selected <option>
//     let selectedOption = select.options[select.selectedIndex];

//     // Get the innerHTML of the selected option
//     let selectedOptionText = selectedOption.innerHTML;

//     let tdItem = document.createElement('td');
//     tdItem.innerHTML = selectedOptionText;

//     // Estoque
//     let selectEstoque = document.querySelector('select[name="estoque"]');

//     let selectedEstoqueOption = selectEstoque.options[selectEstoque.selectedIndex];
    
//     // Get the innerHTML of the selected option
//     let selectedEstoqueOptionText = selectedEstoqueOption.innerHTML;
//     let tdItemEstoque = document.createElement('td');
//     tdItemEstoque.innerHTML = selectedEstoqueOptionText;
    
    
//     let inputQuantidade = document.getElementById('quantidade-' + id_pedido);
//     let Quantidade = inputQuantidade.value;


//     let tdQuantidade = document.createElement('td');
//     // let inputQuantidade = document.createElement('input');
//     // inputQuantidade.type = 'number';
//     tdQuantidade.innerHTML = Quantidade;

//     /*let tdExcluir = document.createElement('td');
//     let btnExcluir = document.createElement('button');
//     btnExcluir.addEventListener("click", deleteRow(button), false);
//     btnExcluir.id_produto = produto.id_produto;
//     btnExcluir.innerHTML = "Excluir";
//     tdExcluir.appendChild(btnExcluir);
// */
//     tr.appendChild(tdItem);
//     tr.appendChild(tdItemEstoque);
//     tr.appendChild(tdQuantidade);
//     //tr.appendChild(tdExcluir);
//     tbody.appendChild(tr);
// }

function deleteRow(button) {
    // A linha (tr) é o elemento pai do botão clicado
    let row = button.closest('tr');
    row.remove(); // Remove a linha da tabela
  } 
