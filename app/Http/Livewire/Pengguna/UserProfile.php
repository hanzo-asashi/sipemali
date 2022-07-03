<?php

namespace App\Http\Livewire\Pengguna;

use Livewire\Component;

class UserProfile extends Component
{
//    use WithMedia;
//
//    public $name;
//
//    public $message = '';
//
//    public $mediaComponentNames = ['myUpload'];
//
//    public $myUpload;

    public function submit()
    {
//        $formSubmission = User::create([
//            'name' => $this->name,
//        ]);
//
//        $formSubmission
//            ->addFromMediaLibraryRequest($this->myUpload)
//            ->toMediaCollection('images');
//
//        $this->message = 'Your form has been submitted';
//
//        $this->name = '';
//        $this->clearMedia();
    }
    public function render()
    {
        return view('livewire.pengguna.user-profile');
    }
}
