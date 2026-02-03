@extends('admin.layout.master')

@section('content')
<div class="container">
    <h1>{{ __('admin.messages.contact_messages') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('admin.messages.name') }}</th>
                <th>{{ __('admin.messages.email') }}</th>
                <th>{{ __('admin.messages.phone') }}</th>
                <th>{{ __('admin.messages.subject') }}</th>
                <th>{{ __('admin.messages.message') }}</th>
                <th>{{ __('admin.messages.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->phone }}</td>
                <td>{{ $message->subject }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $messages->links() }}
</div>
@endsection
