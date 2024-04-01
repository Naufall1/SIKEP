<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Login</title>
@vite('resources/css/app.css')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-container h2 {
        text-align: center;
    }
    .login-container form {
        display: flex;
        flex-direction: column;
    }
    .login-container form input {
        margin: 10px 0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .login-container form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
</style>
</head>
<body>
<div class="login-container">
    <h2 class="p-">Login</h2>
    <form action="{{route('login')}}" method="post">
        {{ csrf_field() }}
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
