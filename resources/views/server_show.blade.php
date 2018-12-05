<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="row main-filter">
            <div class="col-md-12">
                <div class="page-title"><hr><span><a href="{{$server->link}}" target="_blank">{{$server->h2}}</a></span></div>
            </div>
            {{--<div class="col-md-6">--}}
            {{--<div class="page-but" data-toggle="modal" data-target="#myModal">Добавить услугу</div>--}}
            {{--<div class="page-but">Наши услуги</div>--}}
            {{--<div class="page-but">Заявка в "Наши рекомендации"</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<div class="contaner-fluid">
    <div class="container page-content clearboth">
        {{--<div class="row">--}}
            {{--<div class="col-12 page-title-2 align-items-center d-flex">--}}
                {{--<span class="unactive">Главная / </span><span class="active ml-1">{{$server->name}}</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row page-content-row">
                    <div class="col-md-6">
                        @if (isset($server->picture) && $server->picture != "default")
                            <img class="img-fluid" src="/uploads/servers/server-{{$server->id}}{{$server->picture}}?time={{$server->updated_at->format('d_h_i_s')}}" alt="{{$server->name}}">
                        @else
                            <img class="img-fluid" src="/uploads/servers/DEFAULT.png" alt="{{$server->name}}">
                        @endif
                    </div>
                    <div class="col-md-6">
                            <h2>{{$server->name}}</h2>
                            <dl class="row">
                                <dt class="col-sm-3">Хроники</dt>
                                <dd class="col-sm-9">{{$server->chronicle->name}}</dd>

                                <dt class="col-sm-3">Рейт</dt>
                                <dd class="col-sm-9">{{$server->rate->name}}</dd>

                                <dt class="col-sm-3">Дата</dt>
                                <dd class="col-sm-9">{{$server->p}}</dd>
                            </dl>
                            <a href="{{$server->link}}" target="_blank" class="btn btn-outline-info btn-server">НА САЙТ СЕРВЕРА</a>
                    </div>
                </div>
            <div class="row page-content-row">
                <div class="col-md-6 server-seo">
                    {!! $seo_text !!}
                </div>
                <div class="col-md-6">
                    <div id="disqus_thread"></div>
                    <script>

                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://l2oko-ru.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
        </div>
    </div>
</div>
</div>