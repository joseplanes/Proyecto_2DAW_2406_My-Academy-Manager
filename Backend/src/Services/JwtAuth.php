<?php

namespace App\Services;

use Firebase\JWT\JWT;
use App\Entity\Usuario;

class JwtAuth
{
    public $manager;
    public function __construct($manager)
    {
        $this->manager = $manager;
        $this->key='cp';
    }


    public function singup($email, $password, $gettoken=null){
        //Comprobar si el usuario existe
        $user=$this->manager->getRepository(Usuario::class)->findOneBy([
            'email'=>$email,
            'password'=>$password
        ]);

        $signup=false;

        if(is_object($user)){
            $signup=true;
        }
        
        //Si existe, devolver token jwt
        if($signup){
            
            $token = [
                'sub' => $user->getId(),
                'email' => $user->getEmail(),
                'nombre' => $user->getNombre(),
                'apellidos' => $user->getApellidos(),
                'rol' => $user->getRol(),
                'id_profesor' => ($user->getRol() == 'profesor') ? $user->getProfesors()->first()->getId() : null,
                'id_alumno' => ($user->getRol() == 'alumno') ? $user->getAlumnos()->first()->getId() : null,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            ];

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);




            //Devolver datos decodificados o token en funcion de un parametro
            if($gettoken){
                $data = $jwt;
            }else{
                $data = $decoded;
            }

        //Comprobar si las credenciales son correctas

        //Devolver token jwt

    }
    else{
        $data = [
            'status' => 'error',
            'message' => 'Login incorrecto'
        ];
    }
    return $data;
    }


    public function checkToken($jwt, $identity=false){
        $auth=false;

        try{
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        }catch(\UnexpectedValueException $e){
            $auth=false;
        }catch(\DomainException $e){
            $auth=false;
        }

        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth=true;
        }else{
            $auth=false;
        }

        if($identity){
            return $decoded;
        }

        return $auth;
    }
}
