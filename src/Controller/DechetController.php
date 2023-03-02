<?php

namespace App\Controller;

use App\Entity\Bac;
use App\Entity\Categorie;
use App\Entity\Dechet;
use App\Form\DechetnewType;
use App\Form\DechetType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DechetController extends AbstractController
{
    /**
     * @Route("/dechet", name="app_dechet")
     */
    public function index(): Response
    {
        return $this->render('dechet/index.html.twig', [
            'controller_name' => 'DechetController',
        ]);
    }



    /**
     * @Route("/afficherdechet", name="displayDechet")
     */
    public function afficherdecht(PaginatorInterface $Paginator,Request $request): Response
    {
        $Dechets= $this->getDoctrine()->getManager()->getRepository(Dechet::class)->findAll();
        $pagination = $Paginator->paginate(
            $Dechets, // données à paginer
            $request->query->getInt('page', 1), // numéro de la page par défaut
            3 // nombre d'éléments par page
        );
        return $this->render('dechet/index.html.twig', [
            'b'=>$pagination
        ]);
    }



    /**
     * @Route("/addDechet", name="addDechet")
     */
    public function addDechet(Request $request): Response
    {
      
       $Dechet=new Dechet();
       $form=$this->createForm(DechetType::class,$Dechet);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           
         $em = $this->getDoctrine()->getManager();
           $em->persist($Dechet);
           $em->flush();

           return $this->redirectToRoute('displayDechet');
       }
       else
       return $this->render('dechet/createDechet.html.twig',['f'=>$form->createView()]);

    }


       /**
     * @Route("/ajouterdechetfront/{id}/{idbac}", name="ajouterdechetfront")
     */
    public function ajouterdechetfront(Request $request,$id,$idbac): Response
    {
        $categorie = $this->getDoctrine()->getManager()->getRepository(Categorie::class)->find($id);
        $bac = $this->getDoctrine()->getManager()->getRepository(Bac::class)->find($idbac);

       $Dechet=new Dechet();
       $form=$this->createForm(DechetnewType::class,$Dechet);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           
         $em = $this->getDoctrine()->getManager();
         $Dechet->setIdBac($bac);
         $Dechet->setIdCat($categorie);
           $em->persist($Dechet);
           $em->flush();

           return $this->redirectToRoute('afficherbacfront');
       }
       else
       return $this->render('dechet/createdechetfront.html.twig',['f'=>$form->createView()]);

    }




    /**
     * @Route("/modifierDechet/{id}", name="modifierDechet")
     */
    public function modifierDechet(Request $request,$id): Response
    {
      
       $Dechets=$this->getDoctrine()->getManager()->getRepository(Dechet::class)->find($id);
       $form=$this->createForm(DechetType::class,$Dechets);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
    
       
           $em = $this->getDoctrine()->getManager();
           
           $em->flush();

           return $this->redirectToRoute('displayDechet');
       }
       else
       return $this->render('dechet/modifierDechet.html.twig',['f'=>$form->createView()]);

    }



    /**
* @Route("/deleteDechet", name="deleteDechet")
*/
public function deleteDechet( 
    Request $request

){

$Dechet=$this->getDoctrine()->getRepository(Dechet::class)->findOneBy(array('id'=>$request->query->get("id")));
$em=$this->getDoctrine()->getManager();
$em->remove($Dechet);
$em->flush();
return new Response("success");

}















/**
     * @Route("/Dechetlist",name="Dechetlist")
     */

     public function getDechets(SerializerInterface $serializer ){
        $Dechets = $this->getDoctrine()->getManager()->getRepository(Dechet::class)->findAll();
      
        $json=$serializer->serialize($Dechets,'json',['groups'=>'Dechet']);
        return new Response($json);
    }

    /**
     * @Route("/registerDechet", name="registerDechet")
     */
    public function registerDechet( Request $request,SerializerInterface $serializer,EntityManagerInterface $manager){
        $Dechet = new Dechet();
        $id_categorie = new Categorie();
        $id_bac= new Bac();
        $id_bac=$this->getDoctrine()->getRepository(Bac::class)->findOneBy(array('id'=>$request->query->get("idbac")));
        $id_categorie=$this->getDoctrine()->getRepository(Categorie::class)->findOneBy(array('id'=>$request->query->get("idcat")));

        $Dechet->setQuantite($request->query->get("quantite"));

        $Dechet->setDate(new DateTime($request->query->get("date")) );
        $Dechet->setIdBac($id_bac);
        $Dechet->setIdCat($id_categorie);

        $manager->persist($Dechet);
        $manager->flush();
        $json=$serializer->serialize($Dechet,'json',['groups'=>'Dechet']);
        return new Response($json);
    }


   /**
     * @Route("/updateDechet", name="updateDechet")
     */
    public function updateDechet( 
        Request $request,
        serializerInterface $serializer,
        EntityManagerInterface $entityManager)
        {
    $Dechet = new Dechet();
    $Dechet=$this->getDoctrine()->getRepository(Dechet::class)->findOneBy(array('id'=>$request->query->get("id")));

    $Dechet->setQuantite($request->query->get("quantite"));
$entityManager->persist($Dechet);
$entityManager->flush();

 return new Response("success");

}

/**
* @Route("/deletedechet", name="deletedechet")
*/
public function deleteBaac( 
        Request $request,
        serializerInterface $serializer,
        EntityManagerInterface $entityManager

){

    $Dechet=$this->getDoctrine()->getRepository(Dechet::class)->findOneBy(array('id'=>$request->query->get("id")));
    $em=$this->getDoctrine()->getManager();
    $em->remove($Dechet);
    $em->flush();
    return new Response("success");
   
}










}
