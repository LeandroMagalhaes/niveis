
function enviar() {
    const dados = {
      "email": document.getElementById("email").value,
      "senha": document.getElementById("senha").value,
      "lembrar": document.getElementById("email").checked,
    };

    validarLogin(dados);
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();      
    var userToken = googleUser.getAuthResponse().id_token; 

    const dados = {
      user_id: profile.getId(),
      userName: profile.getName(),
      userPicture: profile.getImageUrl(),
      email: profile.getEmail(),
      givenName: profile.getGivenName(),
      familyName: profile.getFamilyName()
    };
    
    validarLogin(dados);          
}

	function validarLogin(dados) {
    fetch("../controller/logar_ajax.php", {
      method: "POST",
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(dados)
    }).then(response => {
      response.json().then(result => {
        if (result.status == 'success') {
          window.location.href = "restrito.php";
        } else {
          let divMsg = document.getElementById('mensagens');
          divMsg.innerHTML = `<div class='alert alert-${result.status}'>${result.msg}</div>`;
        }
      })
    }).catch(function(error) {
      console.log("Falha ao executar a requisição " + error.message);
    })
}
