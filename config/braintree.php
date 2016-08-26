<?php
return [
    'default' => [
        'environment' => getenv('BRAINTREE_ENVIRONMENT'),
        'merchantAccountId' => getenv('BRAINTREE_MERCHANT_ACCT_ID'),
        'merchantId' => getenv('BRAINTREE_MERCHANT_ID'),
        'publicKey' => getenv('BRAINTREE_PUBLIC_KEY'),
        'privateKey' => getenv('BRAINTREE_PRIVATE_KEY'),
        'options' => [
            'payment' => [],
            'sale' => [
                'addBillingAddressToPaymentMethod' => true,
                'storeInVaultOnSuccess' => true,
                'submitForSettlement' => true,
                'three_d_secure' => [ 'required' => true ],
            ],
            'billing' => [],
        ]
    ],
];