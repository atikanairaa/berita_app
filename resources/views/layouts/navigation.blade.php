<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="shrink-0 flex items-center">
          <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
          </a>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
          </x-nav-link>
        
          @if (auth()->check() && auth()->user()->role == 'admin')
            <x-nav-link :href="route('beritas.index')" :active="request()->routeIs('beritas.*')">
              {{ __('Kelola Berita') }}
            </x-nav-link>
          @endif
        </div>
      </div>

      <div class="hidden sm:flex sm:items-center sm:ms-6 relative" @keydown.window.escape="dropdownOpen = false" x-cloak>
        <!-- Dropdown Trigger -->
        <div>
          <button @click="dropdownOpen = !dropdownOpen" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" id="user-menu" aria-haspopup="true" :aria-expanded="dropdownOpen.toString()">
            <span>{{ Auth::user()->name ?? 'Guest' }}</span>
            <svg class="ml-1 fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </button>
        </div>
        <!-- Dropdown Menu -->
        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu" tabindex="-1" style="display: none;">
          <div class="py-1" role="none">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">
              {{ __('Profile') }}
            </a>
            <form method="POST" action="{{ route('logout') }}" role="none">
              @csrf
              <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-1" @click="$nextTick(() => dropdownOpen = false)">
                {{ __('Log Out') }}
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Mobile menu button -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out" aria-controls="mobile-menu" aria-expanded="false">
          <svg x-show="!open" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" style="display:none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden" id="mobile-menu">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
      </x-responsive-nav-link>
      @if (auth()->check() && auth()->user()->role == 'admin')
      <x-responsive-nav-link :href="route('beritas.index')" :active="request()->routeIs('beritas.*')">
        {{ __('Berita') }}
      </x-responsive-nav-link>
      @endif
    </div>

    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
      <div class="px-4">
        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name ?? 'Guest' }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? '' }}</div>
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
          {{ __('Profile') }}
        </x-responsive-nav-link>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-responsive-nav-link :href="route('logout')"
            onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>
      </div>
    </div>
  </div>
</nav>
