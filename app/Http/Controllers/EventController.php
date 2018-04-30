<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Session;
use App\Event;
use App\User;
use Calendar;

class EventController extends Controller
{
    public function index() {
      $events = Event::get();
      $isAllday = [
        0 => false,
        1 => true
      ];
      $event_list = [];
      foreach ($events as $key => $event) {

        $event_list[] = Calendar::event(
          $event->name,
          $isAllday[$event->allday],
          new \DateTime($event->event_start),
          new \DateTime($event->event_end),
          $event->id,
          [
            'color' => $event->event_color,
          ]
        );
      }
      $table_events = Event::with('user')->paginate(10);
      $calendar_details = Calendar::addEvents($event_list);

      return view('events.index', compact('calendar_details', 'table_events'));
    }

    public function store(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|unique:events',
        'event_start' => 'required',
        'event_end' => 'required'
      ]);
      if ($validator->fails()) {
        \Session::flash('warning','Please enter the valid details');
        return Redirect::to('/home/events')->withInput()->withErrors($validator);
      }
      $eventColor = [
        0 => '#367fa9',
        1 => '#00a65a',
        2 => '#dd4b39',
        3 => '#f012be',
        4 => '#f39c12',
        5 => '#777',
        6 => '#ff851b',
        7 => '#00c0ef'
      ];
      $event = new Event;
      $event->user_id = $request->user_id;
      $event->name = $request->name;
      $event->event_color = $eventColor[$request->event_color];

      if($request->has('allday')) {
        $event->allday = 1;
        $event->event_start = $request->event_start;
        $event->event_end = $request->event_end;
      } else {
        $event->allday = 0;
        //Input endtime to get HH & MM from HH:MM
        $startHM = explode(":", $request->time_start);
        //DateTime to unix for calculation
        $eStart = strtotime($request->event_start) + $startHM[0]*60*60 + $startHM[1]*60;
        //DateTime to String
        $event->event_start = date('Y-m-d H:i:s', $eStart);
        //Input endtime to get HH & MM from HH:MM
        $endHM = explode(":", $request->time_end);
        //DateTime to unix for calculation
        $eEnd = strtotime($request->event_end) + $endHM[0]*60*60 + $endHM[1]*60;
        //DateTime to String
        $event->event_end = date('Y-m-d H:i:s', $eEnd);
      }

      $event->save();

      flash()->success('Event successfully added');
      return Redirect::to('/home/events');
    }

    public function update(Request $request) {
        $event = Event::find($request->id);

        // Validate the data
        $this->validate($request, array(
          'name' => 'required',
          'event_start' => 'required',
          'event_end' => 'required'
        ));

        $event->name = $request->name;
        $event->allday = $request->allday;
        $event->event_color = $request->event_color;
        $event->event_start = $request->event_start;
        $event->event_end = $request->event_end;
        $data->update();
        return response()->json($data);
    }
    public function show() {

    }
}
