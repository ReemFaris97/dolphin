<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Document</title>
    <style>
        @font-face {
            font-family: Almarai;
            src: url(admin/after-login-page/Almarai-Bold.ttf) format("truetype");
        }

        * {
            font-family: Almarai, Arial, Helvetica;
        }

        .body {
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            background-image: url({{asset('admin/after-login-page/panel_bg.png')}});
            direction: rtl;
        }

        .main {
            text-align: center;
        }

        .main div {
            display: flex;
            justify-content: space-evenly;
        }

        .main h1 {
            font-size: 40px;
            font-weight: bolder;
        }

        .main a {
            width: 15%;
            text-decoration: none;
            padding: 50px;
            border-radius: 50px;
            border: 1px solid;
            transition: all 0.7s ease;
            justify-content: space-between;
            display: flex;
            flex-direction: column;
        }

        .main a:hover {
            transform: scale(1.03);
            box-shadow: 0 0 20px rgb(0 0 0 / 70%), inset 0 0 20px rgb(0 0 0 / 20%);
            background-color: beige;
        }

        .main a img {
            width: 100%;
        }

        .main a span {
            font-size: calc(1.5vw + 9px);
            color: black;
        }
    </style>
</head>
<body class="body">
<main class="main">
    <h1>الشركة القابضة</h1>
    <div>
        @if (auth()->user()->is_accountant == 1)
            <a href="{{url('/accounting/home')}}">
                <img
                    src="{{asset('admin/after-login-page/toppng.com-bannercalculator-icon-free-and-calculator-icon-black-and-white-1213x1577.png')}}"
                    alt=""/>
                <span>المحاسبة</span>
            </a>
        @endif

        @if (auth()->user()->is_distributor == 1 )
            <a href="{{url('/distributor/home')}}">
                <img src="{{asset('admin/after-login-page/logo-black.png')}}" alt=""/><span>المندوبين</span>
            </a>
        @endif


        <a href="{{url('admins/tasks')}}">
            <img src="{{asset('admin/after-login-page/PinClipart.com_clipart-erstellen-freeware_1254536.png')}}"
                 alt=""/>
            <span>المهام</span>
        </a>
    </div>
</main>
</body>
</html>
