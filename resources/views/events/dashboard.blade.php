@extends('layouts.main')

@section('title', 'DASHBOARD')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos Criados</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
               <th scope='col'>#</th>
               <th scope='col'>Nome</th>
               <th scope='col'>Participantes</th>
               <th scope='col'>Ações</th>
            </tr>
        </thead>


        <tbody>
            @foreach($events as $event)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                <td>{{count($event->users)}}</td>
                <td>
                    <a href="{{route('editEvent', $event->id)}}" class='btn btn-info edit-btn'><ion-icon name='create-outline'></ion-icon>Editar</a>
                    <!--Chamar a rota através do name-->
                    <form action="{{route('deleteEvents', ['id' =>$event->id , 'users'=>count($event->users)])}}" method="post">
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
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Participando: </h1>

</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($eventasparticipant)>0)
    <table class="table">
        <thead>
            <tr>
               <th scope='col'>#</th>
               <th scope='col'>Nome</th>
               <th scope='col'>Participantes</th>
               <th scope='col'>Ações</th>
            </tr>
        </thead>


        <tbody>
            @foreach($eventasparticipant as $event)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                <td>{{count($event->users)}}</td>
                <td>
                    <form action="/events/leave/{{$event->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name='log-out-outline'></ion-icon>
                            Sair do Evento
                        </button>
                    </form>


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não está participando de nenhum evento</p>
    <a href="/">Veja o eventos</a>
    @endif
</div>

@endsection
