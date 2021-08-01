@props(['submit'])

<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-lg-4">
        <x-jet-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">{{ $description }}</x-slot>
        </x-jet-section-title>
    </div>
    <div class="col-lg-7">
        <div class="block block-rounded block-themed block-transparent bg-black-25">
            <form wire:submit.prevent="{{ $submit }}">
                <div class="block-content">
                    {{ $form }}
                </div>

                @if (isset($actions))
                    <div class="block-content block-content-full block-content-sm bg-black-10 font-size-sm">
                        {{ $actions }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
