<li class="nav-main-item">
    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}"
        href="{{ route('dashboard') }}">
        <i class="nav-main-link-icon fas fa-angle-left"></i>
        <span class="nav-main-link-name">Back to App</span>
    </a>
</li>
<li class="nav-main-heading">Admin Panel</li>
@foreach ($admin_navigation as $nav)
    @if (($nav->user_level === Auth::user()->user_level->description) || ($nav->user_level === "User" && Auth::user()->user_level->description === "Admin"))
        @if ($nav->children)
            <li class="nav-main-item{{ request()->is($nav->url . '*') ? ' open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu{{ request()->is($nav->url) ? ' active' : '' }}" data-toggle="submenu" aria-haspopup="true" aria-expanded="false">
                    <i class="nav-main-link-icon {{ $nav->icon }}"></i>
                    <span class="nav-main-link-name">{{ $nav->title }}</span>
                </a>
                <ul class="nav-main-submenu">
                    @foreach ($nav->children as $child)
                        @if($child->is_hidden === true && request()->is($child->url . '*'))
                            <li class="nav-main-item">
                                <span class="nav-main-link nav-main-link-name {{ request()->is($child->url) ? ' active' : '' }}">
                                    {{ $child->title }}
                                </span>
                            </li>
                        @elseif($child->is_hidden === false)
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is($child->url) ? ' active' : '' }}"
                                   href="/{{ $child->url }}">
                                    <span class="nav-main-link-name">{{ $child->title }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @else
            @if($nav->is_hidden === true && request()->is($nav->url . '*'))
                <li class="nav-main-item">
                    <span class="nav-main-link nav-main-link-name {{ request()->is($nav->url . '*') ? ' active' : '' }}">
                        {{ $nav->title }}
                    </span>
                </li>
            @elseif($nav->is_hidden === false)
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is($nav->url . '*') ? ' active' : '' }}"
                       href="/{{ $nav->url }}">
                        <i class="nav-main-link-icon {{ $nav->icon }}"></i>
                        <span class="nav-main-link-name">{{ $nav->title }}</span>
                    </a>
                </li>
            @endif
        @endif
    @endif
@endforeach
<li class="nav-main-heading">External Laravel Panels</li>
<li class="nav-main-item">
    <a class="nav-main-link" href="/admin/routes">
        <i class="nav-main-link-icon fas fa-map"></i>
        <span class="nav-main-link-name">Routes</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link" href="/~artisan">
        <i class="nav-main-link-icon fas fa-terminal"></i>
        <span class="nav-main-link-name">Artisan</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link" href="/admin/sentemails">
        <i class="nav-main-link-icon fas fa-paper-plane"></i>
        <span class="nav-main-link-name">Sent Emails</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link" href="/telescope">
        <i class="nav-main-link-icon fas fa-microscope"></i>
        <span class="nav-main-link-name">Telescope</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link" href="/admin/compass">
        <i class="nav-main-link-icon fas fa-compass"></i>
        <span class="nav-main-link-name">Compass</span>
    </a>
</li>
