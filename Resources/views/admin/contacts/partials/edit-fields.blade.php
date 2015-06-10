<div class="box-body">
    {!! Form::i18nTextarea('body', trans('contact::contacts.body'), $errors, $lang, $contact) !!}

    {!! Form::i18nCheckbox('online', trans('contact::contacts.online'), $errors, $lang, $contact) !!}
</div>
