@extends('layouts.main')

@section('title', 'DASHBOARD')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
               <th scope='col'>#</th>  
               <th scope='col'>Nome</th> 
               <th scope='col'>participantes</th> 
               <th scope='col'>Ações</th> 
            </tr>
        </thead>

    
        <tbody>
            @foreach($events as $event)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                <td>0</td>
                <td>
                    <a href="{{route('editEvent', $event->id)}}" class='btn btn-info edit-btn'><ion-icon name='create-outline'></ion-icon>Editar</a>
                    <!--Chamar a rota através do name-->
                    <form action="{{route('deleteEvents', $event->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon name='trash-outline'></ion-icon>Deletar</button> 
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não tem eventos</p>
    <p><a href="/">Voltar a página inicial</a></p>
    @endif
</div>

@endsection
