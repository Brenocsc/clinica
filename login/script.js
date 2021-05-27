function handleLoginForm () {
  const form = document.getElementById('loginForm');
  const formData = new FormData(form)

  const options = {
    method: "POST",
    body: formData
  }

  fetch("process-login.php", options)
    .then(async res => console.log(await res.json()))
    .catch(e => console.log(e))
}