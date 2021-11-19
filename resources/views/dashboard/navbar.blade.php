<nav class="w-full h-20 bg-primary-dark-500 flex flex-col md:flex-row justify-between sticky -top-0.5 relative z-50" id="navbar">
    <div class="w-full md:w-1/3 h-full flex justify-between md:justify-start">
        <a class="flex pl-2 pr-4 hover:bg-primary-dark-300 transition" href="{{route('home')}}">
            <img src="{{asset('img/logo.svg')}}" class="w-20 h-20" alt="Logo">
            <h1 class="grid place-items-center ml-3 pb-1">
                    <span class="font-bold text-2xl lg:text-3xl text-text-light ">
                        Tajemná komnata
                    </span>
            </h1>
        </a>
        <div class="self-center text-text-light md:hidden px-3 font-semibold text-2xl hamburger" id="hamburger" onclick="toggleMenu()">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </div>
    <div class="w-full md:w-2/3  md:h-full hidden md:flex flex-row items-start bg-primary-dark-400 md:bg-primary-dark-500 md:justify-end" id="menu">
    @if ($page == "home")
        <a class="px-4 grid place-items-center h-20 pb-1 bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Články
                </span>
        </a>
    @else
        <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition" href="{{route('dashboard')}}">
                <span class="font-semibold text-2xl text-text-light">
                    Články
                </span>
        </a>
    @endif
    @if ($page == "magazine")
        <a class="px-4 grid place-items-center h-20 pb-1 bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Časopis
                </span>
        </a>
    @else
        <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition" href="{{route('dashboard.magazine')}}">
                <span class="font-semibold text-2xl text-text-light">
                    Časopis
                </span>
        </a>
    @endif
    @if ($page == "users")
        <a class="px-4 grid place-items-center h-20 pb-1 bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Uživatelé
                </span>
        </a>
    @else
        <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition" href="{{route('dashboard.users')}}">
                <span class="font-semibold text-2xl text-text-light">
                    Uživatelé
                </span>
        </a>
    @endif
    @if ($page == "settings")
        <a class="px-4 grid place-items-center h-20 pb-1 bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Nastavení
                </span>
        </a>
    @else
        <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition" href="{{route('dashboard.settings')}}">
                <span class="font-semibold text-2xl text-text-light">
                    Nastavení
                </span>
        </a>
    @endif
    </div>

    <script>
        function toggleMenu() {
            document.getElementById('hamburger').classList.toggle("change");
            var menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }
    </script>
</nav>
