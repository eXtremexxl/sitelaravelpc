<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <link rel="stylesheet" href="https://public.codepenassets.com/css/normalize-5.0.0.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>
    <link rel="stylesheet" href="{{ asset('css/qwe.css') }}">


</head>
<body>

    <!-- Хедер -->
    <header class="navbar">
        <a href="/">
          <div class="logo">
          <img src="{{ asset('imagess/logo.png') }}" alt="Logo">
          </div>
        </a>
    
        
        <nav>
            <div class="dropdown">
                <a href="#">Игровые ПК</a>
                <div class="dropdown-menu">
                <a href="{{ url('/catalog') }}">Каталог</a>
                </div>
            </div>



            <div class="dropdown">
                <a href="#">Компоненты</a>
            </div>

            <div class="dropdown">
                <a href="#">Мониторы</a>
            </div>

            <div class="dropdown">
                <a href="#">Периферия</a>
            </div>
        </nav>
        
        <div class="icons">
            <i class="fas fa-user"></i>
            <i class="fas fa-shopping-cart"></i>
        </div>
    </header>

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
                <a href="#" class="hero-btn">ПОДОБРАТЬ КОМПЬЮТЕР</a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('imagess/Untitleddesign_27_720x.png') }}" alt="Игровой компьютер">
            </div>
        </div>
    </section>


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
          <div class="product-img__item" id="img1">
            <img src="{{ asset('imagess/pc2.png') }}" alt="Gaming PC 1" class="product-img__img">
          </div>
          <div class="product-img__item" id="img2">
            <img src="{{ asset('imagess/pc4.webp') }}" alt="Gaming PC 2" class="product-img__img">
          </div>
          <div class="product-img__item" id="img3">
            <img src="{{ asset('imagess/pc3.webp') }}" alt="Gaming PC 3" class="product-img__img">
          </div>
          <div class="product-img__item" id="img4">
            <img src="{{ asset('imagess/pc5.webp') }}" alt="Gaming PC 4" class="product-img__img">
          </div>
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
            <div class="product-slider__item swiper-slide" data-target="img4">
              <div class="product-slider__card">
                <div class="product-slider__content">
                  <h1 class="product-slider__title">
                    GAMING PC PRO <br> X1
                  </h1>
                  <span class="product-slider__price">₽250.000</span>
                  <div class="product-ctr">
                    <div class="product-labels">
                      <div class="product-labels__title">CPU</div>
                      <div class="product-labels__group">
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type1" checked>
                          <span class="product-labels__txt">Intel Core i9</span>
                        </label>
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type1">
                          <span class="product-labels__txt">AMD Ryzen 9</span>
                        </label>
                      </div>
                    </div>
    
                    <span class="hr-vertical"></span>
    
                    <div class="product-inf">
                      <div class="product-inf__percent">
                        <div class="product-inf__percent-circle">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                            <defs>
                              <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#0c1e2c" stop-opacity="0" />
                                <stop offset="100%" stop-color="#cb2240" stop-opacity="1" />
                              </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="47" stroke-dasharray="240, 300" stroke="#cb2240" stroke-width="4" fill="none"/>
                          </svg>
                        </div>
                        <div class="product-inf__percent-txt">
                          85%
                        </div>
                      </div>
                      <span class="product-inf__title">PERFORMANCE</span>
                    </div>
                  </div>
    
                  <div class="product-slider__bottom">
                    <button class="product-slider__cart">
                      ДОБАВИТЬ В КОРЗИНУ
                    </button>
    

                  </div>
                </div>
              </div>
            </div>
    
            <div class="product-slider__item swiper-slide" data-target="img1">
              <div class="product-slider__card">
                <div class="product-slider__content">
                  <h1 class="product-slider__title">
                    GAMING RIG <br> XTREME
                  </h1>
                  <span class="product-slider__price">₽180.000</span>
                  <div class="product-ctr">
                    <div class="product-labels">
                      <div class="product-labels__title">STORAGE</div>
                      <div class="product-labels__group">
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type2" checked>
                          <span class="product-labels__txt">1 TB SSD </span>
                        </label>
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type2">
                          <span class="product-labels__txt">2 TB SSD </span>
                        </label>
                      </div>
                    </div>
    
                    <span class="hr-vertical"></span>
    
                    <div class="product-inf">
                      <div class="product-inf__percent">
                        <div class="product-inf__percent-circle">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                            <defs>
                              <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#0c1e2c" stop-opacity="0" />
                                <stop offset="100%" stop-color="#cb2240" stop-opacity="1" />
                              </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="47" stroke-dasharray="210, 300" stroke="#cb2240" stroke-width="4" fill="none"/>
                          </svg>
                        </div>
                        <div class="product-inf__percent-txt">
                          78%
                        </div>
                      </div>
                      <span class="product-inf__title">STORAGE PERFORMANCE</span>
                    </div>
                  </div>
    
                  <div class="product-slider__bottom">
                    <button class="product-slider__cart">
                      ДОБАВИТЬ В КОРЗИНУ
                    </button>
                  </div>
                </div>
              </div>
            </div>
    
            <div class="product-slider__item swiper-slide" data-target="img2">
              <div class="product-slider__card">
                <div class="product-slider__content">
                  <h1 class="product-slider__title">
                    GAMER'S PC <br> ELITE
                  </h1>
                  <span class="product-slider__price">₽120.000</span>
                  <div class="product-ctr">
                    <div class="product-labels">
                      <div class="product-labels__title">RAM</div>
                      <div class="product-labels__group">
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type3" checked>
                          <span class="product-labels__txt">16 GB DDR4</span>
                        </label>
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type3">
                          <span class="product-labels__txt">32 GB DDR4</span>
                        </label>
                      </div>
                    </div>
    
                    <span class="hr-vertical"></span>
    
                    <div class="product-inf">
                      <div class="product-inf__percent">
                        <div class="product-inf__percent-circle">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                            <defs>
                              <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#0c1e2c" stop-opacity="0" />
                                <stop offset="100%" stop-color="#cb2240" stop-opacity="1" />
                              </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="47" stroke-dasharray="230, 300" stroke="#cb2240" stroke-width="4" fill="none"/>
                          </svg>
                        </div>
                        <div class="product-inf__percent-txt">
                          80%
                        </div>
                      </div>
                      <span class="product-inf__title">SPEED</span>
                    </div>
                  </div>
    
                  <div class="product-slider__bottom">
                    <button class="product-slider__cart">
                      ДОБАВИТЬ В КОРЗИНУ
                    </button>
  
                  </div>
                </div>
              </div>
            </div>
    
            <div class="product-slider__item swiper-slide" data-target="img3">
              <div class="product-slider__card">
                <div class="product-slider__content">
                  <h1 class="product-slider__title">
                    GAMER'S MONSTER <br> 2000X
                  </h1>
                  <span class="product-slider__price">₽450.000</span>
                  <div class="product-ctr">
                    <div class="product-labels">
                      <div class="product-labels__title">GPU</div>
                      <div class="product-labels__group">
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type4" checked>
                          <span class="product-labels__txt">NVIDIA RTX 5090</span>
                        </label>
                        <label class="product-labels__item">
                          <input type="radio" class="product-labels__checkbox" name="type4">
                          <span class="product-labels__txt">NVIDIA RTX 5080</span>
                        </label>
                      </div>
                    </div>
    
                    <span class="hr-vertical"></span>
    
                    <div class="product-inf">
                      <div class="product-inf__percent">
                        <div class="product-inf__percent-circle">
                          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                            <defs>
                              <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#0c1e2c" stop-opacity="0" />
                                <stop offset="100%" stop-color="#cb2240" stop-opacity="1" />
                              </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="47" stroke-dasharray="250, 300" stroke="#cb2240" stroke-width="4" fill="none"/>
                          </svg>
                        </div>
                        <div class="product-inf__percent-txt">
                          90%
                        </div>
                      </div>
                      <span class="product-inf__title">GRAPHIC PERFORMANCE</span>
                    </div>
                  </div>
    
                  <div class="product-slider__bottom">
                    <button class="product-slider__cart">
                      ДОБАВИТЬ В КОРЗИНУ
                    </button>
    

                  </div>
                </div>
              </div>
            </div>
          </div>
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



  <!-- клавы -->
    <div class="qweqwe">
      <div class="card">
          <div class="overflow">
            <div class="model">
              <model-viewer camera-orbit="64deg 25deg 64m" src="https://assets.codepen.io/3421562/leaves_keyboard.glb" shadow-intensity="0.4"></model-viewer>
            </div>
          </div>
          <div class="glass">
            <div class="gradient-blur"><div></div><div></div><div></div><div></div><div></div><div></div></div>
          </div>
          <div class="content">
            <h2>LeafKey</h2>
            <p>Клавиатура, передающая спокойствие леса на кончиках ваших пальцев.</p>
            <div class="options">
              <div onclick="changeModelStyle(this, 0);" style="background: #f2c173;"></div>
              <div onclick="changeModelStyle(this, 60);" style="background: #96dd78;"></div>
              <div onclick="changeModelStyle(this, 110);" style="background: #6ee5bc;"></div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="overflow">
            <div class="model">
              <model-viewer camera-orbit="64deg 25deg 64m" src="https://assets.codepen.io/3421562/topo_keyboard.glb" shadow-intensity="0.4"></model-viewer>
            </div>
          </div>
          <div class="glass">
            <div class="gradient-blur"><div></div><div></div><div></div><div></div><div></div><div></div></div>
          </div>
          <div class="content">
            <h2>TopoKey</h2>
            <p>Клавиатура с индивидуальной подсветкой и неоновой топологией, отображаемой на каждой клавише.</p>
            <div class="options">
              <div onclick="changeModelStyle(this, 0);" style="background: #2cb4f0;"></div>
              <div onclick="changeModelStyle(this, 110);" style="background: #ff69e4;"></div>
              <div onclick="changeModelStyle(this, 290);" style="background: #16b83f;"></div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="overflow">
            <div class="model">
              <model-viewer camera-orbit="64deg 25deg 64m" src="https://assets.codepen.io/3421562/panda_keyboard.glb" shadow-intensity="0.4"></model-viewer>
            </div>
          </div>
          <div class="glass">
            <div class="gradient-blur"><div></div><div></div><div></div><div></div><div></div><div></div></div>
          </div>
          <div class="content">
            <h2>PandaKey</h2>
            <p>Панда, панда, панда ... панда</p>
            <div class="options">
            </div>
          </div>
        </div>
    </div>

