@extends('layouts.base')
@section('title', 'チャット')
@section('modal')
  @include('components.modal')
@endsection
@section('header')
  @include('components.header')
@endsection
@section('content')

  <div id="chat">
    @if (false)
      <div class="modal">
        <div class="modal-content">
          <h2 class="modal-content-title">取引が完了しました</h2>
          <p class="modal-content-text">今回の取引相手はいかがでしたか？</p>
          <div id="stars" class="modal-content-stars">
            <svg class="modal-content-stars-star" data-number="1" width="100" height="100" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 0L24.4903 13.8197H39.0211L27.2654 22.3607L31.7557 36.1803L20 27.6393L8.2443 36.1803L12.7346 22.3607L0.97887 13.8197H15.5097L20 0Z"/>
            </svg>
            <svg class="modal-content-stars-star" data-number="2" width="100" height="100" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 0L24.4903 13.8197H39.0211L27.2654 22.3607L31.7557 36.1803L20 27.6393L8.2443 36.1803L12.7346 22.3607L0.97887 13.8197H15.5097L20 0Z"/>
            </svg>
            <svg class="modal-content-stars-star" data-number="3" width="100" height="100" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 0L24.4903 13.8197H39.0211L27.2654 22.3607L31.7557 36.1803L20 27.6393L8.2443 36.1803L12.7346 22.3607L0.97887 13.8197H15.5097L20 0Z"/>
            </svg>
            <svg class="modal-content-stars-star" data-number="4" width="100" height="100" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 0L24.4903 13.8197H39.0211L27.2654 22.3607L31.7557 36.1803L20 27.6393L8.2443 36.1803L12.7346 22.3607L0.97887 13.8197H15.5097L20 0Z"/>
            </svg>
            <svg class="modal-content-stars-star" data-number="5" width="100" height="100" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 0L24.4903 13.8197H39.0211L27.2654 22.3607L31.7557 36.1803L20 27.6393L8.2443 36.1803L12.7346 22.3607L0.97887 13.8197H15.5097L20 0Z"/>
            </svg>
          </div>
          <a class="modal-content-btn c-btn c-btn--modal-send" href="">送信する</a>
        </div>
      </div>
    @endif
    <div class="container">
      <aside class="sidebar">
        <h3 class="sidebar-title">その他の取引</h3>
        <div class="sidebar-container">
          <div class="sidebar-listed-container">
            <h4 class="sidebar-title-listed">出品</h4>
            <ul class="sidebar-items">
              <li class="sidebar-items-name"><a href="">商品名１</a></li>
              <li class="sidebar-items-name"><a href="">商品名２</a></li>
              <li class="sidebar-items-name"><a href="">商品名３</a></li>
            </ul>
          </div>
          <div class="sidebar-title-processing-container">
            <h4 class="sidebar-title-processing">購入</h4>
            <ul class="sidebar-items">
              <li class="sidebar-items-name"><a href="">商品名A</a></li>
              <li class="sidebar-items-name"><a href="">商品名B</a></li>
              <li class="sidebar-items-name"><a href="">商品名C</a></li>
            </ul>
          </div>
        </div>
      </aside>
      <div class="chat">
        <div class="chat-title">
          <div class="chat-title-profile-outer-frame">
            @if ($user->image && Storage::disk('public')->exists('profile_images/'.$user->image))
              <img class="chat-title-profile-inner-frame" src="{{ asset('storage/profile_images/'.$user->image) }}" alt="プロフィールの画像">
            @else
              <div class="chat-title-profile-no-image">
                <p>NO</p>
                <p>IMAGE</p>
              </div>
            @endif
          </div>
          <h1 class="chat-title-content">「購入者 or 出品者」さんとの取引画面</h1>
          <a class="c-btn c-btn--chat-complete-transaction" href="">取引完了</a>
        </div>
        <div class="chat-item">
          <img src="{{ Storage::disk('public')->url('item_images/'.$purchasedItems->item->image) }}" width="200" height="200" alt="">
          <div class="chat-item-info">
            <h2 class="chat-item-info-name">商品名</h2>
            <p class="chat-item-info-price">¥6,000</p>
          </div>
        </div>
        <div class="chat-content">
          <ul>
            {{-- class="chat-content-list right"にすると右に寄る --}}
            <li class="chat-content-list">
              <div class="chat-content-list-profile">
                <div class="chat-content-list-profile-outer-frame">
                  @if ($user->image && Storage::disk('public')->exists('profile_images/'.$user->image))
                    <img class="chat-content-list-profile-inner-frame" src="{{ asset('storage/profile_images/'.$user->image) }}" alt="プロフィールの画像">
                  @else
                    <div class="chat-content-list-profile-no-image">
                      <p>NO</p>
                      <p>IMAGE</p>
                    </div>
                  @endif
                </div>
                <p class="chat-content-list-profile-name">{{ $user->name }}</p>
              </div>
              <div class="chat-content-list-container">
                <p class="chat-content-list-message">ここにメッセージがはいる</p>

                {{-- この部分はsenderだけに表示されるように変更する --}}
                <div class="chat-content-list-message-container">
                  <a>編集</a>
                  <a>削除</a>
                </div>

              </div>
            </li>
            <li class="chat-content-list">
              <div class="chat-content-list-profile">
                <div class="chat-content-list-profile-outer-frame">
                  @if (!$user->image && Storage::disk('public')->exists('profile_images/'.$user->image))
                    <img class="chat-content-list-profile-inner-frame" src="{{ asset('storage/profile_images/'.$user->image) }}" alt="プロフィールの画像">
                  @else
                    <div class="chat-content-list-profile-no-image">
                      <p>NO</p>
                      <p>IMAGE</p>
                    </div>
                  @endif
                </div>
                <p class="chat-content-list-profile-name">{{ $user->name }}</p>
              </div>
              <div class="chat-content-list-container">
                <p class="chat-content-list-message">ここにメッセージがはいるああああああああああああああああ</p>
                <div class="chat-content-list-message-container">
                  <a>編集</a>
                  <a>削除</a>
                </div>
              </div>
            </li>
            <li class="chat-content-list right">
              <div class="chat-content-list-profile">
                <div class="chat-content-list-profile-outer-frame">
                  @if (!$user->image && Storage::disk('public')->exists('profile_images/'.$user->image))
                    <img class="chat-content-list-profile-inner-frame" src="{{ asset('storage/profile_images/'.$user->image) }}" alt="プロフィールの画像">
                  @else
                    <div class="chat-content-list-profile-no-image">
                      <p>NO</p>
                      <p>IMAGE</p>
                    </div>
                  @endif
                </div>
                <p class="chat-content-list-profile-name">{{ $user->name }}</p>
              </div>
              <div class="chat-content-list-container">
                <p class="chat-content-list-message">http://aaa.com/abccccccccc/ccc/c/c/c/cccccccccccccccccc</p>
                <div class="chat-content-list-message-container">
                  <a>編集</a>
                  <a>削除</a>
                </div>
              </div>

            </li>
          </ul>
          <div class="chat-content-send">
            <form action="" method="">
              <input class="chat-content-send-input" type="text" placeholder="取引メッセージを入力してください">
              <button class="chat-content-send-add-image c-btn c-btn--chat-add-image">画像を追加</button>
              <button class="chat-content-send-submit" type="submit"></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const stars = document.querySelectorAll('.modal-content-stars-star');
    stars.forEach(star => {
      star.addEventListener('mouseover', (e) => {
        const number = parseInt(star.dataset.number);
        for (let i = 0; i < number; i++) {
          stars[i].classList.add('filled');
        }
      });

      star.addEventListener('click', (e) => {
        const number = parseInt(star.dataset.number);

        // クエリパラメータにnumberの値をいれる
        // ?number=numberとする

        stars.forEach(star => {
          star.classList.remove('clicked');
        });

        for (let i = 0; i < number; i++) {
          stars[i].classList.add('clicked');
        }
      });

      star.addEventListener('mouseout', (e) => {
        stars.forEach(star => {
          star.classList.remove('filled');
        });
      });
    });
  </script>
@endsection