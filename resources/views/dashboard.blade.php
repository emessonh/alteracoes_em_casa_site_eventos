@extends('layouts.main')

@section('title', 'DASHBOARD')

@section('content')

<div class="col-md-10" offset-md-1 dashboard-title-container>
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-containe">
    @if(count(events) > 0)
    @else
    <p>Você ainda não tem eventos</p>
    <p><a href="/">Voltar a página inicial</a></p>
    @endif
</div>

@endsection
