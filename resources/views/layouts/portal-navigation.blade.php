<nav class="portal-nav">
    <div class="portal-nav-inner">
        <div class="portal-nav-left">
            <x-brand-logo :href="route('dashboard')" class="portal-nav-logo" />
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="portal-nav-admin {{ request()->routeIs('admin.*') ? 'is-active' : '' }}">Admin</a>
            @endif
        </div>

        <div class="portal-nav-right">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button type="button" class="portal-user-btn">
                        <span class="portal-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        <span>{{ auth()->user()->name }}</span>
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('dashboard')">Overview</x-dropdown-link>
                    <x-dropdown-link :href="route('dashboard.content')">Content</x-dropdown-link>
                    <x-dropdown-link :href="route('dashboard.upgrade')">Upgrade</x-dropdown-link>
                    <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Log out
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
