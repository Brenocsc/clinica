async function searchEndereco (event) {
  console.log(event.target.value)
  const cep = event.target.value

  try {
    const response = await fetch('busca-endereco.php?cep=' + cep)
    const endereco = await response.json()
    const { logradouro, cidade, estado } = endereco

    const inputLogradouro = document.getElementById('logradouro')
    inputLogradouro.value = logradouro

    const inputCidade = document.getElementById('cidade')
    inputCidade.value = cidade

    const inputEstado = document.getElementById('estado')
    inputEstado.value = estado
  } catch (error) {
    console.log(error)
  }
}
