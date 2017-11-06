<div class="row">
    <div class="col-sm-6">
        {!! Form::normalInput("first_name", trans('guestbook::comments.form.first_name'), $errors, $comment) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::normalInput("last_name", trans('guestbook::comments.form.last_name'), $errors, $comment) !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        {!! Form::normalInput("email", trans('guestbook::comments.form.email'), $errors, $comment) !!}
    </div>
    <div class="col-sm-6">
        {!! Form::normalInput("phone", trans('guestbook::comments.form.phone'), $errors, $comment) !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        {!! Form::textarea('message', $comment->message, ['class'=>'form-control textarea']) !!}
    </div>
</div>