function validatePassword(){
    var password = document.getElementById("contraInput");
    var confirm_password = document.getElementById("contraInput2");

    console.log("--- en validate password ---");

    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords don't match");
    } else {
        confirm_password.setCustomValidity('');
    }
}