function SelecionaEstoque(event){

    event.preventDefault();

    
}

document.addEventListener("DOMContentLoaded", () => {
    listarTodos();
});

function listarTodos() {

    
    // Obtém o select do produto
    let selectKit = document.getElementById('kit');
     // Adiciona um ouvinte de evento para o evento 'change'
     selectKit.addEventListener('change', function() {
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
        .then(produto => inserirProduto(produto))
        // erro no http
        .catch(error => console.log(error));
 });
    
}

function inserirProduto(produto) {
    let select = document.getElementById('estoque');
    let option = document.createElement('option');
    option.innerHTML = produto.subtipo_produto;

    option.appendChild(option);
    select.appendChild(select);
}
 