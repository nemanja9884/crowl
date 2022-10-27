<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnswerDetail;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $answers = Answer::orderBy('sentence_id', 'ASC')->paginate(50);
        return view('admin.answers.index', ['answers' => $answers]);
    }

    public function answerDetails($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $answerDetails = AnswerDetail::where('answer_id', $id)->get();
        return view('admin.answers.details', ['answerDetails' => $answerDetails]);
    }
}
