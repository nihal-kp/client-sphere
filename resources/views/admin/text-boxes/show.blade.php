@extends('admin.layouts.app')

@section('title', 'View Text Box')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Text Box Details</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Label:</div>
                <div class="col-md-9">{{ $textBox->label }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Value:</div>
                <div class="col-md-9">{{ $textBox->value }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Clients:</div>
                <div class="col-md-9">
                    @if($textBox->users->isNotEmpty())
                        <ul class="mb-0 pl-3">
                            @foreach($textBox->users as $client)
                                <li>{{ $client->name }} (ID: {{ $client->id }})</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $textBox->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $textBox->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.text-boxes.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('admin.text-boxes.edit', $textBox) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>

@endsection