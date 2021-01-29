<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Entity\Produit;
use App\Form\AddProduitType;
use App\Form\EditeProduitType;

use Symfony\Component\HttpFoundation\Request; 

#[Route('/produit', name: 'produit_')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    /**
     * @Route("/add",name= "add")
     */
    public function AddProduit(Request $request){
        $produit = new Produit();

        $form = $this->createForm(AddProduitType::class,$produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('Image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $entityManager = $this->getDoctrine()->getManager();
            $produit->setImage($fileName);
            $entityManager->persist($produit);
            $entityManager->flush(); 

            $this->addFlash('message','produit add with succes');
            return $this->redirectToRoute('produit_list');
        };
        return $this->render('produit/AddProduit.html.twig', [
            'produitForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/list",name="list")
     */
    public function produitslist(ProduitRepository $produit)
    {
return $this ->render("produit/produit.html.twig", [
    'produits'=>$produit->findAll()
]);
    }
    /**
 * @Route("/edite/{id}",name="edite")
 */
public function editProduit(Produit $produit,Request $request){
    $form = $this->createForm(EditeProduitType::class, $produit);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($produit);
        $entityManager->flush();

        $this->addFlash('message','produit edit with succes');
        return $this->redirectToRoute('produit_list');
    }
    return $this->render('produit/editeproduit.html.twig', [
        'produitForm' => $form->createView()
    ]);
}
}

