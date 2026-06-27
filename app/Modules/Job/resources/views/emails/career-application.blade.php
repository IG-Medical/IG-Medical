@extends('emails.layout')

@push('page-title',isset($subject) ? $subject : $_data['subject'])
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

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

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

    {!! isset($content) ? $content : $_data['content'] !!}
    <table id="table">
        <tr>
            <th>{{ trans_module_job('app.salutation') }}</th>
            <td>{{ $_data->full_name }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.full_name') }}</th>
            <td>{{ $_data->full_name }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.email') }}</th>
            <td>{{ $_data->email }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.phone') }}</th>
            <td>{{ $_data->phone }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.street') }}</th>
            <td>{{ $_data->street }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.number') }}</th>
            <td>{{ $_data->number }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.plz') }}</th>
            <td>{{ $_data->plz }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.place_of_residence') }}</th>
            <td>{{ $_data->place_of_residence }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.land') }}</th>
            <td>{{ $_data->land }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.salary_expectations') }}</th>
            <td>{{ $_data->salary_expectations }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.earliest_start_of_work') }}</th>
            <td>{{ $_data->earliest_start_of_work }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.attentive_to_business_through') }}</th>
            <td>{{ $_data->attentive_to_business_through }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.internal_application') }}</th>
            <td>{{ $_data->internal_application }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.data_protection') }}</th>
            <td>{{ $_data->data_protection }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.admission_to_talent_pool') }}</th>
            <td>{{ $_data->admission_to_talent_pool }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.file_curriculum') }}</th>
            <td>{{ $_data->file_curriculum }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.file_testimonials') }}</th>
            <td>{{ $_data->file_testimonials }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.file_miscellaneous') }}</th>
            <td>{{ $_data->file_miscellaneous }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.file_total_package') }}</th>
            <td>{{ $_data->file_total_package }}</td>
        </tr>
        <tr>
            <th>{{ trans_module_job('app.file_write_to') }}</th>
            <td>{{ $_data->file_write_to }}</td>
        </tr>
    </table>
@endsection
