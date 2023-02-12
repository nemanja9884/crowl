<?php

namespace App\Imports;

use App\Models\Sentence;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SentencesImport implements ToModel, WithHeadingRow
{
    public int $languageId;

    public function __construct($languageId)
    {
        $this->languageId = $languageId;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|void|null
     */
    public function model(array $row)
    {
//        dd($row);
//        if ($row[2] != null && $row[2] != 'GDEX score') {
        if($row['sentence']) {
            Sentence::create([
                'sentence' => str_replace(['<s> ', ' </s>'], ['', ''], $row['sentence']),
                'language_id' => $this->languageId,
                'word_reliability' => $row['gdex_score'],
                'source_toknum' => $row['source_toknum'],
                'source_id' => $row['source_id']
            ]);
        }

//        }
    }
}
