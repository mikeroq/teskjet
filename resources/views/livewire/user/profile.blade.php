<div>
    <div style="background-image: url('/assets/media/photos/photo19@2x.jpg');" class="bg-image">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center bg-black-50">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb" src="{{ $user->profile_photo_url }}" alt="">
                </div>
                <h1 class="h2 text-white mb-0">{{ $user->name }}</h1>
            </div>
        </div>
    </div>
    <div class="content content-boxed">
        <div class="row">
            <div class="col-12">
                {{ $actions->links() }}
                <ul class="timeline timeline-alt py-0" id="scroll-to">
                    @forelse($actions as $activity)
                        <li class="timeline-event" wire:key="{{ $loop->index }}">
                            @switch($activity->event)
                                @case('updated')
                                    <div class="timeline-event-icon bg-success">
                                        <i class="fas fa-pencil-alt fa-fw"></i>
                                    </div>
                                    @break
                                @case('created')
                                    <div class="timeline-event-icon bg-info">
                                        <i class="fas fa-plus fa-fw"></i>
                                    </div>
                                    @break
                                @case('deleted')
                                    <div class="timeline-event-icon bg-danger">
                                        <i class="fas fa-trash-alt fa-fw"></i>
                                    </div>
                                    @break
                            @endswitch
                            <div class="timeline-event-block block block-themed">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">{{ $activity->description }} {{ config('tesk.activity.'.$activity->subject_type.'.name') }}</h3>
                                    <div class="block-options">
                                        <div class="timeline-event-time block-options-item fs-sm">
                                            {{ tz($activity->created_at) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <p>
                                        @switch($activity->event)
                                            @case('updated')
                                                @foreach($activity->changes['attributes'] as  $key => $change)
                                                    {{ Str::of($key)->replace('_', ' ')->title() }} from {{ $activity->changes['old'][$key] }} to {{ $change }}<br>
                                                @endforeach
                                                @break
                                            @case('created')
                                                @if($activity->subject)
                                                    Added
                                                    <a href="{{ route(activity_config($activity->subject_type)['route'], $activity->subject->id) }}">
                                                        {{ $activity->subject->name }}
                                                    </a>
                                                @else
                                                    Added {{ $activity->properties['attributes']['name'] }} (since been deleted)
                                                @endif
                                                @break
                                            @case('deleted')
                                                Deleted {{ $activity->properties['old']['name'] }}
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="timeline-event">
                            No events found
                        </li>
                    @endforelse
                </ul>
                {{ $actions->links() }}
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('gotoTop', () => {
            document.getElementById('scroll-to').scrollIntoView({ behavior: 'smooth', block: 'center' });
        })
    </script>
@endpush