$(function() {
    //Kết nối tới server socket đang lắng nghe
    var socket = io.connect('http://localhost:3001');

    //Socket nhận data và append vào giao diện
    socket.on("send", function(data) {
        console.log(data);
        $("#content_demo_chat").append("<p class='message'><b>" + data.username + "</b>: " + data.message + "</p>")
    })

    //Bắt sự kiện click gửi message (ngoài frontend)
    $("#sendMessage_demo_chat").on('click', function() {
        var username = $('#userChat').val();
        var message = $('#message_demo_chat').val();

        if (username == '' || message == '') {
            alert('Please enter name and message!!');
        } else {
            //Gửi dữ liệu cho socket
            sendDataChat(username, message)
        }
    });


    //Bắt sự kiện click gửi message (trong backend)
    $("#backend_sendMessage_demo_chat").on('click', function() {
        var username = $('#admin_reply').val();
       
        var message = $('#message_demo_chat').val();

        if (username == '' || message == '') {
            alert('Please enter name and message!!');
        } else {
            //Gửi dữ liệu cho socket
            sendDataChat(username,message)
        }
    });

    function sendDataChat(username,message ) {
        data = {};
        data.username = username;
        data.message = message;
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/api/send-data-chat',
            type: 'POST',
            dataType: 'json',
            data: data
        }).done(function(res) {
            if (res.status == 'OK') {
                socket.emit('send', { username: username, message: message });
                $('#message_demo_chat').val('');
            }   
        });
    }

    //tuantv test
    // socket.on("sendpoint", function(data) {
    //     //console.log(data);
    //     $("#show-point").text('');
    //     $("#show-point").append(data.point);
    // })

    // $("#increase-point").on('click', function() {
    //     var point = $("#show-point").text();
    //     if (point != '') {
    //         point = parseInt(point) + 1;
    //     } else {
    //         point = 1;
    //     }

    //     socket.emit('sendpoint', { point: point });
    // });
})