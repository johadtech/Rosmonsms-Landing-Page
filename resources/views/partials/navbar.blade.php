<nav>
    <a href="{{ url('/') }}">Home</a>
    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('posts.create') }}">Create Post</a>
            <a href="{{ route('bookings.index') }}">Manage Bookings</a>
        @endif
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endauth
</nav>