<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Clase;
use App\Repository\ClaseRepository;
use App\Entity\Profesor;
use App\Repository\ProfesorRepository;
use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use App\Entity\Alumno;
use App\Repository\AlumnoRepository;
use App\Entity\Asignatura;
use App\Repository\AsignaturaRepository;
use App\Entity\Aula;
use App\Repository\AulaRepository;
use App\Entity\Calificacion;
use App\Repository\CalificacionRepository;
use App\Entity\DiasSemana;
use App\Repository\DiasSemanaRepository;
use App\Entity\Mensaje;
use App\Repository\MensajeRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\JwtAuth;

#[Route('/list', name: 'app_list')]
class ListController extends AbstractController
{
    #[Route('/asignaturas', name: 'app_asignaturas', methods: ['GET'])]
    public function listarAsignaturas(Request $request,JwtAuth $jwt_auth , AsignaturaRepository $ar,SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            
            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){

                $asignaturas = $ar->findAll();

                $datos = $serializer->serialize($asignaturas, 'json', ['groups' => 'asignaturas', 'max_depth' => 1]);

                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];

            }else{
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No tienes permiso para realizar esta acción'
                ];
               
            }
                
            
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'No tienes permiso para realizar esta acción'
            ];
           
        }


        return new JsonResponse($data);
    }

    #[Route('/usuarios', name: 'app_users', methods: ['GET'])]
    public function listarUsuarios(Request $request,JwtAuth $jwt_auth ,UsuarioRepository $ur, SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            
            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                            
                $usuarios = $ur->findAll();
        
                $datos = $serializer->serialize($usuarios, 'json', ['groups' => 'usuario', 'max_depth' => 1]);
        
                    
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
                                
            }else{
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No tienes permiso para realizar esta accióna'
                ];
            }
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'No tienes permiso para realizar esta acción'
            ];
            
        }

        return new JsonResponse($data);
    }


    #[Route('/clases', name: 'app_claselist', methods: ['GET'])]
    public function listarClases(Request $request, JwtAuth $jwt_auth , ClaseRepository $cr, SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                    
                $clases = $cr->findAll();
    
                $datos = $serializer->serialize($clases, 'json',['groups' => 'clase', 'max_depth' => 1]);
    
                
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
    
            }else{
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No tienes permiso para realizar esta acción'
                ];
                
            }
                    
                
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'No tienes permiso para realizar esta acción'
            ];
            
        }

        return new JsonResponse($data);
    }



    #[Route('/aulas', name: 'app_aulas', methods: ['GET'])]
    public function listarAulas(Request $request,JwtAuth $jwt_auth ,AulaRepository $ar, SerializerInterface $serializer): Response
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $identity = $jwt_auth->checkToken($token, true);
            
            if($identity->rol == 'admin'){
                        
                $aulas = $ar->findAll();
        
                $datos = $serializer->serialize($aulas, 'json', ['groups' => 'aula', 'max_depth' => 1]);
        
                    
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
            }else{
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No tienes permiso para realizar esta acción'
                ];
                
            }
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'No tienes permiso para realizar esta acción'
            ];
            
        }

        return new JsonResponse($data);
    }


    #[Route('/profesores', name: 'app_profesores', methods: ['GET'])]
    public function listarProfesores(Request $request,JwtAuth $jwt_auth ,ProfesorRepository $pr, SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                            
                $profesores = $pr->findAll();
        
                $datos = $serializer->serialize($profesores, 'json', ['groups' => 'profesor', 'max_depth' => 1]);
        
                    
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
            }else{
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No tienes permiso para realizar esta acción'
                ];
                
            }
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'No tienes permiso para realizar esta acción'
            ];
            
        }

        return new JsonResponse($data);
    }

    #[Route('/dias', name: 'app_dias', methods: ['GET'])]
    public function listarDias(Request $request,JwtAuth $jwt_auth ,DiasSemanaRepository $ds, SerializerInterface $serializer): Response
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            
            $identity = $jwt_auth->checkToken($token, true);
                                
            $dias = $ds->findAll();
    
            $datos = $serializer->serialize($dias, 'json', ['groups' => 'dias', 'max_depth' => 1]);
    
                
            $data = [
                'status' => 'success',
                'code' => 200,
                'data' => $datos
            ];
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'No tienes permiso para realizar esta acción'
            ];
            
        }

        return new JsonResponse($data);
    }

    #[Route('/misclases', name: 'app_misclases', methods: ['GET'])]
    public function misClases(Request $request,JwtAuth $jwt_auth ,ClaseRepository $claseRepository, SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $json = json_decode($request->getContent(), true);

            $identity = $jwt_auth->checkToken($token, true);
            
            if($identity->rol == 'alumno'){

                $alumnoId = $identity->id_alumno;
                $clases = $claseRepository->createQueryBuilder('c')
                ->join('c.alumnos', 'a')
                ->where('a.id = :alumnoId')
                ->setParameter('alumnoId', $alumnoId)
                ->getQuery()
                ->getResult();
                
                $datos = $serializer->serialize($clases, 'json', ['groups' => 'clase', 'max_depth' => 1]);

                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
            }else if($identity->rol == 'profesor'){
                $clases = $claseRepository->findBy(['profesor' => $identity->id_profesor]);
    
                $datos = $serializer->serialize($clases, 'json', ['groups' => 'clase', 'max_depth' => 1]);
    
                
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
            }
        }else{
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'No tienes permiso para realizar esta acción'
            ];
            
        }

        return new JsonResponse($data);
    }


    

}
