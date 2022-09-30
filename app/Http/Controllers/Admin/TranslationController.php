<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TranslationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $translations = Translation::paginate(50);
        $languages = Language::get();
        return view('admin.translations.index', ['translations' => $translations, 'languages' => $languages]);
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
            'english_word' => 'required|max:255',
        ));

        $languages = Language::get();
        foreach ($languages as $language) {
            if($request->input('language' . $language->id)) {
                Translation::create([
                    'english_word' => $request->input('english_word'),
                    'translation' => $request->input('language' . $language->id),
                    'language_id' => $language->id
                ]);
            }
        }

        Session::flash('message', 'Successfully made new translations');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.translations.index');
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
        return view('admin.translations.edit', ['translation' => Translation::find($id), 'languages' => Language::all()]);
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
            'english_word' => 'required|max:255',
            'language' => 'required',
            'translation' => 'required'
        ));

        $translation = Translation::find($id);
        $translation->update([
            'english_word' => $request->input('english_word'),
            'language_id' => $request->input('language'),
            'translation' => $request->input('translation')
        ]);

        Session::flash('message', 'Successfully updated translation for english word' . $translation->english_word);
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.translations.index');
    }

    /**
     * @param Translation $translation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Translation $translation)
    {
        $translation->delete();
        Session::flash('message', 'Successfully delete translation  ' . $translation->translation);
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.translations.index');
    }
}
