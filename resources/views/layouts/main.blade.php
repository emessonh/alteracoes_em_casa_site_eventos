<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="shortcut icon" href="/img/hdcevents_logo.svg" type="image/x-icon">
        <!--CSS Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!--Fonte das páginas-->
        <link rel="stylesheet" href="/css/styles.css">
        <!--Fonte do Google-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
        <script src="/js/scripts.js"></script>
    </head>
    <body class="antialiased">
        <header>
            <nav class='navbar navbar-expand-lg navbar-light'>
               <div class="collapse navbar-collapse" id="navbar">

                    <ul class="navbar-nav">
                        <li>
                        <a href="/" class="navbar-brand">
                            <img src="/img/hdcevents_logo.svg" alt="">
                        </a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a href="/" class="nav-link">Perfil</a>
                        </li>
                        @endauth
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar Eventos</a>
                        </li>
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Meus Eventos</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="get">
                                @csrf
                                <a href="/logout" class='nav-link'
                                    onclick='event.preventDeDefault();
                                    this.closest('form').submit();'>
                                Sair
                                </a>
                            </form>
                        </li>
                        @endauth
                    </ul>
               </div>
               @auth
                <div class="email-user">
                    Usuário:
                </div>
               @endauth
            </nav>
        </header>
        <!--Possibilita utilizar conteúdo dinâmico de cada pagina-->
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if (session('msg'))
                        <p class="msg">{{session('msg')}}</p>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        <footer> HDEVENTS &copy; 2023</footer>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
