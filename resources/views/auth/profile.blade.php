<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Profile - TROY Perfumes</title>
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
            --danger:#ef4444;
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
            padding:2rem;
        }
        .profile-container{
            background:var(--bg-elevated);
            border-radius:26px;
            padding:3rem;
            width:100%;
            max-width:500px;
            border:1px solid rgba(148,163,184,0.2);
            box-shadow:0 25px65px rgba(15,23,42,0.95);
        }
        .logo{
            text-align:center;
            margin-bottom:2rem;
        }
        .logo-text{
            font-weight:900;
            letter-spacing:.15em;
            font-size:1.8rem;
            color:var(--text-main);
        }
        .logo-text span{
            color:var(--primary);
        }
        .profile-header{
            text-align:center;
            margin-bottom:2rem;
        }
        .avatar{
            width:100px;
            height:100px;
            border-radius:50%;
            background:linear-gradient(135deg,var(--primary),var(--accent));
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0 auto1rem;
            font-size:2.5rem;
            color:#fff;
        }
        .profile-title{
            font-size:1.5rem;
            margin-bottom:0.5rem;
        }
        .role-badge{
            display:inline-block;
            background:var(--primary-soft);
            color:var(--primary);
            padding:0.25rem0.75rem;
            border-radius:20px;
            font-size:0.85rem;
            text-transform:capitalize;
        }
        .form-group{
            margin-bottom:1.5rem;
        }
        .form-label{
            display:block;
            margin-bottom:0.5rem;
            color:var(--text-muted);
            font-size:0.9rem;
        }
        .form-input{
            width:100%;
            padding:0.875rem1rem;
            border-radius:12px;
            border:1px solid rgba(148,163,184,0.3);
            background:rgba(15,23,42,0.8);
            color:var(--text-main);
            font-family:inherit;
            font-size:1rem;
        }
        .form-input:disabled{
            opacity:0.7;
            cursor:not-allowed;
        }
        .form-input:focus{
            outline:none;
            border-color:var(--primary);
        }
        .btn-primary{
            width:100%;
            padding:1rem;
            border-radius:12px;
            border:none;
            background:linear-gradient(135deg,var(--primary),var(--primary-strong));
            color:#022c22;
            font-family:inherit;
            font-size:1rem;
            font-weight:600;
            cursor:pointer;
            transition:all.3s;
        }
        .btn-primary:hover{
            transform:translateY(-2px);
            box-shadow:0 10px25px rgba(34,197,94,0.4);
        }
        .btn-secondary{
            width:100%;
            padding:1rem;
            border-radius:12px;
            border:1px solid var(--border-subtle);
            background:transparent;
            color:var(--text-main);
            font-family:inherit;
            font-size:1rem;
            font-weight:500;
            cursor:pointer;
            transition:all.3s;
            margin-top:1rem;
        }
        .btn-secondary:hover{
            background:rgba(255,255,255,0.05);
            border-color:var(--accent);
        }
        .alert-success{
            background:rgba(34,197,94,0.1);
            border:1px solid rgba(34,197,94,0.3);
            color:var(--primary);
            padding:1rem;
            border-radius:12px;
            margin-bottom:1.5rem;
            text-align:center;
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
        .menu-links{
            margin-top:1.5rem;
            padding-top:1.5rem;
            border-top:1px solid var(--border-subtle);
        }
        .menu-link{
            display:flex;
            align-items:center;
            gap:1rem;
            padding:0.75rem;
            border-radius:12px;
            color:var(--text-muted);
            text-decoration:none;
            transition:all.3s;
            margin-bottom:0.5rem;
        }
        .menu-link:hover{
            background:rgba(255,255,255,0.05);
            color:var(--text-main);
        }
        .menu-link.danger:hover{
            color:var(--danger);
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <a href="/" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>
        
        <div class="logo">
            <div class="logo-text">TROY<span>PERFUMES</span></div>
        </div>
        
        <div class="profile-header">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <h2 class="profile-title">{{ Auth::user()->name }}</h2>
            <span class="role-badge">{{ Auth::user()->getRoleNames()->first() }}</span>
        </div>
        
        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ Auth::user()->name }}" disabled>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ Auth::user()->email }}" disabled>
            </div>
            
            <div class="form-group">
                <label class="form-label">Member Since</label>
                <input type="text" class="form-input" value="{{ Auth::user()->created_at->format('F d, Y') }}" disabled>
            </div>
        </form>
        
        <div class="menu-links">
            <a href="#" class="menu-link" onclick="document.getElementById('passwordModal').style.display='block';return false;">
                <i class="fas fa-lock"></i> Change Password
            </a>
            <a href="{{ route('logout') }}" class="menu-link danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
    </div>
    
    <!-- Password Change Modal -->
    <div id="passwordModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.8);align-items:center;justify-content:center;z-index:9999;">
        <div class="profile-container" style="max-width:400px;">
            <h3 style="margin-bottom:1.5rem;">Change Password</h3>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-input" required minlength="8">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-input" required minlength="8">
                </div>
                <button type="submit" class="btn-primary">Update Password</button>
                <button type="button" class="btn-secondary" onclick="document.getElementById('passwordModal').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
