@extends('layouts.app')
@section('title', 'My Assigned Text Boxes | Client | ')

@section('content')
<div class="container">
    <h1 class="mb-4">My Assigned Text Boxes</h1>

    @if($textBoxes->isEmpty())
        <div class="alert alert-info">No text boxes assigned to you.</div>
    @endif

    <div class="row">
        @foreach($textBoxes as $textBox)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $textBox->label }}</h5>
                        <p class="card-text"><strong>Value:</strong> {{ $textBox->value }}</p>
                        <p class="text-muted"><small>Assigned on {{ $textBox->created_at->format('d M Y') }}</small></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
