<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset


    <div x-data="LivewireUISpotlight({ componentId: '{{ $this->id }}', placeholder: '{{ trans('livewire-ui-spotlight::spotlight.placeholder') }}', commands: {{ $commands }} })"
         x-init="init()"
         x-show="isOpen"
         x-cloak
         @foreach(config('livewire-ui-spotlight.shortcuts') as $key)
            @keydown.window.prevent.cmd.{{ $key }}="toggleOpen()"
            @keydown.window.prevent.ctrl.{{ $key }}="toggleOpen()"
         @endforeach
         @keydown.window.escape="isOpen = false"
         @toggle-spotlight.window="toggleOpen()"
         :class="{'d-flex justify-content-center sticky-top z-2000': isOpen}"
         class="spotlight-container px-4 pt-8" style="display: none;">
        <div x-show="isOpen" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity">
            <div class="spotlight-backdrop bg-black-25"></div>
        </div>

        <div @click.outside="isOpen = false" x-show="isOpen" x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="spotlight-relative">

                <div class="input-group">
                    <input @keydown.tab.prevent="" @keydown.prevent.stop.enter="go()" @keydown.prevent.arrow-up="selectUp()"
                           @keydown.prevent.arrow-down="selectDown()" x-ref="input" x-model="input"
                           type="text"
                           style="caret-color: #6b7280; border: 0 !important;"
                           class="form-control form-control-alt form-control-lg p-4 force-focus"
                           x-bind:placeholder="inputPlaceholder">
                    <span class="input-group-text input-group-text-alt">
                          <i class="fas fa-sync-alt fa-spin text-muted" wire:loading.delay></i>
                    </span>
                </div>
            <div class="block block-rounded" x-show="filteredItems().length > 0" style="display: none; z-index: 2000;">
                <div class="block-content overflow-y-auto p-0" style="max-height: 265px; z-index: 2000;">
                    <table x-ref="results" class="table table-striped table-bordered table-hover mb-0">
                        <tbody>
                            <template x-for="(item, i) in filteredItems()" :key>
                                <tr>
                                    <td class="p-0">
                                        <a href='' @click="go(item[0].item.id)" style="display:block;" class="px-3 py-4 h-100 w-100 d-flex justify-content-between" :class="{ 'bg-black-10': selected === i, 'hover:bg-black-25': selected !== i }">
                                            <h5 x-text="item[0].item.name" class="text-lg m-0" :class="{'text-gray': selected !== i, 'text-gray-light': selected === i }"></h5>
                                            <span x-text="item[0].item.description" class="text-sm text-gray-dark" :class="{'text-gray': selected !== i, 'text-gray fw-normal': selected === i }"></span>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
