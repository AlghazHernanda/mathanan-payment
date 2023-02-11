

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{url('assets/login.css')}}">
    <title>Facebook-Login or Sign up</title>
    <!-- <link rel="stylesheet" href="style2.css"> -->
</head>
<body>
    <main>
        <div class="row">
            <div class="colm-logo">
               
            </div>

            <form action="" method="POST">
                @csrf
            <div class="colm-form">
                <div class="form-container">
                    <input type="text" name="name" placeholder="name">
                    <input type="email" name="email" placeholder="Email address or phone number">
                    <input type="password" name="password" placeholder="Password">
                    <button class="btn-login">Register</button>

                    {{-- <a href="#">Forgotten password?</a>
                    <button class="btn-new">Create new Account</button> --}}

                </div>
             
            </div>
        </form>
        
        </div>
    </main>
    <footer>
        <div class="footer-contents">
            <ol>
                <li>English (UK)</li>
                <li><a href="#">മലയാളം</a></li>
                <li><a href="#">தமிழ்</a></li>
                <li><a href="#">తెలుగు</a></li>
                <li><a href="#">বাংলা</a></li>
                <li><a href="#">اردو</a></li>
                <li><a href="#">हिन्दी</a></li>
                <li><a href="#">ಕನ್ನಡ</a></li>
                <li><a href="#">Español</a></li>
                <li><a href="#">Português (Brasil)</a></li>
                <li><a href="#">Français (France)</a></li>
                <li><button>+</button></li>
           
            
               
                
                
            </ol>
            <small>Facebook © 2022</small>
        </div>
    </footer>
</body>
</html>