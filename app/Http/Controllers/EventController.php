<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\eventUsers;
use Illuminate\Support\Facades\Hash;

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

    public function showPerfil($id){
        $db_foto = auth()->user()->profile_photo_path;
        if ($db_foto == null){
            $foto = '/foto-perfil.jpg';
        }else{
            $foto = auth()->user()->profile_photo_path;
        }
        return view('/perfil', ['foto' => $foto, 'msg_alert' => null]);
    }

    public function create(){
        return view('/events/create');
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;
        $participant = $user->eventsAsParticipant;
        return view('events.dashboard', ['events' => $events,
        'eventasparticipant' => $participant]);
    }

    public function show($id){

        $event = Event::findOrFail($id);
        $user = auth()->user();
        $hasUserJoined = false;
        if ($user){
            $userEvents = $user->eventsAsParticipant->toArray();
            foreach($userEvents as $user){
                if ($user['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        /*
        Faz a mesma função da linha abaixo
        dd($event->user->name);
        */
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event,
        'eventOwner' => $eventOwner,
        'hasUserJoined' => $hasUserJoined]);
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
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user_id){
            return redirect('/dashboard');
        }

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

    public function leaveEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);
        return redirect('/')->with('msg', 'Você saiu do evento: '.$event->title);
    }

    public function updateUser(Request $request){
        $user = User::findOrFail($request->id);
        $email = $request->nameUser;
        $password = $request->passwordUser;
        $confirmPassword = $request->confirmPassword;

        $user->email = $email;
        $user->password = Hash::make($password);
        if ($password == $confirmPassword && strlen($password) >= 8){
            if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid())
            {
                $photoUser = $request->foto_perfil;

                $extension = $photoUser->extension();

                $imageName = md5($photoUser->getClientOriginalName() . strtotime('now')) .'.'.$extension;

                $photoUser->move(public_path('/img/users'), $imageName);

                $user->profile_photo_path = $imageName;

                $user->update();
            }else{
                $user->update();
            }
            return redirect('/')->with('msg', 'Usuário atualizado com sucesso!');
        }
        elseif (strlen($password) < 8){
            return view('/perfil', ['foto' => '/foto-perfil.jpg'])->with('msg_alert', 'Senha muito pequena, a senha deve ter no mínimo 8 caracter');
        }
        else{
            return view('/perfil', ['foto' => '/foto-perfil.jpg'])->with('msg_alert', 'Senhas diferentes, tente novamente');
        }


    }

    public function deleteUser($id){
        $user = auth()->user();
        $userParticipant = eventUsers::where('user_id', $id);

        if ($userParticipant){
            
            $user->eventsAsParticipant()->detach($id);
        }
        else{
            User::where('id', $id)->delete();
            return redirect("/")->with('msg', 'Usuário excluído com sucesso');
        }
        
        
    }
}
