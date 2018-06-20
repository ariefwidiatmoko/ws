<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Detail;

class DetailController extends Controller
{

    public function index()
    {
        $result = Detail::paginate(20);

        return view('settings.details.index', compact('result'));
    }

    public function create()
    {
        return view('settings.details.create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $this->validate($request, array(
          'detailname' => 'required|unique:details'
        ));

        $detail = new Detail;

        $detail->detailname = $request->detailname;
        $detail->detaildescription = $request->detaildescription;
        $detail->created_by = Auth::user()->name;

        $detail->save();

        $notification = array(
          'message' => ucwords($request->detailname) . ' was successfully saved.',
          'alert-type' => 'success'
        );

        return redirect()->route('details.index')->with($notification);
    }

    public function edit($id)
    {
        $detail = Detail::findOrFail($id);

        return view('settings.details.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $detail = Detail::findOrFail($id);

        // Validate the data
        $this->validate($request, array(
          'detailname' => 'required|unique:details,detailname,'.$detail->id
        ));

        $detail->update($request->all());

        $notification = array(
          'message' => ucwords($request->detailname) . ' was successfully updated.',
          'alert-type' => 'success'
        );

        return redirect()->route('details.index')->with($notification);
    }

    public function destroy($id)
    {
      $detail = Detail::findOrFail($id);

      $detail->delete();

      $notification = array(
        'message' => ucwords($detail->detailname) . ' was successfully deleted.',
        'alert-type' => 'error'
      );

      return redirect()->route('details.index')->with($notification);
    }
}
