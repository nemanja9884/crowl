<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $logs = [];
        if ($handle = opendir(public_path('sentences'))) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
//                    dd(explode('_', $entry));
                    $user = Admin::find(explode('_', $entry)[0]);
                    $logs[] = [
                        'filename' => $entry,
                        'user' => $user->name ?? '',
                        'date' => Carbon::parse(filemtime(public_path('sentences') . '/' . $entry))->format('Y-m-d H:i:s')
                    ];
                }
            }
            closedir($handle);
        }

        return view('admin.logs.index', ['logs' => $logs]);
    }
}
