<!DOCTYPE html>
<html lang="es-PE">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CRUD con Vue.js, PHP y MySQL</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style>
    :root {
      --color-primary: #41B883;
      --color-secondary: #35495E;
      --bg-color: #727F80;
    }
    .btn,
    .btn-large {
      background-color: var(--color-primary);
    }
    .btn:hover,
    .btn-large:hover {
      background-color: var(--color-secondary);
    }
    .ModalWindow {
      position: fixed;
      z-index: 999;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, .25);
      display: none;
    }
    .ModalWindow-container{
      margin: 5vh auto 0;
      width: 60%;
      background-color: #FFF;
    }
    .ModalWindow-heading{
      padding: 0 1rem;
      background-color:  var(--bg-color);
      color: #FFF;
    }
    .ModalWindow-content {
      padding: 1rem;
    }
    .u-flexColumnCenter {
      padding: 1rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .u-show {
      display: initial;
    }
    
    .fade-enter-active,
    .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter,
    .fade-leave-to {
      opacity: 0
    }
  </style>
</head>
<body>
    <h1>Gorda odiosa</h1>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  script
</body>
</html>