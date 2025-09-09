<div class="container mt-4" style="max-width: 750px;">
    <!-- Header chứng từ -->
    <div class="row mb-3 border-bottom pb-2">
        <div class="col">
            <small class="text-muted d-block">Mã đơn hàng</small>
            <strong>{{ $id }}</strong>
        </div>
        <div class="col">
            <small class="text-muted d-block">Ngày</small>
            <strong>{{ now()->format('d/m/Y') }}</strong>
        </div>
        <div class="col">
            <small class="text-muted d-block">Phòng/Đơn vị</small>
            <strong>{{ number_format($amount) }} VND<</strong>
        </div>
        <div class="col">
            <small class="text-muted d-block">Phương thức thanh toán</small>
            <strong>Chuyển khoản ngân hàng (Quét mã QR)</strong>
        </div>
    </div>

    <!-- Thân thẻ VietQR -->
    <div class="card shadow-sm">
        <div class="card-header text-center bg-light">
            <h5 class="mb-1">Mã QR chuyển khoản ngân hàng</h5>
            <img src="https://vietqr.net/Content/img/logo-vietqr.png" alt="VietQR" height="40">
        </div>

        <div class="card-body text-center">
            <img src="{{ $qr }}" alt="VietQR" class="img-fluid border p-2 rounded" style="max-width: 250px;">
            <div class="mt-2">
                <img src="https://vietqr.net/Content/img/logo-napas.png" alt="napas" height="25" class="me-2">
                <img src="https://img.vietqr.io/image/{{ strtolower($bank) }}-logo.png" alt="bank" height="25">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                    <tr>
                        <th>Ngân hàng</th>
                        <td>{{ $bank }}</td>
                    </tr>
                    <tr>
                        <th>Số tài khoản</th>
                        <td>{{ $account }}</td>
                    </tr>
                    <tr>
                        <th>Chủ tài khoản</th>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr>
                        <th>Số tiền</th>
                        <td class="text-danger fw-bold">{{ number_format($amount) }} VND</td>
                    </tr>
                    <tr>
                        <th>Nội dung</th>
                        <td>{{ $memo }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer text-center text-muted small">
            Vui lòng chuyển khoản đúng nội dung để hệ thống xác nhận tự động.
        </div>
    </div>
</div>
