<style>
    p {
        word-break: break-all;
    }
    .example{
    text-align: center;
    }
</style>
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold  text-gray-800 leading-tight">
            <button class="bg-gray-400 hover:bg-gray-200 text-white rounded px-4 py-2"
                onclick="location.href='/admin/top'">TOP</button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="example">

                    <h1 class="flex justify-center items-center text-xl">全ユーザーへお知らせ新規作成</h1><br><br>
                    <form method="POST" action="{{ route('allusermessagecreateconf') }}">
                        @csrf

                        <!-- タイトル -->
                        <div>
                            <x-input-label class="text-xl"  for="message_titlee" :value="__('タイトル')" /><br>
                            <x-text-input id="message_title" class="block mt-1 w-full text-xl" type="text"
                                name="message_title" :value="old('message_title')" required autofocus
                                autocomplete="message_title" />
                            <x-input-error :messages="$errors->get('message_title')" class="mt-2" />
                        </div><br><br>
                        <!-- メッセージ内容 -->
                        <div>
                            <x-input-label class="text-xl" for="message" :value="__('メッセージ')" /><br>
                            <textarea class="text-xl" id="message" name="message" rows="10" cols="70" :value="old('message')"></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div><br>


                            <x-secondary-button onClick="history.back()">
                                {{ __('戻る') }}
                            </x-secondary-button>

                            <x-primary-button class="ms-4">
                                {{ __('次へ') }}
                            </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
