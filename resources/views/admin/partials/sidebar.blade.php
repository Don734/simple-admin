<aside class="sidebar">
    <a href="{{ dashboard_route(config("admin.route_name_prefix")."dashboard") }}" class="navbar-brand">
        <span class="text">{!! config("admin.name") !!}</span>
    </a>
    <ul class="nav flex-column sidebar-menu">
        @foreach ($menu_list as $menu)
            @if (array_key_exists('header', $menu))
            <li class="nav-header">{{$menu['header']}}</li>
            @else
                <li class="nav-item">
                    <a class="nav-link @if($menu['route'] == $current_route) active @endif" aria-current="page" href="{{dashboard_route($menu['route'])}}"><span class="icon"><i class="{{$menu['icon']}}"></i></span> @lang('admin.menu.'.$menu['title'])</a>
                </li>
            @endif
        @endforeach
    </ul>
</aside>