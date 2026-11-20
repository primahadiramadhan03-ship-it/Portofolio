<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Dashboard - Prima Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { 
            --primary-color: #00d4aa; --bg-dark: #0a0e17; --bg-card: #111827; --bg-sidebar: #0f172a; 
            --text-primary: #ffffff; --text-secondary: #9ca3af; --border-color: #1f2937; 
            --success: #10b981; --warning: #f59e0b; 
        }
        html { scroll-behavior: smooth; height: 100%; overflow-y: auto; }
        body { 
            font-family: 'Inter', sans-serif; background-color: var(--bg-dark); color: var(--text-primary); 
            line-height: 1.6; overflow-x: hidden; overflow-y: auto !important; min-height: 100vh;
            -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; position: relative !important; 
        }
        .admin-container { display: flex; min-height: 100vh; position: relative; }
        .sidebar { width: 280px; background: var(--bg-sidebar); border-right: 1px solid var(--border-color); position: fixed; height: 100vh; overflow-y: auto; transition: transform 0.3s ease; z-index: 1000; }
        .sidebar-header { padding: 30px 20px; border-bottom: 1px solid var(--border-color); }
        .sidebar-header h2 { font-size: 20px; font-weight: 700; color: var(--primary-color); display: flex; align-items: center; gap: 10px; }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 15px 20px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px; color: var(--text-secondary); border-left: 3px solid transparent; }
        .menu-item:hover, .menu-item.active { background: rgba(0, 212, 170, 0.1); color: var(--primary-color); border-left-color: var(--primary-color); }
        .menu-item i { width: 20px; text-align: center; }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); z-index: 999; backdrop-filter: blur(4px); }
        .main-content { flex: 1; margin-left: 280px; padding: 40px; transition: margin-left 0.3s ease; min-height: 100vh; overflow-y: auto; }
        .menu-toggle { display: none; position: fixed; top: 20px; left: 20px; z-index: 1001; background: var(--primary-color); color: var(--bg-dark); border: none; width: 50px; height: 50px; border-radius: 10px; cursor: pointer; font-size: 20px; box-shadow: 0 4px 15px rgba(0, 212, 170, 0.3); transition: all 0.3s ease; }
        .menu-toggle:hover { transform: scale(1.05); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color); flex-wrap: wrap; gap: 15px; }
        .header h1 { font-size: 28px; font-weight: 700; }
        .header-actions { display: flex; gap: 15px; flex-wrap: wrap; }
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; border: none; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; white-space: nowrap; }
        .btn-primary { background: var(--primary-color); color: var(--bg-dark); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 212, 170, 0.3); }
        .btn-secondary { background: var(--bg-card); color: var(--text-primary); border: 1px solid var(--border-color); }
        .btn-secondary:hover { border-color: var(--primary-color); color: var(--primary-color); }
        .card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 30px; margin-bottom: 30px; }
        .card-header { margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color); }
        .card-header h3 { font-size: 18px; font-weight: 600; color: var(--primary-color); }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-primary); }
        .form-group label small { color: var(--text-secondary); font-weight: 400; font-size: 12px; }
        .form-control { width: 100%; padding: 12px 16px; background: var(--bg-dark); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-primary); font-family: 'Inter', sans-serif; font-size: 14px; transition: all 0.3s ease; -webkit-appearance: none; }
        .form-control:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(0, 212, 170, 0.1); }
        textarea.form-control { min-height: 120px; resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .section-content { display: none; }
        .section-content.active { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; display: flex; align-items: center; gap: 20px; }
        .stat-icon { width: 60px; height: 60px; border-radius: 12px; background: rgba(0, 212, 170, 0.1); display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--primary-color); }
        .stat-info h4 { font-size: 28px; font-weight: 700; margin-bottom: 5px; }
        .stat-info p { color: var(--text-secondary); font-size: 14px; }
        .file-upload { border: 2px dashed var(--border-color); border-radius: 8px; padding: 30px; text-align: center; cursor: pointer; transition: all 0.3s ease; }
        .file-upload:hover { border-color: var(--primary-color); background: rgba(0, 212, 170, 0.05); }
        .file-upload i { font-size: 40px; color: var(--text-secondary); margin-bottom: 10px; }
        .file-upload input[type="file"] { display: none; }
        .data-table { width: 100%; border-collapse: collapse; color: var(--text-primary); }
        .data-table th, .data-table td { padding: 12px; text-align: left; border-bottom: 1px solid var(--border-color); }
        .data-table th { color: var(--text-secondary); font-weight: 600; font-size: 13px; text-transform: uppercase; }
        
        @media (max-width: 1024px) { .sidebar { width: 260px; } .main-content { margin-left: 260px; padding: 30px 20px; } }
        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            .sidebar { transform: translateX(-100%); width: 280px; }
            .sidebar.active { transform: translateX(0); }
            .sidebar-overlay.active { display: block; }
            .main-content { margin-left: 0; padding: 80px 20px 40px; }
            .header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .header h1 { font-size: 24px; }
            .header-actions { width: 100%; justify-content: flex-start; }
            .btn { flex: 1; justify-content: center; min-width: 120px; }
            .form-row { grid-template-columns: 1fr; gap: 15px; }
            .stats-grid { grid-template-columns: 1fr; gap: 15px; }
            .stat-card { padding: 20px; }
            .stat-icon { width: 50px; height: 50px; font-size: 20px; }
            .stat-info h4 { font-size: 24px; }
            .card { padding: 20px; }
            .file-upload { padding: 20px; }
            .menu-item { padding: 12px 20px; font-size: 15px; }
        }
        @media (max-width: 480px) {
            .header h1 { font-size: 20px; } .card-header h3 { font-size: 16px; } .stat-info h4 { font-size: 20px; } .stat-info p { font-size: 13px; }
            .form-control { font-size: 16px; padding: 14px 16px; } .btn { padding: 12px 20px; font-size: 15px; } .menu-toggle { width: 45px; height: 45px; font-size: 18px; }
        }
        @media (hover: none) { .menu-item:active { background: rgba(0, 212, 170, 0.2); } .btn:active { transform: scale(0.98); } }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    
    <div class="admin-container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header"><h2><i class="fas fa-cog"></i> Admin Panel</h2></div>
            <nav class="sidebar-menu">
                <div class="menu-item active" onclick="showSection('dashboard'); toggleSidebar();"><i class="fas fa-home"></i><span>Dashboard</span></div>
                <div class="menu-item" onclick="showSection('profile'); toggleSidebar();"><i class="fas fa-user"></i><span>Profile & Kontak</span></div>
                <div class="menu-item" onclick="showSection('homepage'); toggleSidebar();"><i class="fas fa-desktop"></i><span>Homepage</span></div>
                <div class="menu-item" onclick="showSection('about'); toggleSidebar();"><i class="fas fa-info-circle"></i><span>About Me</span></div>
                <div class="menu-item" onclick="showSection('skills'); toggleSidebar();"><i class="fas fa-code"></i><span>Skills</span></div>
                <div class="menu-item" onclick="showSection('portfolio'); toggleSidebar();"><i class="fas fa-briefcase"></i><span>Portfolio</span></div>
                <div class="menu-item" onclick="showSection('contact'); toggleSidebar();"><i class="fas fa-envelope"></i><span>Contact Settings</span></div>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <div class="menu-item" onclick="if(confirm('Yakin ingin logout?')) document.getElementById('logoutForm').submit();"><i class="fas fa-sign-out-alt"></i><span>Logout</span></div>
            </nav>
        </aside>

        <main class="main-content">
            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #10b981; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Dashboard Section -->
            <div id="dashboard" class="section-content active">
                <div class="header">
                    <h1>Dashboard</h1>
                    <div class="header-actions">
                        <a href="/" target="_blank" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> Lihat Website</a>
                    </div>
                </div>
                <div class="stats-grid">
                    <div class="stat-card"><div class="stat-icon"><i class="fas fa-briefcase"></i></div><div class="stat-info"><h4>{{ \App\Models\Portofolio::count() }}</h4><p>Portfolio Items</p></div></div>
                    <div class="stat-card"><div class="stat-icon"><i class="fas fa-code"></i></div><div class="stat-info"><h4>{{ \App\Models\Skill::count() }}</h4><p>Skills Items</p></div></div>
                    <div class="stat-card"><div class="stat-icon"><i class="fas fa-users"></i></div><div class="stat-info"><h4>{{ \App\Models\Kontak::whereNotNull('pesan_pengirim')->count() }}</h4><p>Pesan Baru</p></div></div>
                </div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-info-circle"></i> Selamat Datang!</h3></div>
                    <p>Selamat datang di Admin Panel. Data yang kamu simpan di sini akan langsung muncul di halaman utama website.</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div id="profile" class="section-content">
                <div class="header"><h1>Profile & Kontak</h1></div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-user-circle"></i> Informasi Profile</h3></div>
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ $user->name ?? 'Prima' }}" required>
                                @error('nama') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email ?? 'prima@email.com' }}" required>
                                @error('email') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $user->alamat ?? 'Jakarta, Indonesia' }}">
                                @error('alamat') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" name="status" class="form-control" value="{{ $user->status ?? 'Available for Work' }}">
                                @error('status') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Link GitHub</label>
                            <input type="text" name="link_github" class="form-control" value="{{ $user->link_github ?? 'https://github.com/prima' }}">
                            @error('link_github') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label>Password Baru Login Admin <small>(Kosongkan jika tidak ingin mengubah password)</small></label>
                            <div style="position: relative;">
                                <input type="password" id="adminPasswordInput" name="password" class="form-control" placeholder="Masukkan password baru (minimal 6 karakter)" style="padding-right: 42px;">
                                <i class="fas fa-eye" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--text-secondary);" onclick="toggleAdminPassword(this)" title="Lihat password"></i>
                            </div>
                            @error('password') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label>Foto Profil</label>
                            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 15px; flex-wrap: wrap;">
                                @if($user && $user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}?v={{ time() }}" alt="Foto Profil" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary-color);">
                                @else
                                    <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--bg-dark); border: 2px dashed var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 24px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                                <div class="file-upload" onclick="document.getElementById('foto_profil_upload').click()" style="flex: 1; min-width: 200px; padding: 15px;">
                                    <i class="fas fa-camera"></i><p>Klik untuk upload foto profil</p><small>Format: JPG, PNG, Max: 5MB</small>
                                    <input type="file" id="foto_profil_upload" name="foto_profil" accept="image/*" onchange="updateFileName(this, 'foto_file_name')">
                                </div>
                            </div>
                            @error('foto_profil') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            @if($user && $user->foto_profil) 
                                <small style="color: var(--primary-color); display: block; margin-bottom: 10px;">Foto saat ini: {{ basename($user->foto_profil) }}</small> 
                            @endif
                            <small id="foto_file_name" style="color: var(--primary-color); display: none;"></small>
                        </div>
                        <div class="form-group">
                            <label>Upload CV (PDF)</label>
                            <div class="file-upload" onclick="document.getElementById('cv_upload').click()">
                                <i class="fas fa-cloud-upload-alt"></i><p>Klik untuk upload CV</p><small>Format: PDF, Max: 5MB</small>
                                <input type="file" id="cv_upload" name="cv" accept=".pdf" onchange="updateFileName(this)">
                            </div>
                            @error('cv') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            @if($user && $user->cv) <small style="color: var(--primary-color); margin-top: 10px; display: block;">File saat ini: {{ basename($user->cv) }}</small> @endif
                            <small id="file_name" style="color: var(--primary-color); margin-top: 10px; display: block;"></small>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- Homepage Section -->
            <div id="homepage" class="section-content">
                <div class="header"><h1>Homepage Settings</h1></div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-home"></i> Hero Section</h3></div>
                    <form action="{{ route('admin.homepage.update') }}" method="POST">
                        @csrf
                        <div class="form-group"><label>Role/Posisi</label><input type="text" name="role" class="form-control" value="{{ $homepage->role ?? 'Full-Stack Developer' }}" required></div>
                        <div class="form-group"><label>Judul Deskripsi</label><input type="text" name="judul_deskripsi" class="form-control" value="{{ $homepage->judul_deskripsi ?? 'Hey I\'m Prima, Full-Stack Developer' }}" required></div>
                        <div class="form-group"><label>Catatan Utama (subtitle)</label><textarea name="catatan_utama" class="form-control" required>{{ $homepage->catatan_utama ?? 'I help business grow by crafting amazing web experiences.' }}</textarea></div>
                        <div class="form-group"><label>Deskripsi Lengkap</label><textarea name="deskripsi" class="form-control" rows="5" required>{{ $homepage->deskripsi ?? 'Saya adalah developer yang passionate dalam menciptakan solusi digital yang inovatif dan fungsional.' }}</textarea></div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- About Section -->
            <div id="about" class="section-content">
                <div class="header"><h1>About Me Settings</h1></div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-user"></i> About Me Content</h3></div>
                    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label>Judul</label><input type="text" name="judul" class="form-control" value="{{ $about->judul ?? 'Hello!' }}" required></div>
                        <div class="form-group"><label>Deskripsi Singkat</label><textarea name="deskripsi" class="form-control" rows="3" required>{{ $about->deskripsi ?? 'My name is Prima and I specialize in web development...' }}</textarea></div>
                        <div class="form-group"><label>Judul Detail</label><input type="text" name="judul_detail" class="form-control" value="{{ $about->judul_detail ?? 'Hello!' }}"></div>
                        <div class="form-group"><label>Deskripsi Detail</label><textarea name="deskripsi_detail" class="form-control" rows="5">{{ $about->deskripsi_detail ?? 'When I\'m not coding, I am writing blogs, reading...' }}</textarea></div>
                        <div class="form-group">
                            <label>Gambar About Me</label>
                            <div class="file-upload" onclick="document.getElementById('about_image').click()">
                                <i class="fas fa-image"></i><p>Klik untuk upload gambar</p><small>Format: JPG, PNG, Max: 5MB</small>
                                <input type="file" id="about_image" name="aboutme_gambar" accept="image/*" onchange="updateFileName(this)">
                            </div>
                            @error('aboutme_gambar') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            @if($about && $about->aboutme_gambar) <small style="color: var(--primary-color); margin-top: 10px; display: block;">Gambar saat ini: {{ basename($about->aboutme_gambar) }}</small> @endif
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- Skills Section -->
            <div id="skills" class="section-content">
                <div class="header"><h1>Skills Settings</h1></div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-plus-circle"></i> Tambah Skill Baru</h3></div>
                    <form action="{{ route('admin.skills.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label>Judul Kategori</label>
                                <input type="text" name="skill_judul" class="form-control" placeholder="Web Development" required>
                                @error('skill_judul') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label>Pilih Ikon/Emoji</label>
                                <select name="emoji" class="form-control" required>
                                    <option value="">-- Pilih Ikon --</option>
                                    <option value="fa-code">💻 Code (fa-code)</option>
                                    <option value="fa-laptop-code">🖥️ Laptop (fa-laptop-code)</option>
                                    <option value="fa-mobile-alt">📱 Mobile (fa-mobile-alt)</option>
                                    <option value="fa-database">🗄️ Database (fa-database)</option>
                                    <option value="fa-server">🖥️ Server (fa-server)</option>
                                    <option value="fa-cloud">☁️ Cloud (fa-cloud)</option>
                                    <option value="fa-shield-alt">🛡️ Security (fa-shield-alt)</option>
                                    <option value="fa-network-wired">🌐 Network (fa-network-wired)</option>
                                    <option value="fa-robot">🤖 AI/Robot (fa-robot)</option>
                                    <option value="fa-microchip">💾 Hardware (fa-microchip)</option>
                                    <option value="fa-paint-brush">🎨 Design (fa-paint-brush)</option>
                                    <option value="fa-tools">🛠️ Tools (fa-tools)</option>
                                </select>
                                @error('emoji') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Skill</label>
                                <input type="text" name="judul_perskill" class="form-control" placeholder="Laravel" required>
                                @error('judul_perskill') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label>Level Keahlian</label>
                                <select name="level" class="form-control" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="beginner">🌱 Beginner (Pemula)</option>
                                    <option value="intermediate">🌿 Intermediate (Menengah)</option>
                                    <option value="advanced"> Advanced (Mahir)</option>
                                    <option value="expert">🌟 Expert (Ahli)</option>
                                </select>
                                @error('level') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-plus"></i> Tambah Skill
                        </button>
                    </form>
                </div>

                <!-- Daftar Skill Saat Ini -->
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-list"></i> Daftar Skill Saat Ini</h3></div>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Ikon</th>
                                    <th>Nama Skill</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skills as $skill)
                                <tr>
                                    <td>{{ $skill->skill_judul }}</td>
                                    <td><i class="fas {{ $skill->emoji }}" style="color: var(--primary-color); font-size: 16px;"></i> ({{ $skill->emoji }})</td>
                                    <td><strong>{{ $skill->judul_perskill }}</strong></td>
                                    <td>
                                        @php
                                            $levelBadges = [
                                                'beginner' => ['#10b981', 'Beginner'],
                                                'intermediate' => ['#00d4aa', 'Intermediate'],
                                                'advanced' => ['#059669', 'Advanced'],
                                                'expert' => ['#047857', 'Expert'],
                                            ];
                                            $badge = $levelBadges[$skill->level] ?? ['#00d4aa', ucfirst($skill->level)];
                                        @endphp
                                        <span style="background: rgba(0, 212, 170, 0.1); color: {{ $badge[0] }}; border: 1px solid {{ $badge[0] }}; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                            {{ $badge[1] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 8px; align-items: center;">
                                            <button type="button" class="btn" style="background: #3b82f6; color: white; padding: 6px 12px; font-size: 12px;" onclick='openEditSkillModal(@json($skill))'>
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.skills.delete', $skill->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus skill {{ $skill->judul_perskill }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn" style="background: #ef4444; color: white; padding: 6px 12px; font-size: 12px;">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--text-secondary); padding: 20px;">Belum ada data skill.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Portfolio Section -->
            <div id="portfolio" class="section-content">
                <div class="header"><h1>Portfolio Settings</h1></div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-plus-circle"></i> Tambah Portfolio Item</h3></div>
                    <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Foto Project</label>
                            <div class="file-upload" onclick="document.getElementById('portfolio_foto').click()">
                                <i class="fas fa-image"></i><p>Klik untuk upload foto</p><small>Format: JPG, PNG, Max: 2MB</small>
                                <input type="file" id="portfolio_foto" name="foto" accept="image/*" onchange="updateFileName(this)" required>
                            </div>
                            @error('foto') <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group"><label>Judul Project</label><input type="text" name="judul" class="form-control" required></div>
                        <div class="form-group"><label>Deskripsi Singkat</label><textarea name="deskripsi_singkat" class="form-control" rows="2" required></textarea></div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control" required>
                                <option value="project">Project</option>
                                <option value="organization">Organization</option>
                                <option value="certificate">Certificate</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Judul Isi (Detail)</label><input type="text" name="judul_isi" class="form-control"></div>
                        <div class="form-group"><label>Deskripsi Isi (Detail)</label><textarea name="deskripsi_isi" class="form-control" rows="4"></textarea></div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;"><i class="fas fa-plus"></i> Tambah Portfolio</button>
                    </form>
                </div>

                <!-- Daftar Portfolio -->
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-list"></i> Daftar Portfolio</h3></div>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($portfolios as $item)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $item->foto) }}" alt="foto" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;"></td>
                                    <td>{{ $item->judul }}</td>
                                    <td><span style="background: rgba(0, 212, 170, 0.1); color: var(--primary-color); padding: 4px 10px; border-radius: 4px; font-size: 12px; text-transform: uppercase;">{{ $item->kategori }}</span></td>
                                    <td>
                                        <div style="display: flex; gap: 8px; align-items: center;">
                                            <button type="button" class="btn" style="background: #3b82f6; color: white; padding: 6px 12px; font-size: 12px;" onclick='openEditPortfolioModal(@json($item))'>
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.portfolio.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn" style="background: #ef4444; color: white; padding: 6px 12px; font-size: 12px;">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 20px;">Belum ada data portfolio.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div id="contact" class="section-content">
                <div class="header"><h1>Contact Settings</h1></div>
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-cog"></i> Pengaturan Halaman Kontak</h3></div>
                    <form action="{{ route('admin.contact.update') }}" method="POST">
                        @csrf
                        <div class="form-group"><label>Judul Halaman</label><input type="text" name="judul" class="form-control" value="{{ $contact->judul ?? 'I\'m currently available for freelance work' }}"></div>
                        <div class="form-group"><label>Deskripsi Singkat</label><textarea name="deskripsi_singkat" class="form-control" rows="2">{{ $contact->deskripsi_singkat ?? 'Send me a message and let\'s create something amazing together' }}</textarea></div>
                        <div style="margin-top: 15px; margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: var(--text-primary);"><i class="fas fa-share-alt" style="color: var(--primary-color);"></i> Link Media Sosial</label>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 13px;"><i class="fab fa-github" style="color: var(--primary-color);"></i> GitHub</label>
                                    <input type="text" name="link_github" class="form-control" placeholder="https://github.com/username" value="{{ $contact->link_github ?? ($user->link_github ?? '') }}">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 13px;"><i class="fab fa-linkedin" style="color: #0a66c2;"></i> LinkedIn</label>
                                    <input type="text" name="link_linkedin" class="form-control" placeholder="https://linkedin.com/in/username" value="{{ $contact->link_linkedin ?? '' }}">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 13px;"><i class="fab fa-instagram" style="color: #e4405f;"></i> Instagram</label>
                                    <input type="text" name="link_instagram" class="form-control" placeholder="https://instagram.com/username" value="{{ $contact->link_instagram ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    </form>
                </div>

                <!-- Daftar Pesan Masuk -->
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-inbox"></i> Pesan yang Masuk</h3></div>
                    @forelse($messages as $msg)
                        <div style="border-bottom: 1px solid var(--border-color); padding: 15px 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                <strong>{{ $msg->nama_pengirim }}</strong>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <small style="color: var(--text-secondary);">{{ $msg->created_at ? $msg->created_at->format('d M Y, H:i') : '' }}</small>
                                    <form action="{{ route('admin.message.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan dari {{ $msg->nama_pengirim }}?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="background: transparent; border: 1px solid #ef4444; color: #ef4444; padding: 4px 8px; font-size: 11px; border-radius: 4px;">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <small style="color: var(--primary-color);">{{ $msg->email_pengirim }}</small>
                            <p style="color: var(--text-secondary); margin-top: 8px; line-height: 1.5;">{{ $msg->pesan_pengirim }}</p>
                        </div>
                    @empty
                        <p style="padding: 15px; color: var(--text-secondary); text-align: center;">Belum ada pesan masuk.</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Edit Skill -->
    <div id="editSkillModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.85); z-index: 9999; justify-content: center; align-items: center; backdrop-filter: blur(5px);">
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; width: 92%; max-width: 520px; padding: 30px; position: relative; box-shadow: 0 20px 50px rgba(0,0,0,0.6); max-height: 90vh; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); font-size: 18px; font-weight: 600; display: flex; align-items: center; gap: 10px; margin: 0;">
                    <i class="fas fa-edit"></i> Edit Skill
                </h3>
                <button type="button" onclick="closeEditSkillModal()" style="background: none; border: none; color: var(--text-secondary); font-size: 26px; cursor: pointer; line-height: 1;">&times;</button>
            </div>

            <form id="editSkillForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Judul Kategori</label>
                    <input type="text" id="edit_skill_judul" name="skill_judul" class="form-control" placeholder="Contoh: Web Development" required>
                </div>
                <div class="form-group">
                    <label>Pilih Ikon/Emoji</label>
                    <select id="edit_emoji" name="emoji" class="form-control" required>
                        <option value="fa-code">💻 Code (fa-code)</option>
                        <option value="fa-laptop-code">🖥️ Laptop (fa-laptop-code)</option>
                        <option value="fa-mobile-alt">📱 Mobile (fa-mobile-alt)</option>
                        <option value="fa-database">🗄️ Database (fa-database)</option>
                        <option value="fa-server">🖥️ Server (fa-server)</option>
                        <option value="fa-cloud">☁️ Cloud (fa-cloud)</option>
                        <option value="fa-shield-alt">🛡️ Security (fa-shield-alt)</option>
                        <option value="fa-network-wired">🌐 Network (fa-network-wired)</option>
                        <option value="fa-robot">🤖 AI/Robot (fa-robot)</option>
                        <option value="fa-microchip">💾 Hardware / Chip (fa-microchip)</option>
                        <option value="fa-paint-brush">🎨 Design (fa-paint-brush)</option>
                        <option value="fa-tools">🛠️ Tools (fa-tools)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Skill</label>
                    <input type="text" id="edit_judul_perskill" name="judul_perskill" class="form-control" placeholder="Contoh: Laravel" required>
                </div>
                <div class="form-group">
                    <label>Level Keahlian</label>
                    <select id="edit_level" name="level" class="form-control" required>
                        <option value="beginner">🌱 Beginner (Pemula)</option>
                        <option value="intermediate">🌿 Intermediate (Menengah)</option>
                        <option value="advanced">🌲 Advanced (Mahir)</option>
                        <option value="expert">🌟 Expert (Ahli)</option>
                    </select>
                </div>
                <div style="display: flex; gap: 12px; margin-top: 25px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditSkillModal()" style="justify-content: center;">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Portfolio -->
    <div id="editPortfolioModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.85); z-index: 9999; justify-content: center; align-items: center; backdrop-filter: blur(5px);">
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; width: 92%; max-width: 600px; padding: 30px; position: relative; box-shadow: 0 20px 50px rgba(0,0,0,0.6); max-height: 90vh; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); font-size: 18px; font-weight: 600; display: flex; align-items: center; gap: 10px; margin: 0;">
                    <i class="fas fa-edit"></i> Edit Portfolio Item
                </h3>
                <button type="button" onclick="closeEditPortfolioModal()" style="background: none; border: none; color: var(--text-secondary); font-size: 26px; cursor: pointer; line-height: 1;">&times;</button>
            </div>

            <form id="editPortfolioForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Foto Project (Biarkan kosong jika tidak ingin mengganti foto)</label>
                    <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 10px;">
                        <img id="edit_portfolio_current_img" src="" alt="Current Foto" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color); display: none;">
                        <div style="font-size: 12px; color: var(--text-secondary);" id="edit_portfolio_img_info">Foto saat ini</div>
                    </div>
                    <div class="file-upload" onclick="document.getElementById('edit_portfolio_foto').click()">
                        <i class="fas fa-image"></i><p>Pilih foto baru (opsional)</p><small>Format: JPG, PNG, WEBP, Max: 5MB</small>
                        <input type="file" id="edit_portfolio_foto" name="foto" accept="image/*" onchange="updateEditPortfolioFileName(this)">
                    </div>
                    <small id="edit_portfolio_file_name" style="display: none; color: var(--primary-color); margin-top: 6px; font-size: 12px; font-weight: 500;"></small>
                </div>
                <div class="form-group">
                    <label>Judul Project</label>
                    <input type="text" id="edit_portfolio_judul" name="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select id="edit_portfolio_kategori" name="kategori" class="form-control" required>
                        <option value="project">Project</option>
                        <option value="organization">Organization</option>
                        <option value="certificate">Certificate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi Singkat</label>
                    <textarea id="edit_portfolio_deskripsi_singkat" name="deskripsi_singkat" class="form-control" rows="2" required></textarea>
                </div>
                <div class="form-group">
                    <label>Judul Isi (Detail)</label>
                    <input type="text" id="edit_portfolio_judul_isi" name="judul_isi" class="form-control">
                </div>
                <div class="form-group">
                    <label>Deskripsi Isi (Detail)</label>
                    <textarea id="edit_portfolio_deskripsi_isi" name="deskripsi_isi" class="form-control" rows="4"></textarea>
                </div>
                <div style="display: flex; gap: 12px; margin-top: 25px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditPortfolioModal()" style="justify-content: center;">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function forceEnableScroll() {
            document.body.style.overflow = 'auto'; document.body.style.position = ''; document.body.style.width = ''; document.body.style.height = '';
            document.documentElement.style.overflow = 'auto';
            const sidebar = document.getElementById('sidebar'); const overlay = document.querySelector('.sidebar-overlay');
            if (sidebar) sidebar.classList.remove('active'); if (overlay) overlay.classList.remove('active');
            document.querySelectorAll('*').forEach(el => { if (el.style.overflow === 'hidden' && el !== sidebar) { el.style.overflow = ''; } });
        }
        window.addEventListener('load', forceEnableScroll);
        window.addEventListener('pageshow', function(event) { if (event.persisted || (window.performance && window.performance.navigation.type === 2)) { forceEnableScroll(); } });
        document.addEventListener('DOMContentLoaded', forceEnableScroll);

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar'); const overlay = document.querySelector('.sidebar-overlay');
            if (!sidebar || !overlay) return;
            sidebar.classList.toggle('active'); overlay.classList.toggle('active');
            if (sidebar.classList.contains('active') && window.innerWidth <= 768) { document.body.style.overflow = 'hidden'; } 
            else { document.body.style.overflow = 'auto'; }
        }

        function showSection(sectionName) {
            document.querySelectorAll('.section-content').forEach(section => section.classList.remove('active'));
            document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
            const target = document.getElementById(sectionName); if (target) target.classList.add('active');
            const clickedItem = event.target.closest('.menu-item'); if (clickedItem) clickedItem.classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateFileName(input, displayId = 'file_name') {
            const fileName = input.files[0]?.name; const display = document.getElementById(displayId);
            if (fileName) { display.textContent = 'File terpilih: ' + fileName; display.style.display = 'block'; } 
            else { display.style.display = 'none'; }
        }

        function logout() { if (confirm('Yakin ingin logout?')) { window.location.href = '/'; } }

        function toggleAdminPassword(el) {
            const input = document.getElementById('adminPasswordInput');
            if (input.type === 'password') {
                input.type = 'text';
                el.classList.remove('fa-eye');
                el.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                el.classList.remove('fa-eye-slash');
                el.classList.add('fa-eye');
            }
        }

        function openEditSkillModal(skill) {
            const modal = document.getElementById('editSkillModal');
            const form = document.getElementById('editSkillForm');
            form.action = '/admin/skills/' + skill.id;
            document.getElementById('edit_skill_judul').value = skill.skill_judul;
            document.getElementById('edit_emoji').value = skill.emoji;
            document.getElementById('edit_judul_perskill').value = skill.judul_perskill;
            document.getElementById('edit_level').value = skill.level || 'beginner';
            modal.style.display = 'flex';
        }

        function closeEditSkillModal() {
            const modal = document.getElementById('editSkillModal');
            if (modal) modal.style.display = 'none';
        }

        function openEditPortfolioModal(item) {
            const modal = document.getElementById('editPortfolioModal');
            const form = document.getElementById('editPortfolioForm');
            form.action = '/admin/portfolio/' + item.id;
            document.getElementById('edit_portfolio_judul').value = item.judul || '';
            document.getElementById('edit_portfolio_kategori').value = item.kategori || 'project';
            document.getElementById('edit_portfolio_deskripsi_singkat').value = item.deskripsi_singkat || '';
            document.getElementById('edit_portfolio_judul_isi').value = item.judul_isi || '';
            document.getElementById('edit_portfolio_deskripsi_isi').value = item.deskripsi_isi || '';
            
            const currentImg = document.getElementById('edit_portfolio_current_img');
            const imgInfo = document.getElementById('edit_portfolio_img_info');
            const fileInfo = document.getElementById('edit_portfolio_file_name');
            const fotoInput = document.getElementById('edit_portfolio_foto');
            fotoInput.value = '';
            fileInfo.style.display = 'none';

            if (item.foto) {
                currentImg.src = '/storage/' + item.foto;
                currentImg.style.display = 'block';
                imgInfo.style.display = 'block';
            } else {
                currentImg.style.display = 'none';
                imgInfo.style.display = 'none';
            }

            modal.style.display = 'flex';
        }

        function closeEditPortfolioModal() {
            const modal = document.getElementById('editPortfolioModal');
            if (modal) modal.style.display = 'none';
        }

        function updateEditPortfolioFileName(input) {
            const fileName = input.files[0]?.name;
            const display = document.getElementById('edit_portfolio_file_name');
            if (fileName) {
                display.textContent = 'File baru terpilih: ' + fileName;
                display.style.display = 'block';
            } else {
                display.style.display = 'none';
            }
        }

        // Tutup modal jika klik di area luar
        window.addEventListener('click', function(e) {
            const skillModal = document.getElementById('editSkillModal');
            if (e.target === skillModal) {
                closeEditSkillModal();
            }
            const portfolioModal = document.getElementById('editPortfolioModal');
            if (e.target === portfolioModal) {
                closeEditPortfolioModal();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                const sidebar = document.getElementById('sidebar'); const overlay = document.querySelector('.sidebar-overlay');
                if (sidebar) sidebar.classList.remove('active'); if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = 'auto'; document.documentElement.style.overflow = 'auto';
            }
        });
        setInterval(() => { if (document.body.style.overflow === 'hidden' && window.innerWidth > 768) { document.body.style.overflow = 'auto'; } }, 1000);
    </script>
</body>
</html>