function validarFormulario() {
    var email = document.getElementById("form1").value;
    var senha = document.getElementById("form2").value;
  
    if (email.trim() === "" || senha.trim() === "") {
      alert("Por favor, preencha todos os campos.");
      return false;
    }

    var formatoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!formatoEmail.test(email)) {
      alert("Por favor, insira um endereço de e-mail válido.");
      return false;
    }

    return true;
  }