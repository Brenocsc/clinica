async function handleLoginForm (e) {
  e.preventDefault()
  const form = e.target
  const formData = new FormData(form)

  const options = {
    method: 'POST',
    body: formData
  }

  try {
    const responseJson = await fetch('process-login.php', options)
    const response = await responseJson.json()
    console.log(response)

    const { success, detail } = response

    if (success) {
      window.open(detail,'_blank');
      const span = document.getElementById('spanDetails')
      span.textContent = ''
    } else {
      const span = document.getElementById('spanDetails')
      span.textContent = detail
    }
  } catch (error) {
    console.log(error)
  }
}
