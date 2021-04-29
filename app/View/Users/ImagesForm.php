<?php

namespace App\View\Users;

class ImagesForm extends \App\View\Main
{
    public function content($data = [])
    {
        ?>
            <div class="block">
                <div class="block-header">
                    <ul class="block-options">
                        <li>
                            <button type="button"><i class="si si-settings"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Добавления изображения к пользователю</h3>
                </div>
                <div class="block-content">
                    <form class="form-horizontal push-10-t" action="/users/images/add?id=<?= $data['id-user'] ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-xs-12" for="example-file-input">Выберите изображение</label>
                            <div class="col-xs-12">
                                <input type="file" id="example-file-input" name="image-file">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <button class="btn btn-sm btn-primary" type="submit">Отправить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
}