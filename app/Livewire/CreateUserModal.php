<?php

namespace App\Livewire;

use Livewire\Component;

class CreateUserModal extends Component
{
    public function render()
    {
        return view('livewire.create-user-modal');
    }

    public function createUser()
    {
        // Validation can be added here if necessary

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->reset(); // Clear input fields after submission

        $this->emit('userCreated'); // Emit an event to close the modal or update the UI
    }
}
