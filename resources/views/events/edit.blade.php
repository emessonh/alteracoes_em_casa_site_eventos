@extends('layouts.main')

@section('title', 'Editando: ' .$event->title)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{$event->title}}</h1>
    <form action="/events/update/{{$event->id}}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagem do evento: </label>
            <input type="file" name="image" id="image" class='form-control-file'>
            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class='img-preview'>
        </div>
        <div class="form-group">
            <label for="title">Evento: </label>
            <input type="text" class='form-control' name="title" id="title" value='{{$event->title}}'>
        </div>
        <div class="form-group">
            <label for="date">Data do evento: </label>
            <input type="date" class='form-control' name="date" id="date" value='{{$event->date->format('Y-m-d')}}'>
        </div>
        <div class="form-group">
            <label for="title">Cidade: </label>
            <input type="text" class='form-control' name="city" id="city" value='{{$event->city}}'>
        </div>
        <div class="form-group">
            <label for="title">Descrição: </label>
            <textarea name="description" id="description" cols="30" rows="10" class='form-control' >{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="title">Privado: </label>
            <select name="private" id="private" class='form-control'>
                <option value=0>Não</option>
                <option value=1 {{$event->private == 1 ? "selected='selected'": ""}}>Sim</option>
            </select>
        </div>
        <div class="form-group" id='checkbox' >
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
        <input type="submit" class='btn btn-primary' value="Editar evento">
    </form>
</div>

@endsection