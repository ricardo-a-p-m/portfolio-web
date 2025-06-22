function buscarArticulo() {
  const url = "https://es.wikipedia.org/w/api.php";
  const busqueda = document.getElementById("busqueda").value;
  const resultadosDiv = document.getElementById("resultados");
  resultadosDiv.innerHTML = ""; // Clear previous results

  const searchParams = {
    action: "query",
    format: "json",
    list: "search",
    srsearch: busqueda,
    srnamespace: 0,
    srlimit: 60,
  };

  $.ajax({
    url,
    data: searchParams,
    dataType: "jsonp",
    success: function (searchResponse) {
      const searchResults = searchResponse.query.search;

      searchResults.forEach(function (result) {
        const pageId = result.pageid;
        const detailsParams = {
          action: "query",
          format: "json",
          prop: "extracts|pageimages",
          exintro: true,
          explaintext: true,
          redirects: 1,
          inprop: "url",
          pilimit: "max",
          pageids: pageId,
        };

        $.ajax({
          url,
          data: detailsParams,
          dataType: "jsonp",
          success: function (detailsResponse) {
            const page = detailsResponse.query.pages[pageId];
            const image_url = page.thumbnail?.source || "";

            if (image_url && image_url.trim() !== "") {
              const containerElement = document.createElement("div");
              containerElement.setAttribute("class", "articulo-contenedor");

              const imgElement = document.createElement("img");
              imgElement.setAttribute("class", "articulo-imagen");
              imgElement.setAttribute(
                "src",
                image_url.replace(/\/thumb\//, "/").replace(/\/\d+px-.+$/, "")
              );

              containerElement.appendChild(imgElement);

              imgElement.addEventListener("click", function () {
                mostrarInfoImagen(page.title, page.extract);
              });

              resultadosDiv.appendChild(containerElement);
            }
          },
        });
      });
    },
    error: function (error) {
      console.log(error);
    },
  });
}
