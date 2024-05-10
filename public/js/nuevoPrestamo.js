function calcularDineroTotal() {
    // Obtener el valor del monto
    var monto = parseFloat(
        document.getElementById("monto").value.replace(",", "")
    ); // Reemplaza la coma por nada para evitar errores al convertir a número

    // Obtener el valor de los intereses en porcentaje
    var interesesPorcentaje = parseFloat(
        document.getElementById("intereses").value.replace(",", "")
    ); // Reemplaza la coma por nada para evitar errores al convertir a número

    // Calcular el monto de los intereses
    var interesesMonto = (monto * interesesPorcentaje) / 100;

    // Calcular el dinero total
    var dineroTotal = monto + interesesMonto;

    // Mostrar el dinero total en el campo correspondiente
    document.getElementById("dinero_total").value = dineroTotal.toFixed(2); // Limitar a dos decimales
}


function formatCurrency(input) {
    // Eliminar caracteres no numéricos
    let value = input.value.replace(/[^0-9]/g, "");

    // Dar formato al valor con un signo de dólar y puntos cada tres cifras
    value = "$" + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Asignar el valor formateado de vuelta al campo de entrada
    input.value = value;
}
