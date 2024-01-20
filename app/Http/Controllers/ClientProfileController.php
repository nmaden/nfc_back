<?php

namespace App\Http\Controllers;

use App\Models\ClientLink;
use App\Models\ClientPhone;
use App\Models\ClientProfile;
use App\Models\User;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientProfileController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'fio' => 'nullable|string',
            'name_business' => 'nullable|string',
            'emails.*.value' => 'required|email|unique:client_emails,email',
            'emails.*.name' => 'nullable|string',
            'phones.*.value' => 'required|string|max:11',
            'phones.*.name' => 'nullable|string',
            'links.*.value' => 'required',
            'links.*.name' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $file_name = $file->getClientOriginalName();
            $file_path = $file->store('uploads', 'public');

            auth()->user()->update([
                'name' => $request->fio,
                'name_business' => $request->name_business,
                'photo_path' => $file_path,
                'photo_name' => $file_name,
            ]);
        } else {
            auth()->user()->update([
                'name' => $request->fio,
                'name_business' => $request->name_business,
            ]);
        }


        foreach (json_decode($request->phones) as $phone) {
            if ( isset($phone->id) )
                ClientPhone::where('id',$phone->id)->update([
                    'name' => $phone->name,
                    'value' => $phone->value,
                    'user_id' => auth()->user()->id
                ]);
            else
                ClientPhone::create([
                    'name' => $phone->name,
                    'value' => $phone->value,
                    'user_id' => auth()->user()->id
                ]);

        }

        foreach (json_decode($request->links) as $link) {

            if ( isset($link->id) )
                ClientLink::where('id',$link->id)->update([
                    'name' => $link->name,
                    'value' => $link->value,
                    'icon' => $link->icon,
                    'user_id' => auth()->user()->id
                ]);
            else
                ClientLink::create([
                    'name' => $link->name,
                    'value' => $link->value,
                    'icon' => $link->icon,
                    'user_id' => auth()->user()->id
                ]);
        }

        return response()->json(['message' => 'Сәтті сақталды'], 200);
    }

    public function index(Request $request) {

        if ($request->hash) {
            $user = User::where('user_hash',$request->hash)->load('phones', 'links');
        }
        else {
            $user = auth()->user();
            $user->load('phones', 'links');
        }

        return $user;
    }

    public function deleteLink(ClientLink $client_link) {
        $client_link->delete();

        return response()->json(['message' => 'Успешно  удалено'], 200);
    }

    public function deletePhone(ClientPhone  $client_phone) {
        $client_phone->delete();
        return response()->json(['message' => 'Успешно  удалено'], 200);
    }

    public function updateLink(Request $request) {
        $client_link = new ClientLink();
        $client_link->name = $request->input('name');
        $client_link->value = $request->input('value');
        $client_link->icon = $request->icon;
        $client_link->user_id = auth()->user()->id;
        $client_link->save();
        return response()->json(['message' => 'Сәтті өзгертілді'], 200);
    }

    public function updatePhone(Request $request) {
        $client_phone = new ClientPhone();
        $client_phone->name = $request->name;
        $client_phone->value = $request->value;
        $client_phone->user_id = auth()->user()->id;
        $client_phone->save();
        return response()->json(['message' => 'Сәтті өзгертілді'], 200);
    }

    public function updateVisibleLink(Request $request,int $id) {
        $client_link = ClientLink::where('id',$id)->first();
        $client_link->show = $request->show;
        $client_link->value = $request->value;
        $client_link->user_id = auth()->user()->id;
        $client_link->save();
        return response()->json(['message' => 'Сәтті өзгертілді'], 200);
    }

    public function updateVisiblePhone(Request $request,ClientPhone $client_phone) {
        $client_phone->show = $request->show;
        $client_phone->save();
        return response()->json(['message' => 'Сәтті өзгертілді'], 200);
    }
}