<!-- реки -->
    <div class="hero2">
      <div class="overlay">
          <h2 class="guarantee">FunnyMoment РЕКОМЕНДУЕТ</h2>
          <h1 class="headline">ЛУЧШИЕ КОМПЛЕКТУЮЩИЕ:<br>СОБРАННЫЕ ЭКСПЕРТАМИ</h1>
          <a href="#" class="btn">УЗНАТЬ БОЛЬШЕ →</a>
        </div>
    </div>

    <!-- шаги -->
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


  <!-- фут -->
  <footer class="footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>Игровые ПК</h3>
            <a href="#">Все модели</a>
            <a href="#">Конфигуратор</a>
        </div>

        <div class="footer-column">
            <h3>Компоненты</h3>
            <a href="#">Процессоры</a>
            <a href="#">Видеокарты</a>
            <a href="#">Оперативная память</a>
            <a href="#">Накопители</a>
            <a href="#">Материнские платы</a>
            <a href="#">Блоки питания</a>
        </div>

        <div class="footer-column">
            <h3>Мониторы</h3>
            <a href="#">Full HD</a>
            <a href="#">2K</a>
            <a href="#">4K</a>
            <a href="#">Игровые мониторы</a>
        </div>

        <div class="footer-column">
            <h3>Периферия</h3>
            <a href="#">Клавиатуры</a>
            <a href="#">Мыши</a>
            <a href="#">Гарнитуры</a>
            <a href="#">Коврики</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>Copyright © 2025 FunnyMoment | Все права защищены.</p>
    </div>
</footer>

    




    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>
    <script src="{{ asset('js/cod.js') }}"></script>
</body>
</html>
