<html>
<head>
    <title>%title%</title>
    <meta charset="utf-8">
    <meta name="description" content="%meta_desc%" />
    <meta name="keywords" content="%meta_key%" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="%address%favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="%address%favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/cat_script.js"></script>
    <script src="//api-maps.yandex.ru/2.0/?lang=ru-RU&load=package.full" type="text/javascript"></script>
    <script src="../js/search_address.js" type="text/javascript"></script>
    <script src="../gallery/js/lightgallery.min.js"></script>
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link type="text/css" rel="stylesheet" href="../gallery/css/lightgallery.css" />
    <link rel="stylesheet" href="../css/main-back.css" type="text/css">
</head>
<body>

<style type="text/css">

    #YMapsID {
        width: 100%;
        height: 400px;
        margin-top: 25px;
        border: 1px solid #ccc;;
    }
</style>
<div class="container" id="main_container">
    <div class="row">
        <div class="col-md-12 header">
            <div id="header-mid">
                <div class="col-md-3">
                    <a href="/"><img src="../images/login-logo.png" class="logo"></a>
                </div>
                <div class="col-md-6 block_contact">
                    <i class="fa fa-mobile fa-2x" style="float: left;"></i><p class="contact">+7 987 654 32 10</p>
                    <i class="fa fa-map-marker fa-2x" style="float: left;"></i><p class="contact">г. Волжский, б-р Профсоюзов, 1б, офис 220</p>
                </div>
                <div class="col-md-3">
                    <div class="block_hello block_content">
                        <p class="block_title">Личный кабинет</p>
                        %login%
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav id="menu">
                <ul>
                    <li><a href="/">Подобрать жилье</a>
                        <div class="dropdown-nav no_padding">
                            <table class="menu-table">
                                <tr>
                                    <td class="menu-td col-md-3 no_padding">
                                        <div id="category" class="menu-block">
                                            <div class="elem-nav-cat-title">Категория</div>
                                            <div id="cat-kvart" data-type="1" data-show="cat-kvart-2" class="elem-nav-cat">Квартира</div>
                                            <div id="cat-house" data-type="2" data-show="cat-house-2" class="elem-nav-cat">Дом, дача, участок</div>
                                            <div id="cat-komn" data-type="3" data-show="cat-comnt-2" class="elem-nav-cat">Комната</div>
                                        </div>
                                    </td>
                                    <td class="menu-td col-md-3 no_padding">
                                        <div id="cat-sdelka" class="menu-block" hidden>
                                            <div class="elem-nav-cat-title">Вид сделки</div>
                                            <div data-deal="1" class="elem-nav-cat">Продажа</div>
                                            <div data-deal="2" class="elem-nav-cat">Обмен</div>
                                        </div>
                                    </td>
                                    <td id="menu-cat-3" class="menu-td col-md-3 no_padding">
                                        <div id="cat-kvart-2" class="menu-block" hidden>
                                            <div class="elem-nav-cat-title">Тип объекта</div>
                                            <a href="" id="kvart-2-1"><div class="elem-nav-cat">Вторичка</div></a>
                                            <a href="" id="kvart-2-2"><div class="elem-nav-cat">Новостройка</div></a>
                                        </div>
                                        <div id="cat-house-2" class="menu-block" hidden>
                                            <div class="elem-nav-cat-title">Тип объекта</div>
                                            <a href="" id="house-2-1"><div class="elem-nav-cat">Дом</div></a>
                                            <a href="" id="house-2-2"><div class="elem-nav-cat">Дача</div></a>
                                            <a href="" id="house-2-3"><div class="elem-nav-cat">Коттедж</div></a>
                                            <a href="" id="house-2-4"><div class="elem-nav-cat">Таунхаус</div></a>
                                        </div>
                                        <div id="cat-comnt-2" class="menu-block" hidden>
                                            <div class="elem-nav-cat-title">Тип объекта</div>
                                            <a href="" id="comnt-2-1"><div id="comnt-2-1" class="elem-nav-cat">Гостиничного</div></a>
                                            <a href="" id="comnt-2-2"><div class="elem-nav-cat">Коридорного</div></a>
                                            <a href="" id="comnt-2-3"><div class="elem-nav-cat">Секционного</div></a>
                                            <a href="" id="comnt-2-4"><div class="elem-nav-cat">Коммунальная</div></a>
                                        </div>
                                    </td>
                                    <td class="menu-td col-md-3 no_padding">
                                        <div class="menu-block">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    %random_obj%
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </li>
                    <li><a href="#">Выбрать банк</a>
                        <div class="dropdown-nav no_padding"></div>
                        <table class="menu-table"></table>
                    </li>

                    <li><a href="#">Это интересно</a>
                        <div class="dropdown-nav no_padding">
                            <table class="menu-table">
                                <tr>
                                    <td class="menu-td col-md-4 no_padding">
                                        <div class="menu-block">
                                            <div class="block_obj_comfort_title">Новости</div>
                                            %posts_section_1%
                                        </div>
                                    </td>
                                    <td class="menu-td col-md-4 no_padding">
                                        <div class="menu-block">
                                            <div class="block_obj_comfort_title">Помощь</div>
                                            %posts_section_2%
                                        </div>
                                    </td>
                                    <td class="menu-td col-md-4 no_padding">
                                        <div class="menu-block">
                                            <div class="block_obj_comfort_title">Разное</div>
                                            %posts_section_3%
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </li>
                    <li><a href="#">О нас</a>
                        <div class="col-md-12 dropdown-nav">
                            <div class="col-md-3"><div class="colum">
                                    <ul>
                                        <li><a href="#m3_1">Наша услуга №1</a>
                                            <ul>
                                                <li><a href="#m3_1_1">Дополнение к услуге 1</a></li>
                                                <li><a href="#m3_1_1">Дополнение к услуге 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#m3_2">Наша услуга №2</a>
                                            <ul>
                                                <li><a href="#m3_2_1">Дополнение к услуге 3</a></li>
                                                <li><a href="#m3_2_1">Дополнение к услуге 4</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#m3_3">Наша услуга №3</a></li>
                                        <li><a href="#m3_4">Наша услуга №4</a></li>
                                        <li><a href="#m3_5">Услуга 5</a></li>
                                    </ul>
                                </div></div>
                            <div class="col-md-3"><div class="colum"><h6>Закупки</h6></div></div>
                            <div class="col-md-3"><div class="colum"><h6>Опа</h6></div></div>
                            <div class="col-md-3"><div class="colum"><h6>аааа</h6></div></div>
                        </div>
                    </li>
                    <li><a href="#">Контакты</a>
                        <div class="dropdown-nav no_padding">
                            <table class="menu-table">
                                <tr>
                                    <td class="menu-td col-md-3 no_padding">
                                        <div class="menu-block">
                                            <div class="contacts"><div class="col-md-2"><span>Тел.</span></div><div class="col-md-10"><p>+7 987 654 32 10</p></div></div>
                                            <div class="contacts"><div class="col-md-2"><span>Адрес</span></div><div class="col-md-10"><p>г. Волжски, б-р Профсоюзов, 1б, офис 220</p></div></div>
                                            <a class="nl_btn_green send_email">Написать нам</a>
                                        </div>
                                    </td>
                                    <td class="menu-td col-md-9 no_padding">
                                        <div class="menu-block">
                                            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=ra90pEYrkEA1oYiMWKFC8sn7ZUmRn1_h&amp;width=100%25&amp;height=300&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </li>
                </ul>
            </nav><!--menu1-->
        </div>
    </div>
    %top%
    %middle%
    %bottom%
    </div>
