<?php

namespace App\Livewire;

use App\Mail\ContactUsMail;
use Illuminate\Contracts\Session\Session;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|min:3|max:255',
        'subject' => 'required|string|min:3|max:255',
        'message' => 'required|string|min:3|max:1000',
    ];

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function send(){
        $validatedDate = $this->validate();

        try {
            Mail::to('support@domain.com')->send(New ContactUsMail($validatedDate));

            Session()->flash('success', 'Message sent successfully!');
        } catch (\Throwable $th) {
            Session()->flash('error', 'Failed send message');
        }

        $this->reset();
    }
}
