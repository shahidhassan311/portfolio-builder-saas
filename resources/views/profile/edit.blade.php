<x-portal-layout active="account" title="Account settings" description="Update your sign-in email, name, and password.">
        <div class="portal-settings-stack">
            <div class="portal-panel">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="portal-panel">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="portal-panel">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
</x-portal-layout>
