function loadPage(url) {
    // Utiliza AJAX para cargar el contenido de la página sin recargarla
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            // Reemplaza el contenido de la página actual con el nuevo contenido
            document.documentElement.innerHTML = this.responseText;
            // Cambia la URL en la barra de direcciones del navegador
            history.pushState({}, '', url);
        }
    };
    xhttp.open('GET', url, true);
    xhttp.send();
}
