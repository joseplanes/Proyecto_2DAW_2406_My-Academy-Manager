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

#[Route('/api/admin', name: 'app_admin')]
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

                    if($nombre==null && $descripcion==null && $img==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han rellenado todos los campos'
                        ];
                        return new JsonResponse($data);
                    }
                    if($nombre==null && $descripcion==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han rellenado el nombre y la descripción'
                        ];
                        return new JsonResponse($data);

                    }
                    if($nombre==null && $img==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han rellenado el nombre y la imagen'
                        ];
                        return new JsonResponse($data);

                    }
                    if($descripcion==null && $img==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han rellenado la descripción y la imagen'
                        ];
                        return new JsonResponse($data);

                    }
                    if($nombre==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se ha rellenado el nombre'
                        ];
                        return new JsonResponse($data);
                    }
                    if($descripcion==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se ha rellenado la descripción'
                        ];
                        return new JsonResponse($data);
                    }
                    if($img==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se ha rellenado la imagen'
                        ];
                        return new JsonResponse($data);
                    }


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

                    if($nombre==null && $capacidad==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han rellenado todos los campos'
                        ];
                        return new JsonResponse($data);
                    }
                    
                    if($capacidad==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se ha rellenado la capacidad'
                        ];
                        return new JsonResponse($data);
                    }
                    if($capacidad<1){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'La capacidad no puede ser menor que 1'
                        ];
                        return new JsonResponse($data);
                    }
                    if($nombre==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se ha rellenado el nombre'
                        ];
                        return new JsonResponse($data);
                    }
                    if($capacidad==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se ha rellenado la capacidad'
                        ];
                        return new JsonResponse($data);
                    }
                    if($nombre==null || $capacidad==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han rellenado todos los campos'
                        ];
                        return new JsonResponse($data);
                    }
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
                    $horai= new \DateTime($hora_inicio);
                    $horaf= new \DateTime($hora_fin);
                    if($horaf<$horai){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'La hora de inicio no puede ser mayor que la hora de fin'
                        ];
                        return new JsonResponse($data);
                    }
                    if($dias==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han seleccionado los días de la semana'
                        ];
                        return new JsonResponse($data);

                    }
                    if($hora_inicio==null || $hora_fin==null || $asignatura==null || $profesor==null || $aula==null){
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han rellenado todos los campos'
                        ];
                        return new JsonResponse($data);
                    }

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
    
    
    #[Route('/eliminar/clase/{id}', name: 'eliminar_clase', methods: ['GET'])]
    public function eliminarClase($id,Request $request,JwtAuth $jwt_auth ,SerializerInterface $serializer, EntityManagerInterface $entityManager,ClaseRepository $cr)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                $clase = $cr->findOneBy(['id' => $id]);
                $alumnos = $clase->getAlumnos();
                $dias = $clase->getDias();
                $calificaciones = $clase->getCalificacions();
                $asistencia= $clase->getAsistencias();
                if ($clase) {
                    foreach ($alumnos as $alumno) {
                        $clase->removeAlumno($alumno);
                    }
                    foreach ($dias as $dia) {
                        $clase->removeDia($dia);
                    }
                    foreach ($calificaciones as $calificacion) {
                        $entityManager->remove($calificacion);
                    }
                    foreach ($asistencia as $asist) {
                        $entityManager->remove($asist);
                    }
                    $entityManager->remove($clase);
                    $entityManager->flush();
                    $data = [
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Clase eliminada con éxito'
                    ];
                }else{
                    $data = [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'No se ha podido eliminar la clase'
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


    #[Route('/eliminar/alumno/{clase}/{id}', name: 'eliminar_alumnoclase', methods: ['GET'])]
    public function eliminarAlumnoClase($id,$clase,Request $request,JwtAuth $jwt_auth ,SerializerInterface $serializer,AlumnoRepository $ar, EntityManagerInterface $entityManager, ClaseRepository $cr)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin'){
                $clase = $cr->findOneBy(['id' => $clase]);
                $alumno = $ar->findOneBy(['id' => $id]);
                if ($alumno) {
                    $clase->removeAlumno($alumno);
                    $entityManager->persist($clase);
                    $entityManager->flush();
                    $data = [
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Alumno eliminado con éxito'
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
    
    #[Route('/add/alumno/{clase}', name: 'añadir_alumnoclase', methods: ['POST'])]
    public function anadirAlumnoClase($clase,Request $request,JwtAuth $jwt_auth ,SerializerInterface $serializer,AlumnoRepository $ar, EntityManagerInterface $entityManager, ClaseRepository $cr)
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
                    $alumnos= (!empty($params->alumnos)) ? $params->alumnos : null;
                    $clase=$cr->findOneBy(['id' => $clase]);
                    $capacidad=$clase->getAula()->getCapacidad();
                    $numalumnos=$clase->getAlumnos()->count();

                    if ($alumnos && $clase) {
                        foreach ($alumnos as $alumnoId) {
                            $alumno = $ar->findOneBy(['id' => $alumnoId]);
                            if ($alumno) {
                                if($numalumnos<$capacidad){
                                    $clase->addAlumno($alumno);
                                    $numalumnos++;
                                }else{
                                    $data = [
                                        'status' => 'error',
                                        'code' => 400,
                                        'message' => 'El aula es de capacidad '.$capacidad.'. Seleccione menos alumnos'
                                    ];
                                    return new JsonResponse($data);
                                }
                            }
                        }
            
                        $entityManager->persist($clase);
                        $entityManager->flush();
                
                        $data = [
                            'status' => 'success',
                            'code' => 200,
                            'message' => 'Alumnos añadidos con éxito'
                        ];
                    }else{
                        $data = [
                            'status' => 'error',
                            'code' => 400,
                            'message' => 'No se han podido añadir a los nuevos alumnos'
                        ];
                    
                    }
                }else{
                    $data = [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'No se han podido añadir a los nuevos alumnos'
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
