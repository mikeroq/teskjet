<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="block-content">
            <x-input label="Link Title" id="title" wire:model="title" required autofocus />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Add</span>
            </button>
        </div>
    </form>
</div>