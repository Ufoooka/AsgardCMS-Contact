Hello

We've received a new enquiry through the website, here are the details:

@foreach (config('asgard.contact.config.fields') as $fieldName => $options)
    {{ trans('contact::contacts.form.labels.'.$fieldName) }}    {{ $$fieldName }}
@endforeach
