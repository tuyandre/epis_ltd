<?php

return [
    'tagline' => 'For all your electrical needs',
    'phone' => '+250 788 655 604',
    'phone_href' => '+250788655604',
    'emails' => array_values(array_filter(array_map('trim', explode(',', env('EPIS_CONTACT_EMAILS', 'theoneste@epis.rw,info@epis.rw'))))),
    'address' => 'Kigali, Rwanda',
    'services_options' => [
        'Electrical, plumbing and HVAC installation',
        'MV and LV line installation',
        'Audit, testing and commissioning',
        'Something else',
    ],
];
