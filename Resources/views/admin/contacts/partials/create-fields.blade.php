<div class="box-body">
    {!! Form::i18nTextarea('body', trans('contact::contacts.body'), $errors, $lang) !!}

    {!! Form::i18nCheckbox('online', trans('contact::contacts.online'), $errors, $lang) !!}
</div>
