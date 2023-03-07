<?php

namespace App\Controller;

use App\Entity\Bac;
use App\Form\BacType;
use App\Form\SearchFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use PDO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

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
        $form=$this->createForm(SearchFormType::class);

      

        return $this->render('bac/index.html.twig', [
            'b'=>$bacs,
            'f'=>$form->createView()
        ]);
    }




     /**
     * @Route("/affiche", name="displaybac2")
     */
    public function affiche(Request $request): Response
    {
        $bacs= $this->getDoctrine()->getManager()->getRepository(Bac::class)->findAll();

        $form=$this->createForm(SearchFormType::class);

        return $this->render('bac/affiche.html.twig', [
            'b'=>$bacs,
            'f'=>$form->createView()
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



/**
 * @Route("/search", name="search")
 */
public function search(Request $request,SerializerInterface $serializer,PaginatorInterface $Paginator)
{
    $em = $this->getDoctrine()->getManager();
    $bacRepository = $em->getRepository(Bac::class);
  // deserialize the form data into an array
  $search = $request->query->get('search_form');
  $query= $search["searchQuery"];
  $sort = $search["orderby"];
  // retrieve the search query from the 'query' attribute
    $queryBuilder = $bacRepository->createQueryBuilder('b');
    
    $search = $request->query->get('searchQuery');
   

    
    
        $queryBuilder->where('b.ref LIKE :search OR b.adresse LIKE :search OR b.codepostal LIKE :search OR b.capacite LIKE :search')
                     ->setParameter('search', "%$query%");
    
    
    if ($sort ) {
        $queryBuilder->orderBy("b.$sort","ASC");
    }
    
    $result = $queryBuilder->getQuery()->getResult();
    $json=$serializer->serialize($result,'json',['groups'=>'bac']);
   
    
    return $this->json([
        'results' => $this->renderView('bac/result.html.twig', [
            'b' => $result,
           
            
        ]),
    
       
    ]);
}




   /**
     * @Route("/stats", name="statss")
     */
    public function statistiques(EntityManagerInterface $em){
        // On va chercher toutes les bac per quantite
  
        $bacs= $this->getDoctrine()->getManager()->getRepository(Bac::class)->findAll();

       
        $bacid = [];
        $produitCount = [];
        $quantite = [];
        foreach($bacs as $b){
     
            $sql = "SELECT SUM(quantite) AS c FROM dechet WHERE id_bac_id=". $b->getId() .";";
            $stmt = $em->getConnection()->prepare($sql);
            $result = $stmt->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($row['c'])
            {
            $bacid[] = $b->getId();
            $quantite[] = $row['c'];
        }
        }
  
  
        return $this->render('bac/Stat.html.twig', [
            'dates' => json_encode($bacid),
            'produitCount' => json_encode($quantite),
        ]);
  
  
    }







/**
     * @Route("/Baclist",name="Baclist")
     */

     public function getBacs(SerializerInterface $serializer ){
        $Bacs = $this->getDoctrine()->getManager()->getRepository(Bac::class)->findAll();
      
        $json=$serializer->serialize($Bacs,'json',['groups'=>'bac']);
        return new Response($json);
    }

    /**
     * @Route("/registerBac", name="registerBac")
     */
    public function registerBac( Request $request,SerializerInterface $serializer,EntityManagerInterface $manager){
        $Bac = new Bac();


        $Bac->setAdresse($request->query->get("adresse"));
        $Bac->setCapacite($request->query->get("capacite"));
        $Bac->setEtat($request->query->get("etat"));
        $Bac->setCodepostal($request->query->get("codepostal"));
        $Bac->setRef($request->query->get("ref"));
        $manager->persist($Bac);
        $manager->flush();
        $json=$serializer->serialize($Bac,'json',['groups'=>'Bac']);
        return new Response($json);
    }


   /**
     * @Route("/updateBac", name="updateBac")
     */
    public function updateBac( 
        Request $request,
        serializerInterface $serializer,
        EntityManagerInterface $entityManager)
        {
    $Bac = new Bac();
    $Bac=$this->getDoctrine()->getRepository(Bac::class)->findOneBy(array('id'=>$request->query->get("id")));

    $Bac->setAdresse($request->query->get("adresse"));
    $Bac->setCapacite($request->query->get("capacite"));
    $Bac->setEtat($request->query->get("etat"));
    $Bac->setCodepostal($request->query->get("codepostal"));
    $Bac->setRef($request->query->get("ref"));
$entityManager->persist($Bac);
$entityManager->flush();

 return new Response("success");

}

/**
* @Route("/deleteBaac", name="deleteuaer")
*/
public function deleteBaac( 
        Request $request,
        serializerInterface $serializer,
        EntityManagerInterface $entityManager

){

    $Bac=$this->getDoctrine()->getRepository(Bac::class)->findOneBy(array('id'=>$request->query->get("id")));
    $em=$this->getDoctrine()->getManager();
    $em->remove($Bac);
    $em->flush();
    return new Response("success");
   
}



}
