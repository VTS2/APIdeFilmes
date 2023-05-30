const form = document.querySelector('#filmesForm')
const tituloInput = document.querySelector('#tituloInput')
const diretorInput = document.querySelector('#diretorInput')
const autorInput = document.querySelector('#autorInput')
const ano_lancamentoInput = document.querySelector('#ano_lancamentoInput')
const GeneroInput = document.querySelector('#GeneroInput')
const URL = 'http://localhost:8001/filmes.php'

const tableBody = document.querySelector('#filmesTable')

function carregarFilmes() {
    fetch(URL, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(response => response.json())
        .then(filmes => {
            tableBody.innerHTML = ''

            for (let i = 0; i < filmes.length; i++) {
                const tr = document.createElement('tr')
                const filme = filmes[i]
                tr.innerHTML = `
                    <td>${filme.id}</td>
                    <td>${filme.titulo}</td>
                    <td>${filme.diretor}</td>
                    <td>${filme.autor}</td>
                    <td>${filme.ano_lancamento}</td>
                    <td>${filme.genero}</td>
                    <td>
                        <button data-id="${filmes.id}"onclick="atualizarFilme(${filmes.id})">Editar</button>
                        <button onclick="excluirFilme(${filmes.id})">Excluir</button>
                    </td>
                `
                tableBody.appendChild(tr)
            }

        })
}

//função para criar um livro
function adicionarFilmes(e) {

    e.preventDefault()

    const titulo = tituloInput.value
    const diretor = diretorInput.value
    const autor = autorInput.value
    const ano_lancamento = ano_lancamentoInput.value
    const genero = GeneroInput.value

    fetch(URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `titulo=${encodeURIComponent(titulo)}&diretor=${encodeURIComponent(diretor)}&autor=${encodeURIComponent(autor)}&ano_lancamento=${encodeURIComponent(ano_lancamento)}&genero=${encodeURIComponent(genero)}`
    })
        .then(response => {
            if (response.ok) {
                carregarFilmes()
                tituloInput.value = ''
                diretorInput.value = ''
                autorInput.value = ''
                ano_lancamentoInput.value = ''
                GeneroInput.value = ''
            } else {
                console.error('Erro ao add filme')
                alert('Erro ao add filme')
            }
        })
}

function atualizarfilme(id) {
    const novoTitulo = prompt("Digite o novo titulo")
    const novoDiretor = prompt("Digite o novo diretor")
    const novoAutor = prompt("Digite o novo Autor")
    const novoLancamento = prompt("Digite o ano de lancamento")
    const novoGenero = prompt("Digite o novo  genero")
    if (novoTitulo && novoDiretor && novoAutor && novoLancamento && novoGenero) {
        fetch(`${URL}?id=${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `titulo=${encodeURIComponent(novoTitulo)}&diretor=${encodeURIComponent(novoDiretor)}&autor=${encodeURIComponent(novoAutor)}&lancamento=${encodeURIComponent(novoLancamento)}&genero=${encodeURIComponent(novoGenero)}`
        })
            .then(response => {
                if (response.ok) {
                    carregarLivros()
                } else {
                    console.error('Erro ao att livro')
                    alert('erro ao att livro')
                }
            })
    }
}

function excluirFilme(id) {
    if (confirm('Deseja excluir esse livro?')) {
        fetch(`${URL}?id=${id}`, {
            method: 'DELETE',
        })

            .then(response => {
                if (response.ok) {
                    carregarFilmes()
                } else {
                    console.error('Erro ao excluir Livro')
                    alert('Erro ao excluir Livro')
                }
            })
    }
}


form.addEventListener('submit', adicionarFilmes)

carregarFilmes()

console.log()