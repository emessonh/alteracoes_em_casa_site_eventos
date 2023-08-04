@extends('layouts.main')

@section('title', 'Perfil')

@section('content')

<!--Modal de exlusão do usuário-->

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
                        <form action="{{route('deleteUser', auth()->user()->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
</div>

<div class="card-user-data">
    <div id='image-perfil'>
        <img src="/img/users/{{$foto}}" alt="Foto de perfil">
    </div>
    <div class='form-user'>
        <form action="/updateUser/{{auth()->user()->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="user-data">
                <input type="file" name="foto_perfil" id="foto_perfil">
            </div>
            <div class="user-data">
                <label for="nameUser">Usuário: </label><br>
                <input type="text" name="nameUser" id="nameUser" value="{{auth()->user()->email}}">
            </div>
            <div class="user-data">
                <label for="passwordUser">Senha: </label><br>
                <input type="password" name="passwordUser" id="passwordUser">
            </div>
            <div class="user-data">
                <label for="confirmPassword">Confirmação de senha: </label><br>
                <input type="password" name="confirmPassword" id="confirmPassword" >
            </div>
            <div>
                <button type="submit" class='btn btn-info'>
                    <ion-icon name='create-outline'></ion-icon>Editar conta
                </button>
            </div>
        </form>
        <form action="/deleteUser/{{auth()->user()->id}}" method="post">
            @csrf
            <button type="button" class='btn btn-danger' data-toggle="modal" data-target="#myModal">
                <ion-icon name='trash'></ion-icon>Excluir conta
            </button>
        </form>
    </div>
</div>


@endsection
