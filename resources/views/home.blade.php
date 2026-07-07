@extends('layouts.app')

@section('title', 'Eduarda Cardoso Estética – Limpeza de Pele | Biomédica em Estética')
@section('description', 'Biomédica especializada em limpeza de pele. Atendimento acolhedor, humanizado e personalizado. Agende pelo WhatsApp!')
@section('og_title', 'Eduarda Cardoso Estética – Limpeza de Pele com Biomédica')
@section('og_description', 'Limpeza de pele realizada por biomédica especializada. Atendimento humanizado e personalizado. Agende agora pelo WhatsApp!')
@section('og_image', asset('img/profissional.jpeg'))

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
        <span class="hero-badge">✦ Biomédica ✦</span>
        <h1 class="hero-title">
            Cuidado, saúde e<br>
            <em>bem-estar para a sua pele</em>
        </h1>
        <p class="hero-subtitle">
            Seja bem-vindo(a)! Atendimento acolhedor e personalizado para cuidar da saúde da sua pele e fortalecer sua autoestima.
        </p>
        <div class="hero-actions">
            <a href="https://wa.me/{{ config('business.whatsapp') }}?text={{ urlencode('Olá! Gostaria de agendar um horário de limpeza de pele.') }}"
               class="btn btn-primary" target="_blank" rel="noopener">
                <i class="fab fa-whatsapp"></i> Agendar Agora
            </a>
            <a href="#servicos" class="btn btn-outline">
                Conhecer Serviços
            </a>
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
                    @php $photoUrl = config('business.photo_url') ?: asset('img/profissional.jpeg'); @endphp
                    <img src="{{ $photoUrl }}" alt="Eduarda Cardoso"
                         style="width:100%;height:100%;object-fit:cover;object-position:top center;border-radius:var(--radius)">
                    <div class="sobre-img-badge">
                        <i class="fas fa-certificate"></i>
                        <span>Biomédica</span>
                    </div>
                </div>
            </div>

            <div class="sobre-content" data-aos="fade-left">
                <span class="section-label">Sobre Mim</span>
                <h2 class="section-title">
                    Olá, sou <em>Eduarda Cardoso Picolo Santos</em>
                </h2>
                <p class="sobre-text">
                    Sou biomédica e atualmente estou me especializando na área da estética por meio de uma pós-graduação. Meu objetivo é proporcionar um atendimento acolhedor e de qualidade, ajudando cada cliente a cuidar da saúde da pele e a fortalecer sua autoestima.
                </p>
                <p class="sobre-text">
                    Acredito que pequenos cuidados fazem grande diferença na forma como nos sentimos e nos enxergamos. Será um prazer cuidar da sua pele e fazer parte da sua jornada de autocuidado.
                </p>

                <div class="sobre-features">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Atendimento humanizado</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Ambiente confortável e acolhedor</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Avaliação individualizada</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Pós-graduação em estética</span>
                    </div>
                </div>

                <a href="https://wa.me/{{ config('business.whatsapp') }}?text={{ urlencode('Olá! Gostaria de agendar um horário de limpeza de pele.') }}"
                   class="btn btn-primary" target="_blank" rel="noopener">
                    Agendar Consulta <i class="fab fa-whatsapp"></i>
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
            <h2 class="section-title">Limpeza de <em>Pele</em></h2>
            <p class="section-desc">Um procedimento pensado para você — cuidado com técnica, atenção individualizada e muito carinho.</p>
        </div>

        <div class="servicos-grid" style="max-width:680px;margin:0 auto">
            @foreach($servicos as $i => $servico)
            <div class="servico-card" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="servico-icon">
                    <i class="{{ $servico['icone'] }}"></i>
                </div>
                <h3 class="servico-titulo">{{ $servico['titulo'] }}</h3>
                <p class="servico-desc">{{ $servico['descricao'] }}</p>
                <div class="servico-footer">
                    <span class="servico-preco">{{ $servico['preco'] }}</span>
                    <a href="https://wa.me/{{ config('business.whatsapp') }}?text={{ urlencode('Olá! Gostaria de agendar um horário de limpeza de pele.') }}"
                       class="servico-btn" target="_blank" rel="noopener">Agendar</a>
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
            <button class="filter-btn" data-filter="limpeza">Limpeza de Pele</button>
        </div>

        <div class="galeria-grid">
            @foreach($galeria as $i => $item)
            @php
                $imgSrc = null;
                if (!empty($item['imagem'])) {
                    $imgSrc = str_starts_with($item['imagem'], 'http') ? $item['imagem'] : \Storage::url($item['imagem']);
                }
            @endphp
            <div class="galeria-item" data-category="{{ $item['categoria'] }}" data-aos="zoom-in" data-aos-delay="{{ $i * 80 }}">
                @if($imgSrc)
                    <img src="{{ $imgSrc }}" alt="{{ $item['titulo'] }}" loading="lazy">
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
                    @php
                        $antesSrc  = str_starts_with($item->foto_antes,  'http') ? $item->foto_antes  : \Storage::url($item->foto_antes);
                        $depoisSrc = str_starts_with($item->foto_depois, 'http') ? $item->foto_depois : \Storage::url($item->foto_depois);
                    @endphp
                    <div class="ad-slide">
                        <div class="ad-card">
                            <div class="ad-compare">
                                {{-- Depois fica abaixo, Antes por cima com clip-path --}}
                                <div class="ad-compare-layer ad-compare-depois">
                                    <img src="{{ $depoisSrc }}" alt="Depois – {{ $item->titulo }}" loading="lazy">
                                </div>
                                <div class="ad-compare-layer ad-compare-antes">
                                    <img src="{{ $antesSrc }}" alt="Antes – {{ $item->titulo }}" loading="lazy">
                                </div>
                                <span class="ad-badge ad-badge-antes">Antes</span>
                                <span class="ad-badge ad-badge-depois">Depois</span>
                                <div class="ad-compare-handle">
                                    <div class="ad-compare-btn">
                                        <i class="fas fa-arrows-left-right"></i>
                                    </div>
                                </div>
                                <div class="ad-compare-caption">
                                    <span class="ad-caption-tag">{{ $item->servico }}</span>
                                    <span class="ad-caption-title">{{ $item->titulo }}</span>
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
                <div class="diferencial-icon"><i class="fas fa-heart"></i></div>
                <h4>Atendimento Humanizado</h4>
                <p>Cada cliente recebe atenção cuidadosa e personalizada, porque acreditamos que cuidar da pele também é cuidar da autoestima.</p>
            </div>
            <div class="diferencial" data-aos="fade-up" data-aos-delay="100">
                <div class="diferencial-icon"><i class="fas fa-spa"></i></div>
                <h4>Ambiente Acolhedor</h4>
                <p>Um espaço confortável e tranquilo pensado para que você se sinta bem desde o momento em que chega.</p>
            </div>
            <div class="diferencial" data-aos="fade-up" data-aos-delay="200">
                <div class="diferencial-icon"><i class="fas fa-search"></i></div>
                <h4>Avaliação Individualizada</h4>
                <p>Cada atendimento começa com uma avaliação cuidadosa das características e necessidades únicas de cada cliente.</p>
            </div>
            <div class="diferencial" data-aos="fade-up" data-aos-delay="300">
                <div class="diferencial-icon"><i class="fas fa-graduation-cap"></i></div>
                <h4>Formação Especializada</h4>
                <p>Biomédica em constante atualização através de pós-graduação em estética para oferecer tratamentos seguros e modernos.</p>
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
            <a href="https://wa.me/{{ config('business.whatsapp') }}?text=Olá! Gostaria de agendar um horário."
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
                            <a href="https://wa.me/{{ config('business.whatsapp') }}" target="_blank">{{ config('business.phone_display') }}</a>
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
                            <span>Entre em contato para saber mais</span>
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

                <a href="https://wa.me/{{ config('business.whatsapp') }}?text=Olá! Gostaria de agendar um horário."
                   class="btn btn-whatsapp" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp"></i> Agendar pelo WhatsApp
                </a>
            </div>

            <!-- Form -->
            <div class="contato-form-wrapper" data-aos="fade-left">
                <form class="contato-form" id="contato-form"
                      action="{{ route('contato') }}" method="POST"
                      data-wpp="{{ config('business.whatsapp') }}" novalidate>
                    @csrf
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
                                   placeholder="(18) 9 9157-2291" required>
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
                            @foreach($servicos as $s)
                                @php $titulo = is_array($s) ? $s['titulo'] : $s->titulo; @endphp
                                <option value="{{ $titulo }}" {{ old('servico') == $titulo ? 'selected' : '' }}>{{ $titulo }}</option>
                            @endforeach
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
            <img id="lb-img" src="" alt="" style="display:none">
            <i id="lb-icon" class="fas fa-image"></i>
        </div>
        <div class="lightbox-caption">
            <h4 id="lb-title"></h4>
            <span id="lb-category"></span>
        </div>
    </div>
</div>

@endsection
