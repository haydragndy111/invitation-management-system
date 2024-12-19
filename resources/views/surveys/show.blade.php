@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">{{ $survey->name }}</h1>

    <div class="bg-white shadow-md rounded p-6">
        <p><strong>Created At:</strong> {{ $survey->created_at->format('d-m-Y') }}</p>
        <p><strong>Updated At:</strong> {{ $survey->updated_at->format('d-m-Y') }}</p>
    </div>

    <div class="mt-6">
        @if ($invitation != null)
            <a href="{{ route('surveys.accept-invitation', ['survey' => $survey->id, 'invitation' => $invitation->id]) }}"
            class="text-green-500 hover:underline">
                Accept Invitation
            </a>
        @endif
    </div>
</div>
@endsection
