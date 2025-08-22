<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dairy Farm Management | Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<style>
    :root{
        --primary:#0a2a66;
        --primary-dark:#081d46;
        --accent:#00bcd4;
        --accent-dark:#0097a7;
        --light:#e6f2ff;
        --text:#333;
        --muted:#555;
        --card-shadow:0 8px 24px rgba(0,0,0,.15);
        --card-shadow-lg:0 14px 34px rgba(0,0,0,.22);
        --radius:14px;
        --speed:.35s;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    body{
        font-family:'Montserrat',sans-serif;
        line-height:1.6;color:var(--text);
        background:#fdfdfd;scroll-behavior:smooth;
    }

    /* UTILITIES */
    .container{max-width:1200px;margin:0 auto;padding:0 20px;}
    .btn{
        display:inline-block;
        padding:14px 28px;border-radius:999px;
        font-weight:700;text-decoration:none;
        transition:transform var(--speed), box-shadow var(--speed), background var(--speed), color var(--speed);
        will-change:transform, box-shadow;
    }
    .btn-primary{
        background:var(--accent);color:#fff;box-shadow:0 10px 24px rgba(0,188,212,.28);
    }
    .btn-primary:hover{background:var(--accent-dark);transform:translateY(-2px);box-shadow:0 14px 30px rgba(0,151,167,.34);}
    .hover-lift{transition:transform var(--speed), box-shadow var(--speed);}
    .hover-lift:hover{transform:translateY(-8px);box-shadow:var(--card-shadow-lg);}
    .img-zoom{overflow:hidden;border-radius:10px;box-shadow:var(--card-shadow);}
    .img-zoom img{display:block;width:100%;transition:transform .8s ease;}
    .img-zoom:hover img{transform:scale(1.06);}

    /* REVEAL ON SCROLL */
    .reveal{opacity:0;transform:translateY(30px);transition:opacity .8s ease, transform .8s ease;}
    .reveal.visible{opacity:1;transform:translateY(0);}

    /* HEADER */
    header{
        background:var(--primary);
        position:fixed;top:0;width:100%;
        padding:1rem 1.5rem;
        display:flex;justify-content:space-between;align-items:center;
        z-index:1000;color:#fff;box-shadow:0 6px 16px rgba(0,0,0,.15);
    }
    header.scrolled{background:var(--primary-dark);}
    .logo{display:flex;align-items:center;gap:10px;}
    .logo img{height:60px;border-radius:6px;}
    .logo span{font-size:1.4rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;}

    /* NAVIGATION */
    nav{display:flex;align-items:center;gap:10px;}
    nav a{
        color:#fff;text-decoration:none;font-size:0.95rem;font-weight:600;
        padding:8px 14px;border-radius:999px;border:1px solid rgba(255,255,255,.25);
        transition:background var(--speed), transform var(--speed), border-color var(--speed);
    }
    nav a:hover{background:rgba(255,255,255,.12);transform:translateY(-2px);border-color:rgba(255,255,255,.35);}
    nav .fb-btn{background:#4267B2;border-color:#4267B2;}
    nav .fb-btn:hover{background:#365899;}

    /* HAMBURGER */
    .menu-toggle{display:none;flex-direction:column;cursor:pointer;gap:4px;}
    .menu-toggle span{display:block;width:25px;height:3px;background:#fff;border-radius:2px;}

    /* HERO */
    .hero{
        position:relative;height:95vh;display:flex;justify-content:center;align-items:center;
        text-align:center;color:#fff;overflow:hidden;margin-top:80px;
    }
    .hero video{position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;}
    .hero::after{content:'';position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,.55),rgba(0,0,0,.45));z-index:1;}
    .hero-content{
        position:relative;z-index:2;max-width:1000px;padding:0 20px;
        animation:fadeInUp 1s ease-out;
    }
    .hero h1{font-size:3rem;margin-bottom:1rem;text-shadow:0 6px 18px rgba(0,0,0,.45);}
    .hero p{font-size:1.2rem;margin-bottom:2rem;opacity:.95;}

    /* WHY CHOOSE US */
    .why-inline{
        margin-top:28px;display:grid;gap:18px;grid-template-columns:repeat(3,minmax(0,1fr));
    }
    .why-card{
        background:rgba(255,255,255,.12);backdrop-filter:blur(6px);
        border:1px solid rgba(255,255,255,.22);color:#fff;
        padding:18px;border-radius:12px;box-shadow:0 10px 22px rgba(0,0,0,.25);
        transition:transform var(--speed), box-shadow var(--speed), background var(--speed), border-color var(--speed);
    }
    .why-card:hover{transform:translateY(-6px);box-shadow:0 16px 34px rgba(0,0,0,.35);background:rgba(255,255,255,.18);border-color:rgba(255,255,255,.32);}
    .why-card h3{font-size:1.6rem;margin-bottom:6px;}
    .why-card p{font-size:0.98rem;}

    /* TWO COLUMN */
    .two-col{display:flex;flex-wrap:wrap;padding:90px 40px;align-items:center;}
    .two-col .text{flex:1 1 50%;padding:20px;min-width:300px;}
    .two-col .text h2{font-size:2.4rem;margin-bottom:20px;color:var(--primary);}
    .two-col .text p{font-size:1.15rem;line-height:1.8;}
    .two-col .image{flex:1 1 50%;min-width:300px;}
    .two-col .image .img-zoom{border-radius:12px;}

    /* Alternating backgrounds */
    section:nth-of-type(odd){background:#bcf5f9;}
    section:nth-of-type(even){background:#89c5fd;}

    /* PRODUCTS */
    .products{padding:90px 40px;text-align:center;color:#333;}
    .products h2{font-size:2.4rem;margin-bottom:40px;color:var(--primary);}
    .products .grid{display:grid;gap:30px;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));}
    .product-card{
        background:#fff;padding:22px;border-radius:12px;box-shadow:var(--card-shadow);
        color:#333;transition:transform var(--speed), box-shadow var(--speed);
    }
    .product-card:hover{transform:translateY(-8px);box-shadow:var(--card-shadow-lg);}
    .product-card img{width:100%;height:200px;object-fit:cover;border-radius:10px;}
    .product-card h3{margin-top:12px;font-size:1.3rem;color:var(--primary);}

    /* CONTACT */
    .contact{padding:90px 40px;text-align:center;}
    .contact h2{font-size:2.4rem;margin-bottom:30px;}
    .contact-info{
        max-width:560px;margin:auto;text-align:left;font-size:1.08rem;
        background:#fff;padding:22px;border-radius:12px;box-shadow:var(--card-shadow);
    }
    .contact-info a{color:var(--primary);font-weight:700;text-decoration:none;border-bottom:1px dashed rgba(10,42,102,.35);}
    .contact-info a:hover{border-bottom-color:transparent;}

    /* FOOTER */
    footer{background:var(--primary);color:#fff;text-align:center;padding:30px 20px;}

    /* ANIMATIONS */
    @keyframes fadeInUp{from{opacity:0;transform:translateY(40px);}to{opacity:1;transform:translateY(0);}}

    /* RESPONSIVE */
    /* RESET + VARIABLES */
:root{
    --primary:#0a2a66;
    --primary-dark:#081d46;
    --accent:#00bcd4;
    --accent-dark:#0097a7;
    --light:#e6f2ff;
    --text:#333;
    --muted:#555;
    --card-shadow:0 8px 24px rgba(0,0,0,.15);
    --card-shadow-lg:0 14px 34px rgba(0,0,0,.22);
    --radius:14px;
    --speed:.35s;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Montserrat',sans-serif;
    line-height:1.6;
    color:var(--text);
    background:#fdfdfd;
    scroll-behavior:smooth;
    font-size:16px;
}
img{max-width:100%;height:auto;display:block;}

/* GENERAL UTILITIES */
.container{max-width:1200px;margin:0 auto;padding:0 20px;}
.btn{padding:12px 22px;font-size:1rem;border-radius:999px;}

/* HEADER */
header{padding:0.8rem 1rem;}
.logo img{height:50px;}
.logo span{font-size:1.2rem;}

/* HERO */
.hero{height:90vh;margin-top:70px;}
.hero h1{font-size:2rem;}
.hero p{font-size:1rem;}
.hero .btn{padding:10px 18px;font-size:0.9rem;}

/* WHY CHOOSE US */
.why-inline{grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;}
.why-card h3{font-size:1.2rem;}
.why-card p{font-size:0.9rem;}

/* TWO COLUMN SECTIONS */
.two-col{display:flex;flex-wrap:wrap;padding:50px 20px;}
.two-col .text h2{font-size:1.8rem;}
.two-col .text p{font-size:1rem;}
.two-col .image{margin-top:18px;}

/* PRODUCTS */
.products{padding:60px 20px;}
.products h2{font-size:1.9rem;}
.products .grid{grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:18px;}
.product-card img{height:160px;}
.product-card h3{font-size:1.1rem;}

/* CONTACT */
.contact{padding:60px 20px;}
.contact h2{font-size:1.9rem;}
.contact-info{font-size:0.95rem;padding:16px;}

/* FOOTER */
footer{padding:20px;font-size:0.9rem;}

/* MEDIA QUERIES */

/* Tablets < 992px */
@media (max-width:992px){
  .hero h1{font-size:1.8rem;}
  .two-col{flex-direction:column;padding:40px 20px;}
  nav{width:100%;right:0;}
}

/* Mobiles < 768px */
@media (max-width:768px){
  header{padding:0.6rem 0.8rem;}
  .logo img{height:42px;}
  .logo span{font-size:1rem;}
  nav a{font-size:0.85rem;padding:6px 10px;}
  .hero{height:80vh;}
  .hero h1{font-size:1.6rem;}
  .hero p{font-size:0.95rem;}
}

/* Small Mobiles < 480px (344px–400px like your 344×882 screen) */
@media (max-width:480px){
  body{font-size:14px;}
  .hero{height:75vh;}
  .hero h1{font-size:1.4rem;line-height:1.3;}
  .hero p{font-size:0.85rem;}
  .btn{padding:8px 14px;font-size:0.8rem;}
  .why-card h3{font-size:1rem;}
  .why-card p{font-size:0.8rem;}
  .products h2,
  .contact h2,
  .two-col .text h2{font-size:1.5rem;}
  .product-card img{height:130px;}
  footer{font-size:0.75rem;}
}
/* --- Extra small devices (344px - 400px width) --- */
@media (max-width:400px){
  body{font-size:13px;}
  
  /* Header */
  header{padding:0.4rem 0.6rem;}
  .logo img{height:38px;}
  .logo span{font-size:0.85rem;}

  /* Hero section */
  .hero{height:auto;min-height:75vh;padding:20px 10px;}
  .hero h1{font-size:1.2rem;line-height:1.4;}
  .hero p{font-size:0.8rem;margin-bottom:1rem;}
  .hero .btn{padding:6px 12px;font-size:0.75rem;}

  /* Why choose us cards */
  .why-inline{grid-template-columns:1fr;gap:10px;margin-top:16px;}
  .why-card{padding:10px;}
  .why-card h3{font-size:0.95rem;margin-bottom:4px;}
  .why-card p{font-size:0.75rem;}

  /* Sections */
  .two-col{padding:30px 15px;}
  .two-col .text h2,
  .products h2,
  .contact h2{font-size:1.3rem;}
  .two-col .text p{font-size:0.85rem;}

  /* Products */
  .product-card{padding:12px;}
  .product-card img{height:120px;}
  .product-card h3{font-size:1rem;}
  .product-card p{font-size:0.8rem;}

  /* Contact */
  .contact-info{font-size:0.8rem;padding:12px;}

  /* Footer */
  footer{font-size:0.7rem;padding:15px;}
}

    @media (max-width:992px){.why-inline{grid-template-columns:1fr 1fr;}}
    @media (max-width:768px){
        nav{position:absolute;top:70px;right:0;background:var(--primary);
            flex-direction:column;align-items:flex-start;padding:12px;width:230px;display:none;
            box-shadow:0 16px 30px rgba(0,0,0,.25);}
        nav.active{display:flex;}
        .menu-toggle{display:flex;}
        .hero h1{font-size:2.2rem;}
        .two-col{flex-direction:column;padding:60px 20px;}
    }
    @media (max-width:520px){
        .logo img{height:48px;}
        .logo span{font-size:1rem;}
        nav a{font-size:0.9rem;padding:7px 12px;}
        .hero{height:88vh;}
        .hero p{font-size:1.05rem;}
        .why-inline{grid-template-columns:1fr;}
    }
</style>
<script>
    window.addEventListener('scroll',()=>{
        document.querySelector('header').classList.toggle('scrolled',window.scrollY>50);
    });
    document.addEventListener('DOMContentLoaded',()=>{
        const toggle=document.querySelector('.menu-toggle');
        const nav=document.querySelector('nav');
        toggle.addEventListener('click',()=>nav.classList.toggle('active'));
        const observer=new IntersectionObserver((entries)=>{
            entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');observer.unobserve(e.target);}});
        },{threshold:0.12});
        document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));
    });
</script>
</head>
<body>

<header>
    <div class="logo">
        <img src="images/logo.jpg" alt="Farm Logo">
        <span>SUNSHINE DAIRIES</span>
    </div>
    <div class="menu-toggle"><span></span><span></span><span></span></div>
    <nav>
        <a href="#about">About Us</a>
        <a href="#mission">Our Mission</a>
        <a href="#products">Our Products</a>
        <a href="#who">Who We Are</a>
        <a href="#contact">Contact Us</a>
        <a href="https://www.facebook.com/p/Sunshine-Dairies-61552469106859/" class="fb-btn" target="_blank">Facebook</a>
    </nav>
</header>

<!-- HERO -->
<section class="hero" id="hero">
    <video autoplay muted loop playsinline>
        <source src="images/fav.mp4" type="video/mp4">
    </video>
    <div class="hero-content">
        <h1 class="reveal">Welcome to SUNSHINE DAIRIES</h1>
        <p class="reveal" style="transition-delay:.08s">From our happy cows to your happy home — Fresh, pure, and full of goodness, every single day.</p>
        <a href="#products" class="btn btn-primary reveal" style="transition-delay:.16s">Explore Products</a>
        <div class="why-inline reveal" style="transition-delay:.24s">
            <div class="why-card"><h3>1000+ Customers</h3><p>Loved and trusted by families.</p></div>
            <div class="why-card"><h3>We Deliver</h3><p>Islamabad, Rawalpindi &amp; Fateh Jang.</p></div>
            <div class="why-card"><h3>10+ Healthy Cows</h3><p>Ethically raised, ensuring quality.</p></div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="two-col">
    <div class="text reveal">
        <h2>About Us</h2>
        <p>At DairyFarm, we deliver <strong>100% pure cow dairy</strong> — milk, ghee, and yogurt — preserving natural taste and nutrients.</p>
    </div>
    <div class="image reveal" style="transition-delay:.12s">
        <div class="img-zoom"><img src="images/about.webp" alt="About Us"></div>
    </div>
</section>

<!-- MISSION -->
<section id="mission" class="two-col">
    <div class="text reveal">
        <h2>Our Mission</h2>
        <p>Our mission is to provide pure milk direct from farm to customers.<br><br><strong>Order &amp; Queries:</strong> 0333-5608961</p>
    </div>
    <div class="image reveal" style="transition-delay:.12s">
        <div class="img-zoom"><img src="images/logo.jpg" alt="Our Mission"></div>
    </div>
</section>

<!-- PRODUCTS -->
<section id="products" class="products">
    <div class="container">
        <h2 class="reveal">Our Products</h2>
        <div class="grid">
            <div class="product-card hover-lift reveal">
                <img src="images/milk.jpg" alt="Milk">
                <h3>Pure Cow Milk</h3>
                <p>Fresh, rich in calcium &amp; protein.</p>
            </div>
            <div class="product-card hover-lift reveal" style="transition-delay:.08s">
                <img src="images/ghee.jpg" alt="Ghee">
                <h3>Desi Cow Ghee</h3>
                <p>Traditionally made, aromatic, nutrient-rich.</p>
            </div>
            <div class="product-card hover-lift reveal" style="transition-delay:.16s">
                <img src="images/yougurt.jpg" alt="Yogurt">
                <h3>Natural Cow Yogurt</h3>
                <p>Creamy, probiotic, preservative-free.</p>
            </div>
        </div>
    </div>
</section>

<!-- WHO WE ARE -->
<section id="who" class="two-col">
    <div class="text reveal">
        <h2>Who We Are</h2>
        <p>We are a team of agronomists and dairy specialists, redefining farm-to-table dairy with transparency and quality.</p>
    </div>
    <div class="image reveal" style="transition-delay:.12s">
        <div class="img-zoom"><img src="images/farmwho.webp" alt="Who We Are"></div>
    </div>
</section>

<!-- CONTACT -->
<section id="contact" class="contact">
    <div class="container">
        <h2 class="reveal">Contact Us</h2>
        <div class="contact-info reveal" style="transition-delay:.08s">
            <p><strong>Address:</strong> 0.5 km, off Qutbal toll plaza, Fateh Jang, Pakistan</p>
            <p><strong>Phone:</strong> 0333 5608961</p>
            <p><strong>Email:</strong> sunshinequtbal@gmail.com</p>
            <p><strong>Facebook:</strong> <a href="https://www.facebook.com/p/Sunshine-Dairies-61552469106859/" target="_blank">Visit our Facebook Page</a></p>
        </div>
    </div>
</section>

<footer>&copy; <?php echo date('Y'); ?> DairyFarm. All Rights Reserved.</footer>

</body>
</html>
