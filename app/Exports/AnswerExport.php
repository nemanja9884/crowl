<?php

namespace App\Exports;

use App\Models\Answer;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnswerExport implements WithHeadings, FromCollection, WithMapping
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $answers = Answer::orderBy('sentence_id', 'ASC');
        if ($this->request->filled('sentence')) {
            $answers->whereHas('sentence', function ($query) {
                $query->where('sentence', 'like', '%' . $this->request->input('sentence') . '%');
            });
        }
        if ($this->request->filled('sentence_status')) {
            if ($this->request->input('sentence_status') == 'returned') {
                $answers->whereHas('sentence', function ($query) {
                    $query->where('returned', 1);
                });
            } elseif ($this->request->input('sentence_status') == 'done') {
                $answers->whereHas('sentence', function ($query) {
                    $query->where('finished', 1);
                });
            } elseif ($this->request->input('sentence_status') == 'new') {
                $answers->whereDoesntHave('sentence');
            } elseif ($this->request->input('sentence_status') == 'in-game') {
                $answers->whereHas('sentence', function ($query) {
                    $query->where('finished', 0);
                });
            }
        }
        if ($this->request->filled('user_status')) {
            if ($this->request->input('user_status') == 'registered_user') {
                $answers->whereNotNull('user_id');
            } elseif ($this->request->input('user_status') == 'guest_user') {
                $answers->whereNull('user_id');
            }
        }
        if ($this->request->filled('language')) {
            $answers->where('language_id', $this->request->input('language'));
        }
        if ($this->request->filled('positive_answer')) {
            $answers->where('positive_answer', $this->request->input('positive_answer'));
        }
        if ($this->request->filled('negative_answer')) {
            $answers->where('negative_answer', $this->request->input('negative_answer'));
        }
        if ($this->request->filled('date_from')) {
            $answers->whereDate('created_at', '>=', Carbon::parse($this->request->input('date_from'))->format('Y-m-d'));
        }
        if ($this->request->filled('date_to')) {
            $answers->whereDate('created_at', '<=', Carbon::parse($this->request->input('date_to'))->format('Y-m-d'));
        }

        return $answers->get();
    }

    public function headings(): array
    {
        return [
            'Language',
            'Sentence',
            'User',
//            'IP address',
            'Positive answer',
            'Negative answer',
            'Reasons',
            'Sentence bad part',
            'Sentence source_id',
            'Sentence source_toknum',
//            'Created at',
//            'Updated at'
        ];
    }

    public function map($row): array
    {
        $reasons = '';
        $sentenceBadPart = '';
        foreach ($row->answersDetails as $detail) {
            $reasons .= '| ' . $detail->reason;
            $sentenceBadPart .= ' . Bad parts for reason: ' . $detail->reason . ': ' . $detail->sentence_bad_part;
        }
        return [
            $row->language->name,
            $row->sentence->sentence,
            $row->user ? $row->user->name : '',
//            $row->ip_address,
            $row->positive_answer,
            $row->negative_answer,
            $reasons,
            $sentenceBadPart,
            $row->sentence->source_id,
            $row->sentence->source_toknum,
//            $row->created_at,
//            $row->updated_at
        ];
    }
}
