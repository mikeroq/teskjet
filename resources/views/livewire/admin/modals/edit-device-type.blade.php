<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="block-content">
            <x-input label="Name" id="name" wire:model="name" required autofocus />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>