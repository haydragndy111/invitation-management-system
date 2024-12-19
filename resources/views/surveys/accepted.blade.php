@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Invitation Accepted</h1>

    <div class="bg-white shadow-md rounded p-6">
        <p>You have successfully accepted the invitation for the survey <strong>{{ $survey->name }}</strong>.</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('surveys.show', [
            'survey' => $survey->id,
            'invitation' => $invitation->id,
        ]) }}" class="text-blue-500 hover:underline">Back to Survey</a>
    </div>
</div>
@endsection
