function openMenu() {
  document.querySelector("#toggle-menu-mobile").classList.contains("d-sm-none")
    ? document
        .querySelector("#toggle-menu-mobile")
        .classList.remove("d-sm-none")
    : document
        .querySelector("#toggle-menu-mobile")
        .classList.remove("d-sm-none");
}

function closeMenu() {
  !document.querySelector("#toggle-menu-mobile").classList.contains("d-sm-none")
    ? document.querySelector("#toggle-menu-mobile").classList.add("d-sm-none")
    : document.querySelector("#toggle-menu-mobile").classList.add("d-sm-none");
}

function newPage(route) {
  window.location.href = route;
}

setInterval(() => {
  let ref = localStorage.getItem("X-Reference-Id");

  if (!ref) newPage("/login");
}, 100);


function deconnexion() {
  localStorage.removeItem("X-Reference-Id");
}


function reponseEmail() {

	var message = document.querySelector('#message-reponse')?.value
	var email = document.querySelector('#user-mail')?.innerText
	var id = document.querySelector('#user-id')?.innerText
	console.log( email )


	if( !message || !email ) {
		Swal.fire(
				"JVGO Assistant!",
				"Votre veillez renseigner le message de reponse",
				"error"
			)
			return
	}
	document.querySelector('#loading-indicator').classList.remove('d-none')

	axios.post("/reponse-client", { message: message , email: email , id: id })
	
	.then( ( reponse) => {

		console.log(reponse.data);

		document.querySelector('#loading-indicator').classList.add('d-none')

		if ( reponse.data.code == "success") {

			if(document.querySelector('#message-reponse')) document.querySelector('#message-reponse').value = ""

			Swal.fire(
				"JVGO Assistant!",
				"Votre reponse a bien ete transmit",
				"success"
			)

		} else {
			Swal.fire(
				"JVGO Assistant!",
				"Votre reponse n'a pas ete transmit",
				"error"
			)
		}

	}).catch( error => {
		console.log(error)
	})
}
