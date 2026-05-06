<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Bantuan Sosial</title>

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background:#f5f7fb;
    color:#333;
}

/* NAVBAR */
.navbar{
    background:#2c3e50;
    color:white;
    padding:16px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
}

.navbar h2{
    font-size:20px;
    font-weight:600;
}

.nav-right{
    display:flex;
    align-items:center;
    gap:15px;
}

.user-name{
    font-size:14px;
}

/* CONTAINER */
.container{
    width:90%;
    max-width:1100px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    background: whitesmoke;
}
input, select, textarea{
    width:100%;
    padding:10px;
    margin-top:6px;
    margin-bottom:14px;
    border:1px solid #ccc;
    border-radius:6px;
}
/* BUTTON */
.btn{
    padding:8px 16px;
    border-radius:6px;
    font-size:14px;
    border:none;
    cursor:pointer;
    display:inline-block;
    transition:all 0.2s ease;
    font-weight:500;
    text-decoration:none;
}

/* PRIMARY */
.btn-primary{
    background:#3498db;
    color:white;
}

.btn-primary:hover{
    background:#2980b9;
    transform:translateY(-1px);
}

/* WARNING */
.btn-warning{
    background:#f39c12;
    color:white;
}

.btn-warning:hover{
    background:#d68910;
}

/* DANGER */
.btn-danger{
    background:#e74c3c;
    color:white;
}

.btn-danger:hover{
    background:#c0392b;
}

/* SECONDARY */
.btn-secondary{
    background:#95a5a6;
    color:white;
}

.btn-secondary:hover{
    background:#7f8c8d;
}

/* LOGOUT */
.logout-btn{
    background:#e74c3c;
    border:none;
    padding:7px 14px;
    color:white;
    border-radius:6px;
    cursor:pointer;
    transition:0.2s;
}

.logout-btn:hover{
    background:#c0392b;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    font-size:14px;
}

table th{
    background:#2c3e50;
    font-weight:600;
    color: white;
}

table th, table td{
    padding:12px;
    border:2px solid #e2e6ea;
}

table tr:hover{
    background:#fafafa;
}

/* ALERT */
.alert-success{
    background:#d4edda;
    padding:12px;
    border-radius:6px;
    margin-bottom:15px;
    color:#155724;
    border:1px solid #c3e6cb;
}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>Sistem Bantuan Sosial</h2>

    <div class="nav-right">
        @auth
            <span class="user-name">👤 {{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        @endauth
    </div>
</div>

<!-- CONTENT -->
<div class="container">
    @yield('content')
</div>

</body>
</html>