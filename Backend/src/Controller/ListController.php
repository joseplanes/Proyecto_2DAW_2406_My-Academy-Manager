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
use App\Entity\Asistencia;
use App\Repository\AsistenciaRepository;

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
    public function misClases(Request $request,JwtAuth $jwt_auth , ProfesorRepository $pr,AlumnoRepository $ar , SerializerInterface $serializer)
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
                $clases = $ar->find($alumnoId)->getClases();
                
                $datos = $serializer->serialize($clases, 'json', ['groups' => 'clasesalumno', 'max_depth' => 1]);

                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
            }else if($identity->rol == 'profesor'){
                $profesorId = $identity->id_profesor;
                $clases = $pr->find($profesorId)->getClases();
    
                $datos = $serializer->serialize($clases, 'json', ['groups' => 'clasesprofesor', 'max_depth' => 1]);
    
                
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


    #[Route('/misclaseshoy', name: 'app_misclaseshoy', methods: ['GET'])]
    public function misClasesHoy(Request $request,JwtAuth $jwt_auth , ClaseRepository $cr,ProfesorRepository $pr,AlumnoRepository $ar , SerializerInterface $serializer)
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
                $clasesid = $ar->find($alumnoId)->getClases();
                $today = new \DateTime();
                $today = new \DateTime();
                $todaynumber = $today->format('N');
                $clases = [];
                foreach($clasesid as $clase){
                    $claseDia= $clase->getDias();
                    foreach($claseDia as $dia){
                        if($dia->getId() == $todaynumber){
                            $clases[] = $clase;
                        }
                    }
                }
                
                $datos = $serializer->serialize($clases, 'json', ['groups' => 'clasesalumno', 'max_depth' => 1]);

                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
            }else if($identity->rol == 'profesor'){
                $profesorId = $identity->id_profesor;
                $clasesid = $pr->find($profesorId)->getClases();
                $today = new \DateTime();
                $todaynumber = $today->format('N');
                $clases = [];
                foreach($clasesid as $clase){
                    $claseDia= $clase->getDias();
                    foreach($claseDia as $dia){
                        if($dia->getId() == $todaynumber){
                            $clases[] = $clase;
                        }
                    }
                }
    
                $datos = $serializer->serialize($clases, 'json', ['groups' => 'clasesprofesor', 'max_depth' => 1]);
    
                
                $data = [
                    'status' => 'success',
                    'code' => 200,
                    'data' => $datos
                ];
            }
            else if($identity->rol == 'admin'){
                $clasesid = $cr->findAll();
                $today = new \DateTime();
                $todaynumber = $today->format('N');
                $clases = [];
                foreach($clasesid as $clase){
                    $claseDia= $clase->getDias();
                    foreach($claseDia as $dia){
                        if($dia->getId() == $todaynumber){
                            $clases[] = $clase;
                        }
                    }
                }
    
                $datos = $serializer->serialize($clases, 'json', ['groups' => 'clasesprofesor', 'max_depth' => 1]);
    
                
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


    #[Route('/clase/{id}', name: 'app_clase_detalle', methods: ['GET'])]
    public function listarClaseDetalle(Request $request, JwtAuth $jwt_auth ,ClaseRepository $claseRepository, SerializerInterface $serializer, $id)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $json = json_decode($request->getContent(), true);

            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'admin' || $identity->rol == 'profesor' || $identity->rol == 'alumno'){
                $clases = $claseRepository->findBy(['id' => $id]);

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


    #[Route('/asistencia', name: 'asistencia', methods: ['POST'])]
    public function Asistencia(Request $request,ClaseRepository $cr, AlumnoRepository $ar, JwtAuth $jwt_auth,EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            
            $identity = $jwt_auth->checkToken($token, true);

            if($identity->rol == 'profesor'){
                $json = $request->get('json', null);
                $params =  json_decode($json);

                if(!empty($json)){
                    $fecha= (!empty($params->fecha)) ? $params->fecha : null;
                    $claseid= (!empty($params->clase)) ? $params->clase : null;
                    $alumnos= (!empty($params->alumnos)) ? $params->alumnos : null;
                    
                    $clase = $cr->find($claseid);

                if ($clase && $fecha && $alumnos) {
                    foreach ($alumnos as $alumnoId) {
                        $asistencia = new Asistencia();
                        $asistencia->setClase($clase);
                        $asistencia->setFecha(new \DateTime($fecha));
                        $alumno = $ar->find($alumnoId);
                        if ($alumno) {
                            $asistencia->setAlumno($alumno);
                            $entityManager->persist($asistencia);
                        }
                    }
                    $entityManager->flush();
                    $data = [
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Faltas de asistencia guardadas correctamente.'
                    ];
                }
                    
                    

                }else{
                    $data = [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'No se han guardado los datos correctamente'
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

    

}
