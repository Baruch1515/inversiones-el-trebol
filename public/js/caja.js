function formatCurrency(input) {
    // Eliminar caracteres no numéricos
    let value = input.value.replace(/[^0-9]/g, "");

    // Dar formato al valor con un signo de dólar y puntos cada tres cifras
    value = "$" + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Asignar el valor formateado de vuelta al campo de entrada
    input.value = value;
}

