<!DOCTYPE html>
<html lang="en">
<head>
    <title>Holiday PDF</title>
</head>
<body>

    <h2>Title: {{ $holiday->title }}</h2>
    <h3>Description: </h3>
    <p>{{ $holiday->description }}</p>
    <h3>Date:</h3>
    <p>{{ $holiday->date }}</p>
    <h3>Location:</h3>
    <p>{{ $holiday->description }}</p>
    <h3>Created by:</h3>
    <p> {{ $holiday->creator->name }}</p>
    <h3>Updated by:</h3>
    <p>{{ $holiday->updater->name ?? 'No updater' }}</p>
    <h2>Participants</h2>
    @if(!$holiday->participants->isEmpty())
        <ul>
            @foreach($holiday->participants as $participant)
                <li>{{ $participant->name }}</li>
            @endforeach
        </ul>
    @else
        <h2>There are no participants in this event.</h2>
    @endif
</body>
</html>
