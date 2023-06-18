<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TranslationsImport;
use App\Models\Fragment;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TranslationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $translations = DB::table('fragments');
        if ($request->filled('key')) {
            $page = 'search';
            $translations->where('key', 'like', '%' . $request->input('key') . '%');
        }

        $translations = $translations->paginate(50);
        $translations->getCollection()->transform(function ($item) {
            if (!is_array($item->text)) {
                $item->text = json_decode($item->text, true);
            }
            $lang = Language::where('lang_code', array_keys($item->text)[0])->first();
            $item->language = $lang->name;
            $item->translation = array_values($item->text)[0];
            $item->key = str_replace('home.', '', $item->key);
            return $item;
        });

        $languages = Language::get();
        return view('admin.translations.index', ['translations' => $translations, 'languages' => $languages, 'page' => $page ?? 'all']);
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
            'english_word' => 'required',
        ));

        $languages = Language::get();

        $fragment = new Fragment();
        $fragment->key = 'home.' . $request->input('english_word');
        foreach ($languages as $language) {
            if ($request->input('language' . $language->id)) {
                $fragment->setTranslation('text', $language->lang_code, $request->input('language' . $language->id));
            }
        }
        $fragment->save();

        Session::flash('message', 'Successfully made new translations');
        Session::flash('alert-class', 'success');
        return redirect()->back();
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
        $fragment = DB::table('fragments')->where('id', $id)->first();
        $fragment->text = json_decode($fragment->text, true);
        $fragment->key = str_replace('home.', '', $fragment->key);
        return view('admin.translations.edit', ['translation' => $fragment, 'languages' => Language::all()]);
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
            'english_word' => 'required',
        ));

        $languages = Language::get();
        $fragment = Fragment::find($id);
        $fragment->key = 'home.' . $request->input('english_word');
        foreach ($languages as $language) {
//            if ($request->input('language' . $language->id)) {
                $fragment->setTranslation('text', $language->lang_code, $request->input('language' . $language->id));
//            }
        }
        $fragment->save();

        Session::flash('message', 'Successfully updated translation');
        Session::flash('alert-class', 'success');
        return redirect()->back();
    }

    /**
     * @param Translation $translation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Fragment::find($id)->delete();
        Session::flash('message', 'Successfully delete translation');
        Session::flash('alert-class', 'success');
        return redirect()->back();
    }

    public function import(Request $request)
    {
        $this->validate($request, array(
            'file' => 'required'
        ));

        $file = $request->file('file');
        $file->move('translations', $file->getClientOriginalName());

        $import = new TranslationsImport();
        Excel::import($import, public_path('translations/' . $file->getClientOriginalName()));

        Session::flash('message', 'Successfully imported translations');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.translations.index');
    }
}
