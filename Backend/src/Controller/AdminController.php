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

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                $json = $request->get('json', null);
                $params =  json_decode($json);
                if(!empty($json)){
                    $nombre= (!empty($params->nombre)) ? $params->nombre : null;
                    $descripcion= (!empty($params->descripcion)) ? $params->descripcion : null;
                    $img= (!empty($params->img)) ? $params->img : null;
                    $asignatura = new Asignatura();
                    $asignatura->setNombre($nombre);
                    $asignatura->setDescripcion($descripcion);
                    $asignatura->setImg($img);
                    
                    
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
                        'message' => 'No se ha podido crear la asignatura'
                    ];
                    
                }
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




    #[Route('/aulas/crear', name: 'crear_aula', methods: ['POST'])]
    public function crearAulas(Request $request,JwtAuth $jwt_auth,EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            
            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                $json = $request->get('json', null);
                $params =  json_decode($json);

                if(!empty($json)){
                    $nombre= (!empty($params->nombre)) ? $params->nombre : null;
                    $capacidad= (!empty($params->capacidad)) ? $params->capacidad : null;
                    $aula = new Aula();
                    $aula->setNombre($nombre);
                    $aula->setCapacidad($capacidad);
                    
                    $entityManager->persist($aula);
                    $entityManager->flush();
                    
                    $data = [
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Aula creada correctamente'
                    ];

                }else{
                    $data = [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'No se ha podido crear el aula'
                    ];
                
                }
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

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                $json = $request->get('json', null);
                $params =  json_decode($json);
                if(!empty($json)){
                    $hora_inicio= (!empty($params->horaInicio)) ? $params->horaInicio : null;
                    $hora_fin= (!empty($params->horaFin)) ? $params->horaFin : null;
                    $asignatura= (!empty($params->asignatura)) ? $params->asignatura : null;
                    $profesor= (!empty($params->profesor)) ? $params->profesor : null;
                    $aula= (!empty($params->aula)) ? $params->aula : null;
                    $dias= (!empty($params->dias)) ? $params->dias : null;

                    $clase=new Clase();

                    $clase->setHoraInicio(new \DateTime($hora_inicio));
                    $clase->setHoraFin(new \DateTime($hora_fin));

                    $idasignatura = $ar->findOneBy(['id' => $asignatura]);
                    $idprofesor = $pr->findOneBy(['id' => $profesor]);
                    $idaula = $aulaRepository->findOneBy(['id' => $aula]);

                    if ($idasignatura && $idprofesor && $idaula) {
                        
                        $clase->setAsignatura($idasignatura);
                        $clase->setProfesor($idprofesor);
                        $clase->setAula($idaula);
                
                        foreach ($dias as $diaId) {
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
