<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCASFLIX - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background: #141414;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Background hero image behind the form */
        .auth-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: url('https://images8.alphacoders.com/135/1354384.png') center/cover no-repeat;
            filter: brightness(0.3);
            z-index: 0;
        }

        .auth-wrapper {
            position: relative;
            z-index: 10;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6rem 1rem 2rem;
        }

        .auth-box {
            background: rgba(0, 0, 0, 0.82);
            border-radius: 6px;
            padding: 3rem 3.5rem;
            width: 100%;
            max-width: 440px;
            animation: fadeInUp 0.5s ease both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .auth-box h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        /* Tab switcher */
        .auth-tabs {
            display: flex;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #333;
        }

        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 0.6rem;
            cursor: pointer;
            color: #aaa;
            font-weight: 600;
            font-size: 1rem;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            transition: all 0.2s;
        }

        .auth-tab.active {
            color: #fff;
            border-bottom-color: #e50914;
        }

        /* Form panels */
        .auth-panel { display: none; }
        .auth-panel.active { display: block; }

        /* Inputs */
        .auth-input {
            background: #333 !important;
            border: none !important;
            border-radius: 4px !important;
            color: #fff !important;
            padding: 1rem !important;
            font-size: 1rem !important;
            margin-bottom: 1rem;
            width: 100%;
            transition: background 0.2s;
        }

        .auth-input:focus {
            background: #454545 !important;
            box-shadow: none !important;
            outline: none !important;
            color: #fff !important;
        }

        .auth-input::placeholder { color: #aaa !important; }

        /* Submit buttons */
        .btn-auth {
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 0.5rem;
        }

        .btn-auth-signin {
            background: #e50914;
            color: #fff;
        }

        .btn-auth-signin:hover {
            background: #c40812;
            transform: scale(1.02);
        }

        .btn-auth-signup {
            background: #e50914;
            color: #fff;
        }

        .btn-auth-signup:hover {
            background: #c40812;
            transform: scale(1.02);
        }

        .auth-divider {
            text-align: center;
            color: #aaa;
            font-size: 0.9rem;
            margin: 1.2rem 0;
        }

        .auth-footer-text {
            color: #737373;
            font-size: 0.85rem;
            margin-top: 1.5rem;
        }

        .auth-footer-text a {
            color: #fff;
            text-decoration: none;
        }

        .auth-footer-text a:hover { text-decoration: underline; }

        /* Alert messages */
        .auth-alert {
            border-radius: 4px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .auth-alert.success { background: #1a4a2e; color: #5cdb95; border: 1px solid #2e7d52; }
        .auth-alert.error   { background: #4a1a1a; color: #e57373; border: 1px solid #7d2e2e; }
        .auth-alert.info    { background: #1a2a4a; color: #64b5f6; border: 1px solid #2e4a7d; }

        /* Password strength indicator */
        .strength-bar {
            height: 4px;
            border-radius: 2px;
            margin-top: -0.7rem;
            margin-bottom: 1rem;
            background: #555;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: width 0.3s, background 0.3s;
        }

        .strength-label {
            font-size: 0.75rem;
            color: #aaa;
            text-align: right;
            margin-top: -0.8rem;
            margin-bottom: 0.8rem;
        }

        /* Remember me checkbox */
        .form-check-label { color: #aaa; font-size: 0.9rem; }
        .form-check-input:checked { background-color: #e50914; border-color: #e50914; }

        /* Navbar override for auth page */
        .navbar { background: rgba(0,0,0,0.9) !important; }
    </style>
</head>
<body>

<?php
// Determine which tab to show and any messages from auth_process.php
$active_tab = $_GET['tab'] ?? 'signin';
$msg_type   = $_GET['msg_type'] ?? '';
$msg_text   = htmlspecialchars($_GET['msg'] ?? '');
?>

    <!-- Background -->
    <div class="auth-bg"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-danger fw-bold fs-2" href="index.php">SCASFLIX</a>
        </div>
    </nav>

    <!-- Auth Wrapper -->
    <div class="auth-wrapper">
        <div class="auth-box">

            <!-- Tab Switcher -->
            <div class="auth-tabs">
                <div class="auth-tab <?= $active_tab === 'signin' ? 'active' : '' ?>" onclick="switchTab('signin')">Sign In</div>
                <div class="auth-tab <?= $active_tab === 'signup' ? 'active' : '' ?>" onclick="switchTab('signup')">Sign Up</div>
            </div>

            <!-- Alert Message (from redirect) -->
            <?php if ($msg_type && $msg_text): ?>
            <div class="auth-alert <?= htmlspecialchars($msg_type) ?>">
                <?= $msg_text ?>
            </div>
            <?php endif; ?>

            <!-- ===== SIGN IN PANEL ===== -->
            <div class="auth-panel <?= $active_tab === 'signin' ? 'active' : '' ?>" id="panel-signin">
                <form action="auth_process.php" method="POST">
                    <input type="hidden" name="action" value="signin">

                    <input type="email"
                           name="signin_email"
                           class="auth-input"
                           placeholder="Email address"
                           required
                           autocomplete="email">

                    <input type="password"
                           name="signin_password"
                           class="auth-input"
                           placeholder="Password"
                           required
                           autocomplete="current-password">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember_me" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-muted small">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-auth btn-auth-signin">Sign In</button>
                </form>

                <div class="auth-divider">— OR —</div>

                <p class="auth-footer-text text-center">
                    New to SCASFLIX? 
                    <a href="#" onclick="switchTab('signup')">Sign up now.</a>
                </p>
            </div>

            <!-- ===== SIGN UP PANEL ===== -->
            <div class="auth-panel <?= $active_tab === 'signup' ? 'active' : '' ?>" id="panel-signup">
                <form action="auth_process.php" method="POST" id="signupForm">
                    <input type="hidden" name="action" value="signup">

                    <input type="text"
                           name="signup_name"
                           class="auth-input"
                           placeholder="Full Name"
                           required
                           autocomplete="name">

                    <input type="email"
                           name="signup_email"
                           class="auth-input"
                           placeholder="Email address"
                           required
                           autocomplete="email">

                    <input type="password"
                           name="signup_password"
                           id="signupPassword"
                           class="auth-input"
                           placeholder="Create a password"
                           required
                           oninput="checkStrength(this.value)"
                           autocomplete="new-password">

                    <!-- Password Strength Bar -->
                    <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                    <div class="strength-label" id="strengthLabel"></div>

                    <input type="password"
                           name="signup_confirm"
                           id="signupConfirm"
                           class="auth-input"
                           placeholder="Confirm password"
                           required
                           autocomplete="new-password">

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="agree_terms" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the <a href="#" class="text-danger">Terms of Use</a> and <a href="#" class="text-danger">Privacy Policy</a>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth btn-auth-signup">Create Account</button>
                </form>

                <p class="auth-footer-text text-center mt-3">
                    Already have an account? 
                    <a href="#" onclick="switchTab('signin')">Sign in.</a>
                </p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab switching
        function switchTab(tab) {
            document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.auth-panel').forEach(p => p.classList.remove('active'));
            document.querySelector('.auth-tab:' + (tab === 'signin' ? 'first-child' : 'last-child')).classList.add('active');
            document.getElementById('panel-' + tab).classList.add('active');
        }

        // Password strength checker
        function checkStrength(password) {
            const fill  = document.getElementById('strengthFill');
            const label = document.getElementById('strengthLabel');
            let score = 0;
            if (password.length >= 8)              score++;
            if (/[A-Z]/.test(password))            score++;
            if (/[0-9]/.test(password))            score++;
            if (/[^A-Za-z0-9]/.test(password))    score++;

            const levels = [
                { pct: '0%',   color: '#555',    text: '' },
                { pct: '25%',  color: '#e50914', text: 'Weak' },
                { pct: '50%',  color: '#f39c12', text: 'Fair' },
                { pct: '75%',  color: '#27ae60', text: 'Good' },
                { pct: '100%', color: '#1abc9c', text: 'Strong' },
            ];

            const lvl = password.length === 0 ? levels[0] : levels[score];
            fill.style.width     = lvl.pct;
            fill.style.background = lvl.color;
            label.textContent    = lvl.text;
            label.style.color    = lvl.color;
        }
    </script>
</body>
</html>
