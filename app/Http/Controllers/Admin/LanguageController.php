<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $languages = Language::paginate(20);
        return view('admin.languages.index', ['languages' => $languages]);
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
            'image' => 'required',
            'status' => 'required',
            'sort' => 'required',
        ));

        $language = Language::create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'image' => $request->input('image'),
            'status' => $request->input('status'),
            'sort' => $request->input('sort')
        ]);

        if($language) {
            Session::flash('message', 'Successfully made new language');
            Session::flash('alert-class', 'success');
        } else {
            Session::flash('message', 'There was an error');
            Session::flash('alert-class', 'error');
        }

        return redirect()->route('admin.languages.index');
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
        return view('admin.languages.edit', ['language' => Language::find($id)]);
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
            'status' => 'required',
            'sort' => 'required',
        ));

        $language = Language::find($id);
        $language->update([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'image' => $request->input('image') ?? $language->image,
            'status' => $request->input('status'),
            'sort' => $request->input('sort')
        ]);

        Session::flash('message', 'Successfully updated language ' . $language->name);
        Session::flash('alert-class', 'success');

        return redirect()->route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
