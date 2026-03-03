<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TROY Perfumes - Admin Control Panel (Nuclear Edition)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ========== COMPLETE STYLES (unchanged, same as original) ========== */
        :root {
            --bg: #050816;
            --bg-soft: #050b1f;
            --bg-elevated: #070f25;
            --primary: #22c55e;
            --primary-soft: rgba(34, 197, 94, 0.14);
            --primary-strong: #16a34a;
            --accent: #38bdf8;
            --card: #050b18;
            --glass: rgba(15, 23, 42, 0.65);
            --text-main: #e5f2ff;
            --text-muted: #9ca3af;
            --border-subtle: rgba(148, 163, 184, 0.35);
            --danger: #ef4444;
            --warning: #eab308;
            --success: #22c55e;
            --card-radius: 16px;
            --shadow-soft: 0 18px 45px rgba(15, 23, 42, 0.75);
            --shadow-main: 0 22px 65px rgba(15, 23, 42, 0.95);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: radial-gradient(circle at top, #172554 0, #020617 55%, #000 100%);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Header */
        .admin-header {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 2rem;
            background: linear-gradient(to bottom, rgba(2, 6, 23, 0.98), rgba(2, 6, 23, 0.95));
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.15);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            transition: all 0.4s ease;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text-main);
        }

        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            font-weight: 800;
            font-size: 1.4rem;
        }

        .logo-text {
            font-weight: 800;
            letter-spacing: 0.12em;
            font-size: 1.5rem;
        }

        .admin-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Main Layout */
        .admin-container {
            display: flex;
            min-height: calc(100vh - 80px);
        }

        /* Sidebar */
        .admin-sidebar {
            width: 270px;
            background: var(--bg-elevated);
            border-right: 1px solid rgba(148, 163, 184, 0.12);
            padding: 1.5rem 1.2rem;
            overflow-y: auto;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(15, 23, 42, 0.6);
            border-radius: var(--card-radius);
            margin-bottom: 2rem;
        }

        .admin-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1.3rem;
            border-radius: var(--card-radius);
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            cursor: pointer;
            font-size: 0.92rem;
        }

        .nav-item:hover {
            background: rgba(56, 189, 248, 0.08);
            color: var(--text-main);
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(34, 197, 94, 0.12);
            color: var(--primary);
            border-left: 3px solid var(--primary);
            font-weight: 500;
        }

        .nav-icon {
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .admin-main {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
        }

        /* Control Cards */
        .control-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .control-card {
            background: var(--bg-elevated);
            border-radius: var(--card-radius);
            border: 1px solid rgba(148, 163, 184, 0.15);
            padding: 1.5rem;
            box-shadow: var(--shadow-soft);
            transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
        }

        .control-card:hover {
            border-color: rgba(34, 197, 94, 0.25);
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.85);
            transform: translateY(-3px);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(34, 197, 94, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-input, .form-file {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid rgba(148, 163, 184, 0.25);
            background: rgba(15, 23, 42, 0.7);
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-file:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
            background: rgba(15, 23, 42, 0.85);
        }

        .form-file {
            padding: 0.5rem;
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid rgba(148, 163, 184, 0.3);
            background: rgba(15, 23, 42, 0.8);
            color: var(--text-main);
            font-family: inherit;
            font-size: 1rem;
            min-height: 120px;
            resize: vertical;
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid rgba(148, 163, 184, 0.3);
            background: rgba(15, 23, 42, 0.8);
            color: var(--text-main);
            font-family: inherit;
            font-size: 1rem;
        }

        /* Image preview */
        .image-preview {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }
        .preview-thumb {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.2);
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(148, 163, 184, 0.3);
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(24px);
        }

        /* Buttons */
        .btn {
            padding: 0.7rem 1.4rem;
            border-radius: 10px;
            border: none;
            font-family: inherit;
            font-size: 0.92rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-strong));
            color: #022c22;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(34, 197, 94, 0.35);
        }

        .btn-secondary {
            background: rgba(15, 23, 42, 0.8);
            color: var(--text-main);
            border: 1px solid rgba(148, 163, 184, 0.4);
        }

        .btn-secondary:hover {
            background: rgba(30, 41, 59, 0.8);
            border-color: var(--accent);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Nuclear button */
        .btn-nuclear {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color: white;
        }
        .btn-nuclear:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
        }

        /* Perfume List */
        .perfume-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .perfume-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(15, 23, 42, 0.5);
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, 0.15);
            transition: all 0.3s ease;
        }

        .perfume-item:hover {
            background: rgba(15, 23, 42, 0.7);
            border-color: rgba(56, 189, 248, 0.25);
            transform: translateX(4px);
        }

        .perfume-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .perfume-info {
            flex: 1;
        }

        .perfume-name {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .perfume-price {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .item-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Tabs */
        .tab-container {
            margin-bottom: 2rem;
        }

        .tab-header {
            display: flex;
            gap: 0.5rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
            margin-bottom: 1.5rem;
        }

        .tab-btn {
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-family: inherit;
            font-size: 0.95rem;
            cursor: pointer;
            position: relative;
        }

        .tab-btn.active {
            color: var(--primary);
        }

        .tab-btn.active:after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary);
            border-radius: 2px 2px 0 0;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-elevated);
            border-radius: var(--card-radius);
            padding: 1.5rem;
            border: 1px solid rgba(148, 163, 184, 0.15);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: rgba(34, 197, 94, 0.2);
            transform: translateY(-3px);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Color Picker */
        .color-picker {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .color-swatch {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }
        .color-swatch:hover {
            transform: scale(1.1);
            border-color: var(--primary);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: var(--success);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--danger);
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: var(--bg-elevated);
            border-radius: var(--card-radius);
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid rgba(148, 163, 184, 0.3);
            box-shadow: var(--shadow-main);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .admin-container {
                flex-direction: column;
            }
            
            .admin-sidebar {
                width: 100%;
                padding: 1.5rem;
            }
            
            .nav-menu {
                flex-direction: row;
                flex-wrap: wrap;
            }
            
            .nav-item {
                flex: 1;
                min-width: 150px;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 1rem;
            }
            
            .control-grid {
                grid-template-columns: 1fr;
            }
            
            .admin-main {
                padding: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="logo">
            <div class="logo-img" id="adminLogo">T</div>
            <div class="logo-text">TROY ADMIN</div>
        </div>
        <div class="admin-actions">
            <button class="btn btn-primary" onclick="saveAllChanges()">
                <i class="fas fa-save"></i> Save All Changes
            </button>
            <a href="/" class="btn btn-secondary" style="text-decoration:none;">
                <i class="fas fa-home"></i> Go to Website
            </a>
            <form action="/logout" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Main Container -->
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-user">
                <div class="admin-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <div style="font-weight: 600;">Admin User</div>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">Full Access</div>
                </div>
            </div>
            
            <nav class="nav-menu">
                <a class="nav-item active" data-tab="dashboard">
                    <div class="nav-icon"><i class="fas fa-tachometer-alt"></i></div>
                    <span>Dashboard</span>
                </a>
                <a class="nav-item" data-tab="perfumes">
                    <div class="nav-icon"><i class="fas fa-wine-bottle"></i></div>
                    <span>Perfume Management</span>
                </a>
                <a class="nav-item" data-tab="hero">
                    <div class="nav-icon"><i class="fas fa-star"></i></div>
                    <span>Hero Section</span>
                </a>
                <a class="nav-item" data-tab="videos">
                    <div class="nav-icon"><i class="fas fa-video"></i></div>
                    <span>Customer Videos</span>
                </a>
                <a class="nav-item" data-tab="weather">
                    <div class="nav-icon"><i class="fas fa-cloud-sun"></i></div>
                    <span>Weather System</span>
                </a>
                <a class="nav-item" data-tab="mood">
                    <div class="nav-icon"><i class="fas fa-smile-beam"></i></div>
                    <span>Mood Match</span>
                </a>
                <a class="nav-item" data-tab="design">
                    <div class="nav-icon"><i class="fas fa-palette"></i></div>
                    <span>Design & Theme</span>
                </a>
                <a class="nav-item" data-tab="analytics">
                    <div class="nav-icon"><i class="fas fa-chart-bar"></i></div>
                    <span>Analytics</span>
                </a>
                <a class="nav-item" data-tab="settings">
                    <div class="nav-icon"><i class="fas fa-cog"></i></div>
                    <span>Settings</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main" id="adminMain">
            <!-- Dashboard Tab (unchanged, truncated for brevity) -->
            <div class="tab-content active" id="dashboard">
                <div class="section-header">
                    <h1 class="section-title">Admin Dashboard</h1>
                    <div style="color: var(--text-muted); font-size: 0.9rem;">
                        Last saved: <span id="lastSavedTime">Just now</span>
                    </div>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value" id="perfumeCount">0</div>
                        <div class="stat-label">Active Perfumes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="totalViews">15,842</div>
                        <div class="stat-label">Customer Video Views</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="moodMatches">124</div>
                        <div class="stat-label">Mood Matches Today</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="cartItems">0</div>
                        <div class="stat-label">Active Cart Items</div>
                    </div>
                </div>
                
                <div class="control-grid">
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="card-title">Quick Actions</div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <button class="btn btn-secondary" onclick="loadCustomerData()">
                                <i class="fas fa-sync-alt"></i> Sync with Customer Page
                            </button>
                            <button class="btn btn-secondary" onclick="clearAllCaches()">
                                <i class="fas fa-trash-alt"></i> Clear All Caches
                            </button>
                            <button class="btn btn-secondary" onclick="exportAllData()">
                                <i class="fas fa-download"></i> Export All Data
                            </button>
                            <button class="btn btn-secondary" onclick="importAllData()">
                                <i class="fas fa-upload"></i> Import Data
                            </button>
                        </div>
                    </div>
                    
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="card-title">System Status</div>
                        </div>
                        <div class="form-group">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span>Customer Page</span>
                                <span style="color: var(--success); font-weight: 500;">Online</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span>Weather API</span>
                                <span style="color: var(--success); font-weight: 500;">Connected</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span>Storage Used</span>
                                <span id="storageUsed">12.4 KB</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>Last Backup</span>
                                <span>Today 10:30 AM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perfume Management Tab (unchanged, placeholder) -->
            <div class="tab-content" id="perfumes">
                <div class="section-header">
                    <h1 class="section-title">Perfume Management</h1>
                    <div style="display: flex; gap: 1rem;">
                        <button class="btn btn-nuclear" onclick="nuclearReset()">
                            <i class="fas fa-bomb"></i> Nuclear Reset
                        </button>
                        <button class="btn btn-primary" onclick="openPerfumeModal()">
                            <i class="fas fa-plus"></i> Add New Perfume
                        </button>
                    </div>
                </div>
                
                <div class="tab-container">
                    <div class="tab-header">
                        <button class="tab-btn active" data-perfume-tab="all">All Perfumes</button>
                        <button class="tab-btn" data-perfume-tab="bestsellers">Bestsellers</button>
                        <button class="tab-btn" data-perfume-tab="seasonal">Seasonal</button>
                    </div>
                    
                    <div class="perfume-list" id="perfumeList">
                        <!-- Perfumes will be loaded here -->
                    </div>
                </div>
            </div>

            <!-- Hero Section Tab (unchanged, placeholder) -->
            <div class="tab-content" id="hero">
                <div class="section-header">
                    <h1 class="section-title">Hero Section Control</h1>
                </div>
                <!-- ... (original content) ... -->
                <div class="control-grid">
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-heading"></i>
                            </div>
                            <div class="card-title">Hero Text</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Main Title</label>
                            <input type="text" class="form-input" id="heroTitle" value="TROY Perfumes" placeholder="Main headline">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Subtitle</label>
                            <textarea class="form-textarea" id="heroSubtitle" placeholder="Subtitle description">Discover long-lasting impressions curated by city, weather and your mood. Every bottle inspired by niche blends at accessible impressions pricing.</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Featured Perfume</label>
                            <select class="form-select" id="featuredPerfume">
                                <option value="1">Royal Oud</option>
                                <option value="2">Silver Mountain</option>
                                <option value="3">Desert Breeze</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div class="card-title">Tags & Metrics</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tag 1</label>
                            <input type="text" class="form-input" id="tag1" value="AI weather engine">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tag 2</label>
                            <input type="text" class="form-input" id="tag2" value="4.9/5 average rating">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tag 3</label>
                            <input type="text" class="form-input" id="tag3" value="2% served in name of Allah">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tag 4</label>
                            <input type="text" class="form-input" id="tag4" value="Mood-based matching">
                        </div>
                    </div>
                    
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="card-title">Performance Metrics</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Metric 1</label>
                            <input type="text" class="form-input" id="metric1" value="Over 50+ impressions">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Metric 2</label>
                            <input type="text" class="form-input" id="metric2" value="Up to 10–12 hrs hold">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Metric 3</label>
                            <input type="text" class="form-input" id="metric3" value="Tailored to London, Dubai, Lahore, Karachi & more">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Metric 4</label>
                            <input type="text" class="form-input" id="metric4" value="AI mood detection">
                        </div>
                    </div>
                </div>
            </div>

            <!-- TV Video Upload Tab -->
            <div class="tab-content" id="videos">
                <div class="section-header">
                    <h1 class="section-title">TV Screen Video Manager</h1>
                </div>
                <div class="control-grid">
                    <!-- Upload Card -->
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-upload"></i>
                            </div>
                            <div class="card-title">Upload New TV Video</div>
                        </div>
                        
                        <form id="tvVideoUploadForm" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="form-label">Video Title</label>
                                <input type="text" class="form-input" id="tvVideoTitle" name="title" placeholder="e.g. Royal Oud Promo">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Select Video File</label>
                                <input type="file" class="form-input" id="tvVideoFile" name="video" accept="video/mp4,video/webm,video/ogg,video/quicktime" style="padding: 0.6rem;">
                                <small style="color: var(--text-muted);">Max 100MB. Formats: MP4, WebM, OGG, MOV</small>
                            </div>

                            <!-- Video Requirements Info -->
                            <div style="background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.25); border-radius: 12px; padding: 1rem; margin-bottom: 1rem;">
                                <p style="font-weight: 600; color: var(--primary); margin-bottom: 0.5rem; font-size: 0.85rem;">
                                    <i class="fas fa-info-circle"></i> Video Requirements
                                </p>
                                <ul style="color: var(--text-muted); font-size: 0.8rem; list-style: none; padding: 0; margin: 0; line-height: 1.8;">
                                    <li><i class="fas fa-check" style="color: var(--primary); width: 16px;"></i> <strong>Formats:</strong> MP4, WebM, OGG, MOV</li>
                                    <li><i class="fas fa-check" style="color: var(--primary); width: 16px;"></i> <strong>Max size:</strong> 100 MB</li>
                                    <li><i class="fas fa-check" style="color: var(--primary); width: 16px;"></i> <strong>Min resolution:</strong> 640×360 (360p)</li>
                                    <li><i class="fas fa-check" style="color: var(--primary); width: 16px;"></i> <strong>Max resolution:</strong> 3840×2160 (4K)</li>
                                    <li><i class="fas fa-check" style="color: var(--primary); width: 16px;"></i> <strong>Best aspect ratio:</strong> 16:9 (recommended)</li>
                                </ul>
                            </div>

                            <!-- Error display -->
                            <div id="tvUploadError" style="display:none; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); border-radius: 10px; padding: 0.8rem 1rem; margin-bottom: 1rem; color: #ef4444; font-size: 0.85rem;">
                                <i class="fas fa-exclamation-triangle"></i> <span id="tvUploadErrorMsg"></span>
                            </div>

                            <div id="tvUploadProgress" style="display:none; margin-bottom:1rem;">
                                <div style="background: var(--bg-soft); border-radius: 8px; overflow: hidden; height: 8px;">
                                    <div id="tvUploadBar" style="height:100%; background: var(--primary); width:0%; transition: width 0.3s;"></div>
                                </div>
                                <small id="tvUploadPercent" style="color: var(--text-muted);">0%</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" id="tvUploadBtn" style="width:100%;">
                                <i class="fas fa-cloud-upload-alt"></i> Upload & Set as Active
                            </button>
                        </form>
                    </div>

                    <!-- Current Active Video -->
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-tv"></i>
                            </div>
                            <div class="card-title">Currently Active TV Video</div>
                        </div>
                        <div id="activeVideoPreview" style="text-align:center; padding:1rem 0;">
                            <p style="color: var(--text-muted);">Loading...</p>
                        </div>
                    </div>

                    <!-- All Uploaded Videos -->
                    <div class="control-card" style="grid-column: 1 / -1;">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-film"></i>
                            </div>
                            <div class="card-title">All Uploaded Videos</div>
                        </div>
                        <div id="allVideosList" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:1rem; padding-top:1rem;">
                            <p style="color: var(--text-muted);">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weather System Tab (unchanged, placeholder) -->
            <div class="tab-content" id="weather">
                <div class="section-header">
                    <h1 class="section-title">Weather System Control</h1>
                </div>
                <!-- ... (original content) ... -->
                <div class="control-grid">
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-city"></i>
                            </div>
                            <div class="card-title">City Management</div>
                        </div>
                        
                        <div id="citiesList">
                            <!-- Cities will be loaded here -->
                        </div>
                        
                        <button class="btn btn-secondary" style="width: 100%; margin-top: 1rem;" onclick="addNewCity()">
                            <i class="fas fa-plus"></i> Add New City
                        </button>
                    </div>
                    
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-temperature-high"></i>
                            </div>
                            <div class="card-title">Weather Settings</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Default API</label>
                            <select class="form-select" id="weatherAPI">
                                <option value="open-meteo" selected>Open-Meteo (Free)</option>
                                <option value="openweather">OpenWeather Map</option>
                                <option value="weatherstack">Weatherstack</option>
                                <option value="accuweather">AccuWeather</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">API Key</label>
                            <input type="password" class="form-input" id="apiKey" placeholder="Enter API key" value="demo_key_12345">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Cache Duration</label>
                            <select class="form-select" id="cacheDuration">
                                <option value="5">5 minutes</option>
                                <option value="10" selected>10 minutes</option>
                                <option value="30">30 minutes</option>
                                <option value="60">1 hour</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="enableWeather" checked> Enable Weather System
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="enableFallback" checked> Enable Fallback Data
                            </label>
                        </div>
                    </div>
                    
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-perfume-bottle"></i>
                            </div>
                            <div class="card-title">Temperature-Based Recommendations</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Hot (30°C+)</label>
                            <input type="text" class="form-input" id="recHot" value="Fresh, aquatic and citrus scents that feel cooling in humidity.">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Warm (20-30°C)</label>
                            <input type="text" class="form-input" id="recWarm" value="Balanced scents with citrus + woods or light oud work best.">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Cool (10-20°C)</label>
                            <input type="text" class="form-input" id="recCool" value="Warm, spicy and amber scents feel very cozy in this weather.">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Cold (Below 10°C)</label>
                            <input type="text" class="form-input" id="recCold" value="Rich woods, ambers and sweet gourmands for cooler climate.">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mood Match Tab (unchanged, placeholder) -->
            <div class="tab-content" id="mood">
                <div class="section-header">
                    <h1 class="section-title">Mood Match System</h1>
                </div>
                <!-- ... (original content) ... -->
                <div class="tab-container">
                    <div class="tab-header">
                        <button class="tab-btn active" data-mood-tab="moods">Mood Settings</button>
                        <button class="tab-btn" data-mood-tab="perfume-mapping">Perfume Mapping</button>
                        <button class="tab-btn" data-mood-tab="simulation">Simulation Mode</button>
                    </div>
                    
                    <div class="tab-content active" id="moodSettings">
                        <div class="control-grid">
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <div class="card-title">Camera & Image Settings</div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                        <input type="checkbox" id="enableCamera" checked> Enable Camera Access
                                    </label>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                        <input type="checkbox" id="enableImageUpload" checked> Enable Image Upload
                                    </label>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Max Image Size (MB)</label>
                                    <input type="number" class="form-input" id="maxImageSize" value="5">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Default Mode</label>
                                    <select class="form-select" id="defaultMoodMode">
                                        <option value="simulation" selected>AI Simulation</option>
                                        <option value="mood-match">Mood Match</option>
                                        <option value="azure">Azure AI</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                    <div class="card-title">AI Simulation Settings</div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Default Mood Probabilities</label>
                                    <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.5rem;">
                                        <div style="display: flex; align-items: center; gap: 1rem;">
                                            <span style="min-width: 100px;">Happy:</span>
                                            <input type="range" min="0" max="100" value="25" class="form-input" style="flex: 1; padding: 0;">
                                            <span>25%</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 1rem;">
                                            <span style="min-width: 100px;">Calm:</span>
                                            <input type="range" min="0" max="100" value="20" class="form-input" style="flex: 1; padding: 0;">
                                            <span>20%</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 1rem;">
                                            <span style="min-width: 100px;">Confident:</span>
                                            <input type="range" min="0" max="100" value="15" class="form-input" style="flex: 1; padding: 0;">
                                            <span>15%</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Analysis Delay (ms)</label>
                                    <input type="number" class="form-input" id="analysisDelay" value="1500">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                        <input type="checkbox" id="showConfidence" checked> Show Confidence Scores
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="control-card" style="grid-column: 1 / -1;">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-smile"></i>
                                </div>
                                <div class="card-title">Mood Definitions</div>
                            </div>
                            
                            <div id="moodDefinitions">
                                <!-- Mood definitions will be loaded here -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="perfumeMapping">
                        <div class="section-header" style="margin-bottom: 1rem;">
                            <h2 class="section-title" style="font-size:1.5rem;">Assign Moods to Perfumes</h2>
                            <button class="btn btn-primary" onclick="saveMoodMapping()">
                                <i class="fas fa-save"></i> Save Mood Mapping
                            </button>
                        </div>
                        <div id="moodMappingContainer">
                            <!-- Dynamic list of perfumes with mood checkboxes -->
                        </div>
                    </div>

                    <div class="tab-content" id="simulationMode">
                        <div class="control-card">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <div class="card-title">Simulation Mode</div>
                            </div>
                            <p class="form-text text-muted">Configure simulation parameters (coming soon).</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== ENHANCED DESIGN & THEME TAB ========== -->
            <div class="tab-content" id="design">
                <div class="section-header">
                    <h1 class="section-title">Design & Theme Control</h1>
                </div>
                
                <div class="tab-container">
                    <div class="tab-header">
                        <button class="tab-btn active" data-design-tab="colors">Colors</button>
                        <button class="tab-btn" data-design-tab="images">Images</button>
                        <button class="tab-btn" data-design-tab="animations">Animations</button>
                    </div>
                    
                    <!-- COLORS TAB (expanded) -->
                    <div class="tab-content active" id="designColors">
                        <div class="control-grid">
                            <!-- Primary Colors Card -->
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <div class="card-title">Theme Colors</div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Primary Color</label>
                                    <div class="color-picker">
                                        <div class="color-swatch" style="background: #22c55e;" data-color="#22c55e"></div>
                                        <div class="color-swatch" style="background: #3b82f6;" data-color="#3b82f6"></div>
                                        <div class="color-swatch" style="background: #8b5cf6;" data-color="#8b5cf6"></div>
                                        <div class="color-swatch" style="background: #ec4899;" data-color="#ec4899"></div>
                                        <input type="color" class="form-input" id="primaryColor" value="#22c55e" style="width: 60px; height: 40px; padding: 0;">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Accent Color</label>
                                    <div class="color-picker">
                                        <div class="color-swatch" style="background: #38bdf8;" data-color="#38bdf8"></div>
                                        <div class="color-swatch" style="background: #f97316;" data-color="#f97316"></div>
                                        <div class="color-swatch" style="background: #10b981;" data-color="#10b981"></div>
                                        <div class="color-swatch" style="background: #f59e0b;" data-color="#f59e0b"></div>
                                        <input type="color" class="form-input" id="accentColor" value="#38bdf8" style="width: 60px; height: 40px; padding: 0;">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Background Color</label>
                                    <div class="color-picker">
                                        <div class="color-swatch" style="background: #050816;" data-color="#050816"></div>
                                        <div class="color-swatch" style="background: #0f172a;" data-color="#0f172a"></div>
                                        <div class="color-swatch" style="background: #1e293b;" data-color="#1e293b"></div>
                                        <div class="color-swatch" style="background: #334155;" data-color="#334155"></div>
                                        <input type="color" class="form-input" id="bgColor" value="#050816" style="width: 60px; height: 40px; padding: 0;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Text Color</label>
                                    <div class="color-picker">
                                        <div class="color-swatch" style="background: #e5f2ff;" data-color="#e5f2ff"></div>
                                        <div class="color-swatch" style="background: #ffffff;" data-color="#ffffff"></div>
                                        <div class="color-swatch" style="background: #9ca3af;" data-color="#9ca3af"></div>
                                        <input type="color" class="form-input" id="textColor" value="#e5f2ff" style="width: 60px; height: 40px; padding: 0;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Card Background</label>
                                    <div class="color-picker">
                                        <div class="color-swatch" style="background: #070f25;" data-color="#070f25"></div>
                                        <div class="color-swatch" style="background: #0f172a;" data-color="#0f172a"></div>
                                        <div class="color-swatch" style="background: #1e293b;" data-color="#1e293b"></div>
                                        <input type="color" class="form-input" id="cardBgColor" value="#070f25" style="width: 60px; height: 40px; padding: 0;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Border Color</label>
                                    <div class="color-picker">
                                        <div class="color-swatch" style="background: rgba(148,163,184,0.35);" data-color="rgba(148,163,184,0.35)"></div>
                                        <div class="color-swatch" style="background: #334155;" data-color="#334155"></div>
                                        <div class="color-swatch" style="background: #4b5563;" data-color="#4b5563"></div>
                                        <input type="color" class="form-input" id="borderColor" value="#9ca3af" style="width: 60px; height: 40px; padding: 0;">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Preview Card (updated) -->
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="card-title">Live Preview</div>
                                </div>
                                
                                <div style="display: flex; flex-direction: column; gap: 1rem; background: var(--bg-elevated); padding: 1rem; border-radius: 12px;">
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="width: 80px; height: 40px; background: var(--primary); border-radius: 8px;"></div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 500; color: var(--text-main);">Primary Color</div>
                                            <div style="font-size: 0.9rem; color: var(--text-muted);">Used for buttons and highlights</div>
                                        </div>
                                    </div>
                                    
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="width: 80px; height: 40px; background: var(--accent); border-radius: 8px;"></div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 500; color: var(--text-main);">Accent Color</div>
                                            <div style="font-size: 0.9rem; color: var(--text-muted);">Used for secondary elements</div>
                                        </div>
                                    </div>
                                    
                                    <div style="display: flex; gap: 1rem;">
                                        <div style="width: 80px; height: 40px; background: var(--bg); border-radius: 8px;"></div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 500; color: var(--text-main);">Background</div>
                                            <div style="font-size: 0.9rem; color: var(--text-muted);">Main page background</div>
                                        </div>
                                    </div>

                                    <div style="display: flex; gap: 1rem;">
                                        <div style="width: 80px; height: 40px; background: var(--card); border-radius: 8px;"></div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 500; color: var(--text-main);">Card Background</div>
                                            <div style="font-size: 0.9rem; color: var(--text-muted);">Cards and elevated elements</div>
                                        </div>
                                    </div>

                                    <div style="display: flex; gap: 1rem;">
                                        <div style="width: 80px; height: 40px; border: 2px solid var(--border-subtle); border-radius: 8px;"></div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 500; color: var(--text-main);">Border Color</div>
                                            <div style="font-size: 0.9rem; color: var(--text-muted);">Subtle borders and dividers</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;" onclick="applyThemeColors()">
                                    <i class="fas fa-check"></i> Apply Theme Colors
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- IMAGES TAB (new) -->
                    <div class="tab-content" id="designImages">
                        <div class="control-grid">
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <div class="card-title">Logo & Branding</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Logo Image</label>
                                    <input type="file" class="form-file" id="logoImageUpload" accept="image/*" onchange="previewImage(this, 'logoPreview')">
                                    <div class="image-preview" id="logoPreview">
                                        <img src="" class="preview-thumb" style="display:none;" id="logoPreviewImg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Hero Background Image</label>
                                    <input type="file" class="form-file" id="heroImageUpload" accept="image/*" onchange="previewImage(this, 'heroPreview')">
                                    <div class="image-preview" id="heroPreview">
                                        <img src="" class="preview-thumb" style="display:none;" id="heroPreviewImg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Footer Logo (optional)</label>
                                    <input type="file" class="form-file" id="footerLogoUpload" accept="image/*" onchange="previewImage(this, 'footerPreview')">
                                    <div class="image-preview" id="footerPreview">
                                        <img src="" class="preview-thumb" style="display:none;" id="footerPreviewImg">
                                    </div>
                                </div>
                            </div>
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="card-title">Image Notes</div>
                                </div>
                                <p style="color: var(--text-muted);">Upload images in PNG or JPG format. Recommended size: 200x200px for logos, 1920x1080px for hero. Images are stored as data URLs.</p>
                            </div>
                        </div>
                    </div>

                    <!-- ANIMATIONS TAB (new) -->
                    <div class="tab-content" id="designAnimations">
                        <div class="control-grid">
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-film"></i>
                                    </div>
                                    <div class="card-title">Animation Settings</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                        <input type="checkbox" id="enableAnimations" checked> Enable Animations
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Animation Style</label>
                                    <select class="form-select" id="animationStyle">
                                        <option value="fade">Fade</option>
                                        <option value="slide">Slide</option>
                                        <option value="pulse">Pulse</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Animation Speed</label>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <input type="range" min="0.2" max="2" step="0.1" value="1" class="form-input" id="animationSpeed" style="flex:1;">
                                        <span id="speedValue">1.0x</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Hover Effects</label>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <label style="display: flex; align-items: center; gap: 0.3rem;">
                                            <input type="radio" name="hoverEffect" value="scale" checked> Scale
                                        </label>
                                        <label style="display: flex; align-items: center; gap: 0.3rem;">
                                            <input type="radio" name="hoverEffect" value="glow"> Glow
                                        </label>
                                        <label style="display: flex; align-items: center; gap: 0.3rem;">
                                            <input type="radio" name="hoverEffect" value="none"> None
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="control-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                    <div class="card-title">Preview</div>
                                </div>
                                <div style="text-align: center; padding: 2rem;" id="animationPreviewBox">
                                    <div style="width: 100px; height: 100px; background: var(--primary); margin: 0 auto; border-radius: 12px; transition: all var(--animation-speed, 0.3s);" id="previewBox"></div>
                                    <p style="margin-top: 1rem; color: var(--text-muted);">Hover over the box to see effect</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Tab (unchanged, placeholder) -->
            <div class="tab-content" id="analytics">
                <div class="section-header">
                    <h1 class="section-title">Analytics & Insights</h1>
                </div>
                <!-- ... (original content) ... -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">24.7K</div>
                        <div class="stat-label">Total Page Views</div>
                        <div style="color: var(--success); font-size: 0.9rem; margin-top: 0.5rem;">
                            <i class="fas fa-arrow-up"></i> 12% from last week
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">3.2K</div>
                        <div class="stat-label">Unique Visitors</div>
                        <div style="color: var(--success); font-size: 0.9rem; margin-top: 0.5rem;">
                            <i class="fas fa-arrow-up"></i> 8% from last week
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">42%</div>
                        <div class="stat-label">Mobile Users</div>
                        <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.5rem;">
                            58% Desktop
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-value">2.4 min</div>
                        <div class="stat-label">Avg. Session Duration</div>
                        <div style="color: var(--warning); font-size: 0.9rem; margin-top: 0.5rem;">
                            <i class="fas fa-arrow-down"></i> 3% from last week
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab (unchanged, placeholder) -->
            <div class="tab-content" id="settings">
                <div class="section-header">
                    <h1 class="section-title">System Settings</h1>
                </div>
                <!-- ... (original content) ... -->
                <div class="control-grid">
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="card-title">Checkout Settings</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="text" class="form-input" id="whatsappNumber" value="923140063717">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Contribution Percentage</label>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <input type="range" min="0" max="10" value="2" class="form-input" style="flex: 1; padding: 0;">
                                <span id="contributionPercent">2%</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="enableContribution" checked> Enable Contribution System
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="enableLocation" checked> Enable Location for Delivery
                            </label>
                        </div>
                    </div>
                    
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-title">Notifications</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="notifyOrders" checked> Notify on New Orders
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="notifyLowStock" checked> Notify on Low Stock
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="notifyWeatherFail" checked> Notify on Weather API Fail
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" id="notifySystemErrors" checked> Notify on System Errors
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Notification Method</label>
                            <select class="form-select" id="notificationMethod">
                                <option value="browser">Browser Notification</option>
                                <option value="email">Email</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="card-title">Data Management</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Auto-save Interval</label>
                            <select class="form-select" id="autoSaveInterval">
                                <option value="30">30 seconds</option>
                                <option value="60" selected>1 minute</option>
                                <option value="300">5 minutes</option>
                                <option value="600">10 minutes</option>
                                <option value="0">Manual only</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Backup Frequency</label>
                            <select class="form-select" id="backupFrequency">
                                <option value="daily">Daily</option>
                                <option value="weekly" selected>Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Data Retention</label>
                            <select class="form-select" id="dataRetention">
                                <option value="30">30 days</option>
                                <option value="90">90 days</option>
                                <option value="365" selected>1 year</option>
                                <option value="forever">Forever</option>
                            </select>
                        </div>
                        
                        <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                            <button class="btn btn-secondary" style="flex: 1;" onclick="backupData()">
                                <i class="fas fa-save"></i> Backup Now
                            </button>
                            <button class="btn btn-danger" style="flex: 1;" onclick="resetAllData()">
                                <i class="fas fa-trash-alt"></i> Reset All
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Adding/Editing Perfume (unchanged) -->
    <div class="modal" id="perfumeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="perfumeModalTitle">Add New Perfume</h2>
                <button class="close-modal" onclick="closePerfumeModal()">&times;</button>
            </div>
            <div id="perfumeModalContent">
                <!-- Content will be loaded by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Alert Container -->
    <div id="alertContainer" style="position: fixed; top: 100px; right: 20px; z-index: 1000; display: flex; flex-direction: column; gap: 10px;"></div>

    <script>
        // ==================== NUCLEAR ADMIN SCRIPT ====================
        let adminData = {
            perfumes: [],
            heroSection: {},
            videos: {},
            weather: {},
            mood: {},
            design: {
                // default design values
                primaryColor: '#22c55e',
                accentColor: '#38bdf8',
                bgColor: '#050816',
                textColor: '#e5f2ff',
                cardBgColor: '#070f25',
                borderColor: 'rgba(148,163,184,0.35)',
                logo: '',
                heroImage: '',
                footerLogo: '',
                animations: {
                    enabled: true,
                    style: 'fade',
                    speed: 1,
                    hoverEffect: 'scale'
                }
            },
            analytics: {},
            settings: {}
        };

        const MOOD_LIST = ['happy','energetic','calm','romantic','confident','neutral','surprised','sad'];

        // Nuclear Reset
        function nuclearReset() {
            if (confirm('☢️ NUCLEAR RESET: This will delete ALL data (perfumes, settings, everything) and reload the page. Continue?')) {
                localStorage.clear();
                adminData = {
                    perfumes: [],
                    heroSection: {},
                    videos: {},
                    weather: {},
                    mood: {},
                    design: {
                        primaryColor: '#22c55e',
                        accentColor: '#38bdf8',
                        bgColor: '#050816',
                        textColor: '#e5f2ff',
                        cardBgColor: '#070f25',
                        borderColor: 'rgba(148,163,184,0.35)',
                        logo: '',
                        heroImage: '',
                        footerLogo: '',
                        animations: { enabled: true, style: 'fade', speed: 1, hoverEffect: 'scale' }
                    },
                    analytics: {},
                    settings: {}
                };
                alert('Nuclear reset complete. Page will now reload.');
                location.reload();
            }
        }

        // Load all admin data
        function loadAdminData() {
            try {
                // First try to fetch from database API (including inactive for admin)
                fetch('/api/perfumes?include_inactive=1')
                    .then(response => response.json())
                    .then(data => {
                        console.log('API Response:', data);
                        
                        // Handle both array response and object with perfumes key
                        let perfumesData = [];
                        if (Array.isArray(data)) {
                            perfumesData = data;
                        } else if (data && data.perfumes) {
                            perfumesData = data.perfumes;
                        } else if (data && data.success && Array.isArray(data)) {
                            perfumesData = data;
                        }
                        
                        if (perfumesData.length > 0) {
                            adminData.perfumes = perfumesData.map(p => {
                                // Convert notes to array format for edit form
                                let notesArray = [];
                                if (Array.isArray(p.notes)) {
                                    notesArray = p.notes;
                                } else if (p.notes && typeof p.notes === 'object') {
                                    // Handle object format from database
                                    notesArray = [...(p.notes.top || []), ...(p.notes.middle || []), ...(p.notes.base || [])];
                                } else if (typeof p.notes === 'string') {
                                    notesArray = p.notes.split(',').map(n => n.trim());
                                }
                                
                                return {
                                    id: p.id,
                                    name: p.name || 'Untitled',
                                    nameAr: p.name_ar || p.name || '',
                                    price: p.price || 0,
                                    originalPrice: p.original_price || p.originalPrice || p.price || 0,
                                    description: p.description || '',
                                    descriptionAr: p.description_ar || p.description || '',
                                    rating: p.rating || 0,
                                    reviews: p.rating_count || p.reviews || 0,
                                    featured: p.is_featured || p.isFeatured || false,
                                    bestseller: p.is_bestseller || p.isBestseller || false,
                                    active: p.is_active !== false,
                                    city: p.city || '',
                                    temperature: p.recommended_temperature || p.recommendedTemperature || '',
                                    images: (p.images && p.images.length > 0) ? p.images.map(img => typeof img === 'string' ? img : (img.url || img.image_path || '')).filter(img => img) : [],
                                    notes: notesArray
                                };
                            });
                            console.log('Loaded perfumes from database:', adminData.perfumes.length);
                        } else {
                            // Fallback to localStorage
                            const savedData = localStorage.getItem('troy-admin-data');
                            if (savedData) {
                                adminData = JSON.parse(savedData);
                            }
                        }
                        
                        // Ensure design object exists
                        if (!adminData.design) adminData.design = {};
                        if (!adminData.design.animations) adminData.design.animations = { enabled: true, style: 'fade', speed: 1, hoverEffect: 'scale' };
                        if (!adminData.design.primaryColor) adminData.design.primaryColor = '#22c55e';
                        if (!adminData.design.accentColor) adminData.design.accentColor = '#38bdf8';
                        if (!adminData.design.bgColor) adminData.design.bgColor = '#050816';
                        if (!adminData.design.textColor) adminData.design.textColor = '#e5f2ff';
                        if (!adminData.design.cardBgColor) adminData.design.cardBgColor = '#070f25';
                        if (!adminData.design.borderColor) adminData.design.borderColor = 'rgba(148,163,184,0.35)';
                        
                        if (!adminData.perfumes) adminData.perfumes = [];
                        
                        loadCustomerData();
                        updateAllForms();
                        renderMoodMapping();
                        updateDesignPreview();
                        loadStats(); // Load stats from database
                        showAlert('Data loaded successfully from database (' + adminData.perfumes.length + ' perfumes)', 'success');
                    })
                    .catch(error => {
                        console.error('Error fetching from API:', error);
                        // Fallback to localStorage
                        const savedData = localStorage.getItem('troy-admin-data');
                        if (savedData) {
                            adminData = JSON.parse(savedData);
                            if (!adminData.design) adminData.design = {};
                            if (!adminData.design.animations) adminData.design.animations = { enabled: true, style: 'fade', speed: 1, hoverEffect: 'scale' };
                            if (!adminData.design.primaryColor) adminData.design.primaryColor = '#22c55e';
                            if (!adminData.design.accentColor) adminData.design.accentColor = '#38bdf8';
                            if (!adminData.design.bgColor) adminData.design.bgColor = '#050816';
                            if (!adminData.design.textColor) adminData.design.textColor = '#e5f2ff';
                            if (!adminData.design.cardBgColor) adminData.design.cardBgColor = '#070f25';
                            if (!adminData.design.borderColor) adminData.design.borderColor = 'rgba(148,163,184,0.35)';
                        }
                        if (!adminData.perfumes) adminData.perfumes = [];
                        loadCustomerData();
                        updateAllForms();
                        renderMoodMapping();
                        updateDesignPreview();
                        showAlert('Data loaded from local storage', 'success');
                    });
            } catch (error) {
                console.error('Error loading admin data:', error);
                showAlert('Error loading data', 'error');
            }
        }

        // Load stats from database
        function loadStats() {
            fetch('/api/admin/stats')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.stats) {
                        const stats = data.stats;
                        
                        // Update stat cards with real data
                        const perfumeCountEl = document.getElementById('perfumeCount');
                        if (perfumeCountEl) {
                            perfumeCountEl.textContent = stats.perfumeCount;
                        }
                        
                        const totalViewsEl = document.getElementById('totalViews');
                        if (totalViewsEl) {
                            totalViewsEl.textContent = stats.totalPerfumes || '0';
                        }
                        
                        const moodMatchesEl = document.getElementById('moodMatches');
                        if (moodMatchesEl) {
                            moodMatchesEl.textContent = stats.featuredPerfumes || '0';
                        }
                        
                        const cartItemsEl = document.getElementById('cartItems');
                        if (cartItemsEl) {
                            cartItemsEl.textContent = stats.bestsellerPerfumes || '0';
                        }
                        
                        console.log('Stats loaded:', stats);
                    }
                })
                .catch(error => {
                    console.error('Error loading stats:', error);
                });
        }

        // Save all changes
        function saveAllChanges() {
            try {
                gatherFormData();
                localStorage.setItem('troy-admin-data', JSON.stringify(adminData));
                updateCustomerPage();
                document.getElementById('lastSavedTime').textContent = new Date().toLocaleTimeString();
                console.log('Saved admin data:', adminData);
                showAlert('All changes saved successfully', 'success');
            } catch (error) {
                console.error('Error saving data:', error);
                showAlert('Error saving data', 'error');
            }
        }

        // Update customer page with admin changes
        function updateCustomerPage() {
            try {
                localStorage.setItem('troy-display-perfumes', JSON.stringify(adminData.perfumes));
                
                // Save design settings for customer page
                localStorage.setItem('troy-design-settings', JSON.stringify(adminData.design));
                
                const imageData = {
                    logo: { src: adminData.design.logo || '', alt: 'TROY Logo' },
                    hero: { src: adminData.design.heroImage || '', alt: 'TROY Hero' },
                    footerLogo: { src: adminData.design.footerLogo || '', alt: 'TROY Footer Logo' }
                };
                localStorage.setItem('troy-display-images', JSON.stringify(imageData));
                
                const heroData = {
                    title: document.getElementById('heroTitle').value,
                    subtitle: document.getElementById('heroSubtitle').value,
                    tags: [
                        document.getElementById('tag1').value,
                        document.getElementById('tag2').value,
                        document.getElementById('tag3').value,
                        document.getElementById('tag4').value
                    ],
                    metrics: [
                        document.getElementById('metric1').value,
                        document.getElementById('metric2').value,
                        document.getElementById('metric3').value,
                        document.getElementById('metric4').value
                    ]
                };
                localStorage.setItem('troy-hero-data', JSON.stringify(heroData));
                
                showAlert('Customer page updated', 'success');
            } catch (error) {
                console.error('Error updating customer page:', error);
            }
        }

        // Gather data from all forms (including new design fields)
        function gatherFormData() {
            // Hero Section
            adminData.heroSection = {
                title: document.getElementById('heroTitle').value,
                subtitle: document.getElementById('heroSubtitle').value,
                tags: [
                    document.getElementById('tag1').value,
                    document.getElementById('tag2').value,
                    document.getElementById('tag3').value,
                    document.getElementById('tag4').value
                ],
                metrics: [
                    document.getElementById('metric1').value,
                    document.getElementById('metric2').value,
                    document.getElementById('metric3').value,
                    document.getElementById('metric4').value
                ],
                featuredPerfume: document.getElementById('featuredPerfume').value
            };
            
            // Video Settings - now managed via database upload
            adminData.videos = {};
            
            // Weather Settings
            adminData.weather = {
                api: document.getElementById('weatherAPI').value,
                apiKey: document.getElementById('apiKey').value,
                cacheDuration: document.getElementById('cacheDuration').value,
                enabled: document.getElementById('enableWeather').checked,
                fallback: document.getElementById('enableFallback').checked,
                recommendations: {
                    hot: document.getElementById('recHot').value,
                    warm: document.getElementById('recWarm').value,
                    cool: document.getElementById('recCool').value,
                    cold: document.getElementById('recCold').value
                }
            };
            
            // Mood Settings
            adminData.mood = {
                cameraEnabled: document.getElementById('enableCamera').checked,
                imageUploadEnabled: document.getElementById('enableImageUpload').checked,
                maxImageSize: document.getElementById('maxImageSize').value,
                defaultMode: document.getElementById('defaultMoodMode').value,
                showConfidence: document.getElementById('showConfidence').checked,
                analysisDelay: document.getElementById('analysisDelay').value
            };
            
            // Design Settings (colors)
            adminData.design.primaryColor = document.getElementById('primaryColor').value;
            adminData.design.accentColor = document.getElementById('accentColor').value;
            adminData.design.bgColor = document.getElementById('bgColor').value;
            adminData.design.textColor = document.getElementById('textColor').value;
            adminData.design.cardBgColor = document.getElementById('cardBgColor').value;
            adminData.design.borderColor = document.getElementById('borderColor').value;
            
            // Animations
            adminData.design.animations = {
                enabled: document.getElementById('enableAnimations').checked,
                style: document.getElementById('animationStyle').value,
                speed: parseFloat(document.getElementById('animationSpeed').value),
                hoverEffect: document.querySelector('input[name="hoverEffect"]:checked')?.value || 'scale'
            };
            
            // Settings
            adminData.settings = {
                whatsappNumber: document.getElementById('whatsappNumber').value,
                contributionPercent: document.getElementById('contributionPercent').textContent,
                contributionEnabled: document.getElementById('enableContribution').checked,
                locationEnabled: document.getElementById('enableLocation').checked,
                notifications: {
                    orders: document.getElementById('notifyOrders').checked,
                    lowStock: document.getElementById('notifyLowStock').checked,
                    weatherFail: document.getElementById('notifyWeatherFail').checked,
                    systemErrors: document.getElementById('notifySystemErrors').checked,
                    method: document.getElementById('notificationMethod').value
                },
                autoSave: document.getElementById('autoSaveInterval').value,
                backupFrequency: document.getElementById('backupFrequency').value,
                dataRetention: document.getElementById('dataRetention').value
            };
        }

        // Update all forms with loaded data
        function updateAllForms() {
            // Hero Section
            if (adminData.heroSection) {
                document.getElementById('heroTitle').value = adminData.heroSection.title || 'TROY Perfumes';
                document.getElementById('heroSubtitle').value = adminData.heroSection.subtitle || '';
                if (adminData.heroSection.tags) {
                    document.getElementById('tag1').value = adminData.heroSection.tags[0] || '';
                    document.getElementById('tag2').value = adminData.heroSection.tags[1] || '';
                    document.getElementById('tag3').value = adminData.heroSection.tags[2] || '';
                    document.getElementById('tag4').value = adminData.heroSection.tags[3] || '';
                }
                if (adminData.heroSection.metrics) {
                    document.getElementById('metric1').value = adminData.heroSection.metrics[0] || '';
                    document.getElementById('metric2').value = adminData.heroSection.metrics[1] || '';
                    document.getElementById('metric3').value = adminData.heroSection.metrics[2] || '';
                    document.getElementById('metric4').value = adminData.heroSection.metrics[3] || '';
                }
                document.getElementById('featuredPerfume').value = adminData.heroSection.featuredPerfume || '1';
            }
            
            // Video Settings
            if (adminData.videos) {
                document.getElementById('videoTitle').value = adminData.videos.title || '';
                document.getElementById('customerName').value = adminData.videos.customerName || '';
                document.getElementById('customerCompany').value = adminData.videos.company || '';
                document.getElementById('videoDescription').value = adminData.videos.description || '';
                document.getElementById('videoURL').value = adminData.videos.url || '';
                if (adminData.videos.stats) {
                    document.getElementById('viewCount').value = adminData.videos.stats.views || 0;
                    document.getElementById('likeCount').value = adminData.videos.stats.likes || 0;
                    document.getElementById('shareCount').value = adminData.videos.stats.shares || 0;
                }
                document.getElementById('autoIncrement').checked = adminData.videos.autoIncrement || false;
                document.getElementById('incrementRate').value = adminData.videos.incrementRate || 'medium';
                if (adminData.videos.socialSharing) {
                    document.getElementById('enableFacebook').checked = adminData.videos.socialSharing.facebook || false;
                    document.getElementById('enableTwitter').checked = adminData.videos.socialSharing.twitter || false;
                    document.getElementById('enableWhatsApp').checked = adminData.videos.socialSharing.whatsapp || false;
                    document.getElementById('enableCopyLink').checked = adminData.videos.socialSharing.copyLink || false;
                    document.getElementById('enableLikes').checked = adminData.videos.socialSharing.likes || false;
                }
            }
            
            // Weather
            if (adminData.weather) {
                document.getElementById('weatherAPI').value = adminData.weather.api || 'open-meteo';
                document.getElementById('apiKey').value = adminData.weather.apiKey || '';
                document.getElementById('cacheDuration').value = adminData.weather.cacheDuration || '10';
                document.getElementById('enableWeather').checked = adminData.weather.enabled !== false;
                document.getElementById('enableFallback').checked = adminData.weather.fallback !== false;
                if (adminData.weather.recommendations) {
                    document.getElementById('recHot').value = adminData.weather.recommendations.hot || '';
                    document.getElementById('recWarm').value = adminData.weather.recommendations.warm || '';
                    document.getElementById('recCool').value = adminData.weather.recommendations.cool || '';
                    document.getElementById('recCold').value = adminData.weather.recommendations.cold || '';
                }
            }
            
            // Mood
            if (adminData.mood) {
                document.getElementById('enableCamera').checked = adminData.mood.cameraEnabled !== false;
                document.getElementById('enableImageUpload').checked = adminData.mood.imageUploadEnabled !== false;
                document.getElementById('maxImageSize').value = adminData.mood.maxImageSize || 5;
                document.getElementById('defaultMoodMode').value = adminData.mood.defaultMode || 'simulation';
                document.getElementById('showConfidence').checked = adminData.mood.showConfidence !== false;
                document.getElementById('analysisDelay').value = adminData.mood.analysisDelay || 1500;
            }
            
            // Design Colors
            if (adminData.design) {
                document.getElementById('primaryColor').value = adminData.design.primaryColor || '#22c55e';
                document.getElementById('accentColor').value = adminData.design.accentColor || '#38bdf8';
                document.getElementById('bgColor').value = adminData.design.bgColor || '#050816';
                document.getElementById('textColor').value = adminData.design.textColor || '#e5f2ff';
                document.getElementById('cardBgColor').value = adminData.design.cardBgColor || '#070f25';
                document.getElementById('borderColor').value = adminData.design.borderColor || 'rgba(148,163,184,0.35)';
                
                // Animations
                if (adminData.design.animations) {
                    document.getElementById('enableAnimations').checked = adminData.design.animations.enabled !== false;
                    document.getElementById('animationStyle').value = adminData.design.animations.style || 'fade';
                    document.getElementById('animationSpeed').value = adminData.design.animations.speed || 1;
                    document.getElementById('speedValue').textContent = (adminData.design.animations.speed || 1).toFixed(1) + 'x';
                    const hover = adminData.design.animations.hoverEffect || 'scale';
                    document.querySelector(`input[name="hoverEffect"][value="${hover}"]`).checked = true;
                }
                
                // Image previews (if data URLs exist)
                if (adminData.design.logo) {
                    showImagePreview('logoPreview', adminData.design.logo);
                }
                if (adminData.design.heroImage) {
                    showImagePreview('heroPreview', adminData.design.heroImage);
                }
                if (adminData.design.footerLogo) {
                    showImagePreview('footerPreview', adminData.design.footerLogo);
                }
            }
            
            // Settings
            if (adminData.settings) {
                document.getElementById('whatsappNumber').value = adminData.settings.whatsappNumber || '923140063717';
                document.getElementById('contributionPercent').textContent = adminData.settings.contributionPercent || '2%';
                document.getElementById('enableContribution').checked = adminData.settings.contributionEnabled !== false;
                document.getElementById('enableLocation').checked = adminData.settings.locationEnabled !== false;
                if (adminData.settings.notifications) {
                    document.getElementById('notifyOrders').checked = adminData.settings.notifications.orders !== false;
                    document.getElementById('notifyLowStock').checked = adminData.settings.notifications.lowStock !== false;
                    document.getElementById('notifyWeatherFail').checked = adminData.settings.notifications.weatherFail !== false;
                    document.getElementById('notifySystemErrors').checked = adminData.settings.notifications.systemErrors !== false;
                    document.getElementById('notificationMethod').value = adminData.settings.notifications.method || 'browser';
                }
                document.getElementById('autoSaveInterval').value = adminData.settings.autoSave || '60';
                document.getElementById('backupFrequency').value = adminData.settings.backupFrequency || 'weekly';
                document.getElementById('dataRetention').value = adminData.settings.dataRetention || '365';
            }
            
            // Update perfume list
            updatePerfumeList();
        }

        // Helper to show image preview from data URL
        function showImagePreview(previewId, dataUrl) {
            const previewDiv = document.getElementById(previewId);
            if (previewDiv) {
                previewDiv.innerHTML = `<img src="${dataUrl}" class="preview-thumb">`;
            }
        }

        // Update perfume list display
        function updatePerfumeList() {
            const perfumeList = document.getElementById('perfumeList');
            if (!perfumeList) return;
            
            perfumeList.innerHTML = '';
            
            if (!adminData.perfumes || adminData.perfumes.length === 0) {
                perfumeList.innerHTML = `
                    <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                        <i class="fas fa-wine-bottle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <div>No perfumes found. Add your first perfume!</div>
                    </div>
                `;
                return;
            }
            
            adminData.perfumes.forEach((perfume, index) => {
                const item = document.createElement('div');
                item.className = 'perfume-item';
                item.innerHTML = `
                    <img src="${perfume.images && perfume.images[0] ? perfume.images[0] : 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'}" 
                         alt="${perfume.name}" class="perfume-image">
                    <div class="perfume-info">
                        <div class="perfume-name">${perfume.name || 'Unnamed Perfume'}</div>
                        <div class="perfume-price">Rs ${perfume.price ? perfume.price.toLocaleString() : '0'}</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">
                            ${perfume.recommendedTemperature ? '🌡️ ' + perfume.recommendedTemperature : ''}
                            ${perfume.weather && perfume.weather.length ? ' ⛅ ' + perfume.weather.join(', ') : ''}
                            ${perfume.moods && perfume.moods.length ? ' 😊 ' + perfume.moods.join(', ') : ''}
                        </div>
                    </div>
                    <div class="item-actions">
                        <button class="btn btn-secondary" onclick="editPerfume(${index})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deletePerfume(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                perfumeList.appendChild(item);
            });
            
            document.getElementById('perfumeCount').textContent = adminData.perfumes.length;
        }

        // Open perfume modal for adding/editing
        function openPerfumeModal(perfumeIndex = null) {
            const modal = document.getElementById('perfumeModal');
            const title = document.getElementById('perfumeModalTitle');
            const content = document.getElementById('perfumeModalContent');
            
            if (perfumeIndex !== null && adminData.perfumes[perfumeIndex]) {
                title.textContent = 'Edit Perfume';
                const perfume = adminData.perfumes[perfumeIndex];
                content.innerHTML = getPerfumeFormHTML(perfume, perfumeIndex);
            } else {
                title.textContent = 'Add New Perfume';
                content.innerHTML = getPerfumeFormHTML(null, null);
            }
            
            modal.classList.add('active');
        }

        // Close perfume modal
        function closePerfumeModal() {
            document.getElementById('perfumeModal').classList.remove('active');
        }

        // Get perfume form HTML (with moods field)
        function getPerfumeFormHTML(perfume, index) {
            const image1 = (perfume && perfume.images && perfume.images[0]) ? perfume.images[0] : '';
            const image2 = (perfume && perfume.images && perfume.images[1]) ? perfume.images[1] : '';
            const preview1 = image1 ? `<img src="${image1}" class="preview-thumb" alt="preview1">` : '';
            const preview2 = image2 ? `<img src="${image2}" class="preview-thumb" alt="preview2">` : '';
            const moodsValue = (perfume && perfume.moods) ? perfume.moods.join(', ') : '';
            
            return `
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">Perfume Name</label>
                        <input type="text" class="form-input" id="editName" value="${perfume ? perfume.name : ''}" placeholder="e.g., Royal Oud">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-textarea" id="editDescription" placeholder="Description of the perfume">${perfume ? perfume.description : 'A premium fragrance for all occasions'}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Image 1</label>
                        <input type="file" class="form-file" id="editImage1" accept="image/*" onchange="previewImage(this, 'preview1')">
                        <div class="image-preview" id="preview1">${preview1}</div>
                        <small style="color: var(--text-muted);">Leave empty to keep existing image (if editing)</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Image 2</label>
                        <input type="file" class="form-file" id="editImage2" accept="image/*" onchange="previewImage(this, 'preview2')">
                        <div class="image-preview" id="preview2">${preview2}</div>
                        <small style="color: var(--text-muted);">Leave empty to keep existing image (if editing)</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Notes (comma separated)</label>
                        <input type="text" class="form-input" id="editNotes" value="${perfume && perfume.notes ? perfume.notes.join(', ') : 'Oud, Sandalwood, Amber'}" placeholder="Oud, Sandalwood, Amber, Citrus">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Moods (comma separated)</label>
                        <input type="text" class="form-input" id="editMoods" value="${moodsValue}" placeholder="e.g., confident, calm, happy">
                        <small style="color: var(--text-muted);">Available moods: happy, energetic, calm, romantic, confident, neutral, surprised, sad</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Recommended Temperature</label>
                        <input type="text" class="form-input" id="editTemperature" value="${perfume ? perfume.recommendedTemperature : '20-30°C'}" placeholder="e.g., 20-30°C">
                        <small style="color: var(--text-muted);">Recommended temperature range for this perfume</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Weather Conditions (comma separated)</label>
                        <input type="text" class="form-input" id="editWeather" value="${perfume && perfume.weather ? perfume.weather.join(', ') : 'mild, cool'}" placeholder="e.g., mild, cool, warm, hot">
                        <small style="color: var(--text-muted);">Weather conditions suitable for this perfume</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Rating (1-5)</label>
                        <input type="number" class="form-input" id="editRating" min="1" max="5" step="0.1" value="${perfume ? perfume.rating : 4.5}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Price (Rs)</label>
                        <input type="number" class="form-input" id="editPrice" value="${perfume ? perfume.price : '4949'}" placeholder="e.g., 4949">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" class="form-input" id="editCity" value="${perfume ? perfume.city : 'Lahore'}" placeholder="e.g., Lahore">
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <button class="btn btn-secondary" style="flex: 1;" onclick="closePerfumeModal()">
                            Cancel
                        </button>
                        <button class="btn btn-primary" style="flex: 1;" onclick="savePerfume(${index !== null ? index : -1})">
                            ${perfume ? 'Update' : 'Add'} Perfume
                        </button>
                    </div>
                </div>
            `;
        }

        function previewImage(input, previewId) {
            const previewDiv = document.getElementById(previewId);
            previewDiv.innerHTML = '';
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-thumb';
                    previewDiv.appendChild(img);
                    // Also store in adminData if it's a design image
                    if (previewId === 'logoPreview') adminData.design.logo = e.target.result;
                    if (previewId === 'heroPreview') adminData.design.heroImage = e.target.result;
                    if (previewId === 'footerPreview') adminData.design.footerLogo = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        async function savePerfume(index) {
            const saveBtn = event.target;
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            saveBtn.disabled = true;

            try {
                const existing = (index >= 0 && adminData.perfumes[index]) ? adminData.perfumes[index] : null;
                
                const name = document.getElementById('editName').value;
                const price = parseFloat(document.getElementById('editPrice').value);
                const description = document.getElementById('editDescription').value;
                const notes = document.getElementById('editNotes').value.split(',').map(note => note.trim());
                const moods = document.getElementById('editMoods').value.split(',').map(m => m.trim()).filter(m => m);
                const recommendedTemperature = document.getElementById('editTemperature').value;
                const weather = document.getElementById('editWeather').value.split(',').map(w => w.trim());
                const rating = parseFloat(document.getElementById('editRating').value);
                const city = document.getElementById('editCity').value;

                const file1 = document.getElementById('editImage1').files[0];
                const file2 = document.getElementById('editImage2').files[0];

                let images = [];

                const readFile = (file) => {
                    return new Promise((resolve, reject) => {
                        if (!file) {
                            resolve(null);
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = (e) => resolve(e.target.result);
                        reader.onerror = reject;
                        reader.readAsDataURL(file);
                    });
                };

                const [img1Data, img2Data] = await Promise.all([
                    readFile(file1),
                    readFile(file2)
                ]);

                if (index >= 0 && existing) {
                    images[0] = img1Data !== null ? img1Data : (existing.images[0] || '');
                    images[1] = img2Data !== null ? img2Data : (existing.images[1] || '');
                } else {
                    images[0] = img1Data !== null ? img1Data : '';
                    images[1] = img2Data !== null ? img2Data : '';
                }

                // Prepare perfume data
                const perfumeData = {
                    name: name,
                    price: price,
                    original_price: price,
                    description: description,
                    city: city,
                    recommended_temperature: recommendedTemperature,
                    rating: rating,
                    rating_count: 0,
                    is_featured: false,
                    is_bestseller: false,
                    is_active: true,
                    notes: notes,
                    images: images
                };

                // Save to database via API
                const isUpdate = existing && existing.id && existing.id > 100000;
                
                let response;
                if (isUpdate) {
                    // Update existing perfume
                    response = await fetch(`/admin/perfumes/${existing.id}`, {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        body: JSON.stringify(perfumeData)
                    });
                } else {
                    // Create new perfume
                    response = await fetch('/admin/perfumes', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(perfumeData)
                    });
                }

                const result = await response.json();
                
                if (result.id) {
                    // Update local data with the saved perfume
                    const perfume = {
                        id: result.id,
                        name: name,
                        nameAr: '',
                        price: price,
                        originalPrice: price,
                        description: description,
                        descriptionAr: '',
                        rating: rating,
                        reviews: 0,
                        featured: false,
                        bestseller: false,
                        active: true,
                        city: city,
                        temperature: recommendedTemperature,
                        images: images,
                        notes: {
                            top: notes.slice(0, 3),
                            middle: notes.slice(3, 6),
                            base: notes.slice(6, 9)
                        }
                    };

                    if (index >= 0) {
                        adminData.perfumes[index] = perfume;
                    } else {
                        adminData.perfumes.push(perfume);
                    }

                    updatePerfumeList();
                    renderMoodMapping();
                    closePerfumeModal();
                    loadStats(); // Refresh stats
                    showAlert('Perfume saved to database successfully!', 'success');
                } else {
                    throw new Error('Failed to save perfume');
                }
            } catch (error) {
                console.error('Error saving perfume:', error);
                showAlert('Error saving perfume: ' + error.message, 'error');
            } finally {
                saveBtn.innerHTML = originalText;
                saveBtn.disabled = false;
            }
        }

        function editPerfume(index) {
            openPerfumeModal(index);
        }

        function deletePerfume(index) {
            const perfume = adminData.perfumes[index];
            if (!perfume) {
                showAlert('Perfume not found', 'error');
                return;
            }
            
            if (!confirm('Are you sure you want to delete this perfume?')) {
                return;
            }
            
            // Check if it's a database perfume (has valid ID > 100000)
            if (perfume.id && perfume.id > 100000) {
                fetch(`/admin/perfumes/${perfume.id}`, {
                    method: 'DELETE',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    adminData.perfumes.splice(index, 1);
                    updatePerfumeList();
                    renderMoodMapping();
                    loadStats();
                    showAlert('Perfume deleted from database!', 'success');
                })
                .catch(error => {
                    console.error('Error deleting perfume:', error);
                    showAlert('Error deleting perfume', 'error');
                });
            } else {
                // Local perfume - just remove from array
                adminData.perfumes.splice(index, 1);
                updatePerfumeList();
                renderMoodMapping();
                showAlert('Perfume deleted', 'success');
            }
        }

        // Render Mood Mapping tab
        function renderMoodMapping() {
            const container = document.getElementById('moodMappingContainer');
            if (!container) return;
            container.innerHTML = '';

            if (!adminData.perfumes || adminData.perfumes.length === 0) {
                container.innerHTML = '<p style="color: var(--text-muted); text-align:center;">No perfumes available. Add perfumes first.</p>';
                return;
            }

            adminData.perfumes.forEach((perfume, idx) => {
                const div = document.createElement('div');
                div.className = 'mood-mapping-perfume';
                div.innerHTML = `
                    <h4>
                        <img src="${perfume.images && perfume.images[0] ? perfume.images[0] : 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'}" style="width:40px; height:40px; border-radius:8px; object-fit:cover;">
                        ${perfume.name} (Rs ${perfume.price})
                    </h4>
                    <div class="mood-checkbox-group" data-perfume-index="${idx}">
                        ${MOOD_LIST.map(mood => {
                            const checked = (perfume.moods && perfume.moods.includes(mood)) ? 'checked' : '';
                            return `
                                <label class="mood-checkbox-item">
                                    <input type="checkbox" value="${mood}" ${checked}> ${mood}
                                </label>
                            `;
                        }).join('')}
                    </div>
                `;
                container.appendChild(div);
            });
        }

        // Save mood mapping from checkboxes to adminData.perfumes
        function saveMoodMapping() {
            const containers = document.querySelectorAll('.mood-checkbox-group');
            containers.forEach(group => {
                const idx = group.dataset.perfumeIndex;
                if (idx !== undefined) {
                    const checkboxes = group.querySelectorAll('input[type="checkbox"]');
                    const selectedMoods = [];
                    checkboxes.forEach(cb => {
                        if (cb.checked) selectedMoods.push(cb.value);
                    });
                    if (adminData.perfumes[idx]) {
                        adminData.perfumes[idx].moods = selectedMoods;
                    }
                }
            });
            updatePerfumeList();
            showAlert('Mood mapping saved', 'success');
            saveAllChanges();
        }

        // Sync with customer page data
        function loadCustomerData() {
            try {
                const cartData = localStorage.getItem('troy-cart');
                if (cartData) {
                    const cart = JSON.parse(cartData);
                    document.getElementById('cartItems').textContent = cart.length;
                }
                showAlert('Synced with customer page', 'success');
            } catch (error) {
                console.error('Error loading customer data:', error);
            }
        }

        function autoSave() {
            const interval = document.getElementById('autoSaveInterval').value;
            if (interval !== '0') {
                saveAllChanges();
            }
        }

        function updateStats() {
            const used = JSON.stringify(localStorage).length / 1024;
            document.getElementById('storageUsed').textContent = used.toFixed(1) + ' KB';
            const moodMatches = Math.floor(Math.random() * 50) + 100;
            document.getElementById('moodMatches').textContent = moodMatches;
        }

        // Apply theme colors to the admin preview (and update CSS variables)
        function applyThemeColors() {
            const primary = document.getElementById('primaryColor').value;
            const accent = document.getElementById('accentColor').value;
            const bg = document.getElementById('bgColor').value;
            const text = document.getElementById('textColor').value;
            const cardBg = document.getElementById('cardBgColor').value;
            const border = document.getElementById('borderColor').value;

            document.documentElement.style.setProperty('--primary', primary);
            document.documentElement.style.setProperty('--accent', accent);
            document.documentElement.style.setProperty('--bg', bg);
            document.documentElement.style.setProperty('--text-main', text);
            document.documentElement.style.setProperty('--bg-elevated', cardBg);
            document.documentElement.style.setProperty('--border-subtle', border);

            showAlert('Theme colors applied to admin preview', 'success');
            // Also update adminData
            adminData.design.primaryColor = primary;
            adminData.design.accentColor = accent;
            adminData.design.bgColor = bg;
            adminData.design.textColor = text;
            adminData.design.cardBgColor = cardBg;
            adminData.design.borderColor = border;
        }

        // Update animation preview
        function updateDesignPreview() {
            const speed = document.getElementById('animationSpeed').value;
            document.getElementById('speedValue').textContent = parseFloat(speed).toFixed(1) + 'x';
            const box = document.getElementById('previewBox');
            if (box) {
                box.style.transition = `all ${speed}s`;
            }
        }

        function showAlert(message, type = 'success') {
            const container = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            container.appendChild(alert);
            setTimeout(() => alert.remove(), 3000);
        }

        function setupEventListeners() {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function() {
                    const tab = this.dataset.tab;
                    document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
                    document.getElementById(tab).classList.add('active');
                });
            });
            
            // Sub-tabs within Design
            document.querySelectorAll('[data-design-tab]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const tab = this.dataset.designTab;
                    document.querySelectorAll('[data-design-tab]').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    document.querySelectorAll('#design .tab-content').forEach(c => c.classList.remove('active'));
                    if (tab === 'colors') document.getElementById('designColors').classList.add('active');
                    else if (tab === 'images') document.getElementById('designImages').classList.add('active');
                    else if (tab === 'animations') document.getElementById('designAnimations').classList.add('active');
                });
            });
            
            // Sub-tabs within Mood Match
            document.querySelectorAll('[data-mood-tab]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const tab = this.dataset.moodTab;
                    document.querySelectorAll('[data-mood-tab]').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    document.querySelectorAll('#mood .tab-content').forEach(c => c.classList.remove('active'));
                    if (tab === 'moods') document.getElementById('moodSettings').classList.add('active');
                    else if (tab === 'perfume-mapping') document.getElementById('perfumeMapping').classList.add('active');
                    else if (tab === 'simulation') document.getElementById('simulationMode').classList.add('active');
                });
            });
            
            const contributionSlider = document.querySelector('input[type="range"]');
            if (contributionSlider) {
                contributionSlider.addEventListener('input', function() {
                    document.getElementById('contributionPercent').textContent = this.value + '%';
                });
            }
            
            // Animation speed slider
            const speedSlider = document.getElementById('animationSpeed');
            if (speedSlider) {
                speedSlider.addEventListener('input', updateDesignPreview);
            }
            
            // Color swatch clicks
            document.querySelectorAll('.color-swatch').forEach(swatch => {
                swatch.addEventListener('click', function() {
                    const color = this.dataset.color;
                    // Find the nearest color input (assuming structure)
                    const container = this.closest('.color-picker');
                    if (container) {
                        const colorInput = container.querySelector('input[type="color"]');
                        if (colorInput) {
                            colorInput.value = color;
                        }
                    }
                });
            });
            
            document.querySelector('.btn-primary[onclick="saveAllChanges()"]').addEventListener('click', saveAllChanges);
        }

        function previewCustomerPage() {
            saveAllChanges();
            window.open('cccccc.html', '_blank');
        }

        function clearAllCaches() {
            if (confirm('This will clear all cached data including weather cache. Continue?')) {
                localStorage.removeItem('troy-weather-cache-v1');
                showAlert('All caches cleared', 'success');
            }
        }

        function exportAllData() {
            const dataStr = JSON.stringify(adminData, null, 2);
            const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
            const exportFileDefaultName = 'troy-admin-data.json';
            const linkElement = document.createElement('a');
            linkElement.setAttribute('href', dataUri);
            linkElement.setAttribute('download', exportFileDefaultName);
            linkElement.click();
            showAlert('Data exported successfully', 'success');
        }

        function importAllData() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = '.json';
            input.onchange = e => {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = function(event) {
                    try {
                        const importedData = JSON.parse(event.target.result);
                        adminData = importedData;
                        updateAllForms();
                        renderMoodMapping();
                        updateDesignPreview();
                        saveAllChanges();
                        showAlert('Data imported successfully', 'success');
                    } catch (error) {
                        showAlert('Error importing data', 'error');
                    }
                };
                reader.readAsText(file);
            };
            input.click();
        }

        function backupData() {
            saveAllChanges();
            exportAllData();
        }

        function resetAllData() {
            if (confirm('WARNING: This will reset ALL admin data to default. This action cannot be undone. Continue?')) {
                localStorage.clear();
                adminData = {
                    perfumes: [],
                    heroSection: {},
                    videos: {},
                    weather: {},
                    mood: {},
                    design: {
                        primaryColor: '#22c55e',
                        accentColor: '#38bdf8',
                        bgColor: '#050816',
                        textColor: '#e5f2ff',
                        cardBgColor: '#070f25',
                        borderColor: 'rgba(148,163,184,0.35)',
                        logo: '',
                        heroImage: '',
                        footerLogo: '',
                        animations: { enabled: true, style: 'fade', speed: 1, hoverEffect: 'scale' }
                    },
                    analytics: {},
                    settings: {}
                };
                updateAllForms();
                renderMoodMapping();
                updateDesignPreview();
                showAlert('All data reset to default', 'success');
            }
        }

        // ===== TV VIDEO MANAGEMENT =====
        function loadTvVideos() {
            // Load active video
            fetch('/api/tv-video/active')
                .then(r => r.json())
                .then(data => {
                    const container = document.getElementById('activeVideoPreview');
                    if (data.video) {
                        container.innerHTML = `
                            <p style="color:var(--primary); font-weight:600; margin-bottom:0.5rem;">${data.video.title}</p>
                            <video src="${data.video.url}" controls style="width:100%; max-height:220px; border-radius:12px; background:#000;"></video>
                        `;
                    } else {
                        container.innerHTML = '<p style="color:var(--text-muted);">No active video. Upload one above.</p>';
                    }
                })
                .catch(() => {
                    document.getElementById('activeVideoPreview').innerHTML = '<p style="color:var(--danger);">Error loading active video.</p>';
                });

            // Load all videos
            fetch('/api/tv-videos')
                .then(r => r.json())
                .then(data => {
                    const list = document.getElementById('allVideosList');
                    if (!data.videos || data.videos.length === 0) {
                        list.innerHTML = '<p style="color:var(--text-muted);">No videos uploaded yet.</p>';
                        return;
                    }
                    list.innerHTML = data.videos.map(v => `
                        <div style="background:var(--bg-soft); border:1px solid var(--border-subtle); border-radius:12px; padding:1rem; position:relative;">
                            <video src="${v.url}" controls style="width:100%; max-height:160px; border-radius:8px; background:#000; margin-bottom:0.5rem;"></video>
                            <p style="font-weight:600; font-size:0.9rem; margin-bottom:0.25rem;">${v.title}</p>
                            <small style="color:var(--text-muted);">${v.created_at}</small>
                            <div style="display:flex; gap:0.5rem; margin-top:0.75rem;">
                                ${v.is_active
                                    ? '<span style="color:var(--primary); font-size:0.85rem;"><i class="fas fa-check-circle"></i> Active</span>'
                                    : `<button class="btn btn-secondary" style="font-size:0.75rem; padding:0.3rem 0.7rem;" onclick="activateTvVideo(${v.id})"><i class="fas fa-play"></i> Set Active</button>`
                                }
                                <button class="btn" style="font-size:0.75rem; padding:0.3rem 0.7rem; background:var(--danger); color:#fff; border:none; border-radius:8px; cursor:pointer;" onclick="deleteTvVideo(${v.id})"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(() => {
                    document.getElementById('allVideosList').innerHTML = '<p style="color:var(--danger);">Error loading videos.</p>';
                });
        }

        document.getElementById('tvVideoUploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const fileInput = document.getElementById('tvVideoFile');
            const errorDiv = document.getElementById('tvUploadError');
            const errorMsg = document.getElementById('tvUploadErrorMsg');

            // Hide previous errors
            errorDiv.style.display = 'none';

            if (!fileInput.files.length) {
                showAlert('Please select a video file', 'error');
                return;
            }

            const file = fileInput.files[0];

            // Client-side validation: file type
            const allowedTypes = ['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'];
            if (!allowedTypes.includes(file.type)) {
                errorMsg.textContent = `Invalid format "${file.type}". Allowed: MP4, WebM, OGG, MOV.`;
                errorDiv.style.display = 'block';
                return;
            }

            // Client-side validation: file size (100MB)
            if (file.size > 100 * 1024 * 1024) {
                const sizeMB = (file.size / (1024 * 1024)).toFixed(1);
                errorMsg.textContent = `File too large (${sizeMB} MB). Maximum allowed: 100 MB.`;
                errorDiv.style.display = 'block';
                return;
            }

            // Client-side validation: video dimensions
            const videoEl = document.createElement('video');
            videoEl.preload = 'metadata';
            videoEl.onloadedmetadata = function() {
                window.URL.revokeObjectURL(videoEl.src);
                const w = videoEl.videoWidth;
                const h = videoEl.videoHeight;

                if (w < 640 || h < 360) {
                    errorMsg.textContent = `Resolution too low (${w}×${h}). Minimum: 640×360 (360p).`;
                    errorDiv.style.display = 'block';
                    return;
                }

                if (w > 3840 || h > 2160) {
                    errorMsg.textContent = `Resolution too high (${w}×${h}). Maximum: 3840×2160 (4K).`;
                    errorDiv.style.display = 'block';
                    return;
                }

                // Passed all checks — proceed with upload
                doUpload(file);
            };
            videoEl.onerror = function() {
                // Can't read metadata, let server validate
                doUpload(file);
            };
            videoEl.src = URL.createObjectURL(file);
        });

        function doUpload(file) {
            const errorDiv = document.getElementById('tvUploadError');
            const errorMsg = document.getElementById('tvUploadErrorMsg');

            const formData = new FormData();
            formData.append('video', file);
            formData.append('title', document.getElementById('tvVideoTitle').value || file.name);

            const progressDiv = document.getElementById('tvUploadProgress');
            const progressBar = document.getElementById('tvUploadBar');
            const progressText = document.getElementById('tvUploadPercent');
            const uploadBtn = document.getElementById('tvUploadBtn');

            progressDiv.style.display = 'block';
            errorDiv.style.display = 'none';
            uploadBtn.disabled = true;
            uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/admin/tv-videos');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const pct = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = pct + '%';
                    progressText.textContent = pct + '%';
                }
            });

            xhr.onload = function() {
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Upload & Set as Active';
                progressDiv.style.display = 'none';
                progressBar.style.width = '0%';

                if (xhr.status >= 200 && xhr.status < 300) {
                    showAlert('Video uploaded and set as active!', 'success');
                    document.getElementById('tvVideoUploadForm').reset();
                    loadTvVideos();
                } else {
                    try {
                        const err = JSON.parse(xhr.responseText);
                        const msg = err.message || (err.errors && err.errors.video ? err.errors.video[0] : 'Upload failed');
                        errorMsg.textContent = msg;
                        errorDiv.style.display = 'block';
                        showAlert(msg, 'error');
                    } catch(e) {
                        errorMsg.textContent = 'Upload failed. Server returned an error.';
                        errorDiv.style.display = 'block';
                        showAlert('Upload failed', 'error');
                    }
                }
            };

            xhr.onerror = function() {
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Upload & Set as Active';
                progressDiv.style.display = 'none';
                errorMsg.textContent = 'Upload failed. Check your connection.';
                errorDiv.style.display = 'block';
                showAlert('Upload failed. Check your connection.', 'error');
            };

            xhr.send(formData);
        }

        function activateTvVideo(id) {
            fetch(`/admin/tv-videos/${id}/activate`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(r => r.json())
            .then(() => {
                showAlert('Video set as active', 'success');
                loadTvVideos();
            })
            .catch(() => showAlert('Failed to activate video', 'error'));
        }

        function deleteTvVideo(id) {
            if (!confirm('Are you sure you want to delete this video?')) return;
            fetch(`/admin/tv-videos/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(r => r.json())
            .then(() => {
                showAlert('Video deleted', 'success');
                loadTvVideos();
            })
            .catch(() => showAlert('Failed to delete video', 'error'));
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadAdminData();
            setupEventListeners();
            updateStats();
            setInterval(updateStats, 30000);
            setInterval(autoSave, 60000);
            updateDesignPreview();
            loadTvVideos();
        });
    </script>
</body>
</html>