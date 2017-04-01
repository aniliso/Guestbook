@extends('layouts.master')

@section('breadcrumbs')
    @include('partials.parts.breadcrumbs', ['title'=>trans('themes::guestbook.title'), 'breadcrumbs'=>'guestbook.index'])
@endsection

@section('content')
    <section class="ls section_padding_30">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="section_header grey">
                        {{ trans('themes::guestbook.leave comment') }}
                    </h2>
                    <p>
                        {{ trans('themes::guestbook.leave comment description') }}
                    </p>
                    <p>
                        <a href="{{ route('guestbook.comment.form') }}" class="theme_button inverse">{{ trans('themes::guestbook.leave a comment') }}</a>
                    </p>
                </div>
            </div>

        </div>
    </section>
    <section class="ls ms section_padding_top_30 section_padding_bottom_50">
        <div class="container">
            <div class="row">
                @foreach($reviews as $review)
                <div class="col-sm-4">
                    <blockquote class="font-size-14">
                        {{ $review->message }}
                        <div class="media">
                            <div class="media-body grey">
                                <h4 class="media-heading">{{ $review->fullname }}</h4>
                                {{ $review->position }}
                            </div>
                        </div>
                    </blockquote>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! $reviews->render() !!}
                </div>
            </div>
        </div>
    </section>
@endsection