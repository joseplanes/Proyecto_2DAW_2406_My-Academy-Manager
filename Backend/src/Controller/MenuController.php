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



class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function listarMenus(MenuRepository $menu) : Response
    {
        $menus = $menu->findAll();

        return $this->json($menus);
    }

    
    #[Route('/clasebasic', name: 'app_clasebsic', methods: ['GET'])]
    public function listarClasesbasic(ClaseRepository $claseRepository, SerializerInterface $serializer): Response
    {
        $clases = $claseRepository->findAll();
        

        
        $data = $serializer->serialize($clases, 'json', ['groups' => 'clasebasic', 'max_depth' => 1]);

    
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
    
    
    

    #[Route('/clase/{id}', name: 'app_clase_detalle', methods: ['GET'])]
    public function listarClaseDetalle(ClaseRepository $claseRepository, SerializerInterface $serializer, $id): Response
    {
        $clases = $claseRepository->findBy(['id' => $id]);
        

        
        $data = $serializer->serialize($clases, 'json', ['groups' => 'clase', 'max_depth' => 1]);

        
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }


    
    
}
