<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
            "formulario" =>$form ->createView()
        ]);
    }
}
    