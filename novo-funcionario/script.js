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

function showMedico() {
  const divMedico = document.getElementById('divMedico');

  const formMedicoHTML = 
  `<h2>Informações do Médico:</h2>
  <div>
    <label for="especialidade">Especialidade: </label>
    <select name="especialidade">
      <option value="clinico-geral">Clinico Geral</option>
      <option value="endocrinologista">Endocrinologista</option>
      <option value="infectologista">Infectologista</option>
      <option value="neurologista">Neurologista</option>
      <option value="psiquiatra">Psiquiatra</option>
      <option value="dermatologista">Dermatologista</option>
    </select>
  </div>
  <div>
    <label for="crm">CRM: </label>
    <input type="text" name="crm" min="0" required>
  </div>`

  divMedico.innerHTML = formMedicoHTML
}

function hideMedico() {
  const divMedico = document.getElementById('divMedico');
  divMedico.innerHTML = ""
}
