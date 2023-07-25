<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnswerExport;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnswerDetail;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AnswersController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (isset($request->export) && $request->export) {
            return Excel::download(new AnswerExport($request), Auth::guard('admin')->user()->name . '_' . Carbon::now()->timestamp . '.xlsx');
        }

        $answers = Answer::orderBy('sentence_id', 'ASC');
        $page = 'all';
        if ($request->filled('sentence')) {
            $page = 'search';
            $answers->whereHas('sentence', function ($query) use ($request) {
                $query->where('sentence', 'like', '%' . $request->input('sentence') . '%');
            });
        }
        if ($request->filled('sentence_status')) {
            $page = 'search';
            if ($request->input('sentence_status') == 'returned') {
                $answers->whereHas('sentence', function ($query) use ($request) {
                    $query->where('returned', 1);
                });
            } elseif ($request->input('sentence_status') == 'done') {
                $answers->whereHas('sentence', function ($query) use ($request) {
                    $query->where('finished', 1);
                });
            } elseif ($request->input('sentence_status') == 'new') {
                $answers->whereDoesntHave('sentence');
            } elseif ($request->input('sentence_status') == 'in-game') {
                $answers->whereHas('sentence', function ($query) use ($request) {
                    $query->where('finished', 0);
                });
            }
        }
        if ($request->filled('user_status')) {
            $page = 'search';
            if ($request->input('user_status') == 'registered_user') {
                $answers->whereNotNull('user_id');
            } elseif ($request->input('user_status') == 'guest_user') {
                $answers->whereNull('user_id');
            }
        }
        if ($request->filled('language')) {
            $page = 'search';
            $answers->where('language_id', $request->input('language'));
        }
        if ($request->filled('positive_answer')) {
            $page = 'search';
            $answers->where('positive_answer', $request->input('positive_answer'));
        }
        if ($request->filled('negative_answer')) {
            $page = 'search';
            $answers->where('negative_answer', $request->input('negative_answer'));
        }
        if ($request->filled('date_from')) {
            $page = 'search';
            $answers->whereDate('created_at', '>=', Carbon::parse($request->input('date_from'))->format('Y-m-d'));
        }
        if ($request->filled('date_to')) {
            $page = 'search';
            $answers->whereDate('created_at', '<=', Carbon::parse($request->input('date_to'))->format('Y-m-d'));
        }

        $answers = $answers->paginate(50);
        $answers->setPath('');

        return view('admin.answers.index', ['answers' => $answers, 'languages' => Language::all(), 'page' => $page]);
    }

    public function answerDetails($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $answerDetails = AnswerDetail::where('answer_id', $id)->get();
        return view('admin.answers.details', ['answerDetails' => $answerDetails]);
    }

    public function export(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new AnswerExport($request), 'answers.xlsx');
    }
}
