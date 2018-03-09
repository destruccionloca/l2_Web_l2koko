<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.03.2018
 * Time: 17:34
 */

namespace App\Repositories;


use App\Application;
use App\Server;

class ApplicationsRepository extends Repository
{
    public function __construct(Application $application) {
        $this->model = $application;
    }

    public function getOne($email) {
        $result = Server::where('email',$email)->first();
        return $result;
    }

    public function checkApplication($server, $nomination){
        $result = $this->model->where('server_id',$server->id)->where('nomination_id', $nomination->id)->first();
        return $result;
    }

    public function add($request, $nomination) {
        $data = $request->except('_token', '_method');
        $server = $this->getOne($data['email']);
        if(!$server) {
            return array("error" => "Сервер с таким email не найден.");
        }
        if($this->checkApplication($server, $nomination)) {
            return array("error" => "Такая заявка уже существует");
        }
        $this->model->server_id = $server->id;
        $this->model->nomination_id = $nomination->id;
        if($this->model->save()) {
            return array("status" => "Заявка подана.");
        } else {
            return array("error" => "Ошибка подачи заявки.");
        }
    }


}