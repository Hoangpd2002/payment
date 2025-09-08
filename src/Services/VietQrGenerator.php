<?php

namespace Hoangpd\Payment\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class VietQrGenerator
{
    /**
     * Tạo mã QR VietQR
     *
     * @param  array  $options
     *                          - bin: Mã BIN ngân hàng (ví dụ: 970415 cho Vietcombank)
     *                          - account: Số tài khoản hoặc số thẻ
     *                          - name: Tên chủ tài khoản
     *                          - amount: Số tiền (integer hoặc string)
     *                          - content: Nội dung chuyển khoản
     */
    public function generate(array $options): string
    {
        $bin = $options['bin'] ?? '970415';
        $account = $options['account'] ?? '0123456789';
        $name = strtoupper($options['name'] ?? 'NGUYEN VAN A');
        $amount = $options['amount'] ?? null;
        $content = $options['content'] ?? 'Thanh toan don hang';

        // ------------------------
        // Build VietQR payload
        // ------------------------
        $payload = $this->format('00', '01')                           // Version
                 .$this->format('01', '12')                           // QR Type
                 .$this->format('38',
                     $this->format('00', 'A000000727')              // AID
                      .$this->format('01', '11')                      // Service ID
                      .$this->format('02', $bin)                      // BIN
                      .$this->format('03', $account)                  // Account
                 )
                 .$this->format('52', 'QRIB')                         // Merchant category
                 .$this->format('53', '704')                          // Currency (704 = VND)
                 .($amount ? $this->format('54', (string) $amount) : '') // Amount
                 .$this->format('58', 'VN')                           // Country
                 .$this->format('59', $name)                          // Account name
                 .$this->format('62',
                     $this->format('01', $content)                  // Nội dung chuyển khoản
                 );

        // Append CRC (chưa tính CRC thật, chỉ demo)
        $payload .= '6304ABCD';

        // ------------------------
        // Sinh ảnh QR
        // ------------------------
        $result = Builder::create()
            ->writer(new PngWriter)
            ->data($payload)
            ->size(300)
            ->margin(10)
            ->build();

        return 'data:image/png;base64,'.base64_encode($result->getString());
    }

    /**
     * Helper: định dạng TLV (ID + Length + Value)
     */
    private function format(string $id, string $value): string
    {
        $length = str_pad((string) strlen($value), 2, '0', STR_PAD_LEFT);

        return $id.$length.$value;
    }
}
