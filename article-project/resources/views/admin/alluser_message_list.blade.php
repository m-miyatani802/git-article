<style>
    .fj {
        word-break: break-all;
    }

    .l {
        text-align: left;
    }

    /* 罫線 */
    .list-decimal,
    .list-decimal th,
    .list-decimal td {
        border: solid 1px #666;
    }

    /* セルの余白 */
    .list-decimal th,
    .list-decimal td {
        padding: 5px;
    }
</style>
<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <div class="flex justify-center items-center gap-5">
                    <button class="bg-gray-400 hover:bg-gray-200 text-white rounded px-4 py-2"
                        onclick="location.href='/admin/top'">TOP</button>
                    <x-dropdown-link :href="route('allusermessagecreate')">
                        <div class="text-xl text-blue-500">
                            {{ __('お知らせ新規作成') }}
                        </div>
                    </x-dropdown-link>
                </div>
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="">
                        <h1 class="text-xl">全ユーザーへお知らせ一覧</h1><br>
                        @if (session('message'))
                            <div class=" text-xl text-red-500">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="">
                            <table class="list-decimal">
                                <thead>
                                    <tr>
                                        <th>タイトル</th>
                                        <th>作成日</th>
                                        <th>更新日</th>
                                        <th>作成者</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <form method="post" action="{{ route('allusermessageshow') }}">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $message['id'] }}">
                                                <input type="hidden" name="admin_id"
                                                    value="{{ $message['admin_id'] }}">
                                                <input type="hidden" name="message_title"
                                                    value="{{ $message['title'] }}">
                                                <input type="hidden" name="message"
                                                    value="{{ $message['description'] }}">
                                                <input type="hidden" name="created_at"
                                                    value="{{ $message['created_at'] }}">
                                                <input type="hidden" name="updated_at"
                                                    value="{{ $message['updated_at'] }}">

                                                <td class="text-xl">
                                                    <button type="submit"
                                                        class="fj l hover:bg-blue-100">{{ $message['title'] }}</button>
                                                </td>
                                                <td><button type="submit"
                                                        class="hover:bg-blue-100">{{ $message['created_at'] }}</button>
                                                </td>
                                                <td><button type="submit"
                                                        class="hover:bg-blue-100">{{ $message['updated_at'] }}</button>
                                                </td>
                                                <td><button type="submit"
                                                        class="hover:bg-blue-100">{{ $message['admin_id'] }}</button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div </x-app-layout>
