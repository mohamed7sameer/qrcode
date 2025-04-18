<?php

return [
    'mode'    => env('Qrcode_MODE', 'live'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'demo' => [
        'url'         => env('QR_CODE_DEMO_URL', 'https://qrcode.test/qrcode/scan/'),
        
    ],
    'live' => [
        'url'         => env('QR_CODE_URL', 'https://rawanniversary.prismafoodsegypt.com/qrcode/scan/'),
        
    ],
    'width' => 500,
    // 'height' => 243,

    
];
