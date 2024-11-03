<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Carbon\Carbon;

class ReminderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::with('events')
            ->get();
        
            $data = [];

            foreach($users as $key => $value) {
                
                foreach($value->events as $k => $v){
                    
                    $data[] = [
                        "user_id" => $value->id,
                        "user_name" => $value->name,
                        "user_email" => $value->email,
                        "event_id" => $v->id,
                        "reminder_date_time" => $v->pivot->reminder_date_time
                    ];
                }
            }
            
        return view('reminders.index', compact('data'));

    }

    public function setReminder($userId, $eventId)
    {
        $user = User::findorFail($userId);
        $eventUser = $user->events()->wherePivot('event_id', $eventId)->first();

        $data = [
            "user_id" => $userId,
            "user_email" => $user->email,
            "event_id" => $eventUser->id,
            "event_name" => $eventUser->title,
            "reminder_date_time" => $eventUser->pivot->reminder_date_time
        ];

        return view('reminders.set-reminder', compact('data'));
    }

    public function updateReminder(Request $request, $userId, $eventId)
    {

        $data = [
            "reminder_date_time" => $request->input("reminder_date_time") ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->input("reminder_date_time"))->format('Y-m-d H:i:s') : null,
        ];

        DB::table('event_user')
            ->where('user_id', $userId)
            ->where("event_id", $eventId)
            ->update($data);

        return redirect()->route('app.reminder.index');
    }
}
