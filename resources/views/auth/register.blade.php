<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register - TROY Perfumes</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <style>
        :root{
            --bg:#050816;
            --bg-soft:#050b1f;
            --bg-elevated:#070f25;
            --primary:#22c55e;
            --primary-soft:rgba(34,197,94,0.14);
            --primary-strong:#16a34a;
            --accent:#38bdf8;
            --text-main:#e5f2ff;
            --text-muted:#9ca3af;
            --border-subtle:rgba(148,163,184,0.35);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:'Poppins',system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
            background:radial-gradient(circle at top, #172554 0, #020617 55%, #000 100%);
            color:var(--text-main);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:1.5rem;
            position:relative;
            overflow:hidden;
        }
        body::before{
            content:'';
            position:absolute;
            top:-30%;
            right:-20%;
            width:600px;
            height:600px;
            background:radial-gradient(circle,rgba(34,197,94,0.08),transparent 70%);
            pointer-events:none;
        }
        body::after{
            content:'';
            position:absolute;
            bottom:-20%;
            left:-15%;
            width:500px;
            height:500px;
            background:radial-gradient(circle,rgba(56,189,248,0.06),transparent 70%);
            pointer-events:none;
        }
        .login-container{
            background:var(--bg-elevated);
            border-radius:26px;
            padding:2.5rem 3rem;
            width:100%;
            max-width:450px;
            border:1px solid rgba(148,163,184,0.15);
            box-shadow:0 25px 65px rgba(15,23,42,0.95);
            position:relative;
            z-index:1;
        }
        .logo{
            text-align:center;
            margin-bottom:2rem;
        }
        .logo-text{
            font-weight:900;
            letter-spacing:.15em;
            font-size:2rem;
            color:var(--text-main);
            display:flex;
            align-items:center;
            justify-content:center;
            gap:0.3rem;
        }
        .logo-text span{
            color:var(--primary);
        }
        .form-title{
            font-size:1.5rem;
            margin-bottom:1.5rem;
            text-align:center;
        }
        .form-group{
            margin-bottom:1.15rem;
        }
        .form-label{
            display:block;
            margin-bottom:0.5rem;
            color:var(--text-muted);
            font-size:0.85rem;
            font-weight:500;
        }
        .form-input{
            width:100%;
            padding:0.875rem 1rem;
            border-radius:14px;
            border:1px solid rgba(148,163,184,0.25);
            background:rgba(15,23,42,0.6);
            color:var(--text-main);
            font-family:inherit;
            font-size:0.95rem;
            transition:all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .form-input::placeholder{
            color:rgba(156,163,175,0.5);
        }
        .form-input:focus{
            outline:none;
            border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(34,197,94,0.15);
            background:rgba(15,23,42,0.8);
        }
        .btn-primary{
            width:100%;
            padding:0.95rem;
            border-radius:14px;
            border:none;
            background:linear-gradient(135deg,var(--primary),var(--primary-strong));
            color:#022c22;
            font-family:inherit;
            font-size:1rem;
            font-weight:700;
            cursor:pointer;
            transition:all 0.35s cubic-bezier(0.4,0,0.2,1);
            letter-spacing:0.02em;
            margin-top:0.5rem;
        }
        .btn-primary:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(34,197,94,0.4);
        }
        .form-footer{
            text-align:center;
            margin-top:1.5rem;
            color:var(--text-muted);
        }
        .form-footer a{
            color:var(--accent);
            text-decoration:none;
        }
        .form-footer a:hover{
            text-decoration:underline;
        }
        .alert-error{
            background:rgba(239,68,68,0.1);
            border:1px solid rgba(239,68,68,0.3);
            color:#ef4444;
            padding:1rem;
            border-radius:12px;
            margin-bottom:1.5rem;
        }
        .back-link{
            display:inline-flex;
            align-items:center;
            gap:0.5rem;
            color:var(--text-muted);
            text-decoration:none;
            margin-bottom:1.5rem;
            transition:all.3s;
        }
        .back-link:hover{
            color:var(--accent);
        }
        /* Smooth entrance animation */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-container {
            animation: slideUp 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <div style="width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--accent));display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.5rem;color:#fff;box-shadow:0 8px 25px rgba(34,197,94,0.3);">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="logo-text">TROY<span>PERFUMES</span></div>
        </div>
        
        <a href="/" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>
        
        <h2 class="form-title">Create Account</h2>
        
        @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" placeholder="Enter your name" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Create a password (min 8 chars)" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm your password" required>
            </div>
            
            <button type="submit" class="btn-primary">Create Account</button>
        </form>
        
        <div class="form-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </div>
</body>
</html>
