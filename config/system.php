<?php
return [
    'app_name' => env('APP_NAME', "Quezon City Health Services"),
    'app_title' => env('APP_TITLE', "Q.C. Health Services"),
    'app_favicon' => env('APP_FAVICON', "assets/images/system/qcid_icon.png"),
    'app_client_url' => env('APPLICANT_BASE_URL', "https://qc-app.kugkugtech.com/"),

    'messages' => [
        'default' => 'Cannot continue, please call system administrator!',
    ],

    'application_status' => [
        'application_form' => 1,
        'uploaded_requirements' => 2,
        'validated_requirements' => 3,
        'created_payment' => 4,
        'validated_payment' => 5,
        'seminar' => 6,
        'head_approval' => 7,
        'released' => 8,
        'rejected' => 98,
        'completed' => 99,
    ],

    'application_progress_status' => [
        1 => 'Application Created',
        2 => 'For-Review',
        3 => 'Requirements Validated',
        4 => 'Payment Created',
        5 => 'Payment Validated',
        6 => 'Ongoing Seminar',
        7 => 'Foir Head Approval',
        8 => 'Released',
        98 => 'Rejected',
        99 => 'Completed',
    ],

    'requirement_status' => [
        1 => 'For Review',
        2 => 'Completed',
        3 => 'Requires Update',
    ],

    'requirement_status_class' => [
        'For Review' => '',
        'Completed' => 'text-success',
        'Requires Update' => 'text-danger',
    ],

    'payment_status' => [
        'for-review' => 1,
        'approved' => 2,
        'rejected' => 3,
    ]
];