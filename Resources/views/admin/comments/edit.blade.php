@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('guestbook::comments.title.edit comment') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.guestbook.comment.index') }}">{{ trans('guestbook::comments.title.comments') }}</a></li>
        <li class="active">{{ trans('guestbook::comments.title.edit comment') }}</li>
    </ol>
@stop

@section('styles')
    {!! Theme::script('js/vendor/ckeditor/ckeditor.js') !!}
@stop

@section('content')
    {!! Form::open(['route' => ['admin.guestbook.comment.update', $comment->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">
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
                            {!! Form::normalInput("subject", trans('guestbook::comments.form.subject'), $errors, $comment) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! BSForm::textarea('message', $comment->message, ['class'=>'textarea']) !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.guestbook.comment.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-2">
            <div class="box">
                <div class="box-body">
                    {!! Form::normalSelect('status', trans('global.form.status'), $errors, app(\Core\Models\Status::class)->lists(), $comment) !!}

                    {!! Form::normalInput("position", trans('guestbook::comments.form.position'), $errors, $comment) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.guestbook.comment.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@stop
