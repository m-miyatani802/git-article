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
    .example{
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
                onClick="location.href='/admin/top'">TOP</button>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @if (session('message'))
                        <div class="text-red-500">
                            {{ session('message') }}
                        </div>
                    @endif

                    <h1 class="flex justify-center items-center text-xl">お知らせ個別画面</h1><br>

                    <h2 class="flex justify-center items-center text-xl">管理者ID</h2>
                    <p class="flex justify-center items-center text-xl example">{{ $message['admin_id'] }}</p><br>

                    <h2 class="flex justify-center items-center text-xl">タイトル</h2>
                    <p class="h-300 p-4 mx-20 my-1 text-xl example fj text-left">{{ $message['title'] }}</p><br>

                    <h2 class="flex justify-center items-center text-xl">メッセージ</h2>
                    <p class="text-xl h-1100 p-4 mx-20 my-1 fj example text-left">{{ $message['description'] }}</p><br>

                    <h2 class="flex justify-center items-center text-xl">作成日</h2>
                    <p class="text-xl example">{{ $message['created_at'] }}</p><br>

                    <h2 class="flex justify-center items-center text-xl">更新日</h2>
                    <p class="text-xl example">{{ $message['updated_at'] }}</p><br>

                    <div class="flex justify-center items-center gap-4">
                        <button class="bg-gray-600 hover:bg-gray-400 text-white rounded px-4 py-2"
                            onClick="location.href='/admin/alluser/message/list'">一覧</button>

                        <form method="POST" action="{{ route('allusermessageupdate') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $message['id'] }}">
                            <input type="hidden" name="admin_id" value="{{ $message['admin_id'] }}">
                            <input type="hidden" name="title" value="{{ $message['title'] }}">
                            <input type="hidden" name="description" value="{{ $message['description'] }}">
                            <input type="hidden" name="created_at" value="{{ $message['created_at'] }}">
                            <input type="hidden" name="updated_at" value="{{ $message['updated_at'] }}">

                            <button class="bg-blue-700 hover:bg-blue-500 text-white rounded px-4 py-2">編集</button>
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
