<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-TI04AnUNNutQtcfw"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    {{-- jquery CDN 3 --}}
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  </head>
 
  <body>
    <button id="pay-button">Pay!</button>

    {{-- data form ini akan di olah oleh webController payment_post --}}
    <form action="" id="submit_form" method="POST">
        @csrf
        {{-- ini biar data payment bisa masuk ke database, jadi kita akalin pake id "json_callback" yang di olah pake kodingan func
         send_response_to_form(result) --}}
        <input type="hidden" name="json" id="json_callback">
    </form>
 
    <script type="text/javascript">

      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {

        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snap_token}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });

      function send_response_to_form(result){
        //jadi masukan hasil result berbentuk JSON yang telah di ubah ke bentuk string oleh JSON.stringify, ke dalam value json_callback
        document.getElementById('json_callback').value = JSON.stringify(result);

        // //buat coba-coba
        // alert(document.getElementById('json_callback').value);

        //submit hasil nya ke hidden form melalui id "submit_form"
        $('#submit_form').submit();
      }

    </script>
  </body>
</html>