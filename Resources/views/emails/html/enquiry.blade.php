<html>
    <body>
        <p>Hello</p>
        <p>We've received a new enquiry through the website, here are the details:</p>

        @foreach (config('asgard.contact.config.fields') as $fieldName => $options)
            <p><strong>{{ trans('contact::contacts.form.'.$fieldName) }}</strong>: {{ nl2br($$fieldName) }}</p>
        @endforeach
    </body>
</html>