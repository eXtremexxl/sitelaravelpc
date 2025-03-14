@extends('layout')

@section('title', 'Главная')

@section('content')
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>

    <!-- Главны -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <div class="badges">
                    <span>🚚 Доставка и сборка от 2-х дней</span>
                    <span>⭐ Более 1000 клиентов</span>
                </div>
                <h1>Сборка и кастомизация игровых компьютеров</h1>
                <p>Заключаем договор, собираем ПК под любой бюджет и задачи</p>
                <div class="features">
                    <div class="feature">
                        <img src="{{ asset('imagess/delivery.svg') }}" alt="Доставка">
                        <p><strong>Бесплатная</strong> доставка по РФ</p>
                    </div>
                    <div class="feature">
                        <img src="{{ asset('imagess/pc.svg') }}" alt="Кастомизация">
                        <p><strong>Индивидуальная</strong> сборка и кастомизация</p>
                    </div>
                    <div class="feature">
                        <img src="{{ asset('imagess/document_3.svg') }}" alt="Гарантия">
                        <p><strong>Гарантия</strong> до 3-х лет</p>
                    </div>
                </div>
                <a href="{{ url('/catalog') }}" class="hero-btn">ПОДОБРАТЬ КОМПЬЮТЕР</a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('imagess/Untitleddesign_27_720x.png') }}" alt="Игровой компьютер">
            </div>
        </div>
    </section>

    <!-- 🔥 Блок "Почему мы?" -->
    <section class="advantages">
        <div class="advantage-card">
            <img src="{{ asset('imagess/time.svg') }}" alt="Быстрая сборка">
            <h3><strong>Профессиональная и быстрая сборка</strong></h3>
            <p>Подберем ПК под Ваши задачи и сделаем любую кастомизацию</p>
        </div>
        <div class="advantage-card">
            <img src="{{ asset('imagess/delivery.svg') }}" alt="Доставка">
            <h3><strong>Бесплатная доставка по всей РФ</strong></h3>
            <p>Средний срок доставки 3-4 дня. Работа по договору, даем гарантию</p>
        </div>
        <div class="advantage-card">
            <img src="{{ asset('imagess/like.svg') }}" alt="Безопасность">
            <h3><strong>Безопасность покупки на всех этапах</strong></h3>
            <p>Возможность оплаты любым способом, включено гарантийное обслуживание</p>
        </div>
    </section>




    <!-- слайдер -->
    <div class="wrapper">
    <div class="content1">
        <div class="product-img">
            @foreach($products as $product)
                <div class="product-img__item" id="img{{ $loop->index }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img__img">
                </div>
            @endforeach
        </div>

        <div class="product-slider">
            <button class="prev disabled">
                <span class="icon">
                    <svg class="icon icon-arrow-right"><use xlink:href="#icon-arrow-left"></use></svg>
                </span>
            </button>
            <button class="next">
                <span class="icon">
                    <svg class="icon icon-arrow-right"><use xlink:href="#icon-arrow-right"></use></svg>
                </span>
            </button>

            <div class="product-slider__wrp swiper-wrapper">
                @foreach($products as $product)
                    <div class="product-slider__item swiper-slide" data-target="img{{ $loop->index }}">
                        <div class="product-slider__card">
                            <div class="product-slider__content">
                                <h1 class="product-slider__title">
                                    {{ $product->name }}
                                </h1>
                                <span class="product-slider__price">₽{{ number_format($product->price, 0, ',', '.') }}</span>

                                <div class="product-ctr">
                                    <!-- Рандомный выбор компонента и производительности -->
                                    @php
                                        $components = [
                                            'cpu' => ['Процессор', ['Intel Core i9', 'AMD Ryzen 9']],
                                            'gpu' => ['Видеокарта', ['NVIDIA RTX 5090', 'NVIDIA RTX 5080']],
                                            'ram' => ['Оперативная память', ['16 GB DDR4', '32 GB DDR4']],
                                            'storage' => ['Накопитель', ['1 TB SSD', '2 TB SSD']]
                                        ];
                                        $randomComponentKey = array_rand($components);
                                        $randomComponent = $components[$randomComponentKey];
                                        $randomPerformance = rand(80, 100);
                                        $dashArray = $randomPerformance * 3;
                                    @endphp

                                    <div class="product-labels">
                                        <div class="product-labels__title">{{ $randomComponent[0] }}</div>
                                        <div class="product-labels__group">
                                            <label class="product-labels__item">
                                                <input type="radio" class="product-labels__checkbox" name="{{ $randomComponentKey }}_{{ $product->id }}" checked>
                                                <span class="product-labels__txt">{{ $randomComponent[1][0] }}</span>
                                            </label>
                                            <label class="product-labels__item">
                                                <input type="radio" class="product-labels__checkbox" name="{{ $randomComponentKey }}_{{ $product->id }}">
                                                <span class="product-labels__txt">{{ $randomComponent[1][1] }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <span class="hr-vertical"></span>

                                    <!-- Рандомный индикатор производительности -->
                                    <div class="product-inf">
                                        <div class="product-inf__percent">
                                            <div class="product-inf__percent-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                                                    <defs>
                                                        <linearGradient id="gradient{{ $loop->index }}" x1="0%" y1="0%" x2="0%" y2="100%">
                                                            <stop offset="0%" stop-color="#0c1e2c" stop-opacity="0" />
                                                            <stop offset="100%" stop-color="#cb2240" stop-opacity="1" />
                                                        </linearGradient>
                                                    </defs>
                                                    <circle cx="50" cy="50" r="47" 
                                                            stroke-dasharray="{{ $dashArray }}, 300" 
                                                            stroke="#cb2240" 
                                                            stroke-width="4" 
                                                            fill="none"/>
                                                </svg>
                                            </div>
                                            <div class="product-inf__percent-txt">
                                                {{ $randomPerformance }}%
                                            </div>
                                        </div>
                                        <span class="product-inf__title">ПРОИЗВОДИТЕЛЬНОСТЬ</span>
                                    </div>
                                </div>

                                <div class="product-slider__bottom">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="product-slider__cart">
                                            ДОБАВИТЬ В КОРЗИНУ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<svg class="hidden" hidden>
    <symbol id="icon-arrow-left" viewBox="0 0 32 32">
        <path d="M0.704 17.696l9.856 9.856c0.896 0.896 2.432 0.896 3.328 0s0.896-2.432 0-3.328l-5.792-5.856h21.568c1.312 0 2.368-1.056 2.368-2.368s-1.056-2.368-2.368-2.368h-21.568l5.824-5.824c0.896-0.896 0.896-2.432 0-3.328-0.48-0.48-1.088-0.704-1.696-0.704s-1.216 0.224-1.696 0.704l-9.824 9.824c-0.448 0.448-0.704 1.056-0.704 1.696s0.224 1.248 0.704 1.696z"></path>
    </symbol>
    <symbol id="icon-arrow-right" viewBox="0 0 32 32">
        <path d="M31.296 14.336l-9.888-9.888c-0.896-0.896-2.432-0.896-3.328 0s-0.896 2.432 0 3.328l5.824 5.856h-21.536c-1.312 0-2.368 1.056-2.368 2.368s1.056 2.368 2.368 2.368h21.568l-5.856 5.824c-0.896 0.896-0.896 2.432 0 3.328 0.48 0.48 1.088 0.704 1.696 0.704s1.216-0.224 1.696-0.704l9.824-9.824c0.448-0.448 0.704-1.056 0.704-1.696s-0.224-1.248-0.704-1.664z"></path>
    </symbol>
</svg>


<!-- 📢 Акция -->
    <div class="discount-container">
        <h2>Скидка 10% на первые заказы!</h2>
        <p>Оформите заказ прямо сейчас и получите эксклюзивную скидку!</p>
        <a href="/catalog" class="discount-button">Купить со скидкой</a>
    </div>



    <!-- 💡 Популярные товары -->
    <div class="container">
        <h2 class="title">Популярные товары</h2>
        <div class="products-grid">
            @foreach($popularProducts as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-info">
                        <h5 class="product-name">{{ $product->name }}</h5>
                        <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                        <p class="product-price">
                            @if($product->discount_price)
                                <span class="old-price">₽{{ $product->price }}</span>
                                <span class="discounted-price">₽{{ number_format($product->discount_price, 2) }}</span>
                            @else
                                ₽{{ number_format($product->price, 2) }}
                            @endif
                        </p>

                        <a href="{{ route('product.show', $product->id) }}" class="product-button">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    <!-- 🛠️ Сборки под заказ -->
    <section class="steps">
        <h2>Получите мощный игровой ПК за 4 простых шага</h2>
        <div class="steps-container">
            <div class="step">
                <div class="step-icon">
                    <img src="{{ asset('imagess/11.svg') }}" alt="Заявка">
                </div>
                <h3>Оставьте заявку на сайте</h3>
                <p>Далее мы уточним детали заказа и пожелания. После заключаем договор с предоплатой в 50% от общей стоимости.</p>
            </div>
            <div class="step">
                <div class="step-icon">
                    <img src="{{ asset('imagess/22.svg') }}" alt="Комплектующие">
                </div>
                <h3>Заказываем комплектующие</h3>
                <p>Обычно мы сразу собираем ПК, но иногда заказываем отсутствующие детали. Если Ваша сборка уже в наличии, то отправим сразу.</p>
            </div>
            <div class="step">
                <div class="step-icon">
                    <img src="{{ asset('imagess/33.svg') }}" alt="Сборка">
                </div>
                <h3>Приступаем к сборке</h3>
                <p>Проверяем и тестируем ПК. Отправим видео с тестами и внешним видом. Делаем финальное согласование.</p>
            </div>
            <div class="step">
                <div class="step-icon">
                    <img src="{{ asset('imagess/44.svg') }}" alt="Доставка">
                </div>
                <h3>Отправляем компьютер</h3>
                <p>Тщательно упаковываем и отправляем в СДЭК (делаем страховку и обрешетку). Отправляем трек номер.</p>
            </div>
        </div>
    </section>



<!-- Кнопка открытия чата -->
<button id="chatbot-open" class="chatbot-open-btn">💬</button>

<!-- Чат-бот -->
<div class="chatbot-container">
    <div class="chatbot-header">
        <h3>Помощник по выбору ПК</h3>
        <button id="chatbot-close">×</button>
    </div>
    <div class="chatbot-body" id="chatbot-body">
        <div class="chatbot-messages" id="chatbot-messages">
            <div class="chatbot-message bot-message">Привет! Я помогу тебе выбрать игровой ПК. Что тебя интересует? Могу предложить сборку по бюджету или играм — просто скажи!</div>
        </div>
        <div class="chatbot-input">
            <div class="input-wrapper">
                <input type="text" id="chatbot-input" placeholder="Введите ваш вопрос...">
                <div id="suggestions-list" class="suggestions-list"></div>
            </div>
            <button id="chatbot-send">Отправить</button>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbotContainer = document.querySelector('.chatbot-container');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotSend = document.getElementById('chatbot-send');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotOpen = document.getElementById('chatbot-open');
    const suggestionsList = document.getElementById('suggestions-list');

    const responses = {
        'какой пк выбрать для игр': 'Для игровых систем мы рекомендуем конфигурацию с процессором Intel Core i7 или AMD Ryzen 7, видеокартой NVIDIA RTX 3060 и оперативной памятью объёмом 16 ГБ.',
        'какой бюджет нужен для игрового пк': 'Для комфортной игры в современные проекты потребуется бюджет от 80 000 рублей. Для систем высокого уровня с максимальными настройками — от 120 000 рублей.',
        'какая гарантия на сборку': 'На все наши сборки предоставляется гарантия сроком до 3 лет в зависимости от выбранных комплектующих и условий обслуживания.',
        'как оформить заказ': 'Заказ можно оформить через каталог на нашем сайте либо обратиться к специалистам для создания индивидуальной конфигурации.',
        'какие комплектующие лучше': 'Для игровых задач оптимальны процессоры Intel Core i7/i9 или AMD Ryzen 7/9, видеокарты NVIDIA RTX 3060/3070/3080 и оперативная память от 16 до 32 ГБ.',
        'есть ли готовые сборки': 'Да, в нашем каталоге представлены готовые конфигурации, разработанные для различных задач и бюджетов.',
        'какой процессор выбрать': 'Для игр рекомендуем Intel Core i7 или AMD Ryzen 7. Для более требовательных задач подойдут Intel Core i9 или AMD Ryzen 9.',
        'какая видеокарта лучше для игр': 'Для игровых систем оптимальны видеокарты NVIDIA RTX 3060, 3070 или 3080 в зависимости от ваших требований к производительности.',
        'сколько стоит доставка': 'Доставка по России бесплатна при заказе от 50 000 рублей. В остальных случаях стоимость рассчитывается индивидуально.',
        'можно ли установить ос': 'Да, мы предлагаем установку операционных систем Windows или Linux по вашему выбору.',
        'как собрать пк самому': 'Для самостоятельной сборки потребуются корпус, материнская плата, процессор, видеокарта, оперативная память, накопители (SSD/HDD) и блок питания. Мы готовы проконсультировать по выбору компонентов.',
        'что лучше: amd или intel': 'AMD предлагает более доступные решения с высокой многопоточной производительностью, Intel обеспечивает преимущество в однопоточных задачах. Для игр оба бренда подходят отлично.',
        'какую материнскую плату выбрать': 'Для процессоров Intel подойдут платы с чипсетами Z690 или Z790, для AMD — B550 или X570. Выбор зависит от совместимости с процессором.',
        'сколько нужно оперативной памяти': 'Для игровых систем достаточно 16 ГБ оперативной памяти. Для стримеров или работы с видео рекомендуется 32 ГБ.',
        'какой блок питания нужен': 'Для средней конфигурации подойдёт блок питания мощностью 650 Вт, для высокопроизводительных систем — 850 Вт. Рекомендуем модели с сертификатом 80+ Gold.',
        'какое охлаждение выбрать': 'Для стандартных задач подойдёт воздушное охлаждение (например, Noctua NH-D15), для мощных систем рекомендуем жидкостное охлаждение (например, NZXT Kraken X63).',
        'какую периферию посоветуешь': 'Рекомендуем механическую клавиатуру (например, Logitech G Pro), мышь Logitech G502 и монитор с частотой обновления 144 Гц (например, ASUS TUF Gaming).',
        'какой софт нужен для игр': 'Для игр необходимы платформы Steam, Discord, актуальные драйверы для видеокарт NVIDIA/AMD, а также утилита MSI Afterburner для настройки производительности.',
        'собери пк за мой бюджет': 'Пожалуйста, укажите ваш бюджет в рублях, и мы предложим оптимальную конфигурацию.',
        'во что хочу поиграть': 'Укажите, в какие игры вы планируете играть, и мы подберём подходящую конфигурацию.',
        'какой ssd выбрать': 'Для игр рекомендуем SSD с интерфейсом NVMe, объёмом от 512 ГБ (например, Samsung 970 EVO или WD Black SN750).',
        'нужен ли hdd': 'HDD пригодится для хранения больших объёмов данных (например, 1-2 ТБ), если SSD используется как основной накопитель.',
        'какой корпус лучше': 'Выбирайте корпус с хорошей вентиляцией и поддержкой современных компонентов, например, NZXT H510 или Cooler Master MasterBox.',
        'как обновить пк': 'Для апгрейда определите слабые места текущей системы (процессор, видеокарта, ОЗУ) и замените их на более производительные аналоги. Мы можем помочь с подбором.',
        'какой монитор выбрать': 'Для игр оптимален монитор с разрешением Full HD или 2K, частотой 144 Гц и временем отклика 1 мс (например, ASUS TUF VG27AQ).',
        'что такое фпс': 'FPS (Frames Per Second) — это количество кадров в секунду, показывающее плавность изображения в играх. Чем выше FPS, тем лучше игровой опыт.',
        'как проверить производительность пк': 'Используйте программы вроде 3DMark для тестирования видеокарты или Cinebench для процессора, чтобы оценить производительность.',
        'какой интернет нужен для игр': 'Для онлайн-игр достаточно скорости 20-50 Мбит/с с низким пингом (до 50 мс).'
    };

    const suggestionOptions = Object.keys(responses).map(key => {
        return key.charAt(0).toUpperCase() + key.slice(1) + '?';
    });

    const gameOptions = {
        'вал': 'Valorant',
        'кс': 'CS:GO',
        'дота': 'Dota 2',
        'сайбер': 'Cyberpunk 2077',
        'рdr': 'Red Dead Redemption 2',
        'гта': 'GTA V',
        'форт': 'Fortnite',
        'майн': 'Minecraft',
        'код': 'Call of Duty',
        'апекс': 'Apex Legends'
    };

    let isFirstOpen = true;
    let awaitingBudget = false;
    let awaitingGames = false;

    // Открыть чат
    chatbotOpen.addEventListener('click', () => {
        chatbotContainer.style.display = 'flex';
        if (isFirstOpen) {
            showInitialSuggestions();
            isFirstOpen = false;
        }
    });

    // Закрыть чат
    chatbotClose.addEventListener('click', () => {
        chatbotContainer.style.display = 'none';
    });

    // Отправка сообщения
    chatbotSend.addEventListener('click', sendMessage);
    chatbotInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });

    // Автодополнение
    chatbotInput.addEventListener('input', () => {
        const query = chatbotInput.value.trim().toLowerCase();
        suggestionsList.innerHTML = '';
        if (query) {
            let options = awaitingGames ? Object.entries(gameOptions) : suggestionOptions.map(opt => [opt, opt]);
            const filteredSuggestions = options.filter(([shortcut, option]) =>
                shortcut.toLowerCase().includes(query) || option.toLowerCase().includes(query)
            );
            if (filteredSuggestions.length) {
                filteredSuggestions.forEach(([_, suggestion]) => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.classList.add('suggestion-item');
                    suggestionItem.textContent = suggestion;
                    suggestionItem.addEventListener('click', () => {
                        chatbotInput.value = suggestion;
                        suggestionsList.style.display = 'none';
                        sendMessage();
                    });
                    suggestionsList.appendChild(suggestionItem);
                });
                suggestionsList.style.display = 'block';
            } else {
                suggestionsList.style.display = 'none';
            }
        } else {
            suggestionsList.style.display = 'none';
        }
    });

    // Скрыть подсказки при клике вне поля
    document.addEventListener('click', (e) => {
        if (!chatbotInput.contains(e.target) && !suggestionsList.contains(e.target)) {
            suggestionsList.style.display = 'none';
        }
    });

    function sendMessage() {
        const userMessage = chatbotInput.value.trim();
        if (!userMessage) return;

        addMessage(userMessage, 'user-message');
        chatbotInput.value = '';
        suggestionsList.style.display = 'none';

        if (awaitingBudget) {
            handleBudgetResponse(userMessage);
            awaitingBudget = false;
        } else if (awaitingGames) {
            handleGamesResponse(userMessage);
            awaitingGames = false;
        } else {
            setTimeout(() => {
                addMessage(getBotResponse(userMessage), 'bot-message');
            }, 500);
        }
    }

    function addMessage(text, className) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('chatbot-message', className);
        messageDiv.textContent = text;
        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function showInitialSuggestions() {
        const existingSuggestions = chatbotMessages.querySelectorAll('.chatbot-suggestion');
        existingSuggestions.forEach(suggestion => suggestion.remove());

        const initialSuggestions = [
            'Какой ПК выбрать для игр?', 'Собери ПК за мой бюджет', 'Во что хочу поиграть', 'Как оформить заказ?'
        ];
        initialSuggestions.forEach(suggestion => {
            const suggestionDiv = document.createElement('div');
            suggestionDiv.classList.add('chatbot-message', 'chatbot-suggestion');
            suggestionDiv.textContent = suggestion;
            suggestionDiv.addEventListener('click', () => {
                chatbotInput.value = suggestion;
                sendMessage();
            });
            chatbotMessages.appendChild(suggestionDiv);
        });
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function getBotResponse(userMessage) {
        const lowerMessage = userMessage.toLowerCase();
        for (const [key, value] of Object.entries(responses)) {
            if (lowerMessage.includes(key)) {
                if (key === 'собери пк за мой бюджет') {
                    awaitingBudget = true;
                } else if (key === 'во что хочу поиграть') {
                    awaitingGames = true;
                }
                return value;
            }
        }
        return 'Не понял вопроса. Попробуй переформулировать!';
    }

    function handleBudgetResponse(budget) {
        const budgetNum = parseInt(budget.replace(/[^0-9]/g, ''));
        let response;
        if (isNaN(budgetNum)) {
            response = 'Пожалуйста, укажи бюджет в рублях числом (например, 80000).';
        } else if (budgetNum < 50000) {
            response = 'За ' + budgetNum + ' рублей можно собрать базовый ПК: Intel Core i3, GTX 1650, 8 ГБ ОЗУ, SSD 256 ГБ.';
        } else if (budgetNum < 80000) {
            response = 'За ' + budgetNum + ' рублей: Intel Core i5, RTX 3050, 16 ГБ ОЗУ, SSD 512 ГБ — для средних настроек.';
        } else if (budgetNum < 120000) {
            response = 'За ' + budgetNum + ' рублей: Intel Core i7, RTX 3060, 16 ГБ ОЗУ, SSD 1 ТБ — комфортный гейминг.';
        } else {
            response = 'За ' + budgetNum + ' рублей: AMD Ryzen 9, RTX 4080, 32 ГБ ОЗУ, SSD 1 ТБ — топовая сборка для 4K!';
        }
        addMessage(response, 'bot-message');
    }

    function handleGamesResponse(games) {
        const lowerGames = games.toLowerCase();
        let fullGameName = '';
        let response;

        for (const [shortcut, game] of Object.entries(gameOptions)) {
            if (lowerGames.includes(shortcut)) {
                fullGameName = game;
                break;
            }
        }

        if (!fullGameName) {
            for (const game of Object.values(gameOptions)) {
                if (lowerGames.includes(game.toLowerCase())) {
                    fullGameName = game;
                    break;
                }
            }
        }

        if (fullGameName === 'CS:GO' || fullGameName === 'Dota 2' || fullGameName === 'Valorant') {
            response = `Для ${fullGameName}: Intel Core i5, GTX 1660 Super, 16 ГБ ОЗУ, SSD 512 ГБ. Примерная стоимость: ~60 000 рублей.`;
        } else if (fullGameName === 'Cyberpunk 2077' || fullGameName === 'Red Dead Redemption 2' || fullGameName === 'GTA V') {
            response = `Для ${fullGameName}: Intel Core i7, RTX 3070, 16 ГБ ОЗУ, SSD 1 ТБ. Примерная стоимость: ~110 000 рублей.`;
        } else if (fullGameName === 'Fortnite' || fullGameName === 'Minecraft') {
            response = `Для ${fullGameName}: Intel Core i5, RTX 3050, 16 ГБ ОЗУ, SSD 512 ГБ. Примерная стоимость: ~70 000 рублей.`;
        } else if (fullGameName === 'Call of Duty' || fullGameName === 'Apex Legends') {
            response = `Для ${fullGameName}: Intel Core i5, RTX 3060, 16 ГБ ОЗУ, SSD 512 ГБ. Примерная стоимость: ~80 000 рублей.`;
        } else {
            response = 'Назови конкретные игры (например, "кс" для CS:GO, "вал" для Valorant), чтобы я подобрал сборку и указал стоимость!';
        }

        addMessage(response, 'bot-message');
    }
});
</script>




















    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>

    <script>
