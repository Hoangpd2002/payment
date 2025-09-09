<div style="text-align: center;">
    <img src="{{ $qr }}" alt="VietQR" style="max-width: 300px;"/>
    <h3>Thông tin chuyển khoản</h3>
    <p><strong>Ngân hàng:</strong> {{ $bank }}</p>
    <p><strong>Số tài khoản:</strong> {{ $account }}</p>
    <p><strong>Chủ tài khoản:</strong> {{ $name }}</p>
    <p><strong>Số tiền:</strong> {{ number_format($amount) }} VND</p>
    <p><strong>Nội dung:</strong> {{ $memo }}</p>
</div>