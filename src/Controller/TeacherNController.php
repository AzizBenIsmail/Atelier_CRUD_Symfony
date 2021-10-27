<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherNController extends AbstractController
{
    /**
     * @Route("/teacher/n", name="teacher_n")
     */
    public function index(): Response
    {
        return $this->render('teacher_n/index.html.twig', [
            'controller_name' => 'TeacherNController',
        ]);
    }


    /**
     * @Route("/read", name="read")
     */
    public function read(): Response
    {
        return $this->render('teacher_n/read.html.twig', [
            'controller_name' => 'TeacherNController',
        ]);
    }
    /**
     * @Route("/azerty", name="azerty")
     */
    public function azerty(): Response
    {
        return $this->render('teacher_n/azerty.html.twig', [
            'controller_name' => 'TeacherNController',
        ]);
    }
}
