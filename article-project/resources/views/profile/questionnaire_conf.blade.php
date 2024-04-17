<x-guest-layout>
    <h1>退会申請ページ</h1><br>
    <div>今後のサービス向上の為、退会理由を教えてください。</div><br>
    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        <div>
            <input type="radio" id="0" name="why_quit" value="0" />
                <label for="0">ID・パスワードを忘れた</label>
        </div>

        <div>
            <input type="radio" id="1" name="why_quit" value="1" />
                <label for="1">サービスに満足できなかった</label>
        </div>

        <div>
            <input type="radio" id="2" name="why_quit" value="2" />
                <label for="2">他のサービスを利用している</label>
        </div>

        <div>
            <input type="radio" id="3" name="why_quit" value="3" />
                <label for="3">使い方がわからないため</label>
        </div>

        <div>
            <input type="radio" id="4" name="why_quit" value="4" />
                <label for="4">サービスを利用しなくなったため</label>
        </div>

        <div>
            <input type="radio" id="5" name="why_quit" value="5" />
                <label for="5">その他</label>
        </div>

        <br>
        <div>上記の詳細または、その他の理由：</div>
        <div>今後のサービス向上のため、退会理由をお聞かせください。</div>

        <textarea name="quit_comment" id="" cols="30" rows="10"></textarea>

        <div class="flex items-center justify-end mt-4">
            <button type="button" onClick="history.back()">戻る</button>

            <x-primary-button class="ms-4">
                {{ __('退会') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        document.querySelectorAll("input[type=radio]").forEach((radio) => {
        radio.addEventListener("click", () => {
          if (radio.classList.contains("is-checked")) {
            radio.classList.remove("is-checked");
            radio.checked = false;
          } else {
            document
              .querySelectorAll("input[type='radio'].is-checked")
              .forEach((checkedRadio) => {
              checkedRadio.classList.remove("is-checked");
            });
            radio.classList.add("is-checked");
          }
        });
    });
    </script>
</x-guest-layout>
