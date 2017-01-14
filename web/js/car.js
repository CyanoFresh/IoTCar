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
    });
});
