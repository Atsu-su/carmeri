<div class="mb-4 text-sm text-gray-600">
  メールアドレスの確認が必要です。確認メールをご確認ください。

  @if (session('status') == 'verification-link-sent')
    <div class="mt-4 text-sm text-green-600">
      新しい確認メールを送信しました。
    </div>
  @endif
</div>

<div class="mt-4 flex items-center justify-between">
  <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">
      確認メールを再送信
    </button>
  </form>

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">
      ログアウト
    </button>
  </form>
</div>