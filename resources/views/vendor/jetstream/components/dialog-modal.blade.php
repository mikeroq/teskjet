@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content block block-themed">
        <div class="block-header bg-primary-dark">
            <h3 class="block-title">{{ $title }}</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                </button>
            </div>
        </div>
        <div class="modal-body text-gray bg-dark">
            {{ $content }}
        </div>
        <div class="modal-footer bg-dark bg-black-10 modal-footer-fixed">
            {{ $footer }}
        </div>
    </div>
</x-jet-modal>
