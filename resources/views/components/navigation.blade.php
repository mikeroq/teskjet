<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header">
        <a class="fw-semibold text-dual" href="{{ route('dashboard') }}">
            <span class="smini-visible">
                <i class="ico-send text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">{{ config('app.name') }}</span>
        </a>
    </div>
    <div class="js-sidebar-scroll">
        <div class="content-side">
            <ul class="nav-main">
                @foreach ($navigation as $nav)
                    @if (($nav->user_level == Auth::user()->user_level->description) || ($nav->user_level == "User" && Auth::user()->user_level->description == "Admin"))
                        @if ($nav->children)
                            <li class="nav-main-item{{ request()->is($nav->url . '*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu{{ request()->is($nav->url) ? ' active' : '' }}"
                                    data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon {{ $nav->icon }}"></i>
                                    <span class="nav-main-link-name">{{ $nav->title }}</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    @foreach ($nav->children as $child)
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is($child->url) ? ' active' : '' }}"
                                                href="/{{ $child->url }}">
                                                <span class="nav-main-link-name">{{ $child->title }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is($nav->url) ? ' active' : '' }}"
                                    href="/{{ $nav->url }}">
                                    <i class="nav-main-link-icon {{ $nav->icon }}"></i>
                                    <span class="nav-main-link-name">{{ $nav->title }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
