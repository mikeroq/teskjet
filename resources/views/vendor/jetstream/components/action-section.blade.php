<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-md-4">
        <x-jet-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">{{ $description }}</x-slot>
        </x-jet-section-title>
    </div>

    <div class="col-md-7">
        <div class="block block-rounded block-themed block-transparent bg-black-25 text-gray">
            <div class="block-content">
                {{ $content }}
            </div>
        </div>
    </div>
</div>
