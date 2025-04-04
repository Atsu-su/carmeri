@extends('layouts.base')
@section('title', 'チャット')
@section('modal')
  @include('components.modal')
@endsection
@section('header')
  @include('components.header')
@endsection
@section('content')
  <div id=values
    {{-- $notBuyer:true => 自分が出品者 --}}
    {{-- $notBuyer:false => 自分が購入者 --}}
    {{-- チャット相手の情報を取得したい --}}
    {{-- $purchase->userは購入者の情報／$purchase->item->userは出品者の情報 --}}
    data-purchaseid="{{ $purchase->id }}"
    data-receiverid="{{ $notBuyer ? $purchase->user->id : $purchase->item->user->id }}"
    data-storage="{{ Storage::url('profile_images/') }}"
    data-chatsend="{{ route('chat.send', ['purchase_id' => $purchase->id, 'receiver_id' => $notBuyer ? $purchase->user->id : $purchase->item->user->id]) }}"
    data-chatread="{{ route("chat.read", $purchase->id) }}"
    data-chatupdate="{{ route("chat.update", ":chatid") }}"
    data-chatdelete="{{ route("chat.delete", ":chatid") }}"
    data-transactioncomplete="{{ route('purchase.complete', $purchase->id) }}?notBuyer={{ (int) $notBuyer }}&receiverId={{ $notBuyer ? $purchase->user->id : $purchase->item->user->id }}"
    data-chatsendimage="{{ route('chat.send.image', ['purchase_id' => $purchase->id, 'receiver_id' => $notBuyer ? $purchase->user->id : $purchase->item->user->id]) }}"
    ></div>
  <div id="chat" data-purchaseid="{{ $purchase->id }}" data-receiverid="{{ $notBuyer ? $purchase->user->id : $purchase->item->user->id }}">
    {{-- @if (!$notBuyer) --}}
      <div id="modal" class="modal js-hidden">
        @if (!$notBuyer)
          <form class="modal-content" action="{{ route('user.rating', $purchase->item->user->id) }}" method="POST">
        @else
          <form class="modal-content" action="{{ route('user.rating', $purchase->user->id) }}" method="POST">
        @endif
          @csrf
          <h2 class="modal-content-title">取引が完了しました</h2>
          <p class="modal-content-text">今回の取引相手はいかがでしたか？</p>
          <div id="stars" class="modal-content-stars">
            {{-- <svg class="modal-content-stars-star" data-number="1" width="100" height="100" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            </svg> --}}
            <div class="modal-content-stars-star" data-number="1"></div>
            <div class="modal-content-stars-star" data-number="2"></div>
            <div class="modal-content-stars-star" data-number="3"></div>
            <div class="modal-content-stars-star" data-number="4"></div>
            <div class="modal-content-stars-star" data-number="5"></div>
          </div>
          <input id="modal-input" type="hidden" name="rating" value="">
          <button id="modal-button" class="modal-content-btn c-btn c-btn--modal-send" type="submit" disabled>送信する</a>
        </form>
      </div>
    {{-- @endif --}}
    <div class="container">
      <aside class="sidebar">
        <h3 class="sidebar-title">取引チャット</h3>
        <div class="sidebar-container">
          <div class="sidebar-listed-container">
            <ul class="sidebar-items">
              @foreach ($items as $item)
                <li class="sidebar-items-name"><a href="{{ route('chat', $item->id)}}">{{ $item->item->name }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>

        {{-- 分離バージョン --}}
        {{-- <h3 class="sidebar-title">取引チャット</h3>
        <div class="sidebar-container">
          <div class="sidebar-listed-container">
            <h4 class="sidebar-title-listed">出品</h4>
            <ul class="sidebar-items">
              @foreach ($sellingItems as $item)
                <li class="sidebar-items-name"><a href="{{ route('chat', $item->id)}}">{{ $item->item->name }}</a></li>
              @endforeach
            </ul>
          </div>
          <div class="sidebar-title-processing-container">
            <h4 class="sidebar-title-processing">購入</h4>
            <ul class="sidebar-items">
              @foreach ($purchasingItems as $item)
                <li class="sidebar-items-name"><a href="{{ route('chat', $item->id)}}">{{ $item->item->name }}</a></li>
              @endforeach
            </ul>
          </div>
        </div> --}}
      </aside>
      <div class="chat">
        <form class="chat-title" onclick="return changeStatusWrapper()">
          <div class="chat-title-profile-outer-frame">
            @php
              $profileImage = $notBuyer ? $purchase->user->image : $purchase->item->user->image;
            @endphp
            @if ($profileImage && Storage::exists('profile_images/'.$profileImage))
              <img class="chat-title-profile-inner-frame"
                src="{{ Storage::url('profile_images/').$profileImage }}" alt="プロフィールの画像">
            @else
              <div class="chat-title-profile-no-image">
                <p>NO</p>
                <p>IMAGE</p>
              </div>
            @endif
          </div>
          <h1 class="chat-title-content"><span>{{ $notBuyer ? $purchase->user->name : $purchase->item->user->name }}さんとの</span>取引画面</h1>
          {{-- @if (!$notBuyer) --}}
            <button id="transaction-complete" class="c-btn c-btn--chat-complete-transaction">取引完了</button>
          {{-- @endif --}}
        </form>
        <div class="chat-item">
          @if ($purchase->item->image && Storage::exists('item_images/'.$purchase->item->image))
            <img src="{{ Storage::url('item_images/'.$purchase->item->image) }}" width="200" height="200" alt="">
          @else
            <img class="c-no-image" src="{{ asset('img/'.'no_image.jpg') }}" width="200" height="200" alt="">
          @endif
          <div class="chat-item-info">
            <h2 class="chat-item-info-name">{{ $purchase->item->name}}</h2>
            <p class="chat-item-info-price">¥{{ number_format($purchase->item->price) }}</p>
          </div>
        </div>
        <div class="chat-content">
          <ul>
            {{-- class="chat-content-list right"にすると右に寄る --}}
            @foreach ($chats as $chat)
              <li class="chat-content-list {{ $chat->sender_id != auth()->id() ? 'left' : 'right'}}">
                <div class="chat-content-list-profile">
                  <div class="chat-content-list-profile-outer-frame">
                    @if ($chat->user->image && Storage::exists('profile_images/'.$chat->user->image))
                      <img class="chat-content-list-profile-inner-frame" src="{{ Storage::url('profile_images/').$chat->user->image }}" alt="プロフィールの画像">
                    @else
                      <div class="chat-content-list-profile-no-image">
                        <p>NO</p>
                        <p>IMAGE</p>
                      </div>
                    @endif
                  </div>
                  <p class="chat-content-list-profile-name">{{ $chat->user->name }}</p>
                </div>
                <div class="chat-content-list-container">
                  @if ($chat->is_text && !$chat->is_deleted)
                    <p class="chat-content-list-message" data-chatid="{{ $chat->id }}">{{ $chat->message }}</p>
                  @elseif ($chat->is_text && $chat->is_deleted)
                    <p class="chat-content-list-message deleted" data-chatid="{{ $chat->id }}">このメッセージは削除されました</p>
                  @elseif (!$chat->is_text && !$chat->is_deleted)
                    <img class="chat-content-list-image" src="{{ Storage::url('chat_images/').$chat->message }}" alt="チャットの画像" data-chatid="{{ $chat->id }}">
                  @elseif (!$chat->is_text && $chat->is_deleted)
                    <p class="chat-content-list-image deleted" data-chatid="{{ $chat->id }}">この画像は削除されました</p>
                  @endif
                  <p class="chat-content-list-datetime">{{ $chat->created_at->format('Y/m/d H:i') }}</p>
                  @if ($chat->sender_id == auth()->id() && !$chat->is_deleted)
                    <div class="chat-content-list-edit" data-istext="{{ $chat->is_text }}">
                      @if ($chat->is_text)
                        <a class="chat-content-list-edit-modify">編集</a>
                      @endif
                      <a class="chat-content-list-edit-delete">削除</a>
                    </div>
                  @endif
                </div>
              </li>
            @endforeach
          </ul>
          {{-- メッセージ編集 --}}
          <dialog id="modify" class="chat-content-modal-modify">
            <form id="modify-form">
              @csrf
              <textarea id="modify-textarea" name="modified-message" placeholder="メッセージを入力してください"></textarea>
              <div class="chat-content-modal-modify-buttons">
                <button id="modify-submit" class="c-btn c-btn--modal-edit" type="button">編集</button>
                <a id="modify-cancel" class="c-btn c-btn--modal-edit-cancel">キャンセル</a>
              </div>
            </form>
          </dialog>
          {{-- メッセージ削除 --}}
          <dialog id="delete" class="chat-content-modal-delete">
            <div id="delete-container" class="chat-content-modal-delete-container">
              @csrf
              <p id="delete-p"></p>
              <div class="chat-content-modal-delete-buttons">
                <button id="delete-submit" class="c-btn c-btn--modal-edit" type="button">削除</button>
                <a id="delete-cancel" class="c-btn c-btn--modal-edit-cancel">キャンセル</a>
              </div>
            </div>
          </dialog>
          {{-- 画像削除 --}}
          <dialog id="delete-image" class="chat-content-modal-delete-image">
            <div id="delete-container-image" class="chat-content-modal-delete-container">
              @csrf
              <img id="delete-image-img" src="">
              <div class="chat-content-modal-delete-buttons">
                <button id="delete-submit-image" class="c-btn c-btn--modal-edit" type="button">削除</button>
                <a id="delete-cancel-image" class="c-btn c-btn--modal-edit-cancel">キャンセル</a>
              </div>
            </div>
          </dialog>
          <div class="chat-content-send">
            <p id="validation-error" class=""></p>
            <form id="form" onsubmit="return sendMessageWrapper()">
              @csrf
              <div class="chat-content-send-textarea">
                <textarea id="input" class="chat-content-send-input" type="text" name="message" value="" placeholder="取引メッセージを入力してください"></textarea>
              </div>
              <label id="label" class="c-btn c-btn--chat-add-image" for="img-input">画像を追加</label>
              <input id="img-input" class="chat-content-send-img-input" type="file" name="image" accept="image/*"/>
              <button class="chat-content-send-submit" type="submit"></button>
            </form>
            <dialog id="img-preview" class="chat-content-send-modal">
              <form id="img-preview-form" method="POST" onclick="return sendImageWrapper()">
                <img id="img-preview-img" src="">
                <input id="img-preview-input" type="hidden" name="base64" value=""/>
                <div class="chat-content-send-modal-buttons">
                  <button class="c-btn c-btn--modal-img-preview-send" type="submit">送信</button>
                  <button id="img-preview-cancel" class="c-btn c-btn--modal-img-preview-cancel" type="button">キャンセル</button>
                </div>
              </form>
            </dialog>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- ================================================ --}}
  {{-- bootstrap.jsをコンパイルしたファイル --}}
  {{-- ================================================ --}}
  <script src="{{ mix('js/app.js') }}"></script>

  {{-- ================================================ --}}
  {{-- 共通変数（複数の機能で利用） --}}
  {{-- ================================================ --}}
  <script>
    const cookieName = 'savedText';
    const purchaseId = document.getElementById('values').dataset.purchaseid;
  </script>

  {{-- ================================================ --}}
  {{-- 共通関数（複数の機能で利用） --}}
  {{-- ================================================ --}}
  <script>
    function createUpdateLink(event, link, modifyForm, modifyDialog) {
      event.preventDefault(); // リンクのデフォルト動作を防止

      // クリックされた編集リンクの親要素（chat-content-list-edit）を取得
      const messageContainer = link.parentElement;
      // 親のchat-content-list-containerを取得
      const contentContainer = messageContainer.parentElement;
      // その中のメッセージ要素を取得
      const messageElement = contentContainer.querySelector('.chat-content-list-message');
      // メッセージのテキストを取得
      const messageText = messageElement.textContent;

      // dialogのformにdata-chatidをセット
      const chatId = messageElement.dataset.chatid;
      modifyForm.dataset.chatid = chatId;

      // 編集エリアにメッセージを表示
      const textarea = document.getElementById('modify-textarea');
      textarea.value = messageText;

      // ダイアログを表示
      modifyDialog.showModal();
    }

    function createDeleteLink(event, link, deleteContainer, deleteDialog, isText = 1) {
      event.preventDefault(); // リンクのデフォルト動作を防止

      // クリックされた編集リンクの親要素（chat-content-list-edit）を取得
      const messageContainer = link.parentElement;
      // 親のchat-content-list-containerを取得
      const contentContainer = messageContainer.parentElement;

      let messageElement;
      if (parseInt(isText)) {
        // contentContainerのメッセージ要素を取得
        messageElement = contentContainer.querySelector('.chat-content-list-message');
        const messageText = messageElement.textContent;
        const pragraph = document.getElementById('delete-p');
        pragraph.textContent = messageText;
      } else {

        // contentContainerの画像要素を取得
        messageElement = contentContainer.querySelector('.chat-content-list-image');
        const messageSrc = messageElement.src;
        const image = document.getElementById('delete-image-img');
        image.src = messageSrc;
      }

      console.log('messageElement::' + messageElement);

      // dialogのformにdata-chatidをセット
      const chatId = messageElement.dataset.chatid;
      deleteContainer.dataset.chatid = chatId;

      // ダイアログを表示
      deleteDialog.showModal();
    }

    function scrollToBottom() {
      const chatContent = document.querySelector('.chat-content ul');
      chatContent.scrollTop = chatContent.scrollHeight;
    }

    function scrollToBottomWrapper(isText){
      if (isText) {
        // テキストの場合
        scrollToBottom();
      } else {
        const image = document.querySelector('.chat-content ul li:last-child .chat-content-list-image');
        if (image.complete) {
          // 画像がすでに読み込まれている場合はすぐにスクロール
          scrollToBottom();
        } else {
          // 画像の読み込みを待ってからスクロール
          image.onload = function() {
            scrollToBottom();
          };
          // 画像が読み込めなかった場合のフォールバック
          image.onerror = function() {
            scrollToBottom();
          };
        }
      }
    }

    function renderChat(isLeft, data) {
      const isText = data.isText;
      const ul = document.querySelector('.chat-content ul');
      const li = document.createElement('li');
      li.className = `chat-content-list ${isLeft ? 'left' : 'right'}`;

      // プロフィール部分を作成
      const profileDiv = document.createElement('div');
      profileDiv.className = 'chat-content-list-profile';

      const profileFrameOuter = document.createElement('div');
      profileFrameOuter.className = 'chat-content-list-profile-outer-frame';

      const profileImg = document.createElement('img');
      profileImg.className = 'chat-content-list-profile-inner-frame';

      const storage = document.getElementById('values').dataset.storage;
      profileImg.src = `${storage}${data.image}`;
      profileImg.alt = 'プロフィールの画像';

      const profileName = document.createElement('p');
      profileName.className = 'chat-content-list-profile-name';
      profileName.textContent = data.username;

      // コンテンツ部分を作成
      const contentDiv = document.createElement('div');
      contentDiv.className = 'chat-content-list-container';

      let message;
      // テキストか画像かで分岐
      if (isText) {
        // テキストの場合
        message = document.createElement('p');
        message.className = 'chat-content-list-message';
        message.textContent = data.message;
        message.dataset.chatid = data.chatId;
      } else {
        // 画像の場合
        message = document.createElement('img');
        message.className = 'chat-content-list-image';
        message.src = data.message;
        message.dataset.chatid = data.chatId;
      }

      const datetimeP = document.createElement('p');
      datetimeP.className = 'chat-content-list-datetime';
      datetimeP.textContent = data.datetime;

      // if文に入れるとeditDivは外では使えない
      const editDiv =document.createElement('div');
      editDiv.className = 'chat-content-list-edit';
      if (!isLeft && isText) {
        const editA1 = document.createElement('a');
        editA1.textContent = '編集';
        const editA2 = document.createElement('a');
        editA2.textContent = '削除';
        editDiv.appendChild(editA1);
        editDiv.appendChild(editA2);

        // 編集ボタンにイベントリスナーを付与
        const modifyForm = document.getElementById('modify-form');
        const modifyDialog = document.getElementById('modify');
        editA1.addEventListener('click', function(e) {
          createUpdateLink(e, editA1, modifyForm, modifyDialog);
        });

        // 削除ボタンにイベントリスナーを付与
        const deleteContainer = document.getElementById('delete-container');
        const deleteDialog = document.getElementById('delete');
        editA2.addEventListener('click', function(e) {
          createDeleteLink(e, editA2, deleteContainer, deleteDialog);
        });
      } else if (!isLeft && !isText) {
        const editA2 = document.createElement('a');
        editA2.textContent = '削除';
        editDiv.appendChild(editA2);

        // 削除ボタンにイベントリスナーを付与
        const deleteContainer = document.getElementById('delete-container-image');
        const deleteDialog = document.getElementById('delete-image');
        editA2.addEventListener('click', function(e) {
          createDeleteLink(e, editA2, deleteContainer, deleteDialog, false);
        });
      }

      // 要素を組み立てる
      profileFrameOuter.appendChild(profileImg);
      profileDiv.appendChild(profileFrameOuter);
      profileDiv.appendChild(profileName);

      contentDiv.appendChild(message);
      contentDiv.appendChild(datetimeP);
      if (!isLeft) {
        contentDiv.appendChild(editDiv);
      }

      li.appendChild(profileDiv);
      li.appendChild(contentDiv);

      ul.appendChild(li);
    }
  </script>

  {{-- ================================================ --}}
  {{-- DOM読み込み後の処理 --}}
  {{-- ================================================ --}}
  <script>
    // チャットの受信処理
    window.addEventListener("DOMContentLoaded", () =>
    {
      // purchaseIdは共通変数で定義
      window.Echo.private(`channel.${window.Laravel.user}.${purchaseId}`)
        // .chat-nameでドットが必要
        .listen('.carmeri-chat', (e) => {
          console.log(e.message);
          // メッセージをレンダリング
          renderChat(true, e.message);
          // チャットの既読処理
          read();
          // 最下部にスクロール（テキストと画像）
          scrollToBottomWrapper(e.message.isText);
        });
    });
  </script>

  {{-- ================================================ --}}
  {{-- メッセージ送信 --}}
  {{-- ================================================ --}}
  <script>
    let isSending = false;
    let isSendingImage = false;

    // 受信時のチャネルIDに使用する（window.Laravel.user）
    window.Laravel = {!! json_encode([
        'user' => auth()->check() ? auth()->user()->id : null,
    ]) !!};

    function sendMessage() {
      isSending = true;

      const socketId = Echo.socketId();
      const form = document.getElementById('form');
      const input = document.getElementById('input');
      const data = new FormData(form);
      const error = document.getElementById('validation-error');
      const url = document.getElementById('values').dataset.chatsend;

      fetch(url, {
        method: 'POST',
        body: data,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'X-Socket-ID': socketId
        }
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(errorData => {
            const error = new Error('Network response was not ok or validation error');
            error.data = errorData;
            throw error;
          });
        }
        return response.json();
      })
      .then(data => {
        // 送信したチャットの表示
        renderChat(false, data);
        // 入力フィールドをクリア
        input.value = '';
        // バリデーションエラーメッセージをクリア
        hideError();
        // 入力フィールドの幅を初期化
        adjustHeight();
        // 保存された入力値の削除
        deleteSavedTextCookie(cookieName, purchaseId);
        // 一番下までスクロール
        scrollToBottom();
        // 送信中フラグを変更（送信可能）
        isSending = false;
      })
      .catch(error => {
        // バリデーションエラーメッセージを表示
        displayError(error.data.errors.message[0]);
        isSending = false;
      });

      return false;
    }

    function sendImage(){
      isSendingImage = true;

      const socketId = Echo.socketId();
      const previewDialog = document.getElementById('img-preview');
      const imgPreview = document.getElementById('img-preview-img');
      const imgPreviewInput = document.getElementById('img-preview-input');
      const form = document.getElementById('img-preview-form');
      const input = document.getElementById('img-preview-input');
      const data = new FormData(form);
      const url = document.getElementById('values').dataset.chatsendimage;

      fetch(url, {
        method: 'POST',
        body: data,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'X-Socket-ID': socketId
        }
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(errorData => {
            const error = new Error('Network response was not ok or validation error');
            error.data = errorData;
            throw error;
          });
        }
        return response.json();
      })
      .then(data => {
        // 送信したチャットの表示
        renderChat(false, data);
        // バリデーションエラーメッセージをクリア
        hideError();
        imgPreview.src = '';
        imgPreviewInput.value = '';
        previewDialog.close();
        isSendingImage = false;
        // 画像が読み込まれたらスクロール
        scrollToBottomWrapper(data.isText);
      })
      .catch(error => {
        displayError(error.data.errors.image[0]);
        imgPreview.src = '';
        imgPreviewInput.value = '';
        previewDialog.close();
        isSendingImage = false;
      });

      return false;
    }

    // バリデーションエラーメッセージの表示
    function displayError(message) {
      const error = document.getElementById('validation-error');
      error.classList.add('c-error-message-top');
      error.textContent = message;
    }

    // バリデーションエラーメッセージの削除
    function hideError(message) {
      const error = document.getElementById('validation-error');
      error.classList.remove('c-error-message-top');
      error.textContent = '';
    }

    function sendMessageWrapper() {
      if (!isSending) {
        sendMessage();
      }
      return false;
    }

    function sendImageWrapper(){
      if (!isSendingImage) {
        sendImage();
      }
      return false;
    }

    function read() {
      const url = document.getElementById('values').dataset.chatread;
      fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
      })
      .catch(error => {
        console.log('Error:', error);
      });
    }

    // 改行された場合に高さを調節するように修正する
    const textarea = document.querySelector('.chat-content-send-input');
    function adjustHeight() {
      textarea.style.height = 'auto';
      textarea.style.height = textarea.scrollHeight + 'px';
    }

    function deleteSavedTextCookie(cookieName, id) {
      document.cookie = `${cookieName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/chat/${id}`;
    }

    // -----------------------
    // イベント定義
    // -----------------------
    // 入力時に高さ調整
    textarea.addEventListener('input', adjustHeight);
    // 初期化
    adjustHeight();
  </script>

  {{-- ================================================ --}}
  {{-- メッセージ修正 --}}
  {{-- ================================================ --}}
  <script>
    let isModifying = false;

    function modifyMessage(chatId) {
      isModifying = true;
      // 文字列は参照ではない
      let baseUrl = document.getElementById('values').dataset.chatupdate;
      let url = baseUrl.replace(':chatid', chatId);
      const form = document.getElementById('modify-form');
      const textarea = document.getElementById('modify-textarea');
      const data = new FormData(form);

      // フォームの内容を送信する処理
      if (!textarea.value) {
        isModifying = false;
        return false;
      }

      fetch(url, {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        method: 'POST',
        body: data,
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // 修正したチャットの表示
        modifyChatContent(data.chatId, data.modifiedMessage);
        // 送信中フラグを下げる
        isModifying = false;
      })
      .catch(error => {
        isModifying = false;
        console.log('Error:', error);
      });

      return false;
    }

    function modifyMessageWrapper(chatId) {
      if (!isModifying) {
        modifyMessage(chatId);
      }
      return false;
    }

    function modifyChatContent(chatId, modifiedMessage) {
      const messageElement = document.querySelector(`.chat-content-list-message[data-chatid="${chatId}"]`);
      messageElement.textContent = modifiedMessage;
    }

    // -----------------------
    // イベント定義
    // -----------------------
    document.addEventListener('DOMContentLoaded', function() {
      const modifyDialog = document.getElementById('modify');
      const modifyForm = document.getElementById('modify-form');

      // dialog内の編集ボタンのイベント
      const updateSubmit = document.getElementById('modify-submit');
      updateSubmit.addEventListener('click', function() {
        // id=valueには入れられない（$chats as $chat）
        const chatId = modifyForm.dataset.chatid;
        modifyMessageWrapper(chatId);
        modifyDialog.close();
      });

      // dialog内のキャンセルボタンのイベント
      const cancel = document.getElementById('modify-cancel');
      cancel.addEventListener('click', function() {
        modifyDialog.close();
      });

      // すべての編集リンクを取得
      const modifyLinks = document.querySelectorAll('.chat-content-list-edit-modify');
      modifyLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
          createUpdateLink(e, link, modifyForm, modifyDialog);
        });
      });
    });
  </script>

  {{-- ================================================ --}}
  {{-- メッセージ削除 --}}
  {{-- ================================================ --}}
  <script>
    let isDeleting = false;

    function deleteMessage(chatId) {
      isDeleting = true;
      let baseUrl = document.getElementById('values').dataset.chatdelete;
      let url = baseUrl.replace(':chatid', chatId);

      // DELETEとして処理してほしいPOSTリクエストを送信
      fetch(url, {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        method: 'POST',
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json()
      })
      .then(data => {
        // 削除したチャットの表示を変更
        deleteChatContent(data.chatId, data.isText);
        // 送信中フラグを下げる
        isDeleting = false;
      })
      .catch(error => {
          isDeleting = false;
          console.error('Error:', error)
        }
      );

      return false;
    }

    function deleteMessageWrapper(chatId) {
      if (!isDeleting) {
        deleteMessage(chatId);
      }
      return false;
    }

    // 削除されたメッセージの表示を変更
    function deleteChatContent(chatId, isText = 1) {
      let targetMessage;
      if (parseInt(isText)) {
        // テキストの場合
        targetMessage = document.querySelector(`.chat-content-list-message[data-chatid="${chatId}"]`);
      } else {
        // 画像の場合
        targetMessage = document.querySelector(`.chat-content-list-image[data-chatid="${chatId}"]`);
      }

      // 対象の要素の親要素を取得
      const parentElement = targetMessage.parentElement;

      // 削除後のメッセージを作成
      const deletedMessage = document.createElement('p');
      deletedMessage.className = 'chat-content-list-message deleted';
      deletedMessage.setAttribute('data-chatid', chatId);

      if (parseInt(isText)) {
        deletedMessage.textContent = 'このメッセージは削除されました';
      } else {
        deletedMessage.textContent = 'この画像は削除されました';
      }

      // 削除対象のメッセージを置き換える
      parentElement.replaceChild(deletedMessage, targetMessage);

      // 編集・削除ボタンを削除
      const targetEditors = parentElement.querySelector('.chat-content-list-edit');
      parentElement.removeChild(targetEditors);
    }

    // -----------------------
    // イベント定義
    // -----------------------
    document.addEventListener('DOMContentLoaded', function() {
      const deleteDialog = document.getElementById('delete');
      const deleteImageDialog = document.getElementById('delete-image');
      const deleteContainer = document.getElementById('delete-container');
      const deleteContainerImage = document.getElementById('delete-container-image');

      // dialog内の削除ボタンのイベント（テキスト）
      const deleteSubmit = document.getElementById('delete-submit');
      deleteSubmit.addEventListener('click', function() {
        const chatId = deleteContainer.dataset.chatid;
        deleteMessageWrapper(chatId);
        deleteDialog.close();
      });

      // dialog内の削除ボタンのイベント（画像）
      const deleteSubmitImage = document.getElementById('delete-submit-image');
      deleteSubmitImage.addEventListener('click', function() {
        const chatId = deleteContainerImage.dataset.chatid;
        deleteMessageWrapper(chatId);
        deleteImageDialog.close();
      });

      // dialog内のキャンセルボタンのイベント
      const cancel = document.getElementById('delete-cancel');
      cancel.addEventListener('click', function() {
        deleteDialog.close();
      });

      const cancelImage = document.getElementById('delete-cancel-image');
      cancelImage.addEventListener('click', function() {
        deleteImageDialog.close();
      });

      const deleteLinks = document.querySelectorAll('.chat-content-list-edit-delete');
      deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
          linkParent = link.parentElement;
          const isText = link.parentElement.dataset.istext;
          if (parseInt(isText)) {
            // テキストの場合
            createDeleteLink(e, link, deleteContainer, deleteDialog, isText);
          } else {
            // 画像の場合
            createDeleteLink(e, link, deleteContainerImage, deleteImageDialog, isText);
          }
        });
      });
    });
  </script>

  {{-- ================================================ --}}
  {{-- 入力したメッセージのクッキーへの保存 --}}
  {{-- ================================================ --}}
  <script>
    // textareaの値をCookieに保存する関数
    function saveTextAreaToCookie(textarea, cookieName, id, expirationHours = 1) {
        // 入力値を取得
        const value = textarea.value;

        // Cookieの有効期限を設定
        const date = new Date();
        date.setTime(date.getTime() + (expirationHours * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();

        // Cookieに保存（エスケープして保存）
        document.cookie = `${cookieName}=${encodeURIComponent(value)};${expires};path=/chat/${id}`;
    }

    // Cookieからtextareaの値を取得して設定する関数
    function loadTextAreaFromCookie(textarea, cookieName) {
        // Cookieから値を取得
        const value = getCookie(cookieName);

        // textareaに値をセット
        if (value) {
            textarea.value = decodeURIComponent(value);
        }
    }

    // 指定したCookieの値を取得する関数
    function getCookie(name) {
        const cookieName = name + "=";
        const cookies = document.cookie.split(';');

        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            if (cookie.indexOf(cookieName) === 0) {
                return cookie.substring(cookieName.length, cookie.length);
            }
        }
        return "";
    }

    document.addEventListener('DOMContentLoaded', function() {
      // cookieName, purchaseIdは共通変数として定義
      const textarea = document.getElementById('input');

      // ページ読み込み時にCookieから値を復元
      loadTextAreaFromCookie(textarea, cookieName);

      // textareaの入力内容が変更されたらCookieに保存
      textarea.addEventListener('input', function() {
          saveTextAreaToCookie(textarea, cookieName, purchaseId);
      });
    });
  </script>

  {{-- ================================================ --}}
  {{-- 評価 --}}
  {{-- ================================================ --}}
  <script>
    let isChangeStatusSending = false;

    function showRatingModal() {
      const modal = document.getElementById('modal');
      modal.classList.remove('js-hidden');
    }

    function changeStatus(){
      isChangeStatusSending = true;
      const url = document.getElementById('values').dataset.transactioncomplete;

      fetch(url, {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        method: 'POST',
      })
      .then(response => {
        if (!response.ok) {
          // throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log(data)
        isChangeStatusSending = false;
        showRatingModal();
      })
      .catch(error => {
        isChangeStatusSending = false;
        console.log('Error:', error);
      });

      return false;
    }

    function changeStatusWrapper() {
      if (!isChangeStatusSending) {
        changeStatus();
      }
      return false;
    }

    // 評価モーダルの表示設定
    const stars = document.querySelectorAll('.modal-content-stars-star');
    stars.forEach(star => {
      // マウスオーバー時の処理
      star.addEventListener('mouseover', function(e) {
        const number = parseInt(this.dataset.number);
        for (let i = 0; i < number; i++) {
          stars[i].classList.add('filled');
        }
      });

      // マウスクリック時の処理
      star.addEventListener('click', function(e) {
        const rating = parseInt(this.dataset.number);
        const input = document.getElementById('modal-input');

        // 一旦全て削除
        stars.forEach(star => {
          star.classList.remove('clicked');
        });

        for (let i = 0; i < rating; i++) {
          stars[i].classList.add('clicked');
        }

        input.value = rating;

        const button = document.getElementById('modal-button');
        button.disabled = false;
      });

      // マウスアウト時の処理
      star.addEventListener('mouseout', (e) => {
        stars.forEach(star => {
          star.classList.remove('filled');
        });
      });
    });
  </script>

  {{-- ================================================ --}}
  {{-- 画像プレビュー --}}
  {{-- ================================================ --}}
  <script>
    // DOM読み込み後に実行する
    function previewImage(e){
      const previewDialog = document.getElementById('img-preview');
      const imgPreview = document.getElementById('img-preview-img');
      const imgPreviewInput = document.getElementById('img-preview-input');
      const file = e.target.files[0];

      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        // ロード後の処理
        reader.onload = function(e) {
          imgPreview.src = e.target.result;
          imgPreviewInput.value = e.target.result;
          previewDialog.showModal();
        }
        reader.readAsDataURL(file);
      }
    }

    function closeModal() {
      const imgPreview = document.getElementById('img-preview-img');
      const imgPreviewInput = document.getElementById('img-preview-input');
      const previewDialog = document.getElementById('img-preview');

      // データを削除後モーダルを閉じる
      imgPreview.src = '';
      imgPreviewInput.value = '';
      previewDialog.close();
    }

    // -----------------------
    // イベント定義
    // -----------------------
    document.getElementById('img-input').addEventListener('change', previewImage);
    document.getElementById('img-preview-cancel').addEventListener('click', closeModal);

  </script>

  {{-- ================================================ --}}
  {{-- 画像拡大表示 --}}
  {{-- ================================================ --}}
  <script>
  document.querySelectorAll('.chat-content-list-image').forEach(image => {
    image.addEventListener('click', function() {
      displayImageModal(this.src);
    });
  });

  function displayImageModal(src) {
    // const modal = document.getElementById('image-modal');
    // const img = document.getElementById('image-modal-img');
    // img.src = src;
    // modal.showModal();
  }
  </script>
@endsection