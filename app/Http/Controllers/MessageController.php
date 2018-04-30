<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
      $message->name = $request->name;
      $message->email = $request->email;
      $message->title = $request->title;
      $message->content = $request->content;

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
      $message->name = $request->name;
      $message->email = $request->email;
      $message->title = $request->title;
      $message->content = $request->content;

      $message->save();

      flash()->success('Thank you for subscribing');

      return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
