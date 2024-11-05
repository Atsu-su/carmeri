<div id="header">
  <img class="logo" src="{{ asset('img/logo.svg') }}" alt="carmeriのロゴ">
  @if (request()->headerType == 'logOut' || request()->headerType == 'logIn')
    <form class="search" action="">
      <input class="search-input" type="text" placeholder="なにをお探しですか？">
    </form>
    <nav class="nav">
      @if (request()->headerType == 'logOut')
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button class="nav-link" type="submit">ログアウト</button>
        </form>
      @else
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      @endif
      <a class="nav-link" href="">マイページ</a>
      <a class="nav-btn c-btn c-btn--header" href="">出品</a>
    </nav>
    <nav class="nav-small">
      <div id="svg" class="nav-small-svg"></div>
      <div id="menu" class="nav-small-menu js-hidden">
        @if (request()->headerType == 'logOut')
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="nav-link" type="submit">ログアウト</button>
          </form>
        @else
          <a class="nav-link" href="{{ route('login') }}">ログイン</a>
        @endif
        <a class="nav-small-menu-link" href="">マイページ</a>
        <a class="nav-small-menu-btn c-btn c-btn--header-small" href="">出品</a>
      </div>
    </nav>
  @endif
</div>
<script>
  const svg = document.getElementById('svg');
  const menu = document.getElementById('menu');

  svg.addEventListener('click', () => {
    if (menu.classList.contains('js-hidden')) {
      menu.classList.remove('js-hidden');
    } else {
      menu.classList.add('js-hidden');
    }
  });
</script>
<script>
  // エンターを押すとsubmitされる機能を実装
</script>