function buscarArticulo() {
  var busqueda = document.getElementById("busqueda").value;
  var wikipediaUrl =
    "https://es.wikipedia.org/w/api.php?action=query&format=json&prop=extracts|pageimages&exintro=true&explaintext=true&redirects=1&titles=" +
    encodeURIComponent(busqueda) +
    "&pithumbsize=500";

  $.ajax({
    url: wikipediaUrl,
    method: "GET",
    dataType: "jsonp",
    success: function (data) {
      var pages = data.query.pages;
      $.each(pages, function (key, value) {
        var page = value;
        var thumbnail = page.thumbnail ? page.thumbnail.source : "";
        var title = page.title ? page.title : "";
        var extract = page.extract ? page.extract.replace(/\[\d+\]​/g, "") : "";

        var result = `<div>
                        <p>${title}</p>
                        <p id="extractText"></p>
                      </div>`;
        $("#resultados").html(result);

        var extractText = document.getElementById("extractText");
        var chars = extract.split("");
        var index = 0;

        var timer = setInterval(function () {
          if (index < chars.length) {
            extractText.innerHTML += chars[index];
            index++;
          } else {
            clearInterval(timer);
            setTimeout(function () {
              mostrarImagen(thumbnail);
              // leerTexto(); ❌ Eliminado para que NO lea automáticamente
            }, 500); // Puedes ajustar el retraso si lo deseas
          }
        }, 0);
      });
    },
    error: function () {
      console.log("Error en la solicitud AJAX.");
    },
  });
}

function mostrarImagen(thumbnail) {
  var imageContainer = document.createElement("div");
  var thumbnailImg = new Image();
  thumbnailImg.src = thumbnail;
  thumbnailImg.alt = "Thumbnail";
  thumbnailImg.classList.add("animated-image");
  imageContainer.appendChild(thumbnailImg);
  $("#resultados").append(imageContainer);
}

function reloadPage() {
  location.reload();
}

function leerTexto() {
  speechSynthesis.cancel(); // ✅ Detiene cualquier lectura previa
  var texto = document.getElementById("resultados").textContent;
  var mensaje = new SpeechSynthesisUtterance(texto);
  speechSynthesis.speak(mensaje);
}
