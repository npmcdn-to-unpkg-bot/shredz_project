<?php

return array(
    'dsn' => env('SENTRY_DSN'),
    'public_dsn' => env('SENTRY_PUBLIC_DSN'),
    // capture release as git sha
    // 'release' => release_id(),
);
