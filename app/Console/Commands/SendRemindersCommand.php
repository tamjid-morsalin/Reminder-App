<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Model\User;
use Carbon\Carbon;
use App\Notifications\EventReminderNotification;
use Illuminate\Support\Facades\Notification;

class SendRemindersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends reminders to registrant';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $events = Event::all();
        
        foreach($events as $event){
            $eventUser = $event->registrants()->wherePivot('reminder_date_time', '<>', NULL)->wherePivot('reminder_date_time', '<=', Carbon::now())->get();
            
            Notification::send($eventUser, new EventReminderNotification($event));
        }
    }
}
