<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class ImportCsvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('import-csv');
    }

    public function importCSV(Request $request)
    {
        //read csv file and skip data
        $file = $request->file('import_csv');
        $handle = fopen($file->path(), 'r');

        //skip the header row
        fgetcsv($handle);

        $chunksize = 25;
        while(!feof($handle))
        {
            $chunkdata = [];

            for($i = 0; $i<$chunksize; $i++)
            {
                $data = fgetcsv($handle);
                if($data === false)
                {
                    break;
                }
                $chunkdata[] = $data; 
            }

            $this->getchunkdata($chunkdata);
        }
        fclose($handle);

        return redirect()->route('app.events.index')->with('success', 'Data has been added successfully.');
    }

    public function getchunkdata($chunkdata)
    {
        foreach($chunkdata as $column)
        {
            $title = $column[0];
            $description = $column[1];
            $startDateTime = $column[2];

            $event = new Event();
            $event->title = $title;
            $event->description = $description;
            $event->start_date_time = $startDateTime;
            $event->save();
        }
    }
}