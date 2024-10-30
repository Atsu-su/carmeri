<div id="header">
  <img class="logo" src="{{ asset('img/logo.svg') }}" alt="carmeriのロゴ">
  <form class="search" action="">
    <input class="search-input" type="text" placeholder="なにをお探しですか？">
  </form>
  <nav class="nav">
    <a class="nav-link" href="">{{ $type }}</a>
    <a class="nav-link" href="">マイページ</a>
    <a class="nav-btn c-btn c-btn--header" href="">出品</a>
  </nav>
  <nav class="nav-small">
    <div id="svg" class="nav-small-svg"></div>
    <div id="menu" class="nav-small-menu js-hidden">
      <a class="nav-small-menu-link" href="">{{ $type }}</a>
      <a class="nav-small-menu-link" href="">マイページ</a>
      <a class="nav-small-menu-btn c-btn c-btn--header-small" href="">出品</a>
    </div>
  </nav>
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