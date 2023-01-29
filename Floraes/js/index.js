/* "use strict"

document.querySelectorAll(".borrarButton").forEach(e => {e.addEventListener("click", prueba)})

function prueba(e) {
  console.log("hola prueba")

  const button = e.target
  const form = button.closest('.form')

  if(confirm("¿Estás seguro?")) {
    console.log(button.closest('.form'))
    console.log(form.id)
    console.log(form.querySelector(".borrarButton"))

  } else {
    console.log("no")
  }
  
} */

/* // codigo del modal cogido de https://www.w3schools.com/howto/howto_css_modals.asp
// Get the modal
var anadirPlantaModal = document.getElementById("anadirPlantaModal");

// Get the button that opens the modal
var anadirPlantaButton = document.getElementById("abrirModalButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];

// When the user clicks on the button, open the modal
anadirPlantaButton.onclick = function() {
  anadirPlantaModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  anadirPlantaModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == anadirPlantaModal) {
    anadirPlantaModal.style.display = "none";
  }
} */

// -------- MODAL ANADIR LOCALIZACION -------- //

/* // Get the modal
var anadirLocModal = document.getElementById("anadirLocModal");

// Get the button that opens the modal
var anadirLocButton = document.getElementById("abrirModalLocButton");

// When the user clicks on the button, open the modal
anadirLocButton.onclick = function() {
  anadirLocModal.style.display = "block";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == anadirPlantaModal) {
    anadirLocModal.style.display = "none";
  }
}

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  anadirLocModal.style.display = "none";
} */