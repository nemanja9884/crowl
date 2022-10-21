<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SentenceController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $sentences = Sentence::paginate(50);
        $languages = Language::all();
        return view('admin.sentences.index', ['sentences' => $sentences, 'languages' => $languages]);
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
            'sentence' => 'required|max:1000',
            'language_id' => 'required',
            'word_reliability' => 'required'
        ));

        $sentence = Sentence::create([
            'sentence' => $request->input('sentence'),
            'language_id' => $request->input('language_id'),
            'word_reliability' => $request->input('word_reliability')
        ]);

        if($sentence) {
            Session::flash('message', 'Successfully made new sentence');
            Session::flash('alert-class', 'success');
        } else {
            Session::flash('message', 'There was an error');
            Session::flash('alert-class', 'error');
        }

        return redirect()->route('admin.sentences.index');
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
        return view('admin.sentences.edit', ['sentence' => Sentence::find($id), 'languages' => Language::all()]);
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
            'sentence' => 'required|max:1000',
            'language_id' => 'required',
            'word_reliability' => 'required'
        ));

        $sentence = Sentence::find($id);
        $sentence->update([
            'sentence' => $request->input('sentence'),
            'language_id' => $request->input('language_id'),
            'word_reliability' => $request->input('word_reliability')
        ]);
        Session::flash('message', 'Successfully updated sentence');
        Session::flash('alert-class', 'success');

        return redirect()->route('admin.sentences.index');
    }

    /**
     * @param Sentence $sentence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sentence $sentence)
    {
        $sentence->delete();
        Session::flash('message', 'Successfully deleted sentence');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.sentences.index');
    }

    public function import(Request $request)
    {
//        $this->validate($request, array(
//            'file' => 'required|mimes:csv',
//        ));

        $file = $request->file('file');
        $file->move('storage/app', $file->getClientOriginalName());

//        Storage::disk('local')->put('sentences/sentences_' . time() . '.csv', file_get_contents($file));

        //save temporarily to storage
//        $path = $file->storeAs(storage_path('app/taki/') . 'sentences_', time() . '.csv');

//        $csv = array_map('str_getcsv', file(storage_path('app/' . $path)));




        //success message and redirect
       // $request->session()->flash('success', 'Data was saved successfully');
        return redirect()->route('admin.sentences.index');
    }
}
