<?php
/**
 * Created by PhpStorm.
 * User: Трик
 * Date: 10.07.2016
 * Time: 22:02
 */

require_once "config_class.php";
require_once "user_class.php";
require_once "object_class.php";
require_once "images_class.php";
require_once "post_class.php";

class Manager {
    private $config;
    private $user;
    private $data;
    private $object; 
    private $user_info;
    private $images;
    private $post;

    public function __construct($db)
    {
        session_start();
        $this->config = new Config();
        $this->user = new User($db);
        $this->object = new Object($db);
        $this->user_info =  $this->getUser();
        $this->data = $this->secureData($_REQUEST);
        $this->images = new Images($db);
        $this->post = new Post($db);
    }

    private function getUser(){
        $login = $_SESSION["login"];
        $password = $_SESSION["password"];
        if ($this->user->checkUser($login, $password)) return $this->user->getUserOnLogin($login);
        else return false;
    }

    private function secureData($data){
        foreach ($data as $key => $value) {
            if (is_array($value)) $this->secureData($value);
            else $data[$key] = htmlspecialchars($value);
        }
        return $data;
    }

    public function redirect($link) {
        header("Location: $link");
        exit;
    }

    public function regUser() {
        $link_reg = $this->config->siteAddress."cabinet/?view=reg";
        $login = $this->data["reg_login"];
        if ($this->user->isExistsUser($login)) return $this->returnMessage("EXISTS_LOGIN","warning", $link_reg);
        $password = $this->data["reg_password"];
        if ($password == "") return $this->unknownError($link_reg);
        $password = $this->hashPassword($password);
        $name = $this->data["reg_name"];
        $email = $this->data["reg_email"];
        $contact = $this->data["reg_contact"];
        $result = $this->user->addUser($login, $password, $name, $email, $contact, 1);
        if ($result)  return $this->returnMessage("SUCCESS_REG", "success", $this->config->siteAddress."cabinet/");
        else return $this->unknownError($link_reg);
    }

    public function regPubUser() {
        $link_reg = $this->config->siteAddress."cabinet/register.php";
        $login = $this->data["reg_login"];
        if ($this->user->isExistsUser($login)) return $this->returnMessage("EXISTS_LOGIN","warning", $link_reg);
        $password = $this->data["reg_password"];
        if ($password == "") return $this->unknownError($link_reg);
        $password = $this->hashPassword($password);
        $name = $this->data["reg_name"];
        $email = $this->data["reg_email"];
        $contact = $this->data["reg_contact"];
        $result = $this->user->addUser($login, $password, $name, $email, $contact, 0);
        if ($result)  return $this->returnMessage("SUCCESS_REG", "success", $this->config->siteAddress."cabinet/");
        else return $this->unknownError($link_reg);
    }

    public function editUser() {
        $link_edit = $_SERVER["HTTP_REFERER"];
        $password = $this->data["edit_password"];
        if ($password == "") $password = $this->user_info["password"];
        else $password = $this->hashPassword($password);
        $name = $this->data["edit_name"];
        $email = $this->data["edit_email"];
        $id = $this->user_info["id"];
        $login = $this->user_info["login"];
        $contact = $this->data["edit_contact"];
        $result = $this->user->editUser($id, $login ,$password, $name, $email, $contact);
        if ($result)  return $this->returnMessage("SUCCESS_EDIT", "success", $this->config->siteAddress."cabinet/");
        else return $this->unknownError($link_edit);
    }

    public function editUserAdm() {
        $user_ = $this->user->getUserOnLogin($this->data["edit_login"]);
        $link_edit = $_SERVER["HTTP_REFERER"];
        $password = $this->data["edit_password"];
        if ($password == "") $password = $user_["password"];
        else $password = $this->hashPassword($password);
        $name = $this->data["edit_name"];
        $email = $this->data["edit_email"];
        $id = $user_["id"];
        $login = $user_["login"];
        $contact = $this->data["edit_contact"];
        $trust = $this->data["edit_trust"];
        $result = $this->user->editUser($id, $login ,$password, $name, $email, $contact, $trust);
        if ($result)  return $this->returnMessage("SUCCESS_EDIT", "success", $this->config->siteAddress."cabinet/");
        else return $this->unknownError($link_edit);
    }

