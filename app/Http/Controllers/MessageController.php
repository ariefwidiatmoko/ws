<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;

class MessageController extends Controller
{

    public function index()
    {
        $result = Message::orderBy('created_at', 'desc')->paginate(20);
        return view('messages.index', compact('result'));
    }

    public function store(Request $request)
    {
      // Validate the data
      $this->validate($request, array(
        'title' => 'required',
        'content' => 'required'
      ));

      $message = new Message;

      $message->user_id = 1;
      $message->sender = $request->sender;
      $message->email = $request->email;
      $message->messagetitle = $request->title;
      $message->messagecontent = $request->content;

      $message->save();

      flash()->success('Thank you, we will reply your email soon, make sure your email is valid.');

      return redirect()->route('contact-us');
    }

    public function subscribe(Request $request)
    {
      // Validate the data
      $this->validate($request, array(
        'title' => 'required',
        'content' => 'required'
      ));

      $message = new Message;

      $message->user_id = 1;
      $message->sender = $request->sender;
      $message->email = $request->email;
      $message->messagetitle = $request->title;
      $message->messagecontent = $request->content;

      $message->save();

      flash()->success('Thank you for subscribing');

      return redirect()->route('welcome');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy(Message $message)
    {
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $message = Message::findOrFail($message->id);
        } else {
            $message = $me->messages()->findOrFail($message->id);
        }

        $message->delete();

        flash()->success('Message has been deleted.');

        return redirect()->route('messages.index');
    }
}
