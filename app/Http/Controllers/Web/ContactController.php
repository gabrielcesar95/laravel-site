<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactRequest;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Permission;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $contact = new Contact();
        $contact->requester = $request->requester;
        $contact->requester_phone = $request->requester_phone;
        $contact->requester_email = $request->requester_email;
        $contact->subject = $request->subject;
        $contact->content = $request->get('content');

        $contact->save();

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->get()->filter(function ($u) {
            return $u->hasPermissionTo('contact@show');
        });

        Notification::send($users, new NewContact($contact));

        return redirect()->route('web.home')->with(['message' => ['type' => 'success', 'message' => "Mensagem enviada!"]]);
    }
}
