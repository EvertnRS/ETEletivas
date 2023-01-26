function usuario_aparecer(){
    const usuario = document.querySelector(".lista_usuario")
    usuario.classList.toggle("aparecer")
}
function eletiva_aparecer(){
    const usuario = document.querySelector(".lista_eletiva")
    usuario.classList.toggle("aparecer")
}

function sair(){
    const sair = document.querySelector(".sair")
    sair.classList.toggle("aparecer")
}



function searchData(){
    const pesquisa = document.querySelector(".pesquisa")
    window.location = "?search="+pesquisa.value
}