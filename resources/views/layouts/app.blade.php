<!DOCTYPE html>
<html lang="pt-BR" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <!-- ===== SEO BÁSICO ===== -->
    <title>@yield('title', 'Eduarda Cardoso Estética – Cuidado, saúde e bem-estar para a sua pele')</title>
    <meta name="description" content="@yield('description', 'Biomédica especializada em estética. Atendimento acolhedor e personalizado em limpeza de pele e tratamentos faciais. Agende sua consulta!')">
    <meta name="keywords" content="estética, biomédica, limpeza de pele, tratamento facial, cuidados com a pele, bem-estar, beleza, Eduarda Cardoso Picolo Santos">
    <meta name="author" content="Eduarda Cardoso Picolo Santos">
    <meta name="robots" content="index, follow">
    <meta name="language" content="pt-BR">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="google-site-verification" content="spa9i8z4UbmjFRljXgFTCU23wGidbdb6HIOusVld8hw">

    <!-- ===== FAVICON ===== -->
    <!-- Favicon SVG (aparece na aba e na barra de endereço) -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Fallback PNG -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <!-- Cor da barra do browser (mobile) -->
    <meta name="theme-color" content="#C4748C">
    <meta name="msapplication-TileColor" content="#C4748C">
    <meta name="msapplication-TileImage" content="{{ asset('favicon-32.png') }}">

    <!-- ===== OPEN GRAPH (Facebook, WhatsApp, LinkedIn) ===== -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Eduarda Cardoso Estética – Beleza e Cuidado Para Você')">
    <meta property="og:description" content="@yield('og_description', 'Especialista em limpeza de pele, micropigmentação, massagem e muito mais. Resultados reais, atendimento personalizado.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-cover.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Eduarda Cardoso Estética">
    <meta property="og:site_name" content="Eduarda Cardoso Estética">
    <meta property="og:locale" content="pt_BR">

    <!-- ===== TWITTER CARD ===== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Eduarda Cardoso Estética – Beleza e Cuidado Para Você')">
    <meta name="twitter:description" content="@yield('og_description', 'Especialista em limpeza de pele, micropigmentação, massagem e muito mais.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-cover.jpg'))">
    <meta name="twitter:image:alt" content="Eduarda Cardoso Estética">

    <!-- ===== SCHEMA.ORG (Google Rich Results) ===== -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BeautySalon",
      "name": "Eduarda Cardoso Estética",
      "description": "Biomédica especializada em limpeza de pele. Atendimento acolhedor e personalizado.",
      "url": "{{ config('app.url') }}",
      "logo": "{{ asset('favicon.svg') }}",
      "image": "{{ asset('images/og-cover.jpg') }}",
      "telephone": "+55{{ config('business.whatsapp') }}",
      "sameAs": [
        "https://www.instagram.com/eduardacardoso.estetica"
      ],
      "openingHoursSpecification": [
        {
          "@@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
          "opens": "09:00",
          "closes": "19:00"
        },
        {
          "@@type": "OpeningHoursSpecification",
          "dayOfWeek": "Saturday",
          "opens": "09:00",
          "closes": "14:00"
        }
      ],
      "priceRange": "$$"
    }
    </script>

    <!-- ===== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#hero" class="nav-logo">
                <img src="{{ asset('img/logo/logo.png') }}" alt="Eduarda Cardoso Estética"
                     class="nav-logo-img">
            </a>

            <ul class="nav-links" id="nav-links">
                <li><a href="#sobre" class="nav-link">Sobre</a></li>
                <li><a href="#servicos" class="nav-link">Serviços</a></li>
                <li><a href="#galeria" class="nav-link">Galeria</a></li>
                <li><a href="#depoimentos" class="nav-link">Depoimentos</a></li>
                <li><a href="https://wa.me/{{ config('business.whatsapp') }}?text={{ urlencode('Olá! Gostaria de agendar um horário de limpeza de pele.') }}" class="nav-link nav-cta" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Agendar</a></li>
            </ul>

            <button class="nav-toggle" id="nav-toggle" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="{{ asset('img/logo/logo.png') }}" alt="Eduarda Cardoso Estética"
                         class="footer-logo-img">
                </div>
                <p class="footer-desc">Cuidado, saúde e bem-estar para a sua pele — atendimento humanizado e personalizado.</p>
                <div class="footer-social">
                    <a href="https://www.instagram.com/eduardacardoso.estetica" target="_blank" rel="noopener" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/{{ config('business.whatsapp') }}" target="_blank" rel="noopener" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <div class="footer-links">
                <h4>Navegação</h4>
                <ul>
                    <li><a href="#sobre">Sobre Mim</a></li>
                    <li><a href="#servicos">Serviços</a></li>
                    <li><a href="#galeria">Galeria</a></li>
                    <li><a href="#depoimentos">Depoimentos</a></li>
                    <li><a href="#contato">Agendamento</a></li>
                </ul>
            </div>

            <div class="footer-services">
                <h4>Serviços</h4>
                <ul>
                    <li>Limpeza de Pele</li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4>Contato</h4>
                <div class="footer-contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <a href="https://wa.me/{{ config('business.whatsapp') }}" target="_blank">{{ config('business.phone_display') }}</a>
                </div>
                <div class="footer-contact-item">
                    <i class="fab fa-instagram"></i>
                    <a href="https://www.instagram.com/eduardacardoso.estetica" target="_blank">@eduardacardoso.estetica</a>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <span>Entre em contato para saber mais</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Eduarda Cardoso Estética. Todos os direitos reservados.</p>
            <p class="footer-dev">Desenvolvido por <a href="https://wa.me/5518981006677" target="_blank" rel="noopener">LeonardoPicolo S. Ranuci</a></p>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/{{ config('business.whatsapp') }}?text=Olá! Gostaria de agendar um horário."
       class="whatsapp-float" target="_blank" rel="noopener" aria-label="Falar no WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Back to Top -->
    <button class="back-to-top" id="back-to-top" aria-label="Voltar ao topo">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}"></script>
</body>
</html>
