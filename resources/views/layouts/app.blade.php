<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eduarda Cardoso Estética - Tratamentos faciais, micropigmentação, massagens e muito mais. Agende sua consulta!">
    <meta name="keywords" content="estética, micropigmentação, limpeza de pele, massagem, tratamento facial, beleza">
    <meta property="og:title" content="Eduarda Cardoso Estética">
    <meta property="og:description" content="Realce sua beleza natural com tratamentos especializados. Agende já!">
    <meta property="og:type" content="website">
    <title>@yield('title', 'Eduarda Cardoso Estética')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#hero" class="nav-logo">
                <span class="logo-icon"><i class="fas fa-spa"></i></span>
                <div class="logo-text">
                    <span class="logo-name">Eduarda Cardoso</span>
                    <span class="logo-sub">Estética</span>
                </div>
            </a>

            <ul class="nav-links" id="nav-links">
                <li><a href="#sobre" class="nav-link">Sobre</a></li>
                <li><a href="#servicos" class="nav-link">Serviços</a></li>
                <li><a href="#galeria" class="nav-link">Galeria</a></li>
                <li><a href="#depoimentos" class="nav-link">Depoimentos</a></li>
                <li><a href="#contato" class="nav-link nav-cta">Agendar</a></li>
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
                    <i class="fas fa-spa"></i>
                    <div>
                        <span class="footer-logo-name">Eduarda Cardoso</span>
                        <span class="footer-logo-sub">Estética</span>
                    </div>
                </div>
                <p class="footer-desc">Realçando a beleza natural de cada cliente com carinho, técnica e dedicação.</p>
                <div class="footer-social">
                    <a href="https://www.instagram.com/eduardacardoso.estetica" target="_blank" rel="noopener" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '5511999999999') }}" target="_blank" rel="noopener" aria-label="WhatsApp">
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
                    <li>Micropigmentação</li>
                    <li>Massagem Relaxante</li>
                    <li>Peeling Facial</li>
                    <li>Radiofrequência</li>
                    <li>Drenagem Linfática</li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4>Contato</h4>
                <div class="footer-contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '5511999999999') }}" target="_blank">(11) 9 9999-9999</a>
                </div>
                <div class="footer-contact-item">
                    <i class="fab fa-instagram"></i>
                    <a href="https://www.instagram.com/eduardacardoso.estetica" target="_blank">@eduardacardoso.estetica</a>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <span>Seg–Sex: 9h às 19h<br>Sáb: 9h às 14h</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Eduarda Cardoso Estética. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '5511999999999') }}?text=Olá! Gostaria de agendar um horário."
       class="whatsapp-float" target="_blank" rel="noopener" aria-label="Falar no WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Back to Top -->
    <button class="back-to-top" id="back-to-top" aria-label="Voltar ao topo">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
