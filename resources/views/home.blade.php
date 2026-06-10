@extends('layouts.app')

@section('title', 'Eduarda Cardoso Estética – Beleza e Cuidado Para Você')

@section('content')

<!-- Flash Messages -->
@if(session('success'))
<div class="flash-success" id="flash-msg">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button onclick="document.getElementById('flash-msg').remove()"><i class="fas fa-times"></i></button>
</div>
@endif

<!-- ===== HERO ===== -->
<section class="hero" id="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="hero-badge">✦ Estética Especializada ✦</span>
        <h1 class="hero-title">
            Realce Sua<br>
            <em>Beleza Natural</em>
        </h1>
        <p class="hero-subtitle">
            Tratamentos personalizados com técnicas avançadas para você se sentir incrível por dentro e por fora.
        </p>
        <div class="hero-actions">
            <a href="#contato" class="btn btn-primary">
                <i class="fab fa-whatsapp"></i> Agendar Agora
            </a>
            <a href="#servicos" class="btn btn-outline">
                Conhecer Serviços
            </a>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <strong>500+</strong>
                <span>Clientes Satisfeitas</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <strong>5+</strong>
                <span>Anos de Experiência</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <strong>10+</strong>
                <span>Tratamentos</span>
            </div>
        </div>
    </div>
    <div class="hero-scroll">
        <span>Deslize para baixo</span>
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- ===== SOBRE ===== -->
<section class="sobre section" id="sobre">
    <div class="container">
        <div class="sobre-grid">
            <div class="sobre-image" data-aos="fade-right">
                <div class="sobre-img-frame">
                    <div class="sobre-img-placeholder">
                        <i class="fas fa-user-circle"></i>
                        <span>Foto da Profissional</span>
                    </div>
                    <div class="sobre-img-badge">
                        <i class="fas fa-certificate"></i>
                        <span>Profissional Certificada</span>
                    </div>
                </div>
            </div>

            <div class="sobre-content" data-aos="fade-left">
                <span class="section-label">Sobre Mim</span>
                <h2 class="section-title">
                    Olá, sou <em>Eduarda Cardoso</em>
                </h2>
                <p class="sobre-text">
                    Sou esteticista apaixonada pelo que faço, com mais de 5 anos de experiência em tratamentos faciais e corporais. Minha missão é ajudar cada cliente a se sentir mais confiante e bonita, respeitando a individualidade de cada uma.
                </p>
                <p class="sobre-text">
                    Trabalho com as técnicas mais modernas do mercado, sempre me atualizando para oferecer os melhores resultados. Meu studio foi criado para ser um espaço de acolhimento, beleza e bem-estar.
                </p>

                <div class="sobre-features">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Técnicas avançadas e certificadas</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Atendimento personalizado</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Produtos de alta qualidade</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Ambiente seguro e acolhedor</span>
                    </div>
                </div>

                <a href="#contato" class="btn btn-primary">
                    Agendar Consulta <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== SERVIÇOS ===== -->
<section class="servicos section section-alt" id="servicos">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-label">O Que Ofereço</span>
            <h2 class="section-title">Nossos <em>Serviços</em></h2>
            <p class="section-desc">Tratamentos pensados para realçar sua beleza com segurança, técnica e muito carinho.</p>
        </div>

        <div class="servicos-grid">
            @foreach($servicos as $i => $servico)
            <div class="servico-card" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="servico-icon">
                    <i class="{{ $servico['icone'] }}"></i>
                </div>
                <h3 class="servico-titulo">{{ $servico['titulo'] }}</h3>
                <p class="servico-desc">{{ $servico['descricao'] }}</p>
                <div class="servico-footer">
                    <span class="servico-preco">{{ $servico['preco'] }}</span>
                    <a href="#contato" class="servico-btn">Agendar</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== GALERIA ===== -->
<section class="galeria section" id="galeria">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-label">Nosso Trabalho</span>
            <h2 class="section-title">Galeria de <em>Resultados</em></h2>
            <p class="section-desc">Veja a transformação de nossas clientes. Cada resultado é único e personalizado.</p>
        </div>

        <div class="galeria-filter" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">Todos</button>
            <button class="filter-btn" data-filter="micropigmentacao">Micropigmentação</button>
            <button class="filter-btn" data-filter="limpeza">Limpeza de Pele</button>
            <button class="filter-btn" data-filter="facial">Facial</button>
            <button class="filter-btn" data-filter="massagem">Massagem</button>
        </div>

        <div class="galeria-grid">
            @foreach($galeria as $i => $item)
            @php $hasImg = !empty($item['imagem']); @endphp
            <div class="galeria-item" data-category="{{ $item['categoria'] }}" data-aos="zoom-in" data-aos-delay="{{ $i * 80 }}">
                @if($hasImg)
                    <img src="{{ Storage::url($item['imagem']) }}" alt="{{ $item['titulo'] }}" loading="lazy">
                @else
                <div class="galeria-placeholder">
                    <i class="fas fa-image"></i>
                    <span>{{ $item['titulo'] }}</span>
                </div>
                @endif
                <div class="galeria-overlay">
                    <span>{{ $item['titulo'] }}</span>
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            @endforeach
        </div>

        <div class="galeria-cta text-center" data-aos="fade-up">
            <p>Quer ver mais resultados?</p>
            <a href="https://www.instagram.com/eduardacardoso.estetica" target="_blank" rel="noopener" class="btn btn-outline">
                <i class="fab fa-instagram"></i> Ver no Instagram
            </a>
        </div>
    </div>