<div class="container" id="footer">
    <div class="row">
        <div class="col-md-4">
            <div class="title_footer">Специальное предложение</div>
            %spec_offers%
        </div>
        <div class="col-md-4">
            <div class="title_footer">Последнии новости</div>
            %posts%
        </div>
        <div class="col-md-4">
            <div class="title_footer">Контакты</div>
            <div class="contacts"><div class="col-md-2"><span>Тел.</span></div><div class="col-md-10"><p>+7 987 654 32 10</p></div></div>
            <div class="contacts"><div class="col-md-2"><span>Адрес</span></div><div class="col-md-10"><p>г. Волжски, б-р Профсоюзов, 1б, офис 220</p></div></div>
        </div>
    </div>
</div>
<div class="container" id="post_footer">
    <div class="row">
        <div class="col-md-8 copi">
            <p>© 1997—2016 ПАО Сбербанк. Россия, Москва, 117997, ул. Вавилова, д. 19, тел. +7 (495) 500 5550, 8 800 555 5550. Генеральная лицензия на осуществление банковских операций от 11 августа 2015 года. Регистрационный номер — 1481</p>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#lightgallery").lightGallery();
    });
</script>
<!-- lightgallery plugins -->
<script src="../gallery/js/lg-thumbnail.min.js"></script>
<script src="../gallery/js/lg-fullscreen.min.js"></script>
</body>
</html>