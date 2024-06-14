<Style>
    .signin {
        background-color: #d3d3d3;
        font-family: 'Montserrat', sans-serif;
        color: #fff;
        font-size: 14px;
        letter-spacing: 1px;

    }

    .login {
        color: white;
        position: relative;
        height: 560px;
        width: 405px;
        margin: auto;
        padding: 60px 60px;
        background: url(<?php echo "$data[domain]/images/shared/Sign_in.png" ?>) no-repeat center center #505050;
        background-size: cover;
        box-shadow: 0px 30px 60px -5px #FFF;
    }

    form {
        padding-top: 80px;
    }

    .active {
        border-bottom: 2px solid #1161ed;
    }

    h2 {
        padding-left: 12px;
        font-size: 22px;
        text-transform: uppercase;
        padding-bottom: 5px;
        letter-spacing: 2px;
        display: inline-block;
        font-weight: 100;
    }

    h2:first-child {
        padding-left: 0px;
    }

    .login span {
        text-transform: uppercase;
        font-size: 12px;
        opacity: 0.8;
        display: inline-block;
        position: relative;
        top: -65px;
        transition: all 0.5s ease-in-out;
    }

    .text {
        border: none;
        width: 89%;
        padding: 10px 20px;
        display: block;
        height: 15px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0);
        overflow: hidden;
        margin-top: 15px;
        transition: all 0.5s ease-in-out;
    }

    .text:focus {
        outline: 0;
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        background: rgba(0, 0, 0, 0);
    }

    .text:focus+span {
        opacity: 1;
    }

    input[type="text"],
    input[type="password"] {
        font-family: 'Montserrat', sans-serif;
        color: #fff;
    }

    input {
        display: inline-block;
        padding-top: 20px;
        font-size: 14px;
    }

    .login h2,
    .login span,
    .custom-checkbox {
        margin-left: 20px;
    }

    .custom-checkbox {
        -webkit-appearance: none;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 8px;
        border-radius: 2px;
        display: inline-block;
        position: relative;
        top: 6px;
    }

    .custom-checkbox:checked {
        background-color: rgba(255, 255, 255, 1);
    }

    .custom-checkbox:checked:after {
        content: '\2714';
        font-size: 10px;
        position: absolute;
        top: 1px;
        left: 2px;
    }

    .custom-checkbox:focus {
        outline: none;
    }

    label[for="checkbox-1-1"] {
        display: inline-block;
        padding-top: 1px;
        padding-left: 5px;
        color: rgba(255, 255, 255, 0.8);
        vertical-align: middle;
    }

    .signin {
        background-color: #1161ed;
        color: #FFF;
        width: 100%;
        padding: 10px 20px;
        display: block;
        height: 39px;
        border-radius: 20px;
        margin-top: 30px;
        transition: all 0.5s ease-in-out;
        border: none;
        text-transform: uppercase;
    }

    .signin:hover {
        background: #4082f5;
        box-shadow: 0px 4px 35px -5px #4082f5;
        cursor: pointer;
    }

    .signin:focus {
        outline: none;
    }

    hr {
        border: 1px solid rgba(255, 255, 255, 0.1);
        top: 85px;
        position: relative;
    }

    a {
        text-align: center;
        display: block;
        top: 90px;
        position: relative;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.8);
    }
</Style>

<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

<div class="login mt-5">
    <h2 class="active"> sign in </h2>
    <form action="" method="post">
        <input type="text" name="account" class="text" name="username">
        <span>username</span>
        <br>
        <br>
        <input type="password" name="password" class="text" name="password">
        <span>password</span>
        <br>
        <button class="signin" type="submit" name="sm">
            Đăng nhập
        </button>
        <a href='<?php echo "$data[domain]/Login/SignUp"; ?>'>Chưa có tài khoản?</a>
        <hr>
    </form>
    <script>
        $("form").submit(function() {
            if ($("input[name='account']").val() == "" || $("input[name='password']").val() == "") {
                alert("Vui lòng nhập tài khoản & mật khẩu!")
                return false;
            }

        })
    </script>
</div>