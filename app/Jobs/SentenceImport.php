<?php

namespace App\Jobs;

use App\Imports\SentencesImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SentenceImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $file;
    public int $languageId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $languageId)
    {
        $this->file = $file;
        $this->languageId = $languageId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import = new SentencesImport($this->languageId);
        Excel::import($import, public_path('sentences/' . $this->file));
    }
}
