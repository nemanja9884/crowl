<?php

namespace App\Console\Commands;

use App\Imports\SentencesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class SentencesCsvConvert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sentences:convert {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = $this->argument('file');
        $import = new SentencesImport();
        Excel::import($import, public_path('sentences/' . $file));
    }
}
