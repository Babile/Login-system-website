function showPasswordFunc() {
  let passwordInput = document.getElementById("password");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } 
  else {
    passwordInput.type = "password";
  }
}

function showPasswordsFunc() {
  let passwordInput = document.getElementById("password");
  let passwordRetypeInput = document.getElementById("password_retype");

  if (passwordInput.type === "password" && passwordRetypeInput.type == "password") {
    passwordInput.type = "text";
    passwordRetypeInput.type = "text";
  } 
  else {
    passwordInput.type = "password";
    passwordRetypeInput.type = "password";
  }
}