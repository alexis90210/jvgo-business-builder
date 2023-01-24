//JVGO

try {
  // ----------------------------------------------------------------------------
  // Nav autoplacing
  // ----------------------------------------------------------------------------

  let headerWidth = document
      .querySelector(".header-bar")
      ?.getBoundingClientRect().height,
    nav = document.querySelector(".section-navigation");
    if(nav) nav.style = `margin-top:${headerWidth}px  !important`;

  // ----------------------------------------------------------------------------
  // Loader
  // ----------------------------------------------------------------------------

  var LoaderBox,
    loader = document.querySelector("#loader");
  window.addEventListener("load", (e) => {
    (LoaderBox = document.createElement("div")).style =
      "position:fixed; top:0;left:0;width:100%; height:100vh;z-index:150;display:grid;place-items:center; background-color:#F8F9FA";
    var d = document.createElement("img");
    (d.src = `${window.location.protocol}/images/loader.svg`),
      LoaderBox.appendChild(d),
      loader.appendChild(LoaderBox);
  }),
    document.addEventListener("DOMContentLoaded", (e) => {
      setTimeout(() => {
        loader.remove(LoaderBox);
      }, 500);
    });

  // ----------------------------------------------------------------------------
  // selectable box time ( could have been usefull for single + go after continue )
  // ----------------------------------------------------------------------------

  var selectableBox = document.querySelectorAll(".selectable-box"),
    len = selectableBox.length;
  for (let e = 0; e < len; e++) {
    const l = selectableBox[e];
    l.addEventListener("click", (e) => {
      for (let e = 0; e < len; e++) {
        selectableBox[e].classList.remove("selectable-box-selected");
      }
      l.classList.add("selectable-box-selected");
    });
  }

  // ----------------------------------------------------------------------------
  // manipulation steps
  // ----------------------------------------------------------------------------

  function suivant(e = 1) {
    if (e > 1) {
      var s = document.querySelector("#content-step-" + (e - 1));
      s.classList.contains("d-block")
        ? (s.classList.add("d-none"), s.classList.remove("d-block"))
        : s.classList.add("d-none");
      var t = document.querySelector(`#content-step-${e}`);
      t.classList.remove("d-none"),
        t.classList.add("d-block"),
        document.querySelector(`#step-${e}`).classList.add("stepper-active");
    }
  }

  function arriere(e = 1) {
    if (e > 0) {
      var s = document.querySelector(`#content-step-${e + 1}`);
      s.classList.contains("d-block")
        ? (s.classList.add("d-none"), s.classList.remove("d-block"))
        : s.classList.add("d-none"),
        document
          .querySelector(`#step-${e + 1}`)
          .classList.remove("stepper-active");
      var t = document.querySelector(`#content-step-${e}`);
      t.classList.add("d-block"),
        t.classList.remove("d-none"),
        document.querySelector(`#step-${e}`).classList.add("stepper-active");
    }
  }

  // ----------------------------------------------------------------------------
  // toggling compta ( whoim) pack
  // ----------------------------------------------------------------------------

  function togglePack(e = 1) {
    var n = document.querySelector("#societe"),
      s = document.querySelector("#independant");
    1 == e &&
      (n.classList.contains("d-none") || n.classList.add("d-none"),
      s.classList.remove("d-none"),
      s.scrollIntoView()),
      2 == e &&
        (s.classList.contains("d-none") || s.classList.add("d-none"),
        n.classList.remove("d-none"),
        n.scrollIntoView());
  }

  // ----------------------------------------------------------------------------
  // open/hide reglement
  // ----------------------------------------------------------------------------

  function openReglement() {
    var e = document.querySelector("#paiement");
    e.classList.remove("d-none"),
      e.scrollIntoView(),
      document.querySelector("#main").classList.add("d-none");
  }
  function hideReglement() {
    var e = document.querySelector("#main");
    e.classList.remove("d-none"),
      e.scrollIntoView(),
      document.querySelector("#paiement").classList.add("d-none");
  }

  // ----------------------------------------------------------------------------
  // open/hide menu hamburger
  // ----------------------------------------------------------------------------

  document.querySelector(".hamburger-btn")?.addEventListener("click", (e) => {
    document.querySelector(".hamburger-mobile-menu").classList.remove("d-none"),
      document.querySelector(".hamburger-mobile-menu").classList.add("d-block");
  }),
    document
      .querySelector(".close-hamburger")?.addEventListener("click", (e) => {
        document
          .querySelector(".hamburger-mobile-menu")
          .classList.add("d-none");
      });

  // ----------------------------------------------------------------------------
  // history navigation go back
  // ----------------------------------------------------------------------------

  function pageArriere(){window.history.back()}function newPage(n){window.location.href=n}function print(){window.print()}

  
} catch (error) {
  console.log(error);
}