</section>

<!-- ===== ANTES E DEPOIS ===== -->
@if($antesDepois->isNotEmpty())
<section class="antes-depois section section-alt" id="antes-depois">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-label">Transformações Reais</span>
            <h2 class="section-title">Antes e <em>Depois</em></h2>
            <p class="section-desc">Resultados reais de clientes que confiaram no nosso trabalho.</p>
        </div>

        <div class="ad-carousel-outer" data-aos="fade-up">
            <div class="ad-carousel-track-wrap" id="adTrackWrap">
                <div class="ad-carousel-track" id="adTrack">
                    @foreach($antesDepois as $item)
                    <div class="ad-slide">
                        <div class="ad-card">
                            <div class="ad-label-row">
                                <span class="ad-servico">{{ $item->servico }}</span>
                                <span class="ad-titulo">{{ $item->titulo }}</span>
                            </div>
                            <div class="ad-images">
                                <div class="ad-img-wrap">
                                    <span class="ad-badge ad-badge-antes">Antes</span>
                                    <img src="{{ Storage::url($item->foto_antes) }}"
                                         alt="Antes – {{ $item->titulo }}" loading="lazy">
                                </div>
                                <div class="ad-divider"><i class="fas fa-arrow-right"></i></div>
                                <div class="ad-img-wrap">
                                    <span class="ad-badge ad-badge-depois">Depois</span>
                                    <img src="{{ Storage::url($item->foto_depois) }}"
                                         alt="Depois – {{ $item->titulo }}" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="ad-arrow ad-arrow-prev" id="adPrev" aria-label="Anterior">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="ad-arrow ad-arrow-next" id="adNext" aria-label="Próximo">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="ad-dots" id="adDots"></div>
        </div>
    </div>
</section>
@endif

<!-- ===== DIFERENCIAIS ===== -->
<section class="diferenciais section-alt">
    <div class="container">
        <div class="diferenciais-grid">
            <div class="diferencial" data-aos="fade-up" data-aos-delay="0">
                <div class="diferencial-icon"><i class="fas fa-award"></i></div>
                <h4>Qualidade Garantida</h4>
                <p>Usamos apenas produtos premium e técnicas certificadas para o melhor resultado.</p>
            </div>
            <div class="diferencial" data-aos="fade-up" data-aos-delay="100">
                <div class="diferencial-icon"><i class="fas fa-heart"></i></div>
                <h4>Atendimento Humanizado</h4>
                <p>Cada cliente recebe atenção personalizada, porque cada pele é única.</p>
            </div>
            <div class="diferencial" data-aos="fade-up" data-aos-delay="200">
                <div class="diferencial-icon"><i class="fas fa-shield-alt"></i></div>
                <h4>Higiene e Segurança</h4>
                <p>Protocolos rigorosos de biossegurança para sua total tranquilidade.</p>
            </div>
            <div class="diferencial" data-aos="fade-up" data-aos-delay="300">
                <div class="diferencial-icon"><i class="fas fa-star"></i></div>
                <h4>Resultados Reais</h4>
                <p>Mais de 500 clientes satisfeitas com resultados que falam por si mesmos.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== DEPOIMENTOS ===== -->
