@extends('emails.layout')

@push('page-title',$subject)

@section('content')
    {!! $content !!}
@endsection
