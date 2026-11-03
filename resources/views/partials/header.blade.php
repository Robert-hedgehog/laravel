<header>
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Laravel Logo" style="height: 24px; vertical-align: middle; margin-right: 8px;">
            <span>LaravelApp</span>
        </a>
        <nav>
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
            <a href="{{ route('feedback.create') }}" class="{{ request()->routeIs('feedback.create') ? 'active' : '' }}">Форма</a>
            <a href="{{ route('feedback.index') }}" class="{{ request()->routeIs('feedback.index') ? 'active' : '' }}">Таблица данных</a>
        </nav>
    </div>
</header>