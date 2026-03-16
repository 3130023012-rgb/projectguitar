<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #0a0a0a; --card: #0f0f0f; --white: #fff; --gold: #caa96c; }
        body { background: var(--bg); color: var(--white); font-family: 'Montserrat', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: var(--card); padding: 50px; width: 400px; border-radius: 5px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        h2 { margin-bottom: 30px; text-align: center; font-weight: 300; letter-spacing: 2px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-size: 0.85rem; color: #888; }
        input { width: 100%; background: #1a1a1a; border: 1px solid #333; padding: 12px; color: white; }
        input:focus { outline: none; border-color: var(--gold); }
        button { width: 100%; padding: 15px; background: var(--white); color: black; border: none; text-transform: uppercase; font-weight: 600; cursor: pointer; }
        button:hover { background: var(--gold); }
        .error { color: #ff4d4d; font-size: 0.85rem; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>ADMIN LOGIN</h2>
        @if(session('error')) <div class="error">{{ session('error') }}</div> @endif
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>