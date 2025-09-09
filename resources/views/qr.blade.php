<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4" style="max-width: 750px;">
    <!-- Header chứng từ -->
    <div class="row mb-3 border-bottom pb-2">
        <div class="col">
            <small class="text-muted d-block">Mã đơn hàng</small>
            <strong>{{ $data['id'] }}</strong>
        </div>
        <div class="col">
            <small class="text-muted d-block">Ngày</small>
            <strong>{{ now()->format('d/m/Y') }}</strong>
        </div>
        <div class="col">
            <small class="text-muted d-block">Phòng/Đơn vị</small>
            <strong>{{ number_format($data['amount']) }} VND</strong>
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
            <img src="{{ $url }}" alt="VietQR" style="max-width: 300px;">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                    <tr>
                        <th>Ngân hàng</th>
                        <td>{{ $data['bankName'] }}</td>
                    </tr>
                    <tr>
                        <th>Số tài khoản</th>
                        <td>{{ $data['accountNo'] }}</td>
                    </tr>
                    <tr>
                        <th>Chủ tài khoản</th>
                        <td>{{ $data['accountName'] }}</td>
                    </tr>
                    <tr>
                        <th>Số tiền</th>
                        <td class="text-danger fw-bold">{{ number_format($data['amount']) }} VND</td>
                    </tr>
                    <tr>
                        <th>Nội dung</th>
                        <td>{{ $data['addInfo'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer text-center text-muted small">
            ⚠️ Vui lòng chuyển khoản đúng nội dung để hệ thống xác nhận tự động.
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
