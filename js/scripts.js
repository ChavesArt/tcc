function SelecionaEstoque(event) {

    event.preventDefault();


}

document.addEventListener("DOMContentLoaded", () => {
    listarTodos();
});

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

function inserirProdutos(produtos) {
    for (const produto of produtos) {

        inserirProduto(produto);

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


function AdicionaLinha() {
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

    /*let tdEstoque = document.createElement('td');
    tdEstoque.innerHTML = select;

    let tdQuantidade = document.createElement('td');
    let inputQuantidade = document.createElement('input');
    inputQuantidade.type = 'number';
    tdQuantidade.innerHTML = inputQuantidade;

    let tdExcluir = document.createElement('td');
    let btnExcluir = document.createElement('button');
    btnExcluir.addEventListener("click", excluir, false);
    btnExcluir.id_produto = produto.id_produto;
    btnExcluir.innerHTML = "Excluir";
    tdExcluir.appendChild(btnExcluir);
*/
    tr.appendChild(tdItem);
    // tr.appendChild(tdEstoque);
    // tr.appendChild(tdQuantidade);
    // tr.appendChild(tdExcluir);
    tbody.appendChild(tr);
}

function excluir() { }
