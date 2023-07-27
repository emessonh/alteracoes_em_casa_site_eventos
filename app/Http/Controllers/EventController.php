<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

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

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;
        return view('events.dashboard', ['events' => $events]);
    }

    public function show($id){

        $event = Event::findOrFail($id);
        /*
        Faz a mesma função da linha abaixo
        dd($event->user->name);
        */
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
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
        $user = auth()->user();
        $event->user_id = $user->id;
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
    public function destroy($id){
        Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id){
        $event = Event::findOrFail($id);
        return view('events.edit', ['event' => $event]);

    }

    public function update(Request $request){
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) .'.'.$extension;

            $requestImage->move(public_path('/img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);
        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/')->with('msg', 'Presença confirmada no evento '.$event->title);


    }
}
