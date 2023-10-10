<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Chat extends Component
{
    use WithFileUploads;


    public $message_text;
    public $photo;
    
    public function render()
    {
        $messages = Message::with('user')->latest()->take(10)->get()->sortBy('id');

        return view('livewire.chat', compact('messages'));
    }

    public function sendMessage()
    {
        $message_text = trim($this->message_text);

        $this->validate([
            'photo' => 'nullable|file|mimes:jpeg,png,gif,pdf,doc,docx,txt|max:2048', // Add appropriate file validation rules here
        ]);

        if (!empty($this->photo))
        {
            $photoPath = $this->photo->store('attachment', 'public');
                Message::insert([
                    'user_id' => auth()->user()->id,
                    'message_text' => $message_text,
                    'file' => $photoPath,
                    'created_at' => now()
                ]);
        }

        if (!empty($message_text))
        {
            Message::create([
                'user_id' => auth()->user()->id,
                'message_text' => $message_text,
            ]);
        }

        $this->reset(['message_text', 'photo']);
    }
     public function delete_massage($id, $fileName)
    {
        $message = Message::find($id);

        if ($message)
        {
            // Delete the message record from the database
            $message->delete();

            // Delete the associated file from storage if it exists
            $filePath = public_path('storage/' . $fileName);
            if (file_exists($filePath)) {
                Storage::disk('public')->delete($fileName);
            }

            // Optionally, you can add a success message or redirect back to the page
            return redirect()->back()->with('success', 'تم حذف الرساله بنجاح');
        }
        else
        {
            // Message not found in the database, you can handle this case as per your requirement
            return redirect()->back()->with('error', 'الرساله غسر موجوده بالفعل');
        }



    }


}