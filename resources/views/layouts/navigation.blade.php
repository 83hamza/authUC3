<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-3 items-center h-16 gap-4">

            {{-- ✅ LEFT: Logo + University Name --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.files.index') }}" class="flex items-center gap-3">
                    <img src="{{ asset('uc3-logo.png') }}" class="h-11 w-auto" alt="UC3 Logo">

                    <div class="hidden sm:block leading-tight">
                        <div class="text-gray-900 font-bold text-sm sm:text-base tracking-wide">
                            University of Constantine 3
                        </div>
                        <div class="text-gray-500 text-xs">
                            Salah Boubnider
                        </div>
                    </div>
                </a>
            </div>

            {{-- ✅ CENTER: Badge --}}
            <div class="hidden md:flex justify-center">
                <span class="px-5 py-1.5 rounded-full bg-sky-100 text-sky-800 font-bold text-sm shadow-sm border border-sky-200">
                    مصلحة الشهادات والمعادلات
                </span>
            </div>

            {{-- ✅ RIGHT: Settings + Admin Dropdown --}}
            <div class="flex justify-end items-center gap-3">

                {{-- ✅ Settings Button (Admin Only) --}}
              @if(auth()->check() && auth()->user()->isAdmin())
    <a href="{{ route('admin.users.index') }}"
       class="hidden sm:inline-flex items-center px-4 py-2 rounded-xl bg-gray-100
              text-gray-700 font-bold hover:bg-sky-100 hover:text-sky-700 transition">
        ⚙️ Settings
    </a>
@endif


                {{-- ✅ Admin Dropdown --}}
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">

                        {{-- Trigger --}}
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-xl shadow-sm
                                text-sm font-semibold text-gray-700 hover:text-sky-700 hover:border-sky-400 transition">
                                <span class="me-2">{{ Auth::user()->name }}</span>

                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        {{-- Dropdown Content --}}
                        <x-slot name="content">

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center gap-2 text-red-600 font-bold text-sm">

                                    <span class="px-2 py-1 rounded-lg bg-red-50 border border-red-200">
                                        ⏻
                                    </span>
                                    تسجيل الخروج
                                </x-dropdown-link>
                            </form>

                        </x-slot>
                    </x-dropdown>
                </div>

                {{-- ✅ Hamburger for mobile --}}
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }"
                                class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }"
                                class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- ✅ Responsive Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">


        {{-- Badge Mobile --}}
        <div class="px-4 pt-2 pb-2 text-center">
            <span class="px-5 py-1.5 rounded-full bg-sky-100 text-sky-800 font-bold text-sm border border-sky-200 shadow-sm">
                مصلحة الشهادات والمعادلات
            </span>
        </div>

        {{-- Settings Mobile --}}
        @if(auth()->user()->is_admin)
            <div class="px-4 pb-2">
                <a href="{{ route('admin.users.index') }}"
                   class="block text-center px-4 py-2 rounded-xl bg-gray-100 text-gray-700 font-bold hover:bg-sky-100 hover:text-sky-700 transition">
                    ⚙️ Settings
                </a>
            </div>
        @endif

        {{-- Logout Mobile --}}
        <div class="pt-4 pb-2 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="text-red-600 font-bold flex items-center gap-2">
                    ⏻ تسجيل الخروج
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
  

</nav>
