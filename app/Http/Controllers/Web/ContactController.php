<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

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

        return redirect()->route('web.home')->with(['message' => ['type' => 'success', 'message' => "Mensagem enviada!"]]);
    }
}
