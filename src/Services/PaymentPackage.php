<?php

namespace payment_package\PaymentPackage;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use payment_package\PaymentPackage\Support\Crc16;
use payment_package\PaymentPackage\Support\Tlv;

class PaymentPackage
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function payload(
        string $acqId,
        string $accountNo,
        ?int $amount = null,
        string $note = '',
        bool $isDynamic = false
    ): string {
        $root = [Tlv::pack('00', '01')]; // payload format
        $root[] = Tlv::pack('01', $isDynamic ? '22' : '11');

        // Merchant Account Info (38)
        $mai = [
            Tlv::pack('00', 'A000000727'),
            Tlv::pack('01', $acqId),
            Tlv::pack('02', $accountNo),
            Tlv::pack('08', 'QRIBFTTA'),
        ];
        $root[] = Tlv::packList('38', $mai);

        $root[] = Tlv::pack('53', '704'); // currency VNĐ

        if (! is_null($amount)) {
            $root[] = Tlv::pack('54', (string) $amount);
        }

        $root[] = Tlv::pack('58', 'VN');

        if ($note !== '') {
            $root[] = Tlv::packList('62', [
                Tlv::pack('08', mb_substr($note, 0, 25, 'UTF-8')),
            ]);
        }

        $withoutCrc = implode('', $root).'6304';
        $crc = Crc16::of($withoutCrc);

        return $withoutCrc.$crc;
    }

    public function payloadFromConfig(?int $amount = null, string $note = '', ?bool $isDynamic = null): string
    {
        $acqId = $this->config['acq_id'] ?? '';
        $accountNo = $this->config['account_no'] ?? '';
        $staticQr = $this->config['static_qr'] ?? true; // fallback mặc định true

        $isDyn = $isDynamic ?? ($staticQr === false);

        return $this->payload($acqId, $accountNo, $amount, $note, $isDyn);
    }

    public function png(string $payload, int $size = 300): string
    {
        $result = Builder::create()
            ->data($payload)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh)
            ->size($size)
            ->margin(10)
            ->build();

        return $result->getString(); // binary PNG
    }
}
