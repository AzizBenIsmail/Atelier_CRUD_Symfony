<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Student;
use App\Form\EtudiantType;
use App\Form\SearchStudentType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index(): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }

    /**
     * @Route("/affiche", name="affiche")
     */
    public function affiche(): Response
    {
        $Etudiant=$this->getDoctrine()->getRepository(Etudiant::class)->findAll();
        return $this->render('etudiant/afficheC.html.twig',['e'=>$Etudiant]);
    }

    /**
     * @Route("/Ajoute", name="Ajoute")
     */
    public function Ajoute(Request $request)
    {//récupération du formulaire
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        /*Ajout du boutton dans l'action
        $form->add('Ajouter',SubmitType::class);*/
//récupérer les données saisies dans les champs
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('affiche');
        }
        return $this->render("etudiant/Ajoute.html.twig",
            array('f'=>$form->createView()));
    }

    /**
     * @Route("/update/{ncl}", name="updateStudent")
     */
    public function update(Request $request, $ncl)
    {
        $student = $this->getDoctrine()->getRepository(Etudiant::class)->find($ncl);
        $form = $this->createForm(EtudiantType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affiche');
        }
        return $this->render("etudiant/update.html.twig", array('form' => $form->createView()));
    }

    /**
     * @Route("/supp/{ncl}", name="supprimer")
     */
    public function suppc($ncl): Response
    {  //recupere le classroom a supprime
        $student=$this->getDoctrine()->getRepository(Etudiant::class)->find($ncl);
        //on passe a la supppresion
        $em=$this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute('affiche');

    }
    /**
     * @Route("/listStudentWithSearch", name="listStudentWithSearch")
     */
    public function listStudentWithSearch(Request $request, EtudiantRepository $repository)
    {
//All of Student
        $students= $repository->findAll();
//list of students order By Mail
        $studentsByMail = $repository->orderByMail();
//search
        $searchForm = $this->createForm(SearchStudentType::class);
        $searchForm->add("Recherche",SubmitType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $NCL = $searchForm['NCL']->getData();
            $resultOfSearch = $repository->searchStudent($NCL);
            return $this->render('etudiant/searchStudent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchStudent" => $searchForm->createView()));
        }
        return $this->render('etudiant/listWithSearch.html.twig', array(
            "students" => $students,
            "studentsByMail" => $studentsByMail,
            "searchStudent" => $searchForm->createView()));
    }
}

