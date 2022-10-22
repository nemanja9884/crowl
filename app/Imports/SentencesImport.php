<?php

namespace App\Imports;

use App\Models\Sentence;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SentencesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|void|null
     */
    public function model(array $row)
    {
        if ($row[2] != null && $row[2] != 'GDEX score') {
            Sentence::create([
                'sentence' => str_replace(['<s> ', ' </s>'], ['', ''], $row['preloadedpor_jsi_newsfeed_virt']),
                'language_id' => 3,
                'word_reliability' => $row[2],
            ]);
        }
    }
}