<section class="depoimentos section" id="depoimentos">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-label">Quem já veio</span>
            <h2 class="section-title">O Que Dizem <em>Nossas Clientes</em></h2>
        </div>

        <div class="depoimentos-grid">
            @foreach($depoimentos as $i => $dep)
            <div class="depoimento-card" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="depoimento-stars">
                    @for($s = 0; $s < $dep['estrelas']; $s++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p class="depoimento-texto">"{{ $dep['texto'] }}"</p>
                <div class="depoimento-autor">
                    <div class="depoimento-avatar">
                        {{ strtoupper(substr($dep['nome'], 0, 1)) }}
                    </div>
                    <div>
                        <strong>{{ $dep['nome'] }}</strong>
                        <span>{{ $dep['servico'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section class="cta-banner">
    <div class="container">
        <div class="cta-content" data-aos="zoom-in">
            <h2>Pronta para se sentir <em>incrível</em>?</h2>
            <p>Agende sua consulta hoje e descubra o tratamento perfeito para você.</p>
            <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '5511999999999') }}?text=Olá! Gostaria de agendar um horário."
               class="btn btn-white" target="_blank" rel="noopener">
                <i class="fab fa-whatsapp"></i> Falar no WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- ===== CONTATO / AGENDAMENTO ===== -->
<section class="contato section" id="contato">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <span class="section-label">Agende Agora</span>
            <h2 class="section-title">Entre em <em>Contato</em></h2>
            <p class="section-desc">Preencha o formulário ou fale diretamente pelo WhatsApp. Respondo o mais rápido possível!</p>
        </div>

        <div class="contato-grid">
            <!-- Info -->
            <div class="contato-info" data-aos="fade-right">
                <div class="info-card">
                    <div class="info-item">
                        <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <h4>WhatsApp</h4>
                            <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '5511999999999') }}" target="_blank">(11) 9 9999-9999</a>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fab fa-instagram"></i></div>
                        <div>
                            <h4>Instagram</h4>
                            <a href="https://www.instagram.com/eduardacardoso.estetica" target="_blank">@eduardacardoso.estetica</a>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <h4>Horário de Atendimento</h4>
                            <span>Segunda a Sexta: 9h às 19h</span><br>
                            <span>Sábado: 9h às 14h</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h4>Localização</h4>
                            <span>Atendimento com hora marcada</span>
                        </div>
                    </div>
                </div>

                <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '5511999999999') }}?text=Olá! Gostaria de agendar um horário."
                   class="btn btn-whatsapp" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp"></i> Agendar pelo WhatsApp
                </a>
            </div>

            <!-- Form -->
            <div class="contato-form-wrapper" data-aos="fade-left">
                <form class="contato-form" id="contato-form" data-wpp="{{ env('WHATSAPP_NUMBER', '5511999999999') }}" novalidate>
                    <h3>Solicitar Agendamento</h3>

                    @if($errors->any())
                    <div class="form-errors">
                        @foreach($errors->all() as $error)
                            <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nome">Nome completo *</label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome') }}"
                                   placeholder="Seu nome" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">WhatsApp / Telefone *</label>
                            <input type="tel" id="telefone" name="telefone" value="{{ old('telefone') }}"
                                   placeholder="(11) 9 9999-9999" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               placeholder="seu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="servico">Serviço de interesse *</label>
                        <select id="servico" name="servico" required>
                            <option value="" disabled selected>Selecione o serviço</option>
                            <option value="Limpeza de Pele" {{ old('servico') == 'Limpeza de Pele' ? 'selected' : '' }}>Limpeza de Pele</option>
                            <option value="Micropigmentação" {{ old('servico') == 'Micropigmentação' ? 'selected' : '' }}>Micropigmentação</option>
                            <option value="Massagem Relaxante" {{ old('servico') == 'Massagem Relaxante' ? 'selected' : '' }}>Massagem Relaxante</option>
                            <option value="Peeling Facial" {{ old('servico') == 'Peeling Facial' ? 'selected' : '' }}>Peeling Facial</option>
                            <option value="Radiofrequência" {{ old('servico') == 'Radiofrequência' ? 'selected' : '' }}>Radiofrequência</option>
                            <option value="Drenagem Linfática" {{ old('servico') == 'Drenagem Linfática' ? 'selected' : '' }}>Drenagem Linfática</option>
                            <option value="Outro" {{ old('servico') == 'Outro' ? 'selected' : '' }}>Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mensagem">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" rows="4"
                                  placeholder="Descreva sua necessidade ou preferência de horário...">{{ old('mensagem') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-paper-plane"></i> Enviar Solicitação
                    </button>

                    <p class="form-note">
                        <i class="fas fa-lock"></i> Seus dados estão seguros. Não compartilhamos com terceiros.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox da Galeria -->
<div id="lightbox" class="lightbox" role="dialog" aria-modal="true" aria-label="Visualizar item da galeria">
    <div class="lightbox-inner">
        <button id="lb-close" class="lightbox-close" aria-label="Fechar">
            <i class="fas fa-times"></i>
        </button>
        <div class="lightbox-preview">
            <img id="lb-img" src="" alt="" style="display:none;width:100%;max-height:70vh;object-fit:contain;border-radius:8px">
            <i id="lb-icon" class="fas fa-image"></i>
        </div>
        <div class="lightbox-caption">
            <h4 id="lb-title"></h4>
            <span id="lb-category"></span>
        </div>
    </div>
</div>

@endsection