    public function login() {        
        $login = $this->data["login"];
        $password = $this->data["password"];
        $password = $this->hashPassword($password);        
        $session_key = $this->hashSessionKey($login);
        $r = $this->config->siteAddress."cabinet/";
        if ($this->user->checkUser($login, $password)) {            
            $_SESSION["login"] = $login;
            $_SESSION["password"] = $password;
            $_SESSION["session_key"] = $session_key;
            return $r;
        }
        else {
            return $this->returnMessage("FAIL_AUTH", "warning", $r);
        }
    }
    
    public function addPost() {
        $link_ = $this->config->siteAddress."cabinet/?view=post";
        $title = $this->data["title"];
        $text = $this->data["text"];
        $text_desc = $this->data["text_desc"];
        $section = $this->data["section"];
        $on_main = $this->data["post_mainpage"];
        $type_img = $this->data["img_type"];
        $date = time();
        $result = $this->post->addPost(array("title" => $title, "text" => $text,"text_desc" => $text_desc, "date" => $date, "section_id" => $section, "on_main" => $on_main, "type_img" => $type_img));
        if ($result)  return $this->returnMessage("SUCCESS_ADD_POST", "success", $link_);
        else return $this->unknownError($link_);
    }

    public function editPost() {
        $link_ = $this->config->siteAddress."cabinet/?view=post";
        $id = $this->data["id"];
        $title = $this->data["title"];
        $text = $this->data["text"];
        $section = $this->data["section"];
        $text_desc = $this->data["text_desc"];
        $on_main = $this->data["post_mainpage"];
        $type_img = $this->data["img_type"];
        $result = $this->post->editPost($id, $title, $text, $text_desc, $section, $on_main, $type_img);
        if ($result)  return $this->returnMessage("SUCCESS_EDIT_POST", "success", $link_);
        else return $this->unknownError($link_);
    }


