<?php

/**
 * On charge les DAO !
 */

require __DIR__ . '/DAO/Chat.DAO.php';
require __DIR__ . '/DAO/User.DAO.php';
require __DIR__ . '/DAO/Message.DAO.php';

/**
 * En premier lieu je stock l'URI et la méthode d'envoi
 *
 * J'explose l'URI et je la nettoie en enlevant la première entrée vide
 *
 * Mon URI est prête à être utilisée
 */

$uri = '';
$method = $_SERVER['REQUEST_METHOD'];

if (isset($_SERVER['PATH_INFO'])) {
    $uri = $_SERVER['PATH_INFO'];
}

$uri_exploded = explode('/', $uri);
$uri_exploded = array_slice($uri_exploded, 1);
$uri_parameters = count($uri_exploded);

switch ($uri_parameters) {
    case 1:
        switch ($method) {
            case 'GET':
                switch($uri_exploded[0]) {
                    case 'users':
                        $dao = new UserDAO();
                        $result = $dao->findAll();

                        foreach($result as $data) {
                            print_r($data->jsonSerialize());
                        }

                        break;
                    case 'chats':
                        $dao = new ChatDAO();
                        $result = $dao->findAll();

                        foreach($result as $data) {
                            print_r($data->jsonSerialize());
                        }

                        //print_r($result);
                        break;
                    default:
                        http_response_code(404);
                        break;
                }
                break;
            case 'POST':
                switch($uri_exploded[0]) {
                    case 'users':
                        $data = json_decode(file_get_contents('php://input'), true);
                        //print_r($data);
                        $dao = new UserDAO();
                        $dao->create($data);

                        break;
                    case 'chats':
                        $dao = new ChatDAO();
                        $foo = NULL;
                        $dao->create($foo);
                        break;
                    default:
                        http_response_code(404);
                        break;
                }
                break;
            default:
                http_response_code(404);
                break;
        }
        break;
    case 2:
        switch ($method) {
            case 'GET':
                switch($uri_exploded[0]) {
                    case 'users':
                        $dao = new UserDAO();
                        $user = $dao->find($uri_exploded[1]);

                        if($user) {
                            print_r($user->jsonSerialize());
                        } else {
                            http_response_code(404);
                        }

                        break;
                    case 'chats':
                        $dao = new ChatDAO();
                        $chat = $dao->find($uri_exploded[1]);

                        if($chat) {
                            print_r($chat->jsonSerialize());
                        } else {
                            http_response_code(404);
                        }
                        break;
                    case 'messages':
                        http_response_code(403);
                        break;
                }
                break;
            case 'POST':
                http_response_code(403);
                break;
            case 'PUT':
                switch($uri_exploded[0]) {
                    case 'users':
                        $dao = new UserDAO();
                        $credentials = json_decode(file_get_contents('php://input'), true);

                        $credentials['_id_user'] = $uri_exploded[1];

                        $done = $dao->update($credentials);

                        if($done) {
                            http_response_code(200);
                        } else {
                            http_response_code(500);
                        }

                        break;
                    default:
                        http_response_code(403);
                        break;
                }
                break;
            case 'DELETE':
                switch($uri_exploded[0]) {
                    case 'users':
                        $dao = new UserDAO();
                        $done = $dao->delete($uri_exploded[1]);

                        if($done) {
                            http_response_code(200);
                        } else {
                            http_response_code(500);
                        }
                        break;
                    default:
                        http_response_code(403);
                }
                break;
            default:
                break;
        }
        break;
    case 3:
        switch ($method) {
            case 'GET':
                switch($uri_exploded[0]) {
                    case 'users':
                        switch($uri_exploded[2]) {
                            case 'messages':
                                $dao = new MessageDAO();
                                $messages = $dao->findAllByUser($uri_exploded[1]);

                                foreach($messages as $message) {
                                    print_r($message->jsonSerialize());
                                }
                                break;
                            default:
                                http_response_code(403);
                        }
                        break;
                    case 'chats':
                        switch($uri_exploded[2]) {
                            case 'messages':
                                $dao = new MessageDAO();
                                $messages = $dao->findAllByChat($uri_exploded[1]);

                                foreach($messages as $message) {
                                    print_r($message->jsonSerialize());
                                }
                                break;
                            case 'users':
                                $dao = new UserDAO();
                                $users = $dao->findAllByChat($uri_exploded[1]);

                                if(!$users) {
                                    return http_response_code(404);
                                } else {
                                    foreach($users as $user) {
                                        print_r($user->jsonSerialize());
                                    }
                                }
                                break;
                            default:
                                http_response_code(403);
                        }
                        break;
                    default:
                        http_response_code(404);
                }
                break;
            case 'POST':
                switch($uri_exploded[0]) {
                    case 'chats':
                        switch($uri_exploded[2]) {
                            case 'messages':
                                $dao = new MessageDAO();
                                $message = json_decode(file_get_contents('php://input'), true);

                                $message[0] = $uri_exploded[1];

                                $done = $dao->create($message);

                                if($done) {
                                    http_response_code(201);
                                } else {
                                    http_response_code(500);
                                }

                                break;
                            default:
                                http_response_code(403);
                        }
                        break;
                    default:
                        http_response_code(404);
                }
                break;
            default:
                http_response_code(404);
                break;
        }
        break;
    default:
        http_response_code(404);
        break;
}