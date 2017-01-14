var wsURL;

var WebSocket;

function initWebSocket(callback) {
    WebSocket = new WebSocket(wsURL);

    WebSocket.onmessage = function (e) {
        try {
            var data = JSON.parse(e.data);

            console.log(data);

            switch (data.type) {
                case 'hello':
                    console.log('Init message');
                    break;
                case 'error':
                    // console.log('Init message');
                    break;
            }
        } catch (e) {
            console.log("Error: " + e);
        }
    };
    WebSocket.onopen = function () {
        console.log('Connection opened');

        callback();
    };
    WebSocket.onclose = function () {
        console.log('Connection closed');
    };
}

function send(msg) {
    if (typeof msg != "string") {
        msg = JSON.stringify(msg);
    }

    console.log(msg);

    if (WebSocket && WebSocket.readyState == 1) {
        WebSocket.send(msg);
    }
}

$(document).ready(function () {
    initWebSocket(function () {
        $('.control-btn').click(function (e) {
            e.preventDefault();

            send({
                'type': $(this).data('action')
            });
        });

        $(document).bind('keydown', 'up', function (e) {
            $('.control-btn.control-move-forward').addClass('disabled');
            send({
                'type': 'move.forward'
            });
        });
        $(document).bind('keyup', 'up', function (e) {
            $('.control-btn.control-move-forward').removeClass('disabled');
        });
        $(document).bind('keydown', 'down', function (e) {
            $('.control-btn.control-move-backward').addClass('disabled');
            send({
                'type': 'move.backward'
            });
        });
        $(document).bind('keyup', 'down', function (e) {
            $('.control-btn.control-move-backward').removeClass('disabled');
        });
        $(document).bind('keydown', 'left', function (e) {
            $('.control-btn.control-move-left').addClass('disabled');
            send({
                'type': 'move.left'
            });
        });
        $(document).bind('keyup', 'left', function (e) {
            $('.control-btn.control-move-left').removeClass('disabled');
        });
        $(document).bind('keydown', 'right', function (e) {
            $('.control-btn.control-move-right').addClass('disabled');
            send({
                'type': 'move.right'
            });
        });
        $(document).bind('keyup', 'right', function (e) {
            $('.control-btn.control-move-right').removeClass('disabled');
        });
    });
});
