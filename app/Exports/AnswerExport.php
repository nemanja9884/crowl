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
        if ($this->request->filled('language')) {
            $answers->where('language_id', $this->request->input('language'));
        }
        if ($this->request->filled('date_from')) {
            $answers->whereDate('created_at', '>=', Carbon::parse($this->request->input('date_from'))->format('Y-m-d'));
        }
        if ($this->request->filled('date_to')) {
            $answers->whereDate('created_at', '<=', Carbon::parse($this->request->input('date_to'))->format('Y-m-d'));
        }

        return $answers->get();
//        return Answer::all();
    }

    public function headings(): array
    {
        return [
            'Language',
            'Sentence',
            'User',
            'IP address',
            'Positive answer',
            'Negative answer',
            'Reasons',
            'Sentence bad part',
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
            $row->ip_address,
            $row->positive_answer,
            $row->negative_answer,
            $reasons,
            $sentenceBadPart,
//            $row->created_at,
//            $row->updated_at
        ];
    }
}
