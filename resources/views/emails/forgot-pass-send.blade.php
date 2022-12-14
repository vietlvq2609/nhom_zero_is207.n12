<div style="width:600px; margin:0 auto">
    <div style="text-align:center">
        <h2>Xin chào {{ $user->name }}</h2>
        <p>Zero Food gủi email này để giúp bạn lấy lại mật khẩu đã mất</p>
        <p>Vui lòng click vào nút bên dưới để bắt đầu lấy lại mật khẩu</p>
        <p>
            <a style="display:inline-block; background: orange; color: #000; padding:7px 25px; font-weight:bold"
            href="{{ route('password.reset', ['user' => $user->id, 'token' => $user->remember_token]) }}">Lấy lại mật khẩu</a>
        </p>
    </div>
</div>