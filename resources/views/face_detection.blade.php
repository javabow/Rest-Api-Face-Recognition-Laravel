<!DOCTYPE HTML>
<html>
<head>
    <title>Flask-SocketIO Test</title>
    <script src="//code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js" integrity="sha256-yr4fRk/GU1ehYJPAs8P4JlTgu0Hdsp4ZKrx8bDEDC3I=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            // Use a "/test" namespace.
            // An application can open a connection on multiple namespaces, and
            // Socket.IO will multiplex all those connections on a single
            // physical channel. If you don't care about multiple channels, you
            // can set the namespace to an empty string.
            namespace = '/test';

            // Connect to the Socket.IO server.
            // The connection URL has the following format, relative to the current page:
            //     http[s]://<domain>:<port>[/<namespace>]
            var socket = io(namespace);

            // Event handler for new connections.
            // The callback function is invoked when a connection with the
            // server is established.
            socket.on('connect', function() {
                socket.emit('my_event', {data: 'I\'m connected!'});
            });

            // Event handler for server sent data.
            // The callback function is invoked whenever the server emits data
            // to the client. The data is then displayed in the "Received"
            // section of the page.
            socket.on('my_response', function(msg, cb) {
                $('#log').append('<br>' + $('<div/>').text('Received #' + msg.count + ': ' + msg.data).html());
                if (cb)
                    cb();
            });

            // Interval function that tests message latency by sending a "ping"
            // message. The server then responds with a "pong" message and the
            // round trip time is measured.
            var ping_pong_times = [];
            var start_time;
            window.setInterval(function() {
                start_time = (new Date).getTime();
                socket.emit('my_ping');
            }, 1000);

            // Handler for the "pong" message. When the pong is received, the
            // time from the ping is stored, and the average of the last 30
            // samples is average and displayed.
            socket.on('my_pong', function() {
                var latency = (new Date).getTime() - start_time;
                ping_pong_times.push(latency);
                ping_pong_times = ping_pong_times.slice(-30); // keep last 30 samples
                var sum = 0;
                for (var i = 0; i < ping_pong_times.length; i++)
                    sum += ping_pong_times[i];
                $('#ping-pong').text(Math.round(10 * sum / ping_pong_times.length) / 10);
            });

            // Handlers for the different forms in the page.
            // These accept data from the user and send it to the server in a
            // variety of ways
            $('form#emit').submit(function(event) {
                socket.emit('my_event', {data: $('#emit_data').val()});
                return false;
            });
            $('form#broadcast').submit(function(event) {
                socket.emit('my_broadcast_event', {data: $('#broadcast_data').val()});
                return false;
            });
            $('form#join').submit(function(event) {
                socket.emit('join', {room: $('#join_room').val()});
                return false;
            });
            $('form#leave').submit(function(event) {
                socket.emit('leave', {room: $('#leave_room').val()});
                return false;
            });
            $('form#send_room').submit(function(event) {
                socket.emit('my_room_event', {room: $('#room_name').val(), data: $('#room_data').val()});
                return false;
            });
            $('form#close').submit(function(event) {
                socket.emit('close_room', {room: $('#close_room').val()});
                return false;
            });
            $('form#disconnect').submit(function(event) {
                socket.emit('disconnect_request');
                return false;
            });
        });
    </script>
</head>
<body>
    <h1>Flask-SocketIO Test</h1>
    <p>Async mode is: <b>{{ async_mode }}</b></p>
    <p>Average ping/pong latency: <b><span id="ping-pong"></span>ms</b></p>
    <h2>Send:</h2>
    <form id="emit" method="POST" action='#'>
        <input type="text" name="emit_data" id="emit_data" placeholder="Message">
        <input type="submit" value="Echo">
    </form>
    <form id="broadcast" method="POST" action='#'>
        <input type="text" name="broadcast_data" id="broadcast_data" placeholder="Message">
        <input type="submit" value="Broadcast">
    </form>
    <form id="join" method="POST" action='#'>
        <input type="text" name="join_room" id="join_room" placeholder="Room Name">
        <input type="submit" value="Join Room">
    </form>
    <form id="leave" method="POST" action='#'>
        <input type="text" name="leave_room" id="leave_room" placeholder="Room Name">
        <input type="submit" value="Leave Room">
    </form>
    <form id="send_room" method="POST" action='#'>
        <input type="text" name="room_name" id="room_name" placeholder="Room Name">
        <input type="text" name="room_data" id="room_data" placeholder="Message">
        <input type="submit" value="Send to Room">
    </form>
    <form id="close" method="POST" action="#">
        <input type="text" name="close_room" id="close_room" placeholder="Room Name">
        <input type="submit" value="Close Room">
    </form>
    <form id="disconnect" method="POST" action="#">
        <input type="submit" value="Disconnect">
    </form>
    <h2>Receive:</h2>
    <div id="log"></div>
</body>
</html>



{{-- @include('template.header')

<video autoplay="true" id="videoElement">

</video>

<script>
    $(document).ready(function(){
        var socket = io.connect('http://' + document.domain + ':' + location.port + '/test');
        socket.on('my response', function(msg) {
            $('#log').append('<p>Received: ' + msg.data + '</p>');
        });
        $('form#emit').submit(function(event) {
            socket.emit('my event', {data: $('#emit_data').val()});
            return false;
        });
        $('form#broadcast').submit(function(event) {
            socket.emit('my broadcast event', {data: $('#broadcast_data').val()});
            return false;
        });
    });
</script> --}}

<script>
    var video = document.querySelector("#videoElement");

    if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
        video.srcObject = stream;
        })
        .catch(function (err0r) {
        console.log("Something went wrong!");
        });
    }
</script>
@include('template.footer') --}}
