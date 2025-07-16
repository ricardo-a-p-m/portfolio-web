$(document).ready(function() {
    // 1. Nombre y Edad
    $("#btn1").click(function() {
        const nombre = $("#Nombre").val();
        const edad = $("#Edad1").val();
        $("#datos1").html(`Nombre: ${nombre}<br>Edad: ${edad}`);
    });

    // 2. Mayor de 3 números
    $("#btn2").click(function() {
        const n1 = parseInt($("#num1").val());
        const n2 = parseInt($("#num2").val());
        const n3 = parseInt($("#num3").val());
        const mayor = Math.max(n1, n2, n3);
        $("#datos2").text(`El número mayor es: ${mayor}`);
    });

    // 3. Clasificar Edad
    $("#btn3").click(function() {
        const edad = parseInt($("#Edad2").val());
        let resultado = "";
        if (edad >= 0 && edad <= 17) resultado = "Eres un niño.";
        else if (edad >= 18 && edad <= 59) resultado = "Eres un adulto.";
        else if (edad >= 60) resultado = "Eres un anciano.";
        else resultado = "Edad no válida.";
        $("#datos3").text(resultado);
    });

    // 4. Promedio de calificaciones
    $("#btn4").click(function() {
        const cantidad = parseInt($("#numCalif").val());
        let suma = 0;
        for (let i = 1; i <= cantidad; i++) {
            const calif = parseInt(prompt(`Ingrese la calificación ${i}:`, "10"));
            suma += calif;
        }
        const promedio = (suma / cantidad).toFixed(2);
        $("#datos4").text(`Su promedio es: ${promedio}`);
    });

    // 5. Pirámide de números
    $("#btn5").click(function() {
        let resultado = "";
        for (let i = 1; i <= 10; i++) {
            resultado += `${String(i).repeat(i)}<br>`;
        }
        $("#datos5").html(resultado);
    });

    // 6. Verificar si divisible por 2
    $("#btn6").click(function() {
        const num = parseInt($("#Num").val());
        const mensaje = (num % 2 === 0) ? "Es divisible por 2." : "No es divisible por 2.";
        $("#datos6").text(mensaje);
    });

    // 7. Mostrar pares del 1 al 100
    $("#btn7").click(function() {
        let resultado = "";
        for (let i = 1; i <= 100; i++) {
            if (i % 2 === 0) resultado += `${i}, `;
        }
        $("#datos7").text(resultado.slice(0, -2));
    });

    // 8. Pirámide de repetición de 1 a 10
    $("#btn8").click(function() {
        let resultado = "";
        for (let i = 1; i <= 10; i++) {
            for (let j = 0; j < i; j++) {
                resultado += `${i}`;
            }
            resultado += `<br>`;
        }
        $("#datos8").html(resultado);
    });
});
