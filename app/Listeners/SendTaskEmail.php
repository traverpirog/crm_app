<?php

namespace App\Listeners;

use App\Events\TaskEvent;
use App\Mail\TaskMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskEmail
{
    public function handle(TaskEvent $event): void
    {
        $task = $event->task;
        $emails = [];
        $creator = User::findOrFail($task->creator_id);
        foreach ($task->users as $user) {
            $emails[] = $user->email;
        }
        $emails[] = $creator->email;
        Mail::to($emails)
            ->send(new TaskMail($task, $event->customSubject));
    }
}
