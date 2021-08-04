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
            <div class="modal-dialog" x-bind:class="modalWidth" role="document">
                <div class="modal-content block block-themed bg-dark" style="box-shadow: none">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title" x-text="modalTitle"></h3>
                        <span x-on:click="bsCloseModal('{{ $id }}')" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                            </svg>
                        </span>
                    </div>
                    @livewire($component['name'], $component['attributes'], key($id))
                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>
