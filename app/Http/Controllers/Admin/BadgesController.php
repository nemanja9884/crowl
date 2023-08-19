<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BadgesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.badges.index', ['badges' => Badge::orderBy('points', 'ASC')->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'points' => 'required',
        ), [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'image.required' => 'Image is required',
            'points.required' => 'Points are required',
        ]);

        $badge = Badge::create($request->input());

        if($badge) {
            Session::flash('message', 'Successfully created new badge');
            Session::flash('alert-class', 'success');
        } else {
            Session::flash('message', 'There was an error');
            Session::flash('alert-class', 'error');
        }

        return redirect()->route('admin.badges.index');
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
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('admin.badges.edit', ['badge' => Badge::find($id)]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|max:255',
            'description' => 'required',
            'points' => 'required',
        ), [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'points.required' => 'Points are required',
        ]);

        $badge = Badge::find($id)->update($request->input());

        if($badge) {
            Session::flash('message', 'Successfully created new badge');
            Session::flash('alert-class', 'success');
        } else {
            Session::flash('message', 'There was an error');
            Session::flash('alert-class', 'error');
        }

        return redirect()->route('admin.badges.index');
    }

    /**
     * @param Badge $badge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Badge $badge)
    {
        $badge->delete();
        Session::flash('message', 'Successfully delete badge ' . $badge->name);
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.badges.index');
    }
}
