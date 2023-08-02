<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="shortcut icon" href="/img/hdcevents_logo.svg" type="image/x-icon">
        <!--CSS Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <!--Fonte das páginas-->
        <link rel="stylesheet" href="/css/styles.css">
        <!--Fonte do Google-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <script src="/js/scripts.js"></script>
        
        
               
        
        

        
    </head>
    <body class="antialiased">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(".btn").click(function(){
                $("#myModal").modal();
            });
        </script>

        <!--
        <script type="text/javascript">
            $('#myModal').on('show.bs.modal', function (event) {                                                       <<<<<<<<<<<#myModal = nome do modal
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipientId    = button.data('id')                                                                 <<<<<<<<<<< button.data('id') é o data-id que você passou em cima
                // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('#id').val(recipientId) 
            })
        </script>
        -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir seu usuário?
                </div>
                
                <div class="modal-footer">
                    <div>
                        <form action="#" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>

                    
                </div>
            </div>
            </div>
        </div>

        <header>
            <nav class='navbar navbar-expand-lg navbar-light'>
               <div class="collapse navbar-collapse" id="navbar">

                    <ul class="navbar-nav">
                        <li>
                        <a href="/" class="navbar-brand">
                            <img src="/img/hdcevents_logo.svg" alt="">
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">Página Inicial</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a href="/perfil/{{auth()->user()->id}}" class="nav-link">Perfil</a>
                        </li>

                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar Eventos</a>
                        </li>
                        @endauth
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
                        <li class="nav-item" style="padding: 9px 5px;">
                            <form action="/logout" method="post">
                                @csrf
                                <a href="/logout" class='nav-link'
                                    onclick='event.preventDefault();
                                    this.closest("form").submit();'>
                                Sair
                                </a>
                            </form>
                        </li>
                    </ul>
               </div>
                <div id="email-user">
                    Usuário: {{auth()->user()->email}}
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
