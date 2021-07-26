// JS Function to show Password on command

function showPassword() {
   
   var password = document.getElementById("clientPassword");

   if (password.type === "password") {
      password.type = "text";
   } else {
      password.type = "password";
   }
}

function goBack() {
   window.history.back();
}
