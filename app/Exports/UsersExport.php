<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithMapping, WithHeadings
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
       return User::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'age',
            'working_on_university',
            'language_teacher',
            'dominant_language',
            'language',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->age,
            $row->working_on_university,
            $row->language_teacher,
            $row->dominant_language,
            $row->language,
        ];
    }
}
