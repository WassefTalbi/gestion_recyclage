<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="app_categorie")
     */
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }














        /**
     * @Route("/cat", name="displayCategorie")
     */
    public function affichercat(PaginatorInterface $Paginator,Request $request): Response
    {
        $Categories= $this->getDoctrine()->getManager()->getRepository(Categorie::class)->findAll();
        $pagination = $Paginator->paginate(
            $Categories, // données à paginer
            $request->query->getInt('page', 1), // numéro de la page par défaut
            4 // nombre d'éléments par page
        );
        return $this->render('Categorie/index.html.twig', [
            'b'=>$pagination
        ]);
    }

       /**
     * @Route("/affichercategoriefront/{id}", name="affichercategoriefront")
     */
    public function affichercategoriefront($id): Response
    {
        $Categories= $this->getDoctrine()->getManager()->getRepository(Categorie::class)->findAll();
        return $this->render('categorie/frontcategorie.html.twig', [
            'b'=>$Categories ,
            'id'=>$id
        ]);
    }
    /**
     * @Route("/addCategorie", name="addCategorie")
     */
    public function addCategorie(Request $request): Response
    {
      
       $Categorie=new Categorie();
       $form=$this->createForm(CategorieType::class,$Categorie);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           
         $em = $this->getDoctrine()->getManager();
           $em->persist($Categorie);
           $em->flush();

           return $this->redirectToRoute('displayCategorie');
       }
       else
       return $this->render('categorie/createCategorie.html.twig',['f'=>$form->createView()]);

    }



    /**
     * @Route("/modifierCategorie/{id}", name="modifierCategorie")
     */
    public function modifierCategorie(Request $request,$id): Response
    {
      
       $Categories=$this->getDoctrine()->getManager()->getRepository(Categorie::class)->find($id);
       $form=$this->createForm(CategorieType::class,$Categories);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
    
       
           $em = $this->getDoctrine()->getManager();
           
           $em->flush();

           return $this->redirectToRoute('displayCategorie');
       }
       else
       return $this->render('categorie/modifierCategorie.html.twig',['f'=>$form->createView()]);

    }



    /**
* @Route("/deleteCategorie", name="deleteCategorie")
*/
public function deleteCategorie( 
    Request $request

){

$Categorie=$this->getDoctrine()->getRepository(Categorie::class)->findOneBy(array('id'=>$request->query->get("id")));
$em=$this->getDoctrine()->getManager();
$em->remove($Categorie);
$em->flush();
return new Response("success");

}
}
