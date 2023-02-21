<?php

namespace App\Controller;

use App\Entity\Bac;
use App\Entity\Categorie;
use App\Entity\Dechet;
use App\Form\DechetnewType;
use App\Form\DechetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

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
            4 // nombre d'éléments par page
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
}
