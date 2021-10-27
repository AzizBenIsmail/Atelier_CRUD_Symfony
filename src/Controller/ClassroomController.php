<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/afficheC", name="afficheC")
     */
        public function afficheC(): Response
    { $r=$this->getDoctrine()->getRepository(Classroom::class);
        $Classroom=$r->findAll();
        return $this->render('classroom/afficheC.html.twig',['c'=>$Classroom]);
    }
    /**
     * @Route("/supp/{id}", name="suppc")
     */
    public function suppc($id): Response
    {  //recupere le classroom a supprime
        $Classroom=$this->getDoctrine()->getRepository(Classroom::class)->find($id);
        //on passe a la supppresion
        $em=$this->getDoctrine()->getManager();
        $em->remove($Classroom);
        $em->flush();
        return $this->redirectToRoute('afficheC');

    }

    /**
     * @Route("/Ajoutc", name="Ajoutc")
     */
    public function Ajoutc(Request $request)
    {//récupération du formulaire
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        /*Ajout du boutton dans l'action
        $form->add('Ajouter',SubmitType::class);*/
//récupérer les données saisies dans les champs
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('afficheC');
        }
        return $this->render("classroom/Ajoutc.html.twig",
            array('f'=>$form->createView()));
    }

    /**
     * @Route("/modifClassroom/{id}", name="modifC")
     */
    public function modifClassroom(Request $request,$id)
    {
        //je récupère la classe à modifier
        $Classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        //récupération du formulaire
        $form = $this->createForm(ClassroomType::class, $Classroom);
        //récupérer les données saisies dans les champs
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('afficheC');
        }
        return $this->render("classroom/update.html.twig", array('form' => $form->createView()));
    }
}
