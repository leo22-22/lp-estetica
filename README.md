# 🌸 Eduarda Cardoso Estética – Landing Page

Landing Page completa em PHP Laravel + Docker + MySQL.

## 📋 Pré-requisitos

- Docker Desktop instalado
- Git

## 🚀 Como rodar

### 1. Clone / acesse o projeto
```bash
cd lp-estetica
```

### 2. Configure o .env
```bash
cp .env.example .env
```
Edite o `.env` com seus dados (WhatsApp, e-mail, etc.)

### 3. Execute o setup (Linux/Mac)
```bash
chmod +x setup.sh
./setup.sh
```

### OU rode manualmente (Windows)
```bash
docker-compose up -d --build
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

### 4. Acesse
- **Site:** http://localhost:8080
- **Admin (contatos):** http://localhost:8080/admin/contatos

## 📁 Estrutura

```
lp-estetica/
├── app/
│   ├── Http/Controllers/HomeController.php   # Lógica principal
│   └── Models/Contato.php                    # Model de agendamentos
├── database/migrations/                       # Tabela de contatos
├── resources/views/
│   ├── layouts/app.blade.php                  # Layout (nav + footer)
│   ├── home.blade.php                         # Landing Page
│   └── admin/contatos.blade.php              # Painel admin
├── public/
│   ├── css/app.css                            # Todos os estilos
│   └── js/app.js                             # JS (animações, filtros)
├── routes/web.php                             # Rotas
├── docker-compose.yml
├── Dockerfile
└── docker/nginx/default.conf
```

## 🎨 Seções da LP

1. **Hero** – Banner full-screen com CTA
2. **Sobre** – Apresentação da profissional
3. **Serviços** – 6 cards de serviços com preços
4. **Galeria** – Grid com filtro por categoria
5. **Diferenciais** – 4 pilares do negócio
6. **Depoimentos** – 4 avaliações de clientes
7. **CTA Banner** – Chamada para WhatsApp
8. **Contato/Agendamento** – Formulário salvo no MySQL

## ⚙️ Configurações importantes (.env)

```env
WHATSAPP_NUMBER=5511999999999   # Número sem espaços/traços
```

## 📸 Adicionar fotos reais

Substitua os placeholders nas views por tags `<img>`:

```blade
{{-- Em home.blade.php, substitua .sobre-img-placeholder por: --}}
<img src="{{ asset('images/eduarda.jpg') }}" alt="Eduarda Cardoso" class="sobre-img-real">
```

Coloque as imagens em `public/images/`.

## 🛑 Parar os containers

```bash
docker-compose down
```
