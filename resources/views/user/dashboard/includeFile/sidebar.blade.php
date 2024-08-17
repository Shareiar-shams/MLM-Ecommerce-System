<div class="navi">
    <ul>
        <li class="{{ isActiveRoute('dashboard') }}"><a href="{{route('dashboard')}}"><i class="fa fa-tachometer" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashboard</span></a></li>

        <li class="{{ isActiveRoute('profile.edit') }}"><a href="{{route('profile.edit')}}"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Profile</span></a></li>

        <li class="{{ isActiveRoute('tools') }}"><a href="{{route('tools')}}"><i class="fa fa-gear" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Tools</span></a></li>

        <li class="{{ isActiveRoute('orders') }}"><a href="{{route('orders')}}"><i class="fa fa-first-order"></i><span class="hidden-xs hidden-sm">Ordered Product</span></a></li>

        <li><a href="{{route('all.chats')}}"><i class="fa fa-comments" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Chat With Admin</span><small style="float: right;">{{ count($notifications) }}<i class="fa fa-comments" aria-hidden="true"></i></small></a></li>

        <li>
            <a href="{{route('all.notifications')}}">
                <i class="fa fa-bell"></i>
                <span class="hidden-xs hidden-sm">Notifications</span> <span class="right badge badge-danger">New</span> 
                {{-- <small style="float: right;">{{count($adminPaidTransactions) + count($newUsers)}}<i class="fa fa-bell"></i></small>  --}}
            </a>
        </li>

        <li>
            <a href="{{route('ticket')}}">
                <i class='fa fa-ticket'></i>
                <span class="hidden-xs hidden-sm">Support Ticket</span>  
                {{-- <small style="float: right;">{{count($adminPaidTransactions) + count($newUsers)}}<i class="fa fa-bell"></i></small>  --}}
            </a>
        </li>
        {{-- <li><a href="#"><i class="fa fa-first-order" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Orders</span></a></li> --}}
        <!--<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Address</span></a></li>-->
        <!--<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Wishlist</span></a></li>-->
        <!--<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Delete Account</span></a></li>-->
        <li>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{ __('Log Out') }}</span>
                </x-responsive-nav-link>
            </form>
        </li>
    </ul>
</div>