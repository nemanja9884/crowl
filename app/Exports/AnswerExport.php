<?php

namespace App\Exports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnswerExport implements WithHeadings, FromCollection, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Answer::all();
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
            'Created at',
            'Updated at'
        ];
    }

    public function map($row): array
    {
        $reasons = '';
        $sentenceBadPart = '';
        foreach ($row->answersDetails as $detail) {
            $reasons .= '; ' . $detail->reason;
            $sentenceBadPart .= '; ' . $detail->reason;
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
            $row->created_at,
            $row->updated_at
        ];
    }
}
