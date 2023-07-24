@extends('layouts.main')

@section('title', 'Criar Eventos')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Crie o seu evento</h1>
        
        <form action="/events" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="form-group">
                <label for="image">Imagem do evento: </label>
                <input type="file" name="image" id="image" class='form-control-file'>
            </div>
            <div class="form-group">
                <label for="title">Evento: </label>
                <input type="text" class='form-control' name="title" id="title" placeholder='Nome do evento'>
            </div>
            <div class="form-group">
                <label for="date">Data do evento: </label>
                <input type="date" class='form-control' name="date" id="date">
            </div>
            <div class="form-group">
                <label for="title">Cidade: </label>
                <input type="text" class='form-control' name="city" id="city" placeholder='Local do evento'>
            </div>
            <div class="form-group">
                <label for="title">Descrição: </label>
                <textarea name="description" id="description" cols="30" rows="10" class='form-control' placeholder='Descrição do evento'></textarea>
            </div>
            <div class="form-group">
                <label for="title">Privado: </label>
                <select name="private" id="private" class='form-control'>
                    <option value=1>Sim</option>
                    <option value=0>Não</option>
                </select>
            </div>
            <div class="form-group" id='checkbox'>
                <label for="title">Itens do evento: </label>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value='Cadeira'>Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value='Palco'>Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value='Bebidas Gratis'>Bebidas Grátis
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value='Comida'>Comida
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value='Brindes'>Brindes
                </div>
            </div>
            <input type="submit" class='btn btn-primary' value="Criar evento">
        </form>
    </div>

@endsection