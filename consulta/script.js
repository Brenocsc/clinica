async function showMedico (event) {
  const especialidade = event.target.value
  console.log(especialidade)

  const response = await fetch('busca-medico.php?especialidade=' + especialidade)
  const medicos = await response.json()

  const selectMedico = document.getElementById('selectMedico')

  let optionHTML = ''
  for (const medico of medicos) {
    const option = `<option value="${medico.codigo}">${medico.nome}</option>`
    optionHTML += option
  }
  selectMedico.disabled = false;
  selectMedico.innerHTML = optionHTML

  showHorario()
}

async function showHorario () {
  const data = document.getElementById('inputData').value
  const codigoMedico = document.getElementById('selectMedico').value

  if (data && codigoMedico) {
    const response = await fetch(`busca-horario.php?data=${data}&codigoMedico=${codigoMedico}`)
    const horariosFechados = await response.json()

    const todosHorarios = [8,9,10,11,12,13,14,15,16,17]
    horariosDisponiveis = todosHorarios.filter(
      horario => !horariosFechados.includes(horario)
    )

    const selectHorario = document.getElementById('selectHorario')

    let optionHTML = ''
    for (const horario of horariosDisponiveis) {
      const option = `<option value="${horario}">${horario}:00</option>`
      optionHTML += option
    }
    selectHorario.disabled = false;
    selectHorario.innerHTML = optionHTML
  }
}