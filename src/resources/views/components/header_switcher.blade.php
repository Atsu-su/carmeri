@if (isset($headerType) && $headerType === 'logIn')
    @include('components.header', ['type' => 'ログイン'])
@elseif (isset($headerType) && $headerType === 'logOut')
    @include('components.header', ['type' => 'ログアウト'])
@else
    @include('components.header_only_logo')
@endif