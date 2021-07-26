<nav id="sidebar" aria-label="Main Navigation">
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <a class="font-w600 text-white tracking-wide" href="{{ route('dashboard') }}">
                {{ config('app.name') }}
            </a>
            <div>
                <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-times-circle"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="nav-main-link-icon fas fa-angle-left"></i>
                        <span class="nav-main-link-name">Back to App</span>
                    </a>
                </li>
                <li class="nav-main-heading">User Control Panel</li>
                @foreach ($usercp_navigation as $nav)
                    @if($nav->children->count() > 0)
                        <li class="nav-main-item{{ request()->is($nav->url.'*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu{{ request()->is($nav->url) ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon {{ $nav->icon }}"></i>
                                <span class="nav-main-link-name">{{ $nav->title }}</span>
                            </a>
                            <ul class="nav-main-submenu">
                            @foreach($nav->children as $child)
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is($child->url) ? ' active' : '' }}" href="/{{ $child->url }}">
                                    <span class="nav-main-link-name">{{ $child->title }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is($nav->url) ? ' active' : '' }}" href="/{{ $nav->url }}">
                                <i class="nav-main-link-icon {{ $nav->icon }}"></i>
                                <span class="nav-main-link-name">{{ $nav->title }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
