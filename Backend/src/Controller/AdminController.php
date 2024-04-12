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
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\JwtAuth;

#[Route('/admin', name: 'app_admin')]
class AdminController extends AbstractController
{
    #[Route('/asignaturas/crear', name: 'app_asignaturas_crear', methods: ['POST'])]
    public function crearAsignaturas(Request $request,JwtAuth $jwt_auth ,EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {   
        
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $json = json_decode($request->getContent(), true);

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){

                $asignatura = new Asignatura();
                $asignatura->setNombre($json['nombre']);
                $asignatura->setDescripcion($json['descripcion']);
                $asignatura->setImg($json['img']);
                        
        
                $entityManager->persist($asignatura);
                $entityManager->flush();

                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Asignatura creada correctamente'
                ];

            }else{
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No tienes permiso para realizar esta acción'
                ];
               
            }
                
            
        }


        return new JsonResponse($data);
    }




    #[Route('/aulas/crear', name: 'crear_aula', methods: ['POST'])]
    public function crearAulas(Request $request,JwtAuth $jwt_auth,EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $json = json_decode($request->getContent(), true);

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){

                $aula=new Aula();
                $aula->setNombre($json['nombre']);
                $aula->setCapacidad($json['capacidad']);
                        
        
                $entityManager->persist($aula);
                $entityManager->flush();


                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Aula creado con éxito'
                ];

            }else{
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No tienes permiso para realizar esta acción'
                ];
               
            }
                
            
        }

        return new JsonResponse($data);
    }


    #[Route('/clase/crear', name: 'crear_clase', methods: ['POST'])]
    public function crearClase(Request $request,JwtAuth $jwt_auth ,SerializerInterface $serializer, EntityManagerInterface $entityManager, AsignaturaRepository $ar, AulaRepository $aulaRepository, DiasSemanaRepository $ds, ProfesorRepository $pr, ClaseRepository $cr)
    {
        //Recoger token 
        $token = $request->headers->get('Authorization');


        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $json = json_decode($request->getContent(), true);

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                $clase = new Clase();
                $clase->setHoraInicio(new \DateTime($json['horaInicio']));
                $clase->setHoraFin(new \DateTime($json['horaFin']));
                
        
                $asignatura = $ar->find($json['asignatura']);
                $profesor = $pr->find($json['profesor']);
                $aula = $aulaRepository->find($json['aula']);
        
                if ($asignatura && $profesor && $aula) {
                    
                    $clase->setAsignatura($asignatura);
                    $clase->setProfesor($profesor);
                    $clase->setAula($aula);
            
                    foreach ($json['dias'] as $diaId) {
                        $dia = $ds->find($diaId);
                        if ($dia) {
                            $clase->addDia($dia);
                        }
                    }
        
                    $entityManager->persist($clase);
                    $entityManager->flush();
            
                    $data = [
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Clase creada con éxito'
                    ];
                }else{
                    $data = [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'No se ha podido crear la clase'
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

    
}
