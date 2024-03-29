<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- アカウント名 -->
        <div>
            <x-input-label for="account_name" :value="__('アカウント名')" />
            <x-text-input id="account_name" class="block mt-1 w-full" type="text" name="account_name" :value="old('account_name')"
                required autofocus autocomplete="account_name" />
            <x-input-error :messages="$errors->get('account_name')" class="mt-2" />
        </div>

        <!-- ユーザー名 -->
        <div>
            <x-input-label for="user_name" :value="__('ユーザー名')" />
            <x-text-input id="user_name" class="block mt-1 w-full" type="text" name="user_name" :value="old('user_name')"
                required autofocus autocomplete="user_name" />
            <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
        </div>

        <!-- メールアドレス -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="emai" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- パスワード -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- パスワード確認 -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード確認')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- 性別 -->
        <div><br>性別</div>
        <div class="form__input--radio">
            <input id="men" type="radio" name="gender" value="0" checked>
            <label for="men" name="gender0" value="男性">男性</label>
            <input id="women" type="radio" name="gender" value="1">
            <label for="women" name="gender1" value="女性">女性</label>
        </div><br>

        <!-- 誕生日 -->
        <div>生年月日</div>
        <label class="date-edit">
            <input type="date" name="birth" value="2000-01-01" required/>
        </label>

        <br>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('ログインはこちら') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('会員登録') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
