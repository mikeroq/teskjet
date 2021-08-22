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
    <div class="bg-body-extra-light">
        <div class="content content-boxed">
            <div class="row items-push text-center">
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase">Sales</div>
                    <a class="link-fx fs-3" href="javascript:void(0)">17980</a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase">Products</div>
                    <a class="link-fx fs-3" href="javascript:void(0)">27</a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase">Followers</div>
                    <a class="link-fx fs-3" href="javascript:void(0)">1360</a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase mb-2">739 Ratings</div>
                    <span class="text-warning">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half"></i>
                </span>
                    <span class="fs-sm text-muted">(4.9)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content content-boxed">
        <div class="row">
            <div class="col-md-7 col-xl-8">
                {{ $actions->links() }}
                <ul class="timeline timeline-alt py-0">
                    @forelse($actions as $activity)
                        <li class="timeline-event">
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
                                                    Added <a href="{{ route(activity_config($activity->subject_type)['route'], $activity->subject->id) }}">{{ $activity->subject->name }}</a>
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
            <div class="col-md-5 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-briefcase text-muted me-1"></i> Products
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="d-flex align-items-center push">
                            <div class="flex-shrink-0 me-3">
                                <a class="item item-rounded bg-info" href="javascript:void(0)">
                                    <i class="si si-rocket fa-2x text-white-75"></i>
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">MyPanel</div>
                                <div class="fs-sm">Responsive App Template</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center push">
                            <div class="flex-shrink-0 me-3">
                                <a class="item item-rounded bg-amethyst" href="javascript:void(0)">
                                    <i class="si si-calendar fa-2x text-white-75"></i>
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">Project Time</div>
                                <div class="fs-sm">Web Application</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center push">
                            <div class="flex-shrink-0 me-3">
                                <a class="item item-rounded bg-city" href="javascript:void(0)">
                                    <i class="si si-speedometer fa-2x text-white-75"></i>
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">iDashboard</div>
                                <div class="fs-sm">Bootstrap Admin Template</div>
                            </div>
                        </div>
                        <div class="text-center push">
                            <button type="button" class="btn btn-sm btn-alt-secondary">View More..</button>
                        </div>
                    </div>
                </div>
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-pencil-alt text-muted me-1"></i> Ratings
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="fs-sm push">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <a class="fw-semibold" href="">Brian Stevens</a>
                                    <span class="text-muted">(5/5)</span>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0">Flawless design execution! I'm really impressed with the product, it really helped me build my app so fast! Thank you!</p>
                        </div>
                        <div class="fs-sm push">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <a class="fw-semibold" href="">Alice Moore</a>
                                    <span class="text-muted">(5/5)</span>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0">Great value for money and awesome support! Would buy again and again! Thanks!</p>
                        </div>
                        <div class="fs-sm push">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <a class="fw-semibold" href="">Barbara Scott</a>
                                    <span class="text-muted">(5/5)</span>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <p class="mb-0">Working great in all my devices, quality and quantity in a great package! Thank you!</p>
                        </div>
                        <div class="text-center push">
                            <button type="button" class="btn btn-sm btn-alt-secondary">Read More..</button>
                        </div>
                    </div>
                </div>
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-share-alt text-muted me-1"></i> Followers
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <ul class="nav-items fs-sm">
                            <li>
                                <a class="d-flex py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar6.jpg" alt="">
                                        <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">Betty Kelley</div>
                                        <div class="fw-normal text-muted">Copywriter</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar11.jpg" alt="">
                                        <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">Jeffrey Shaw</div>
                                        <div class="fw-normal text-muted">Web Developer</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar3.jpg" alt="">
                                        <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">Laura Carr</div>
                                        <div class="fw-normal text-muted">Web Designer</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="text-center push">
                            <button type="button" class="btn btn-sm btn-alt-secondary">Load More..</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
