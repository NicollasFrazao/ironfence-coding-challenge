<nav class="mt-2" style="margin-top: 10px;">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">        
        <li class="nav-header">AUTENTICAÇÃO</li>

        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link {{ \Request::is('*login*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>{{ __('Login') }}</p>
                    </a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ \Request::is('*register*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>{{ __('Cadastro') }}</p>
                    </a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a href="#" class="nav-link {{ \Request::is('*logout*') ? 'active' : '' }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>{{ __('Logout') }}</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            <li class="nav-header">GESTÃO</li>

            {{--
            <li class="nav-item">
                <a href="{{ route('contacts.index') }}" class="nav-link {{ \Request::is('*contacts*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book-open"></i>
                    <p>Contatos</p>
                </a>
            </li>
            --}}
        @endguest   
    </ul>
</nav>