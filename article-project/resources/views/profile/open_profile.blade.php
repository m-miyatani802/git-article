<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('公開プロフィール') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('公開プロフィール変更') }}
                    </h2><br>

                    @if(session('message'))
	                    <div style="color: #006400;">
		                    {{ session('message') }}
	                    </div>
                    @endif

                    <form method="post" action="{{ route('open_profile_store') }}" class="p-6">
                        @csrf

                        <div>{{ __('ユーザー名') }}
                            <input type="text" name="user_name" value="{{$user->user_name != null ? $user->user_name : ''}}">
                        </div><br>

                        <div>{{ __('アカウント名') }}
                            <input type="text" name="account_name" value="{{$user->account_name != null ? $user->account_name : ''}}">
                        </div><br>

                        <div>{{ __('公開用メールアドレス') }}
                            <input type="text" name="open_email" value="{{$user->open_email != null ? $user->open_email : ''}}">
                        </div><br>

                        <div>{{ __('サイトURL') }}
                            <input type="text" name="site_url" value="{{$user->site_url != null ? $user->site_url : ''}}">
                        </div><br>

                        <div>{{ __('自己紹介') }}</div>
                            <textarea name="self_introduction" id="" cols="30" rows="10">{{$user->site_url != null ? $user->site_url : ''}}</textarea><br>

                        <x-secondary-button onClick="history.back()">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-4">
                            {{ __('変更') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
