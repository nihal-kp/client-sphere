@extends('admin.layouts.app')

@section('title', 'View Client')

@section('content')

@php
    use App\Enums\UserStatus;
@endphp

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Client Details</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Name:</div>
                <div class="col-md-9">{{ $client->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Email:</div>
                <div class="col-md-9">{{ $client->email }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Phone:</div>
                <div class="col-md-9">{{ $client->phone }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Image:</div>
                <div class="col-md-9">
                    @if($client->image)
                        <img src="{{ asset('uploads/clients/' . $client->image) }}" alt="Client Image" class="img-thumbnail" width="150">
                    @else
                        <span>No image uploaded</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">
                    @if($client->status === UserStatus::ACTIVE)
                        <span class="badge badge-success">{{ $client->status->label() }}</span>
                    @elseif($client->status === UserStatus::INACTIVE)
                        <span class="badge badge-danger">{{ $client->status->label() }}</span>
                    @else
                        <span class="badge badge-secondary">Unknown</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $client->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $client->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>

@endsection