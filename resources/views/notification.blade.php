<head>
        <title>Laravel Real Time Notification Tutorial With Example</title>
        <h1>Laravel Real Time Notification Tutorial With Example</h1>
        <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
        <script>
      
         var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
            cluster: '{{env("PUSHER_APP_CLUSTER")}}',
            encrypted: true
          });
      
          var channel = pusher.subscribe('notify-channel');
          channel.bind('App\\Events\\Notify', function(data) {
            alert(data.message);
          });
        </script>
      </head>