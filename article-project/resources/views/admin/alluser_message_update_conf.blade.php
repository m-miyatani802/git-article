<style>
    p {
        word-break: break-all;
    }
    .fj {
        white-space: pre-wrap;
    }
    form {
        margin-block-end: 0;
    }
    .example {
        text-align: center;
    }
    .l {
        text-align:left;
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
                    <h1 class="flex justify-center items-center text-xl">お知らせ編集確認</h1><br>

                    <h2 class="flex justify-center items-center text-xl">タイトル</h2>
                    <p class="flex justify-center items-center text-xl h-24 p-4 mx-20 my-1">{{ $message['message_title'] }}</p><br>

                    <h2 class="flex justify-center items-center text-xl">メッセージ</h2>
                    <p class=" text-xl h-500 p-4 mx-20 my-1 fj example l">{{ $message['message'] }}</p><br>

                    {{-- <h2 class="text-xl">作成日</h2>
                    <p class="text-xl">{{ $message['created_at'] }}</p><br>

                    <h2 class="text-xl">更新日</h2>
                    <p class="text-xl">{{ $message['updated_at'] }}</p><br> --}}

                    <div class="flex justify-center items-center gap-4">
                        <button class="bg-gray-600 hover:bg-gray-400 text-white rounded px-4 py-2" onClick="history.back()">戻る</button>

                        <form method="POST" action="{{ route('allusermessageupdatecomplete') }}">
                            @method('PATCH')
                            @csrf

                            <input type="hidden" name="id" value="{{ $message['id'] }}">
                            <input type="hidden" name="admin_id" value="{{ $message['admin_id'] }}">
                            <input type="hidden" name="message_title" value="{{ $message['message_title'] }}">
                            <input type="hidden" name="message" value="{{ $message['message'] }}">

                            <button class="bg-blue-700 hover:bg-blue-600 text-white rounded px-4 py-2">編集</button>
                        </form>

                        {{-- <form method="POST" action="">
    @csrf
    @method('PATCH')

        <input type="hidden" name="id" value="{{ $message['id'] }}">
        <input type="hidden" name="admin_id" value="{{ $message['admin_id'] }}">
        <input type="hidden" name="message_title" value="{{ $message['message_title'] }}">
        <input type="hidden" name="message" value="{{ $message['message'] }}">
        <input type="hidden" name="created_at" value="{{ $message['created_at'] }}">
        <input type="hidden" name="updated_at" value="{{ $message['updated_at'] }}">

        <button class="bg-red-700 hover:bg-red-600 text-white rounded px-4 py-2">削除</button>
    </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
