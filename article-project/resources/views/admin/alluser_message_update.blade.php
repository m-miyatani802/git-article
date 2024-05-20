<style>
    .example {
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
                <div class="">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-center items-center">
                        {{ __('お知らせ編集') }}
                    </h2><br>

                    <form method="post" action="{{ route('allusermessageupdateconf') }}" class="p-6">
                        @csrf

                        <div class="flex justify-center items-center">{{ __('管理者ID') }}</div>
                        <input type="hidden" name="id" value="{{ $message['id'] }}">

                        <p class="flex justify-center items-center">{{ $message['admin_id'] }}</p><br>
                        <input type="hidden" name="admin_id" value="{{ $message['admin_id'] }}">

                        <div class="flex justify-center items-center">{{ __('タイトル') }}</div>
                        <div class="example">
                            <input type="text" class="w-full" name="message_title"
                                value="{{ $message->title != null ? $message->title : '' }}">
                        </div><br><br>

                        <div class="flex justify-center items-center">{{ __('メッセージ') }}</div>
                        <div class="example">
                            <textarea name="message" rows="10" cols="80" value="$message->message">{{ $message->description != null ? $message->description : '' }}</textarea>
                        </div><br>

                        <div class="flex justify-center items-center gap-4">
                            <button class="bg-gray-600 hover:bg-gray-400 text-white rounded px-4 py-2"
                                onClick="history.back()">戻る</button>

                            <button class="bg-blue-700 hover:bg-blue-600 text-white rounded px-4 py-2">編集</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
