<?php

namespace App\Imports;

use App\Models\Fragment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TranslationsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|void|null
     */
    public function model(array $row)
    {
//        dd($row);
        if($row['pt_br']) {
            $fragment = new Fragment();
            $fragment->key = 'home.' . $row['en'];
            $fragment->setTranslation('text', 'sl', $row['sl']);
            $fragment->setTranslation('text', 'et', $row['et']);
            $fragment->setTranslation('text', 'nl-NL', $row['nl_nl']);
            $fragment->setTranslation('text', 'pt-BR', $row['pt_br']);
            $fragment->save();
        }
    }
}
