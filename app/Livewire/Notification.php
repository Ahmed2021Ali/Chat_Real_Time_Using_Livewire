<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Notification extends Component
{
    public function render()
    {
        return view('livewire.notification');
    }
    public function Read_notification_message($id)
    {
        $notification_id=DB::table('notifications')->where('data->message_id',$id)->pluck('id');
        DB::table('notifications')->where('id',$notification_id)->update(['read_at'=>now()]);
        return redirect()->back();
    }
    public function Read_all_notification()
    {
        $user = User::find(auth()->user()->id);

        foreach ($user->unreadNotifications as $notification)
        {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
