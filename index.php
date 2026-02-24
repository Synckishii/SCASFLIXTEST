<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCASFLIX - Stream Your Favorites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Show login success toast
if (isset($_GET['login']) && $_GET['login'] === 'success'): ?>
<div class="alert-toast success" id="contactToast">
    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
    Welcome back, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?>! 🎬
</div>
<?php endif; ?>

<?php
// Show success/error message if redirected from contact_process.php
if (isset($_GET['contact']) && $_GET['contact'] === 'success'): ?>
<div class="alert-toast success" id="contactToast">
    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
    Message sent successfully! We'll get back to you soon.
</div>
<?php elseif (isset($_GET['contact']) && $_GET['contact'] === 'error'): ?>
<div class="alert-toast error" id="contactToast">
    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>
    <?php echo htmlspecialchars($_GET['msg'] ?? 'Something went wrong. Please try again.'); ?>
</div>
<?php endif; ?>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-danger fw-bold fs-2" href="index.php">SCASFLIX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">TV Shows</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Movies</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Anime</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">My List</a></li>
                    <?php if (isset($_SESSION['user_name'])): ?>
                    <li class="nav-item ms-3 d-flex align-items-center gap-2">
                        <span class="text-white small">
                            &#128100; <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                        </span>
                        <a class="btn btn-outline-secondary btn-sm px-3" href="logout.php">Sign Out</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item ms-2">
                        <a class="btn btn-outline-danger btn-sm px-3" href="login.php">Sign In</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section with CSS-only Carousel -->
    <header class="hero-section">
        <input type="radio" name="hero-slide" id="slide1" checked>
        <input type="radio" name="hero-slide" id="slide2">
        <input type="radio" name="hero-slide" id="slide3">
        <input type="radio" name="hero-slide" id="slide4">
        <input type="radio" name="hero-slide" id="slide5">

        <!-- Slide 1: Gundam Seed -->
        <div class="hero-slide" id="hero-slide-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-9">
                        <h1 class="display-1 fw-bold text-white">Mobile Suit Gundam SEED Freedom</h1>
                        <div class="mb-4">
                            <span class="badge bg-success">98% Match</span>
                            <span class="badge bg-secondary ms-2">2024</span>
                            <span class="badge bg-secondary ms-2">2 Seasons</span>
                            <span class="badge bg-warning text-dark ms-2">HD</span>
                        </div>
                        <p class="lead text-white">In the Cosmic Era, coordinators and naturals fight for the future of humanity. Join Kira Yamato as he pilots the legendary Freedom Gundam to end the devastating conflict between Earth and the space colonies.</p>
                        <div class="mt-4 d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-success btn-lg px-5">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-play-fill me-2" viewBox="0 0 16 16"><path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg>
                                Play
                            </button>
                            <button class="btn btn-outline-danger btn-lg px-4">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                                More Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2: Gachiakuta -->
        <div class="hero-slide" id="hero-slide-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-9">
                        <h1 class="display-1 fw-bold text-white">GACHIAKUTA</h1>
                        <div class="mb-4">
                            <span class="badge bg-success">96% Match</span>
                            <span class="badge bg-secondary ms-2">2025</span>
                            <span class="badge bg-secondary ms-2">1 Season</span>
                            <span class="badge bg-warning text-dark ms-2">HD</span>
                        </div>
                        <p class="lead text-white">Rudo lives in a trash town where an unjust decree exiles him to the abyss. There, he discovers a world of danger and possibility, wielding mysterious powers from discarded objects to fight for survival and justice.</p>
                        <div class="mt-4 d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-success btn-lg px-5">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-play-fill me-2" viewBox="0 0 16 16"><path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg>
                                Play
                            </button>
                            <button class="btn btn-outline-danger btn-lg px-4">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                                More Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3: Frieren -->
        <div class="hero-slide" id="hero-slide-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-9">
                        <h1 class="display-1 fw-bold text-white">FRIEREN: BEYOND JOURNEY'S END</h1>
                        <div class="mb-4">
                            <span class="badge bg-success">99% Match</span>
                            <span class="badge bg-secondary ms-2">2023</span>
                            <span class="badge bg-secondary ms-2">2 Seasons</span>
                            <span class="badge bg-warning text-dark ms-2">4K</span>
                        </div>
                        <p class="lead text-white">After the hero's party defeated the Demon King, the elf mage Frieren embarks on a new journey to understand humanity. In her quest spanning decades, she discovers the meaning of friendship and the bonds that transcend time.</p>
                        <div class="mt-4 d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-success btn-lg px-5">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-play-fill me-2" viewBox="0 0 16 16"><path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg>
                                Play
                            </button>
                            <button class="btn btn-outline-danger btn-lg px-4">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                                More Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 4: My Hero Academia -->
        <div class="hero-slide" id="hero-slide-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-9">
                        <h1 class="display-1 fw-bold text-white">MY HERO ACADEMIA</h1>
                        <div class="mb-4">
                            <span class="badge bg-success">97% Match</span>
                            <span class="badge bg-secondary ms-2">2016</span>
                            <span class="badge bg-secondary ms-2">7 Seasons</span>
                            <span class="badge bg-warning text-dark ms-2">HD</span>
                        </div>
                        <p class="lead text-white">In a world where nearly everyone has superpowers called Quirks, Izuku Midoriya dreams of becoming a hero despite being born without one. When the world's greatest hero passes his power to him, Izuku's journey to become the Symbol of Peace begins.</p>
                        <div class="mt-4 d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-success btn-lg px-5">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-play-fill me-2" viewBox="0 0 16 16"><path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg>
                                Play
                            </button>
                            <button class="btn btn-outline-danger btn-lg px-4">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                                More Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 5: Alice in Borderland -->
        <div class="hero-slide" id="hero-slide-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-9">
                        <h1 class="display-1 fw-bold text-white">ALICE IN BORDERLAND</h1>
                        <div class="mb-4">
                            <span class="badge bg-success">95% Match</span>
                            <span class="badge bg-secondary ms-2">2020</span>
                            <span class="badge bg-secondary ms-2">2 Seasons</span>
                            <span class="badge bg-warning text-dark ms-2">4K</span>
                        </div>
                        <p class="lead text-white">An aimless gamer and his friends find themselves in a parallel Tokyo where they must compete in deadly games to survive. Each game tests their intelligence, strength, and will to live as they search for a way back home.</p>
                        <div class="mt-4 d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-success btn-lg px-5">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-play-fill me-2" viewBox="0 0 16 16"><path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/></svg>
                                Play
                            </button>
                            <button class="btn btn-outline-danger btn-lg px-4">
                                <svg width="24" height="24" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                                More Info
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Controls -->
        <div class="hero-nav-controls">
            <label for="slide5" class="hero-nav-btn prev" data-slide="1"></label>
            <label for="slide1" class="hero-nav-btn prev" data-slide="2"></label>
            <label for="slide2" class="hero-nav-btn prev" data-slide="3"></label>
            <label for="slide3" class="hero-nav-btn prev" data-slide="4"></label>
            <label for="slide4" class="hero-nav-btn prev" data-slide="5"></label>
            <label for="slide2" class="hero-nav-btn next" data-slide="1"></label>
            <label for="slide3" class="hero-nav-btn next" data-slide="2"></label>
            <label for="slide4" class="hero-nav-btn next" data-slide="3"></label>
            <label for="slide5" class="hero-nav-btn next" data-slide="4"></label>
            <label for="slide1" class="hero-nav-btn next" data-slide="5"></label>
        </div>

        <!-- Slide Indicator Dots -->
        <div class="hero-indicators">
            <label for="slide1"></label>
            <label for="slide2"></label>
            <label for="slide3"></label>
            <label for="slide4"></label>
            <label for="slide5"></label>
        </div>
    </header>
    
    <!-- Trending Now Section -->
    <section class="container my-5">
        <h3 class="mb-4">Trending Now</h3>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/AoGsDM02UVt0npBA8OvpDcZbaMi.jpg" class="card-img-top" alt="The Witcher">
                    <div class="card-body"><h6 class="card-title">The Witcher</h6><p class="card-text small">Fantasy • Action</p><span class="badge bg-success small">95% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/uOOtwVbSr4QDjAGIifLDwpb2Pdl.jpg" class="card-img-top" alt="Stranger Things">
                    <div class="card-body"><h6 class="card-title">Stranger Things</h6><p class="card-text small">Sci-Fi • Horror</p><span class="badge bg-success small">98% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/gKY6q7SjCkAU6FqvqWybDYgUKIF.jpg" class="card-img-top" alt="Avatar">
                    <div class="card-body"><h6 class="card-title">Avatar: TWOW</h6><p class="card-text small">Adventure • Sci-Fi</p><span class="badge bg-success small">92% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/36xXlhEpQqVVPuiZhfoQuaY4OlA.jpg" class="card-img-top" alt="Wednesday">
                    <div class="card-body"><h6 class="card-title">Wednesday</h6><p class="card-text small">Mystery • Comedy</p><span class="badge bg-success small">96% Match</span></div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- SCAS Student Picks Section -->
    <section class="container my-5">
        <h3 class="mb-4">SCAS Student Picks</h3>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/fWVSwgjpT2D78VUh6X8UBd2rorW.jpg" class="card-img-top" alt="Demon Slayer">
                    <div class="card-body"><h6 class="card-title">Demon Slayer</h6><p class="card-text small">Anime • Action</p><span class="badge bg-success small">99% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/ihK3jUDlcQBMEObbLwSswqpiy3Z.jpg" class="card-img-top" alt="Attack on Titan">
                    <div class="card-body"><h6 class="card-title">Attack on Titan</h6><p class="card-text small">Anime • Drama</p><span class="badge bg-success small">97% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/cMD9Ygz11zjJzAovURpO75Qg7rT.jpg" class="card-img-top" alt="One Piece">
                    <div class="card-body"><h6 class="card-title">One Piece</h6><p class="card-text small">Anime • Adventure</p><span class="badge bg-success small">98% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/fHpKWq9ayzSk8nSwqRuaAUemRKh.jpg" class="card-img-top" alt="Jujutsu Kaisen">
                    <div class="card-body"><h6 class="card-title">Jujutsu Kaisen</h6><p class="card-text small">Anime • Supernatural</p><span class="badge bg-success small">96% Match</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular on SCASFLIX Section -->
    <section class="container my-5">
        <h3 class="mb-4">Popular on SCASFLIX</h3>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/ztkUQFLlC19CCMYHW9o1zWhJRNq.jpg" class="card-img-top" alt="Breaking Bad">
                    <div class="card-body"><h6 class="card-title">Breaking Bad</h6><p class="card-text small">Drama • Thriller</p><span class="badge bg-success small">99% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/1DDE0Z2Y805rqfkEjPbZsMLyPwa.jpg" class="card-img-top" alt="The Crown">
                    <div class="card-body"><h6 class="card-title">The Crown</h6><p class="card-text small">Drama • Historical</p><span class="badge bg-success small">94% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/reEMJA1uzscCbkpeRJeTT2bjqUp.jpg" class="card-img-top" alt="Money Heist">
                    <div class="card-body"><h6 class="card-title">Money Heist</h6><p class="card-text small">Crime • Thriller</p><span class="badge bg-success small">93% Match</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white movie-card">
                    <img src="https://media.themoviedb.org/t/p/w300_and_h450_face/1QdXdRYfktUSONkl1oD5gc6Be0s.jpg" class="card-img-top" alt="Squid Game">
                    <div class="card-body"><h6 class="card-title">Squid Game</h6><p class="card-text small">Thriller • Drama</p><span class="badge bg-success small">97% Match</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER WITH CONTACT FORM ===== -->
    <footer class="scasflix-footer mt-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Brand & About -->
                <div class="col-md-4">
                    <h4 class="text-danger fw-bold fs-3 mb-2">SCASFLIX</h4>
                    <p class="text-muted small mb-3">Your premier streaming destination for anime, series, and movies. Watch anywhere. Cancel anytime.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link">FB</a>
                        <a href="#" class="social-link">TW</a>
                        <a href="#" class="social-link">IG</a>
                        <a href="#" class="social-link">YT</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2">
                    <h6 class="footer-heading">Browse</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">TV Shows</a></li>
                        <li><a href="#">Movies</a></li>
                        <li><a href="#">Anime</a></li>
                        <li><a href="#">My List</a></li>
                    </ul>
                </div>

                <!-- Help -->
                <div class="col-md-2">
                    <h6 class="footer-heading">Help</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>

                <!-- Contact Form -->
                <div class="col-md-4">
                    <h6 class="footer-heading">Send Us a Message</h6>
                    <form action="contact_process.php" method="POST" class="footer-contact-form">
                        <div class="mb-2">
                            <input type="text" name="contact_name" class="form-control form-control-sm footer-input" placeholder="Your Name" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" name="contact_email" class="form-control form-control-sm footer-input" placeholder="Your Email" required>
                        </div>
                        <div class="mb-2">
                            <select name="contact_subject" class="form-select form-select-sm footer-input" required>
                                <option value="" disabled selected>Subject</option>
                                <option value="Technical Issue">Technical Issue</option>
                                <option value="Billing">Billing</option>
                                <option value="Content Request">Content Request</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea name="contact_message" class="form-control form-control-sm footer-input" rows="3" placeholder="Your message..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold">Send Message</button>
                    </form>
                </div>
            </div>

            <hr class="border-secondary mt-5 mb-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted small mb-0">© 2026 SCASFLIX by Raymond Bien Ibarbia. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted small mb-0"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="681b1d1818071a1c28010a091a0a01091b0b091b0e040110460b0705">[email&#160;protected]</a> &nbsp;|&nbsp; 1-800-SCASFLIX</p>
                </div>
            </div>
        </div>
    </footer>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 50);
        });

        // Auto-dismiss toast
 