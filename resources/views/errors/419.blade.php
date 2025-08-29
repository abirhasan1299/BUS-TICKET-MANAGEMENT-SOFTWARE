<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>419 Page Expired</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet"/>

    <style>
        :root{
            --bg:#f5f7fa;
            --primary1:#6c5ce7;
            --primary2:#a29bfe;
            --text:#636e72;
            --muted:#b2bec3;
        }
        *{box-sizing:border-box}
        body{
            background: var(--bg);
            font-family: "Segoe UI", system-ui, -apple-system, Roboto, Arial, sans-serif;
            margin:0;
            overflow:hidden;
        }
        .wrap{
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
            text-align:center;
            padding:24px;
            isolation:isolate; /* ensures glass layer sits above blobs */
        }

        /* floating soft blobs */
        .blob{
            position:absolute;
            border-radius:50%;
            filter: blur(40px);
            opacity:.35;
            z-index:0;
            animation: drift 12s ease-in-out infinite;
            background: radial-gradient(ellipse at 30% 30%, var(--primary2), var(--primary1));
            mix-blend-mode:multiply;
        }
        .blob.b1{ width:260px; height:260px; top:12%; left:8%; animation-delay:0s;}
        .blob.b2{ width:340px; height:340px; bottom:10%; left:16%; animation-delay:2s;}
        .blob.b3{ width:280px; height:280px; top:18%; right:12%; animation-delay:4s;}

        @keyframes drift{
            0%,100%{ transform: translateY(0) translateX(0) rotate(0); }
            50%{ transform: translateY(-30px) translateX(10px) rotate(10deg); }
        }

        /* content pane (no card, but glassy panel) */
        .pane{
            z-index:1;
            backdrop-filter: blur(6px);
            background: rgba(255,255,255,.65);
            border-radius: 20px;
            padding: 42px 32px;
            box-shadow: 0 10px 35px rgba(0,0,0,.08);
            max-width: 700px;
            width: min(94vw, 700px);
        }

        .code{
            font-size: clamp(5rem, 12vw, 12rem);
            font-weight: 900;
            line-height: .9;
            margin: 0 0 10px;
            background: linear-gradient(90deg, var(--primary1), var(--primary2), var(--primary1));
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 3s linear infinite, bob 1.6s ease-in-out infinite;
            letter-spacing: -2px;
            user-select: none;
        }
        @keyframes shine{
            0%{ background-position: 0% 50%;}
            100%{ background-position: 200% 50%;}
        }
        @keyframes bob{
            0%,100%{ transform: translateY(0); }
            50%{ transform: translateY(-10px); }
        }

        .headline{
            font-size: clamp(1.3rem, 2.5vw, 2rem);
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }
        .desc{
            color: var(--muted);
            font-size: 1.05rem;
            margin-bottom: 26px;
        }

        /* action buttons */
        .actions .btn{
            border-radius: 999px;
            padding: .8rem 1.35rem;
            font-weight: 600;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .actions .btn:hover{
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(0,0,0,.12);
        }
        .btn-primary{
            background: linear-gradient(45deg, var(--primary1), var(--primary2));
            border: none;
        }

        /* tiny helper text */
        .hint{
            margin-top: 14px;
            color:#95a0a6;
            font-size:.95rem;
        }

        /* responsive tweaks */
        @media (max-width: 576px){
            .pane{ padding: 32px 20px; }
            .desc br{ display:none; }
        }
    </style>
</head>
<body>

<div class="wrap">
    <!-- blobs (background) -->
    <span class="blob b1"></span>
    <span class="blob b2"></span>
    <span class="blob b3"></span>

    <!-- content -->
    <main class="pane" role="main" aria-labelledby="ttl">
        <h1 class="code" aria-hidden="true">419</h1>
        <h2 id="ttl" class="headline">Oops! Page Expired</h2>
        <p class="desc">
            Your session has expired (usually due to inactivity or a missing CSRF token).<br/>
            Please refresh and try again.
        </p>

        <div class="actions d-flex flex-wrap gap-2 justify-content-center">
            <a href="/" class="btn btn-primary">
                <i class="bi bi-house-door-fill me-1"></i> Go Home
            </a>
            <button type="button" class="btn btn-outline-secondary" id="btn-refresh">
                <i class="bi bi-arrow-repeat me-1"></i> Refresh
            </button>
            <button type="button" class="btn btn-outline-dark" id="btn-back">
                <i class="bi bi-arrow-left-short me-1"></i> Go Back
            </button>
        </div>

        <div class="hint">
            Tip: ensure your form includes <code>@csrf</code> and submit again.
        </div>
    </main>
</div>

<script>
    // optional: randomize blob positions a little for each visit
    document.querySelectorAll('.blob').forEach(b=>{
        const dx = (Math.random()*40-20), dy = (Math.random()*40-20);
        b.style.transform = `translate(${dx}px, ${dy}px)`;
    });

    // actions
    document.getElementById('btn-refresh')?.addEventListener('click', ()=> location.reload());
    document.getElementById('btn-back')?.addEventListener('click', ()=> history.back());

    // optional: auto-refresh countdown (uncomment to use)
    // setTimeout(()=>location.reload(), 10000); // refresh after 10s
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
