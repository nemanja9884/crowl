<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SentenceImport;
use App\Models\Language;
use App\Models\Sentence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SentenceController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $sentences = (new Sentence())->newQuery();
        $page = 'all';
        if ($request->filled('sentence')) {
            $page = 'search';
            $sentences->where('sentence', 'like', '%' . $request->input('sentence') . '%');
        }
        if ($request->filled('language')) {
            $page = 'search';
            $sentences->where('language_id', $request->input('language'));
        }
        if ($request->filled('finished')) {
            $page = 'search';
            $sentences->where('finished', $request->input('finished'));
        }
        if ($request->filled('date_from')) {
            $page = 'search';
            $sentences->whereDate('created_at', '>=', Carbon::parse($request->input('date_from'))->format('Y-m-d'));
        }
        if ($request->filled('date_to')) {
            $page = 'search';
            $sentences->whereDate('created_at', '<=', Carbon::parse($request->input('date_to'))->format('Y-m-d'));
        }

        $sentences = $sentences->orderBy('id', 'desc')->paginate(50);
        $sentences->setPath('');

        $languages = Language::all();
        return view('admin.sentences.index', ['sentences' => $sentences, 'languages' => $languages, 'page' => $page]);
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

        if ($sentence) {
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
     * @param int $id
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
        $this->validate($request, array(
            'file' => 'required',
            'language_id' => 'required'
        ));

        $file = $request->file('file');
        $file->move('sentences', $file->getClientOriginalName());
//        if(config('app.env') == 'production') {
//
//        }
//        SentenceImport::dispatchNow($file->getClientOriginalName(), $request->input('language_id'))->onConnection('database');

        SentenceImport::dispatchNow($file->getClientOriginalName(), $request->input('language_id'));

        Session::flash('message', 'Your sentences will be imported soon, please be patient. Refresh page after a while to check if your sentences have been imported');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.sentences.index');
    }

    public function return(Request $request, $id)
    {
        $sentence = Sentence::findorfail($id);
        $sentence->finished = 0;
        $sentence->returned = 1;
        $sentence->save();
        Session::flash('message', 'Successfully returned sentence in game!');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.sentences.index');
    }
}
