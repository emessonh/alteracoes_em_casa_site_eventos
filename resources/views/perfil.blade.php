@extends('layouts.main')

@section('title', 'Perfil')

@section('content')
<div class="card-user-data">
    <div id='image-perfil'>
        <img src="/img/users/foto-perfil.jpg" alt="Foto de perfil">
    </div>
    <div class='form-user'>
        <form action="/updateUser/1" method="post">
            @csrf
            <div class="user-data">
                <label for="nameUser">Usuário: </label><br>
                <input type="text" name="nameUser" id="nameUser" value="{{auth()->user()->name}}">
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
