<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>avrtv</title>
  <link rel="icon" href="favicon.png" type="image/png">
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #000000;
      color: #00d8ff;
      font-family: Arial, sans-serif;
      overflow: hidden;
    }

    .contenedor {
      background: #181818;
      padding: 30px 20px;
      border-radius: 12px;
      max-width: 400px;
      width: 90%;
      text-align: center;
      box-sizing: border-box;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .contenedor p {
      margin-bottom: 15px;
      font-size: 1.1rem;
      line-height: 1.4;
    }

    .datos {
      background: #000;
      padding: 10px;
      border-radius: 8px;
      font-size: 0.95rem;
      line-height: 1.5;
      word-break: break-all;
      margin-bottom: 20px;
    }

    .btn-regreso {
      background: #00d8ff;
      color: #000;
      border: none;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-regreso:hover {
      background: #0099cc;
      color: #fff;
    }
  </style>
</head>

<body>
  <div class="contenedor">
    <p>Con tu donación, ayudas a mantener avrtv.site activo y libre para todos.</p>
    <div class="datos">
      CLABE: <br>
      Banco: <br>
      Beneficiario:
    </div>
    <p>Gracias por apoyar este proyecto.</p>
    <a href="/avrtv" class="btn-regreso">← Regresar al catálogo</a>
  </div>


</body>


</html>
