# Contact


## Features

* Partial for a contact form, that you can include in your own views

## Configuration

The view of the contact page (you can set this to be a view in your app, which has much more contact on it for example, then include the partial for the form, e.g. `@include('contact::form')`)

The fields and rules for your form

    'fields' => [
        'title' => [
            'type' => 'select',
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


## Usage

Customise the options in the config file and then add the following to the view file that you specified in the config to render the contact form inside it.

    @include('contact::form')
