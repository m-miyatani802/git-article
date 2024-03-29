<x-guest-layout>
    <h1>ご入力頂いたメール宛に送付した認証コードを下記に正しくご入力して下さい。</h1>
    <h2>認証コードの有効期限は30分です。</h2>
    <form method="POST" action="{{ route('authregister') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="onetime_token" :value="__('認証コード')" />
            <x-text-input id="onetime_token" class="block mt-1 w-full" type="number" name="onetime_token" :value="old('onetime_token')" required/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('新規会員登録') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
