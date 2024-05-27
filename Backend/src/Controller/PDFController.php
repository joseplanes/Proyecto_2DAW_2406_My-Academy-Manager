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
use App\Entity\JornadaLaboral;
use App\Repository\JornadaLaboralRepository;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/api/pdf', name: 'app_pdf')]
class PDFController extends AbstractController
{
    #[Route('/misnotas', name: 'app_misnotas_pdf', methods: ['GET'])]
    public function misNotasPdf(Request $request, JwtAuth $jwt_auth, AlumnoRepository $ar)
    {
        // Recoger token
        $token = $request->headers->get('Authorization');

        // Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if ($authCheck) {
            $identity = $jwt_auth->checkToken($token, true);

            if ($identity->rol == 'alumno') {
                $alumnoId = $identity->id_alumno;
                $alumno = $ar->find($alumnoId);
                $notas = $alumno->getCalificacions();

                // Crear el contenido HTML para el PDF
                $html = $this->renderView('pdf/notas.html.twig', [
                    'notas' => $notas,
                    'alumno' => $alumno
                ]);

                // Configuración de Dompdf
                $options = new Options();
                $options->set('defaultFont', 'Arial');
                $options->set('isRemoteEnabled', true);
                $dompdf = new Dompdf($options);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                $output = $dompdf->output();

                return new Response($output, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="notas.pdf"',
                ]);
            }
        }

        return new JsonResponse([
            'status' => 'error',
            'code' => 400,
            'message' => 'No tienes permiso para realizar esta acción'
        ]);
    }

    #[Route('/misjornadas', name: 'app_jornadas_pdf', methods: ['GET'])]
    public function misJornadas(Request $request,JwtAuth $jwt_auth ,ProfesorRepository $pr, JornadaLaboralRepository $jr , SerializerInterface $serializer,EntityManagerInterface $em)
    {
        //Recoger token
        $token = $request->headers->get('Authorization');

        //Comprobar si es correcto
        $authCheck = $jwt_auth->checkToken($token);

        if($authCheck){
            $json = json_decode($request->getContent(), true);

            $identity = $jwt_auth->checkToken($token, true);
            
            if($identity->rol == 'profesor'){
                $profesorId = $identity->id_profesor;
                $profesor = $pr->find($profesorId);
                $jornadas = $jr->findBy(['profesor' => $pr->find($profesorId)]);
                if($jornadas!=null){
                     // Crear el contenido HTML para el PDF
                $html = $this->renderView('pdf/jornadas.html.twig', [
                    'jornadas' => $jornadas,
                    'profesor' => $profesor
                ]);

                // Configuración de Dompdf
                $options = new Options();
                $options->set('defaultFont', 'Arial');
                $options->set('isRemoteEnabled', true);
                $dompdf = new Dompdf($options);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                $output = $dompdf->output();

                return new Response($output, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="jornadas.pdf"',
                ]);
            }
        }

        return new JsonResponse([
            'status' => 'error',
            'code' => 400,
            'message' => 'No tienes permiso para realizar esta acción'
        ]);
        }
    }

}
