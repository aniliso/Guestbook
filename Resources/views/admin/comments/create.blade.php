@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('guestbook::comments.title.create comment') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.guestbook.comment.index') }}">{{ trans('guestbook::comments.title.comments') }}</a></li>
        <li class="active">{{ trans('guestbook::comments.title.create comment') }}</li>
    </ol>
@stop

@section('styles')
    {!! Theme::script('js/vendor/ckeditor/ckeditor.js') !!}
@stop

@section('content')
    {!! Form::open(['route' => ['admin.guestbook.comment.store'], 'method' => 'post', 'files'=>true]) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">

                    @include('guestbook::admin.comments.partials.create-fields')

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.guestbook.comment.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="box">
                <div class="box-body">
                    {!! Form::normalSelect('status', trans('global.form.status'), $errors, app(\Modules\Core\Models\Status::class)->lists()) !!}

                    {!! Form::normalInput("position", trans('guestbook::comments.form.position'), $errors) !!}

                    <div class="form-group{{ $errors->has("attachment") ? ' has-error' : '' }}">
                        {!! Form::file('attachment',['class'=>'form-control-file']) !!}
                        {!! $errors->first("attachment", '<span class="help-block">:message</span>') !!}
                    </div>
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
