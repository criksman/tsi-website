<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href={{asset("css/custom.css")}}>
  <link rel="stylesheet" href={{asset("css/style.css")}}>
  <title>Inicio</title>


</head>
<body class="bg-light">
    <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Bienvenido, {{Auth::user()->username}}</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Perfil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Comenzar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Material de estudio</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Administración
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('admin.show_idiomas') }}">Idiomas</a></li>
                  <li><a class="dropdown-item" href="#">Usuarios</a></li>
                </ul>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">    
                <li class="nav-item">
                  <a href="{{ route('user.logout') }}" class="btn btn-outline-warning">Cerrar sesión</a></button>
                </li>
            </ul> 
          </div>
        </div>
      </nav>
    </div>

    <div class="container p-5">
      @yield('main-content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3d7db5b288.js" crossorigin="anonymous"></script>
</body>
</html>