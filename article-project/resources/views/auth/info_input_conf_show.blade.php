<x-guest-layout>
    <h1>下記の内容で登録します</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
         <div>
            アカウント名
            <input type="hidden" for="account_name" name="account_name" value="{{ $user['account_name'] }}" >
            <div>{{ $user['account_name'] }}</div>
        </div>

        <div>
            ユーザー名
            <input type="hidden" for="user_name" name="user_name" value="{{ $user['user_name'] }}" >
            <div>{{ $user['user_name'] }}<div>
        </div>

        <div class="mt-4">
            メールアドレス
            <input type="hidden" for="email" name="email" value="{{ $user['email'] }}" >
            <div>{{ $user['email'] }}</div>
        </div>

        {{-- パスワード --}}
        <div class="mt-4">
            <input type="hidden" for="password" name="password" value="{{ $user['password'] }}" >
        </div>

        {{-- パスワード確認 --}}
        <div class="mt-4">
            <input type="hidden" for="password_confirmation" name="password_confirmation" value="{{ $user['password_confirmation'] }}" >
        </div>

        <div class="form__input--radio">
            性別
        @if ($user['gender'] == 0)
            <input type="hidden" for="gender" name="gender" value="{{ $user['gender'] }}" >
            <div>男性</div>
        @elseif ($user['gender'] == 1)
            <input type="hidden" for="gender" name="gender" value="{{ $user['gender'] }}" >
            <div>女性</div>
        @endif
        </div><br>

        <div>生年月日</div>
        <label class="date-edit">
            <input type="hidden" name="birth" value="{{ $user['birth'] }}" />
            <div>{{ $user['birth'] }}</div>
        </label><br>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button onClick="history.back()">
                {{ __('戻る') }}
            </x-secondary-button>

            <x-primary-button class="ms-4">
                {{ __('登録') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
