@extends('emails.layout')

@push('page-title',isset($subject) ? $subject : $data['subject'])
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
    {!! isset($content) ? $content : $data['content'] !!}
    <table id="table">
        <tr>
            <th>Company</th>
            <td>{{ $_data->company_name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $_data->email}}</td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td>{{ $_data->full_name  }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $_data->phone }}</td>
        </tr>
        <tr>
            <th>Product</th>
            <td>{{ $product}}</td>
        </tr>
        <tr>
            <th>Message</th>
            <td>{{ $_data->message }}</td>
        </tr>

    </table>
@endsection
