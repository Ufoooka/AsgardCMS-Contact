<?php

return [
    'name' => 'Contacts',
    'fields' => [
        'title' => [
            'type'    => 'select',
            'choices' => [
                ''      => 'Please select',
                'Mr'    => 'Mr',
                'Mrs'   => 'Mrs',
                'Miss'  => 'Miss',
                'Ms'    => 'Ms',
                'Dr'    => 'Dr',
                'Other' => 'Other',
            ],
        ],
        'first_name' => [
            'type' => 'text',
        ],
        'last_name' => [
            'type' => 'text',
        ],
        'email' => [
            'type' => 'text',
        ],
        'enquiry' => [
            'type' => 'textarea',
        ],
    ],
    'rules' => [
        'title'      => 'required',
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|email',
        'enquiry'    => 'required',
    ],
    'mail' => [
        'views' => [
            'contact::emails.html.enquiry',
            'contact::emails.text.enquiry',
        ],
    ],

];
