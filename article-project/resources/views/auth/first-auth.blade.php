<x-guest-layout>
    <h1>メール認証画面</h1><br>
    <h2>メールアドレスを下記にご入力して下さい。<br>メールアドレス宛に認証コードを送付します。</h2>
    <form method="POST" action="{{ route('sendTokenEmail') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('認証コード送信') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