    public function addObject(){
        $type = $this->data["obj_type"];
        $data = time();
        switch ($type) {
            case "1": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_1"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);                
                $geo = $this->data["obj_geo"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();                
                $created_id = ($this->user_info)? $this->user_info["id"]: 0;
                $result = $this->object->addObjType_1($comment, $comforts, $data, $geo,$type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $created_id, 0, $public, $spec_offer, 0);
                $this->CreateImg($this->data["obj_id"]);
                if ($result)  return $this->returnMessage("SUCCESS_ADD_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            case "2": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_2"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $build_type = $this->data["obj_build_type_2"];
                $home_floors = $this->data["obj_home_floors_2"];
                $square = $this->data["obj_house_square"];
                $distance = $this->data["obj_distance"];
                $earth_square = $this->data["obj_earth_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);                
                $geo = $this->data["obj_geo"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $comment = $this->checkStringBr($this->data["obj_comment"]);                
                $comforts = $this->getComfortsId();
                $created_id = ($this->user_info)? $this->user_info["id"]: 0;
                $result = $this->object->addObjType_2($comment,$comforts, $data, $geo, $type, $deal, $form, $city, $area, $address, $distance, $earth_square, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $created_id, 0, $public, $spec_offer, 0);
                $this->CreateImg($this->data["obj_id"]);
                if ($result)  return $this->returnMessage("SUCCESS_ADD_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            case "3": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_3"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);                
                $geo = $this->data["obj_geo"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();                
                $created_id = ($this->user_info)? $this->user_info["id"]: 0;
                $result = $this->object->addObjType_1($comment, $comforts, $data, $geo, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $created_id, 0, $public, $spec_offer, 0);
                $this->CreateImg($this->data["obj_id"]);
                if ($result)  return $this->returnMessage("SUCCESS_ADD_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            default: break;
        }
    }

    public function addUserObject(){
        $type = $this->data["obj_type"];
        $data = time();
        switch ($type) {
            case "1": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_1"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $geo = $this->data["obj_geo"];
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $user_created_id = ($this->user_info)? $this->user_info["id"]: 0;
                $result = $this->object->addObjType_1($comment, $comforts, $data, $geo,$type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, 0, $user_created_id, 0, 0, 1);
                $this->CreateImg($this->data["obj_id"]);
                if ($result)  return $this->returnMessage("SUCCESS_ADD_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            case "2": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_2"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $build_type = $this->data["obj_build_type_2"];
                $home_floors = $this->data["obj_home_floors_2"];
                $square = $this->data["obj_house_square"];
                $distance = $this->data["obj_distance"];
                $earth_square = $this->data["obj_earth_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $geo = $this->data["obj_geo"];
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $user_created_id = ($this->user_info)? $this->user_info["id"]: 0;
                $result = $this->object->addObjType_2($comment,$comforts, $data, $geo, $type, $deal, $form, $city, $area, $address, $distance, $earth_square, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, 0, $user_created_id, 0, 0, 1);
                $this->CreateImg($this->data["obj_id"]);
                if ($result)  return $this->returnMessage("SUCCESS_ADD_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            case "3": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_3"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $geo = $this->data["obj_geo"];
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $user_created_id = ($this->user_info)? $this->user_info["id"]: 0;
                $result = $this->object->addObjType_1($comment, $comforts, $data, $geo, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, 0, $user_created_id, 0, 0, 1);
                $this->CreateImg($this->data["obj_id"]);
                if ($result)  return $this->returnMessage("SUCCESS_ADD_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            default: break;
        }
    }


    private function CreateImg($obj_id){
        $tmp_img = $this->images->getTmpImg($obj_id);
        $ROOT = $_SERVER['DOCUMENT_ROOT'];
        $obj_id = $this->object->getLast();
        $folder = $ROOT.$tmp_img[0]["src_folder"];
        $new_folder = $ROOT."/uploads/".$obj_id;
        for ($i = 0; $i < count($tmp_img); $i++) {
            if (!file_exists($new_folder)) {
                mkdir($new_folder);
            }
            rename($folder.$tmp_img[$i]["new_name"], $new_folder."/".$tmp_img[$i]["new_name"]);
            rename($folder."thumb-".$tmp_img[$i]["new_name"], $new_folder."/thumb-".$tmp_img[$i]["new_name"]);
            $this->images->editImage($tmp_img[$i]["id"], "/uploads/".$obj_id."/", $obj_id);
        }
    }

    public function editObject() {
        $type = $this->data["obj_type"];
        $id = $this->data["obj_id"];
        switch ($type) {
            case "1":
                $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_1"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград") ? $this->data["obj_area_1"] : $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc =   $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_1($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $spec_offer, $public);
                if ($result) return $this->returnMessage("SUCCESS_EDIT_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            case "2":                
                $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_2"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград") ? $this->data["obj_area_1"] : $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $build_type = $this->data["obj_build_type_2"];
                $home_floors = $this->data["obj_home_floors_2"];
                $square = $this->data["obj_house_square"];
                $distance = $this->data["obj_distance"];
                $earth_square = $this->data["obj_earth_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);                
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_2($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $distance, $earth_square, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $spec_offer, $public);
                if ($result) return $this->returnMessage("SUCCESS_EDIT_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            case "3":
                $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_3"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград") ? $this->data["obj_area_1"] : $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);                
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_1($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $spec_offer, $public);
                if ($result) return $this->returnMessage("SUCCESS_EDIT_OBJ", "success",  $this->config->siteAddress."cabinet/");
                break;
            default:
                break;
        }
    }

    public function editActivObject() {
        $type = $this->data["obj_type"];
        $id = $this->data["obj_id"];
        switch ($type) {
            case "1":
                $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_1"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград") ? $this->data["obj_area_1"] : $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc =   $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_1($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $spec_offer, $public);
                if ($result) {
                    $date = time();
                    $this->object->editActivate($id, $date);
                    return $this->returnMessage("SUCCESS_EDIT_OBJ", "success", $this->config->siteAddress."cabinet/");
                }
                break;
            case "2":
                $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_2"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград") ? $this->data["obj_area_1"] : $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $build_type = $this->data["obj_build_type_2"];
                $home_floors = $this->data["obj_home_floors_2"];
                $square = $this->data["obj_house_square"];
                $distance = $this->data["obj_distance"];
                $earth_square = $this->data["obj_earth_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_2($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $distance, $earth_square, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $spec_offer, $public);
                if ($result) {
                    $date = time();
                    $this->object->editActivate($id, $date);
                    return $this->returnMessage("SUCCESS_EDIT_OBJ", "success", $this->config->siteAddress."cabinet/");
                }
                break;
            case "3":
                $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_3"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград") ? $this->data["obj_area_1"] : $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $public = $this->data["obj_public"];
                $spec_offer = $this->data["obj_spec_offer"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_1($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, $spec_offer, $public);
                if ($result) {
                    $date = time();
                    $this->object->editActivate($id, $date);
                    return $this->returnMessage("SUCCESS_EDIT_OBJ", "success", $this->config->siteAddress."cabinet/");
                }
                break;
            default:
                break;
        }
    }

    public function editUserObject(){
        $type = $this->data["obj_type"];
        $id = $this->data["obj_id"];
        switch ($type) {
            case "1": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_1"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_1($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, 0, 0);
                if ($result) return $this->returnMessage("SUCCESS_EDIT_OBJ", "success",  $this->config->siteAddress."cabinet/");
                break;
            case "2": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_2"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $build_type = $this->data["obj_build_type_2"];
                $home_floors = $this->data["obj_home_floors_2"];
                $square = $this->data["obj_house_square"];
                $distance = $this->data["obj_distance"];
                $earth_square = $this->data["obj_earth_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->addObjType_2($comment,$comforts, $id, $type, $deal, $form, $city, $area, $address, $distance, $earth_square, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, 0, 0);
                if ($result)  return $this->returnMessage("SUCCESS_EDIT_OBJ", "success", $this->config->siteAddress."cabinet/");
                break;
            case "3": $deal = $this->data["obj_deal"];
                $form = $this->data["obj_form_3"];
                $city = $this->data["obj_city"];
                $area = ($city == "Волгоград")? $this->data["obj_area_1"]: $this->data["obj_area_2"];
                $address = $this->data["obj_address"];
                $room = $this->data["obj_room"];
                $floor = $this->data["obj_floor"];
                $build_type = $this->data["obj_build_type_1"];
                $home_floors = $this->data["obj_home_floors_1"];
                $square = $this->data["obj_square"];
                $kadastr = $this->data["obj_kadastr"];
                $desc = $this->checkStringBr($this->data["obj_desc"]);
                $price_square = $this->data["obj_price_square"];
                $price = $this->data["obj_price"];
                $doplata = $this->data["obj_doplata"];
                $contacts = $this->checkStringBr($this->data["obj_client_contact"]);
                $comment = $this->checkStringBr($this->data["obj_comment"]);
                $comforts = $this->getComfortsId();
                $result = $this->object->editObjType_1($comment, $comforts, $id, $type, $deal, $form, $city, $area, $address, $room, $floor, $build_type, $home_floors, $square, $kadastr, $desc, $price_square, $price, $doplata, $contacts, 0, 0);
                if ($result) return $this->returnMessage("SUCCESS_EDIT_OBJ", "success",  $this->config->siteAddress."cabinet/");
                break;
            default: break;
        }
    }

    public function logout() {
        unset($_SESSION["login"]);
        unset($_SESSION["password"]);
        unset($_SESSION["session_key"]);
        return $_SERVER["HTTP_REFERER"];
    }

    private function getComfortsId(){
        $text = "";
        $comforts = $this->comfort->getLast() + 1;
        for ($i = 1; $i < $comforts; $i++) {
            $text .= (isset($this->data["comfort-".$i]))? $this->data["comfort-".$i].",": "";
        }
        $text = substr($text, 0 , -1);
        return $text;
    }

    private function checkStringBr($string){
       $string = str_replace(array("\r\n", "\r", "\n"), "\\n", $string);
        return $string;
    }
    
    private function hashPassword($password) {
        return md5($password.$this->config->secret);
    }

    private function hashSessionKey($login) {
        return md5($login.$this->config->secret);
    }

    private function unknownError($r) {
        return $this->returnMessage("UNKNOWN_ERROR", "warning", $r);
    }

    private function returnMessage($message, $type, $r) {
        $_SESSION["message"] = $message;
        $_SESSION["type_message"] = $type;
        return $r;
    }

    private function returnPageMessage($message, $r) {
        $_SESSION["page_message"] = $message;
        return $r;
    }
}