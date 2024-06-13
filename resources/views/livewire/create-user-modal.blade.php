<div x-data="{ showModal: false }">
    <button @click="showModal = true">Create User</button>
    
    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Create New User
        </x-slot>

        <x-slot name="content">
            <livewire:create-user-modal />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showModal', false)">
                Cancel
            </x-jet-secondary-button>

            <x-jet-button wire:click="createUser()">
                Create
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
