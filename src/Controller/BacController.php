<?php

namespace App\Controller;

use App\Entity\Bac;
use App\Form\BacType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class BacController extends AbstractController
{
    /**
     * @Route("/bac", name="app_bac")
     */
    public function index(): Response
    {
        return $this->render('bac/index.html.twig', [
            'controller_name' => 'BacController',
        ]);
    }


    /**
     * @Route("/afficherbac", name="displaybac")
     */
    public function afficherbac(PaginatorInterface $Paginator,Request $request): Response
    {
        $bacs= $this->getDoctrine()->getManager()->getRepository(Bac::class)->findAll();

        $pagination = $Paginator->paginate(
            $bacs, // données à paginer
            $request->query->getInt('page', 1), // numéro de la page par défaut
            4 // nombre d'éléments par page
        );


        return $this->render('bac/index.html.twig', [
            'b'=>$pagination
        ]);
    }



    /**
     * @Route("/addBac", name="addBac")
     */
    public function addBac(Request $request): Response
    {
      
       $Bac=new Bac();
       $form=$this->createForm(BacType::class,$Bac);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           
         $em = $this->getDoctrine()->getManager();
           $em->persist($Bac);
           $em->flush();

           return $this->redirectToRoute('displaybac');
       }
       else
       return $this->render('bac/createBac.html.twig',['f'=>$form->createView()]);

    }



    /**
     * @Route("/modifierBac/{id}", name="modifierBac")
     */
    public function modifierBac(Request $request,$id): Response
    {
      
       $bacs=$this->getDoctrine()->getManager()->getRepository(Bac::class)->find($id);
       $form=$this->createForm(BacType::class,$bacs);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
    
       
           $em = $this->getDoctrine()->getManager();
           
           $em->flush();

           return $this->redirectToRoute('displaybac');
       }
       else
       return $this->render('bac/modifierbac.html.twig',['f'=>$form->createView()]);

    }


      /**
     * @Route("/afficherbacfront", name="afficherbacfront")
     */
    public function afficherbacfront(): Response
    {
        $bacs= $this->getDoctrine()->getManager()->getRepository(Bac::class)->findAll();

        return $this->render('bac/frontindex.html.twig', [
            'b'=>$bacs
        ]);
    }



    /**
* @Route("/deletebac", name="deletebac")
*/
public function deleteBac( 
    Request $request

){

$bac=$this->getDoctrine()->getRepository(Bac::class)->findOneBy(array('id'=>$request->query->get("id")));
$em=$this->getDoctrine()->getManager();
$em->remove($bac);
$em->flush();
return new Response("success");

}
}
