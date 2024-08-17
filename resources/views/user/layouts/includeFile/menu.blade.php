<div class="collapse navbar-collapse" id="navbarText">

    <ul class="navbar-nav">
        @foreach($menus as $menu)
        <li class="nav-item {{ isActiveRoute($menu->route) }}">
            <a class="nav-link" href="{{route($menu->route)}}">{{$menu->name}} <span class="sr-only">(current)</span></a>
        </li>
        @endforeach
    </ul>

</div>