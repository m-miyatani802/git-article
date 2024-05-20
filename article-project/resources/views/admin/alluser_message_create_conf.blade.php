<style>
    .example {
        text-align: center;
        Justify-content: Flex-start;    }

    .fj {
        word-break: break-all;
    }

    .tj {
        white-space: pre-wrap;
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
                <div class="">
                    <h1 class="text-xl example">全ユーザーへお知らせ新規作成確認画面</h1><br>

                    <form method="POST" action="{{ route('allusermessagecreatestore') }}">
                        @csrf
                        <!-- タイトル -->
                        <div>
                            <x-input-label class="example text-xl" for="message_titlee" :value="__('タイトル')" />
                            <input type="hidden" for="message_title" name="message_title"
                                value="{{ $message['message_title'] }}">
                            <div class="text-xl h-300 p-4 mx-20 my-1 text-xl fj tj example">{{ $message['message_title'] }}
                            </div>
                        </div><br>

                        <!-- メッセージ内容 -->
                        <div>
                            <x-input-label class="example text-xl" for="message" :value="__('メッセージ')" />
                            <input type="hidden" for="message" name="message" value="{{ $message['message'] }}">
                            <div class="text-xl h-300 p-4 mx-20 my-1 text-xl l fj tj text-left example">{{ $message['message'] }}</div>
                        </div><br>
                        <div class="flex justify-center items-center gap-4">
                            <x-secondary-button onClick="history.back()">
                                {{ __('戻る') }}
                            </x-secondary-button>

                            <x-primary-button class="ms-4">
                                {{ __('送信') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
