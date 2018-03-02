<form action="vk_api_demo" method="post" name="cross_post">
    <div class="row form_send">
        <div class="form-group col-sm-6">
            <label for="name"class="h4">Имя</label>
            <input type="text" class="form-control" id="name"  placeholder="Введите имя" required>
        </div>
        <div class="form-group col-sm-6">
            <label for="email" class="h4">Контакты</label>
            <input type="email" class="form-control" id="email" placeholder="Введите данные для связи с Вами" required>
        </div>
    </div>
    <div class="form-group form_send">
        <label for="message"class="h4 ">Сообщение</label>
        <textarea id="message" class="form-control" rows="5" placeholder="Введите свое сообщение" required></textarea>
    </div>
    <div class="form_send">
        <button type="submit" id="form-submit" class="btnbtn-success btn-lg pull-right ">Отправить</button>
        <div id="msgSubmit" class="h3 text-center hidden">Message Submitted!</div>
    </div>
</form>