<!DOCTYPE html>
<html lang="pt-BR" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <!-- ===== SEO BÁSICO ===== -->
    <title>@yield('title', 'Eduarda Cardoso Estética – Cuidado, saúde e bem-estar para a sua pele')</title>
    <meta name="description" content="@yield('description', 'Biomédica especializada em limpeza de pele. Atendimento acolhedor, humanizado e personalizado. Agende pelo WhatsApp!')">
    <meta name="keywords" content="estética, biomédica, limpeza de pele, limpeza de pele profissional, tratamento facial, cuidados com a pele, bem-estar, beleza, Eduarda Cardoso, Eduarda Cardoso Picolo Santos, esteticista, pele saudável">
    <meta name="author" content="Eduarda Cardoso Picolo Santos">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="language" content="pt-BR">
    <meta name="rating" content="general">
    <meta name="revisit-after" content="7 days">
    <meta name="geo.region" content="BR-SP">
    <meta name="geo.placename" content="Presidente Venceslau, SP">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="google-site-verification" content="spa9i8z4UbmjFRljXgFTCU23wGidbdb6HIOusVld8hw">

    <!-- ===== FAVICON ===== -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#C4748C">
    <meta name="msapplication-TileColor" content="#C4748C">
    <meta name="msapplication-TileImage" content="{{ asset('favicon-32.png') }}">

    <!-- ===== OPEN GRAPH (Facebook, WhatsApp, LinkedIn) ===== -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Eduarda Cardoso Estética – Limpeza de Pele com Biomédica')">
    <meta property="og:description" content="@yield('og_description', 'Limpeza de pele realizada por biomédica especializada. Atendimento humanizado e personalizado. Agende agora pelo WhatsApp!')">
    <meta property="og:image" content="@yield('og_image', asset('img/profissional.jpeg'))">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:alt" content="Eduarda Cardoso – Biomédica Esteticista">
    <meta property="og:site_name" content="Eduarda Cardoso Estética">
    <meta property="og:locale" content="pt_BR">

    <!-- ===== TWITTER CARD ===== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@eduardacardoso.estetica">
    <meta name="twitter:title" content="@yield('og_title', 'Eduarda Cardoso Estética – Limpeza de Pele com Biomédica')">
    <meta name="twitter:description" content="@yield('og_description', 'Limpeza de pele realizada por biomédica especializada. Atendimento humanizado e personalizado.')">
    <meta name="twitter:image" content="@yield('og_image', asset('img/profissional.jpeg'))">
    <meta name="twitter:image:alt" content="Eduarda Cardoso – Biomédica Esteticista">

    <!-- ===== SCHEMA.ORG (Google Rich Results) ===== -->
    <script type="application/ld+json">
    [
    {
      "@@context": "https://schema.org",
      "@@type": "WebSite",
      "name": "Eduarda Cardoso Estética",
      "alternateName": "Eduarda Cardoso Estetica",
      "url": "{{ config('app.url') }}"
    },
    {
      "@@context": "https://schema.org",
      "@@type": "BeautySalon",
      "name": "Eduarda Cardoso Estética",
      "description": "Biomédica especializada em limpeza de pele. Atendimento acolhedor, humanizado e personalizado.",
      "url": "{{ config('app.url') }}",
      "logo": "{{ asset('img/logo/logo.png') }}",
      "image": "{{ asset('img/profissional.jpeg') }}",
      "telephone": "+5518991572291",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Rua Almirante Barroso, nº 74",
        "addressLocality": "Presidente Venceslau",
        "addressRegion": "SP",
        "addressCountry": "BR"
      },
      "areaServed": {
        "@@type": "City",
        "name": "Presidente Venceslau"
      },
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+5518991572291",
        "contactType": "customer service",
        "availableLanguage": "Portuguese",
        "contactOption": "TollFree"
      },
      "sameAs": [
        "https://www.instagram.com/eduardacardoso.estetica",
        "https://wa.me/5518991572291"
      ],
      "hasOfferCatalog": {
        "@@type": "OfferCatalog",
        "name": "Serviços de Estética",
        "itemListElement": [
          {
            "@@type": "Offer",
            "itemOffered": {
              "@@type": "Service",
              "name": "Limpeza de Pele",
              "description": "Limpeza de pele profissional realizada por biomédica especializada."
            },
            "price": "85.00",
            "priceCurrency": "BRL"
          }
        ]
      },
      "employee": {
        "@@type": "Person",
        "name": "Eduarda Cardoso Picolo Santos",
        "jobTitle": "Biomédica",
        "sameAs": "https://www.instagram.com/eduardacardoso.estetica"
      },
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "5.0",
        "reviewCount": "5",
        "bestRating": "5",
        "worstRating": "1"
      },
      "priceRange": "R$"
    },
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "Como agendar uma limpeza de pele?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "O agendamento é feito diretamente pelo WhatsApp (18) 99157-2291 ou pelo formulário no site eduardacardosoestetica.com.br. O atendimento é com hora marcada."
          }
        },
        {
          "@@type": "Question",
          "name": "Onde é realizada a limpeza de pele?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "O atendimento é realizado em Presidente Venceslau, SP, com hora marcada. Entre em contato pelo WhatsApp (18) 99157-2291 para saber o endereço e disponibilidade."
          }
        },
        {
          "@@type": "Question",
          "name": "Qual a importância da limpeza de pele?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "A limpeza de pele remove impurezas, células mortas, excesso de oleosidade e cravos, mantendo a pele saudável e favorecendo a absorção dos produtos da rotina de cuidados. Também contribui para a prevenção de acne e melhora a aparência geral da pele."
          }
        },
        {
          "@@type": "Question",
          "name": "Quem realiza o procedimento?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "O procedimento é realizado pela Eduarda Cardoso Picolo Santos, biomédica especializada em estética, com pós-graduação na área. O atendimento é humanizado, acolhedor e personalizado para cada cliente."
          }
        },
        {
          "@@type": "Question",
          "name": "Quanto custa a limpeza de pele?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "A limpeza de pele custa R$ 85, realizada por biomédica especializada em Presidente Venceslau, SP. Agende pelo WhatsApp (18) 99157-2291."
          }
        }
      ]
    }
    ]
    </script>

    <!-- ===== GOOGLE ANALYTICS GA4 ===== -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-G7YV11QDST"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-G7YV11QDST');
    </script>

    <!-- ===== PRELOAD RECURSOS CRÍTICOS ===== -->
    <link rel="preload" as="image" href="{{ asset('img/logo/logo.png') }}">
    <link rel="preload" as="image" href="{{ asset('img/profissional.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

    <!-- ===== FONTS ===== -->
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

    <!-- Instagram Float Button -->
    <a href="{{ config('business.instagram') }}"
       class="instagram-float" target="_blank" rel="noopener" aria-label="Ver Instagram">
        <i class="fab fa-instagram"></i>
    </a>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/{{ config('business.whatsapp') }}?text=Olá! Gostaria de agendar um horário."
       class="whatsapp-float" target="_blank" rel="noopener" aria-label="Falar no WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}"></script>
</body>
</html>
