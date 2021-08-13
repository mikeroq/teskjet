<li {{ $attributes->merge(['class' => 'nav-item']) }}>
    <button :class="{ 'active': tab === '#{{ $id }}' }" class="nav-link" role="tab" aria-controls="{{ $id }}" x-on:click.prevent="tab='#{{ $id }}'; window.location.hash = '#{{ $id }}' " id="{{ $id }}-tab">
        {{ $name }}
    </button>
</li>