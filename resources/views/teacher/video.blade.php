<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jitsi Video Conference</title>
    <!-- Add any necessary styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #jitsi-container {
            height: 600px;
            width: 100%;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Jitsi Video Conference</h1>

    <div id="jitsi-container"></div>
</div>

<!-- Load Jitsi external API -->
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

        // Listen for participants joining
        api.addEventListener('participantJoined', function (event) {
            console.log('Participant joined:', event);
        });

        // Listen for conference joining
        api.addEventListener('videoConferenceJoined', function(event) {
            console.log('Conference started:', event);
        });

        // Listen for when the conference is ready to close
        api.addEventListener('readyToClose', function () {
            console.log('The conference has ended');
        });
    });
</script>

</body>
</html>
