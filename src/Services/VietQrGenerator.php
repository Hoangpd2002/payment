<?php

namespace hoangpd\payment\Services;

use Illuminate\View\View;

class VietQrGenerator
{
    /**
     * Render URL payment following VietQR Quicklink format
     *
     * @param  mixed  $template
     * @param  mixed  $amount
     */
    public function getUrlPayment(array $data): string
    {
        $base = rtrim(config('vietqr.quicklink_base'), '/');
        $tpl = $data['template'] ?: config('vietqr.default_template', 'compact');

        $url = "{$base}/{$data['bankId']}-{$data['accountNo']}-{$tpl}.jpg";

        $params = [];
        if (! empty($data['amount'])) {
            $params['amount'] = $data['amount'];
        }
        if (! empty($data['addInfo'])) {
            $params['addInfo'] = $data['addInfo'];
        }
        if (! empty($data['accountName'])) {
            $params['accountName'] = $data['accountName'];
        }

        if (! empty($params)) {
            $url .= '?'.http_build_query($params);
        }

        return $url;
    }

    /**
     * Render QR code view
     *
     * @param  mixed  $template
     * @param  mixed  $amount
     */
    public function renderQrCode(array $data): View
    {
        $url = $this->getUrlPayment($data);

        return view('payment::qr', compact('url', 'data'));
    }
}
