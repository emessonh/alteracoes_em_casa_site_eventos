@extends('layouts.main')

@section('title', 'Perfil')

@section('content')

@if ('msg_alert' != null)
 <div class="container-fluid">
        <div class="row">
                <p class="msg-alert">{{$msg_alert}}</p>
        </div>
 </div>
 @endif
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
                <input type="password" name="passwordUser" id="passwordUser" value="{{auth()->user()->password}}">
            </div>
            <div class="user-data">
                <label for="confirmPassword">Confirmação de senha: </label><br>
                <input type="password" name="confirmPassword" id="confirmPassword" value="{{auth()->user()->password}}">
            </div>
            <div>
                <button type="submit" class='btn btn-info'>
                    <ion-icon name='create-outline'></ion-icon>Editar conta
                </button>
            </div>
        </form>
        <form action="/deleteUser/1" method="post">
            @csrf
            <button type="submit" class='btn btn-danger'>
                <ion-icon name='trash'></ion-icon>Excluir conta
            </button>
        </form>
    </div>
</div>


@endsection
