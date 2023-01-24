  // ----------------------------------------------------------------------------
  // open menu
  // ----------------------------------------------------------------------------

function openMenu() {
  document.querySelector("#toggle-menu-mobile").classList.contains("d-sm-none")
    ? document
        .querySelector("#toggle-menu-mobile")
        .classList.remove("d-sm-none")
    : document
        .querySelector("#toggle-menu-mobile")
        .classList.remove("d-sm-none");
}

  // ----------------------------------------------------------------------------
  //  menu 
  // ----------------------------------------------------------------------------


function closeMenu() {
  document.querySelector("#toggle-menu-mobile").classList.contains("d-sm-none"),
    document.querySelector("#toggle-menu-mobile").classList.add("d-sm-none");
}

  // ----------------------------------------------------------------------------
  // launch new page
  // ----------------------------------------------------------------------------


function newPage(e) {
  window.location.href = e;
}

  // ----------------------------------------------------------------------------
  // reponse mail
  // ----------------------------------------------------------------------------

function reponseEmail() {
  var e = document.querySelector("#message-reponse")?.value,
    o = document.querySelector("#user-mail")?.innerText,
    n = document.querySelector("#user-id")?.innerText;
  console.log(o),
    e && o
      ? (document
          .querySelector("#loading-indicator")
          .classList.remove("d-none"),
        axios
          .post("/reponse-client", { message: e, email: o, id: n })
          .then((e) => {
            console.log(e.data),
              document
                .querySelector("#loading-indicator")
                .classList.add("d-none"),
              "success" == e.data.code
                ? (document.querySelector("#message-reponse") &&
                    (document.querySelector("#message-reponse").value = ""),
                  Swal.fire(
                    "JVGO Assistant!",
                    "Votre reponse a bien ete transmit",
                    "success"
                  ))
                : Swal.fire(
                    "JVGO Assistant!",
                    "Votre reponse n'a pas ete transmit",
                    "error"
                  );
          })
          .catch((e) => {
            console.log(e);
          }))
      : Swal.fire(
          "JVGO Assistant!",
          "Votre veillez renseigner le message de reponse",
          "error"
        );
}
