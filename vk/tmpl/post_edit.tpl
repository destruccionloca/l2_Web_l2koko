<div id="create_obj">
    <form class="obj_form" name="posts_edit" action="functions.php" method="post">
        <ul id="obj_ul">
            <li>
                <h2>Редактирование статьи</h2>
                <span class="required_notification">* Обязательные поля</span>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <div id="title">
                            <label for="title">Заголовок</label>
                            <input size="40" name="title" id="title" value="%title%" type="text" required/>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <div id="mess">
                            <label for="desc">Содержимое сообщения</label>
                            <textarea name="text" id="editor1" rows="10" cols="80">%content%</textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <div id="short_desc">
                            <label for="short_desc">Кратное описание</label>
                            <textarea style="width: 100%" name="text_desc" id="short_desc" rows="5" cols="80">%short_content%</textarea>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="section">Раздел</label>
                            <select name="section" class="easydropdown">
                                %section%
                            </select>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Опции</b></p>
                        <div id="options">
                            <label><input %on_main% id="mainpage" type="checkbox" value="1" name="post_mainpage" >На главную</label>
                            <input id="img_type" name="img_type" value="%type_img%" hidden>
                        </div>
                    </div>
                </div>
            </li>
            <li id="li-for-main" %on_main_img%>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Button trigger modal -->
                        <button id="mod" class="btn btn-primary" data-toggle="modal" data-target="#myModal_main">
                            Загрузить изображение (для Главной)
                        </button>
                    </div>
                </div>
            </li>
            <li>
                <div class="submit">
                    <input name="id" value="%id%" hidden>
                    <input class="submit" type="submit" name="post_edit" value="Редактировать">
                </div>
            </li>
        </ul>
    </form>
    <!-- Modal - Main -->
    <div class="modal fade" id="myModal_main" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Загрузка изображения (Для главной)</h4>
                </div>
                <div class="modal-body">
                    <form class="dropzone" id="my-main">
                        <input class="post-id" name="postidmain" type="text" hidden >
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        %script%
    </script>
    <script>
        $(document).ready(function () {
            $('#mainpage').change(function () {
                $('#li-for-main').stop().toggle('fast');
            });

            var renameFilenamef = function (name) {
                var id = $('.post-id').val() + ".";
                var type = "." + (name.replace(/^.*\./, ''));
                $('#img_type').val(type);
                return name.replace(/^.*\./, id);
            };

            Dropzone.autoDiscover = false;

            var myDropzoneTheFirst = new Dropzone(
                    '#my-main', //id of drop zone element 1
                    {
                        url: "upload.php/?type=post",
                        acceptedFiles: "image/*",
                        maxFilesize: 100,
                        addRemoveLinks: true,
                        maxFiles: 1,
                        renameFilename: renameFilenamef,
                        removedfile: function (file) {
                            var nameF = renameFilenamef(file.name);
                            $.ajax({
                                type: 'POST',
                                url: 'delete.php/?type=post',
                                data: "file=" + nameF,
                                dataType: 'html'
                            });
                            var _ref;
                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                        },
                        init: function () {
                            thisDropzone = this;
                            var id = $('.post-id').val();
                            <!-- 4 -->
                            $.get('upload.php/?type=post', {postidmain: id})
                                    .done(function (data) {
                                        $.each(data, function (index, item) {
                                            //// Create the mock file:
                                            var mockFile = {
                                                name: item.name,
                                                size: item.size,
                                                status: Dropzone.ADDED,
                                                accepted: true
                                            };
                                            // Call the default addedfile event handler
                                            thisDropzone.emit("addedfile", mockFile);
                                            // And optionally show the thumbnail of the file:
                                            //thisDropzone.emit("thumbnail", mockFile, "uploads/"+item.name);
                                            thisDropzone.createThumbnailFromUrl(mockFile, "../uploads/images/main/" + item.name);
                                            thisDropzone.emit("complete", mockFile);
                                            thisDropzone.files.push(mockFile);
                                        });
                                    });
                        }
                    }
            );
        });
    </script>
</div>