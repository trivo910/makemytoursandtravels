@php
    $currentPath = '/' . trim(request()->path(), '/');
    $navigationItems = [
        ['label' => 'Home', 'url' => route('home'), 'path' => '/'],
        ['label' => 'About', 'url' => rtrim(url('/about'), '/') . '/', 'path' => '/about'],
        ['label' => 'Our Standards', 'url' => rtrim(url('/our-standards'), '/') . '/', 'path' => '/our-standards'],
        ['label' => 'Tempo Traveller Hire', 'url' => rtrim(url('/tempo-traveller-hire'), '/') . '/', 'path' => '/tempo-traveller-hire'],
        ['label' => "FAQ's", 'url' => rtrim(url('/faqs'), '/') . '/', 'path' => '/faqs'],
        ['label' => 'Contact', 'url' => rtrim(url('/contact'), '/') . '/', 'path' => '/contact'],
    ];
    $standardsChildren = [
        ['label' => 'Bus Hire', 'url' => rtrim(url('/bus-hire'), '/') . '/', 'path' => '/bus-hire'],
        ['label' => 'Urbania', 'url' => rtrim(url('/urbania'), '/') . '/', 'path' => '/urbania'],
    ];
    $standardsChildIsCurrent = in_array($currentPath, array_column($standardsChildren, 'path'), true);
    $standardsIsCurrent = in_array($currentPath, ['/our-standards', '/bus-hire', '/urbania'], true);
@endphp

<header class="site-header">
    <div class="container">
        <div class="site-header__bar">
            <a class="brand" href="{{ route('home') }}" aria-label="Make My Tours & Travels home">
                <img class="brand__logo" src="{{ asset('images/make-my-tours-logo.png') }}"
                     alt="Make My Tours & Travels" width="1600" height="406">
            </a>

            <nav class="desktop-nav" aria-label="Main navigation">
                <ul class="desktop-nav__list">
                    @foreach ($navigationItems as $item)
                        @if ($item['path'] === '/our-standards')
                            <li class="nav-item nav-item--dropdown{{ $standardsIsCurrent ? ' is-current-parent' : '' }}{{ $standardsChildIsCurrent ? ' is-expanded' : '' }}">
                                <div class="nav-item__primary">
                                    <a class="nav-link{{ $currentPath === $item['path'] ? ' is-current' : '' }}"
                                       href="{{ $item['url'] }}"
                                       @if ($currentPath === $item['path']) aria-current="page" @endif>
                                        {{ $item['label'] }}
                                    </a>
                                    <button class="dropdown-toggle" type="button"
                                            aria-label="Show Our Standards submenu"
                                            aria-expanded="{{ $standardsChildIsCurrent ? 'true' : 'false' }}"
                                            aria-controls="standards-submenu">
                                        <svg viewBox="0 0 12 8" aria-hidden="true" focusable="false">
                                            <path d="m1 1 5 5 5-5" fill="none" stroke="currentColor" stroke-width="1.6"/>
                                        </svg>
                                    </button>
                                </div>
                                <ul class="dropdown-menu" id="standards-submenu">
                                    @foreach ($standardsChildren as $child)
                                        <li>
                                            <a class="dropdown-menu__link{{ $currentPath === $child['path'] ? ' is-current' : '' }}"
                                               href="{{ $child['url'] }}"
                                               @if ($currentPath === $child['path']) aria-current="page" @endif>
                                                {{ $child['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link{{ $currentPath === $item['path'] ? ' is-current' : '' }}"
                                   href="{{ $item['url'] }}"
                                   @if ($currentPath === $item['path']) aria-current="page" @endif>
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>

            <a class="header-contact" href="tel:+917718036300">
                <span class="header-contact__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false">
                        <path d="M6.6 2.8h3.1l1.5 4.8-2 1.8a15.3 15.3 0 0 0 5.4 5.4l1.8-2 4.8 1.5v3.1c0 1.1-.9 2-2 2C10 19.4 4.6 14 4.6 6.8c0-1.1.9-2 2-2Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="header-contact__copy">
                    <strong>Contact Us Now</strong>
                    <span>+91 77180 36300</span>
                </span>
            </a>

            <button class="menu-toggle" type="button" aria-controls="mobile-menu"
                    aria-expanded="false" aria-label="Open navigation">
                <span class="menu-toggle__icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="mobile-menu" id="mobile-menu" hidden>
        <button class="mobile-menu__backdrop" type="button" tabindex="-1" aria-label="Close navigation"></button>
        <div class="mobile-menu__panel" role="dialog" aria-modal="true" aria-label="Mobile navigation">
            <div class="mobile-menu__heading">
                <a class="brand" href="{{ route('home') }}" aria-label="Make My Tours & Travels home">
                    <img class="brand__logo" src="{{ asset('images/make-my-tours-logo.png') }}"
                         alt="Make My Tours & Travels" width="1600" height="406">
                </a>
                <button class="mobile-menu__close" type="button" aria-label="Close navigation">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <nav id="mobile-navigation" class="mobile-nav" aria-label="Mobile navigation">
                <ul class="mobile-nav__list">
                    @foreach ($navigationItems as $item)
                        @if ($item['path'] === '/our-standards')
                            <li class="mobile-nav__item">
                                <div class="mobile-nav__row">
                                    <a class="mobile-nav__link{{ $currentPath === $item['path'] ? ' is-current' : '' }}"
                                       href="{{ $item['url'] }}"
                                       @if ($currentPath === $item['path']) aria-current="page" @endif>
                                        {{ $item['label'] }}
                                    </a>
                                    <button class="mobile-submenu-toggle" type="button"
                                            aria-label="Show Our Standards submenu"
                                            aria-expanded="{{ $standardsChildIsCurrent ? 'true' : 'false' }}"
                                            aria-controls="mobile-standards-submenu">
                                        <svg viewBox="0 0 12 8" aria-hidden="true" focusable="false">
                                            <path d="m1 1 5 5 5-5" fill="none" stroke="currentColor" stroke-width="1.6"/>
                                        </svg>
                                    </button>
                                </div>
                                <ul class="mobile-submenu" id="mobile-standards-submenu"
                                    @if (!$standardsChildIsCurrent) hidden @endif>
                                    @foreach ($standardsChildren as $child)
                                        <li>
                                            <a class="mobile-nav__link mobile-nav__link--nested{{ $currentPath === $child['path'] ? ' is-current' : '' }}"
                                               href="{{ $child['url'] }}"
                                               @if ($currentPath === $child['path']) aria-current="page" @endif>
                                                {{ $child['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="mobile-nav__item">
                                <a class="mobile-nav__link{{ $currentPath === $item['path'] ? ' is-current' : '' }}"
                                   href="{{ $item['url'] }}"
                                   @if ($currentPath === $item['path']) aria-current="page" @endif>
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>

            <a class="mobile-menu__contact" href="tel:+917718036300">
                <span>Call Make My Tours &amp; Travels</span>
                <strong>+91 77180 36300</strong>
            </a>
        </div>
    </div>
</header>
