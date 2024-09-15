@extends('layouts.video')

@section('title', 'BCH Online Class')

@section('content')
    <div id="jitsi-container" class="rounded-lg overflow-hidden border border-gray-300"></div>
@endsection

@push('scripts')
<script src="https://meet.jit.si/external_api.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const domain = "meet.jit.si";
        const roomName = "{{ uniqid('room-', true) }}"; // Generate a unique room name

        const options = {
            roomName: roomName,
            width: '100%',
            height: 600,
            parentNode: document.querySelector('#jitsi-container'),
            userInfo: {
                displayName: "{{ Auth::user()->name }}" // Use the authenticated user's name
            }
        };

        // Initialize the Jitsi Meet API
        const api = new JitsiMeetExternalAPI(domain, options);

        api.addEventListener('participantJoined', function(event) {
            console.log('Participant joined:', event);
        });

        api.addEventListener('videoConferenceJoined', function(event) {
            console.log('Conference started:', event);
        });

        api.addEventListener('readyToClose', function() {
            console.log('The conference has ended');
        });
    });
</script>
@endpush
