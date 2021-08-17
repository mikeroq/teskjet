<li class="nav-main-item">
    <a class="nav-main-link" href="{{ route('dashboard') }}">
        <i class="nav-main-link-icon fas fa-angle-left"></i>
        <span class="nav-main-link-name">Back to App</span>
    </a>
</li>
<li class="nav-main-heading">User Control Panel</li>
@foreach ($usercp_navigation as $nav)
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
@endforeach
