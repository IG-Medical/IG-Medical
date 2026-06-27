@extends('emails.layout')

@push('page-title',$subject)
@push('css')
    <style>
        body {
            font-family: sans-serif;
        }
        table, td, th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        #table {
            font-family: sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even){background-color: #f2f2f2;}

        #table tr:hover {background-color: #ddd;}

        #table th {
            text-align: center;
            width: 124px;
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #3E98D7;
            color: white;
        }
    </style>
    </style>
@endpush
@section('content')
    {!! $content !!}
    <table id="table">
        <tr>
            <th>Name</th>
            <td>{{ $_data->first_name  }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $_data->email }}</td>
        </tr>
{{--        <tr>--}}
{{--            <th>Department</th>--}}
{{--            <td>{{  $_data->department }}</td>--}}
{{--        </tr>--}}
        <tr>
            <th>Company</th>
            <td>{{ $_data->company}}</td>
        </tr>
        <tr>
            <th>Country</th>
            <td>{{ $country}}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{  $_data->phone }}</td>
        </tr>
{{--        <tr>--}}
{{--            <th>Surname</th>--}}
{{--            <td>{{ $_data->surname }}</td>--}}
{{--        </tr>--}}
        <tr>
            <th>Product</th>
            <td>{{ $product}}</td>
        </tr>
    </table>
@endsection
