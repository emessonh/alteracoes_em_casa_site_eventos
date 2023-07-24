<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index (){
        $search = request('search'); 
        if ($search){
            /*permite fazer buscas no banco*/
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        }else{
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }
     
    public function create(){
        return view('/events/create');
    }

    public function show($id){

        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }

    public function inscrever_em_eventos(){
        return view('/events/entrar');
    }

    public function Cadastrar(){
        return view('/events/cadastrar');
    }

    public function store(Request $request){
        $event = new Event;
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) .'.'.$extension;

            $requestImage->move(public_path('/img/events'), $imageName);

            $event->image = $imageName;
        }else {
            $event->image = 'event_placeholder.jpg';
        }
        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->description = $request->description;
        $event->private = $request->private;
        $event->itens = $request->itens;

        /** Verificação de imagem */
        
        
        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso');
    }
}
