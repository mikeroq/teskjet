<div
    x-data="LivewireUiModal()"
    x-init="init()"
    x-on:keydown.escape.window="closeModalOnEscape()"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
>
    @forelse($components as $id => $component)
        <div
            id="{{ $id }}"
            x-ref="{{ $id }}"
            class="modal right fade" tabindex="-1" role="dialog"
            aria-hidden="true"
        >
            <div class="modal-dialog dark-mode" x-bind:class="modalWidth" role="document"
                 @click.outside="closeModalOnEscape()"
            >
                <div class="modal-content">
                    <div class="block block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">{{ $component['modalAttributes']['bsTitle'] }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" x-on:click="bsCloseModal('{{ $id }}')" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @livewire($component['name'], $component['attributes'], key($id))
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>