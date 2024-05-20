<x-guest-layout>
    <x-dropdown-link :href="route('allusermessagelist')" class="text-xl">
        {{ __('全ユーザーへ通知') }}
    </x-dropdown-link>

    <x-dropdown-link :href="route('adminlogout')" class="text-xl"
        onclick="event.preventDefault();
            this.closest('form').submit();">
        {{ __('通報') }}
    </x-dropdown-link>

    <x-dropdown-link :href="route('adminlogout')" class="text-xl"
        onclick="event.preventDefault();
            this.closest('form').submit();">
        {{ __('データ検索') }}
    </x-dropdown-link><br>

    <form method="POST" action="{{ route('adminlogout') }}">
        @csrf

        <x-dropdown-link :href="route('adminlogout')" class="text-blue-700 text-xl"
            onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</x-guest-layout>
