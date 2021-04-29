<?php

namespace App\Controller;

class Users
{
    public function run()
    {
        $pdo = \App\Service\DB::get();
        $stmt = $pdo->prepare("
            SELECT
                *
            FROM
                `users`
        ");

        $stmt->execute();

        $view = new \App\View\Users();
        $view->render([
            'title' => 'Пользователи',
            'data' => $stmt->fetchAll()
        ]);
    }

    public function runAdd()
    {
        $errors = [];

        if ($_POST && ! $errors = $this->checkData($_POST)) {
            var_dump($_POST);
            $pdo = \App\Service\DB::get();
            $stmt = $pdo->prepare("
                INSERT INTO
                    `users`(
                        `name`,
                        `email`,
                        `password`
                    ) VALUES (
                        :name,
                        :email,
                        :password
                    )
            ");

            $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':password' => sha1($_POST['password'])
            ]);
            header('Location: /users');
            return;
        }
        $view = new \App\View\Users\Form();
        $view->render([
            'data' => $_POST,
            'errors' => $errors
        ]);
    }

    public function runEdit()
    {
        $pdo = \App\Service\DB::get();
        $stmt = $pdo->prepare("
            SELECT
                *
            FROM
                `users`
            WHERE
                `id` = :id
        ");

        $stmt->execute([
            ':id' => $_GET['id']
        ]);

        $user = $stmt->fetch();
        
        $errors = [];
        if ($_POST && ! $errors = $this->checkData($_POST)) {
            $stmt = $pdo->prepare("
                UPDATE
                    `users`
                SET
                    `name`=:name,
                    `email`=:email,
                    `password` = :password
                WHERE
                    `id` = :id
            ");

            $stmt->execute([
                ':name' => $_POST['name'],
                ':email' =>$_POST['email'],
                ':password' => $_POST['password'] !== '' ? sha1($_POST['password']) : $user['password'],
                ':id' => $_GET['id']
            ]);

            header('Location: /users');
            return;
        }

        $view = new \App\View\Users\Form();
        $view->render([
            'data' => $user,
            'errors' => $errors,
            'user-id' => $_GET['id'],   
        ]);
    }

    private function checkData($data)
    {
        $errors = [];
        if (isset($data['password'], $data['confirm-password']) && $data['password'] !== $data['confirm-password']) {
            $errors['password'] = 'Неправильно заполнено поле пароль';
        }

        if (!isset($data['name']) || $data['name'] === '') {
            $errors['name'] = 'Введите ваше имя!';
        }
        return $errors;
    }

    public function runImages()
    {
        $pdo = \App\Service\DB::get();
        $stmt = $pdo->prepare("
            SELECT
                *
            FROM
                `user_images`
            WHERE
                `id_user` = :id_user
        ");

        $stmt->execute([
            ':id_user' => $_GET['id']
        ]);

        $view = new \App\View\Users\Images();
        $view->render([
            'title' => 'Фото пользователя',
            'data' => $stmt->fetchAll(),
            'id-user' => $_GET['id']
        ]);
    }

    public function runImagesAdd()
    {
        if ($_FILES) {
            //echo sys_get_temp_dir();
            var_dump($_FILES);
            return;
        }
        $view = new \App\View\Users\ImagesForm();
        $view->render([
            'id-user' => $_GET['id']
        ]);
    }
}