(() => {
    const modelViewers = document.querySelectorAll('model-viewer');
    const cards = document.querySelectorAll('.card');
    const defaultOrbit = '64deg 25deg 64m';
    const hoverOrbit = '90deg -42deg 80m';
    const applyOrbit = (modelViewer, orbit) => {
      modelViewer.setAttribute('camera-orbit', orbit);
      modelViewer.setAttribute('interpolation-decay', '200');
    };
    cards.forEach((card, index) => {
      const modelViewer = modelViewers[index];
      if (modelViewer) {
        card.addEventListener('mouseenter', () => applyOrbit(modelViewer, hoverOrbit));
        card.addEventListener('mouseleave', () => applyOrbit(modelViewer, defaultOrbit));
        modelViewer.addEventListener('load', () => {
          modelViewer.classList.add('loaded');
        });
      } else {
        console.log(`No model found for card at i:${index}`);
      }
    });
  })();
  
  function changeModelStyle(element, deg, invert = 0) {
    const card = element.closest('.card');
    const modelViewer = card.querySelector('model-viewer');
    if (modelViewer) { modelViewer.style.filter = `hue-rotate(${deg}deg) invert(${invert})`; }
  }


  
        (() => {
    const modelViewers = document.querySelectorAll('model-viewer');
    const cards = document.querySelectorAll('.card');
    const defaultOrbit = '64deg 25deg 64m';
    const hoverOrbit = '90deg -42deg 80m';
    const applyOrbit = (modelViewer, orbit) => {
      modelViewer.setAttribute('camera-orbit', orbit);
      modelViewer.setAttribute('interpolation-decay', '200');
    };
    cards.forEach((card, index) => {
      const modelViewer = modelViewers[index];
      if (modelViewer) {
        card.addEventListener('mouseenter', () => applyOrbit(modelViewer, hoverOrbit));
        card.addEventListener('mouseleave', () => applyOrbit(modelViewer, defaultOrbit));
        modelViewer.addEventListener('load', () => {
          modelViewer.classList.add('loaded');
        });
      } else {
        console.log(`No model found for card at i:${index}`);
      }
    });
  })();
  
  function changeModelStyle(element, deg, invert = 0) {
    const card = element.closest('.card');
    const modelViewer = card.querySelector('model-viewer');
    if (modelViewer) { modelViewer.style.filter = `hue-rotate(${deg}deg) invert(${invert})`; }
  }

  var swiper = new Swiper('.product-slider', {
    spaceBetween: 30,
    effect: 'fade',
    // initialSlide: 2,
    loop: false,
    navigation: {
        nextEl: '.next',
        prevEl: '.prev'
    },
    // mousewheel: {
    //     // invert: false
    // },
    on: {
        init: function(){
            var index = this.activeIndex;

            var target = $('.product-slider__item').eq(index).data('target');

            console.log(target);

            $('.product-img__item').removeClass('active');
            $('.product-img__item#'+ target).addClass('active');
        }
    }

});

swiper.on('slideChange', function () {
    var index = this.activeIndex;

    var target = $('.product-slider__item').eq(index).data('target');

    console.log(target);

    $('.product-img__item').removeClass('active');
    $('.product-img__item#'+ target).addClass('active');

    if(swiper.isEnd) {
        $('.prev').removeClass('disabled');
        $('.next').addClass('disabled');
    } else {
        $('.next').removeClass('disabled');
    }

    if(swiper.isBeginning) {
        $('.prev').addClass('disabled');
    } else {
        $('.prev').removeClass('disabled');
    }
});

$(".js-fav").on("click", function() {
    $(this).find('.heart').toggleClass("is-active");
});
    </script>

@endsection
