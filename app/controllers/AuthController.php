<?php

namespace app\controllers;

use flight\Engine;
use app\repositories\UserRepository;
use app\services\UserService;
use app\services\Validator;

class AuthController {

  protected Engine $app;

  public function __construct(Engine $app) {
    $this->app = $app;
  }

  public function showRegister() {
    $this->app->render('auth/register', [
      'values' => ['nom'=>'','prenom'=>'','email'=>'','telephone'=>''],
      'errors' => ['nom'=>'','prenom'=>'','email'=>'','password'=>'','confirm_password'=>'','telephone'=>''],
      'success' => false
    ]);
  }

  //la méthode appelée en AJAX (via POST /api/validate/register) pour vérifier en temps réel 
  // si les données du formulaire d’inscription sont valides, sans recharger la page.
  public function validateRegisterAjax() {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $pdo  = $this->app->db();
      $repo = new UserRepository($pdo);

      $req = $this->app->request();

      $input = [
        'nom' => $req->data->nom,
        'prenom' => $req->data->prenom,
        'email' => $req->data->email,
        'password' => $req->data->password,
        'confirm_password' => $req->data->confirm_password,
        'telephone' => $req->data->telephone,
      ];

      $res = Validator::validateRegister($input, $repo);

      $this->app->json([
        'ok' => $res['ok'],
        'errors' => $res['errors'],
        'values' => $res['values'],
      ]);
    } catch (Throwable $e) {
      http_response_code(500);
      $this->app->json([
        'ok' => false,
        'errors' => ['_global' => 'Erreur serveur lors de la validation.'],
        'values' => []
      ]);
    }
  }

  //creation d'un nouveau user
  public function postRegister() {
    $pdo  = $this->app->db();
    $repo = new UserRepository($pdo);
    $svc  = new UserService($repo);

    $req = $this->app->request();

    $input = [
      'nom' => $req->data->nom,
      'prenom' => $req->data->prenom,
      'email' => $req->data->email,
      'password' => $req->data->password,
      'confirm_password' => $req->data->confirm_password,
      'telephone' => $req->data->telephone,
    ];

    $res = Validator::validateRegister($input, $repo);

    if ($res['ok']) {
      $svc->register($res['values'], (string)$input['password']);
      $this->app->render('auth/register', [
        'values' => ['nom'=>'','prenom'=>'','email'=>'','telephone'=>''],
        'errors' => ['nom'=>'','prenom'=>'','email'=>'','password'=>'','confirm_password'=>'','telephone'=>''],
        'success' => true
      ]);
      return;
    }

    $this->app->render('auth/register', [
      'values' => $res['values'],
      'errors' => $res['errors'],
      'success' => false
    ]);
  }
}