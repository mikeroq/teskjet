@props(['submit'])
<h2 class="content-heading">{{ $title }}</h2>
<div class="row push">
    <div class="col-lg-4">
        <p class="text-muted">
            {{ $description }}
        </p>
    </div>
    <div class="col-lg-7">
        <div class="block block-rounded">
            <div class="block-content">
                <form wire:submit.prevent="{{ $submit }}">
                    {{ $form }}
                    @if (isset($actions))
                    {{ $actions }}
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
