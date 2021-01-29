<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 
use App\Repository\CatalogueRepository;
use App\Entity\Catalogue;
use App\Form\AddCatalogueType;

#[Route('/catalogue', name: 'catalogue_')]
class CatalogueController extends AbstractController
{
  #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
        ]);
    }
  /**
  * @Route("/add", name="add")
 */
    public function AddCatalogue(Request $request){
        $catalogue = new Catalogue();

        $form = $this->createForm(AddCatalogueType::class,$catalogue);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $catalogue->setUser($this->getUser());

            $file = $form->get('Icon')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

			// if($image){
			// 	$fichier = md5(uniqid()).'.'.$image->guessExtension();
			// 	$image->move(
			// 		$this->getParameter('app.path.icons'),
			// 		$fichier
			// 	);
			// 	$catalogue->setIcon($fichier);
            // }
            
            $entityManager = $this->getDoctrine()->getManager();
            $catalogue->setIcon($fileName);
            $entityManager->persist($catalogue);
            $entityManager->flush(); 

            $this->addFlash('message','Catalogue add with succes');
            return $this->redirectToRoute('catalogue_list');
        };
        return $this->render('catalogue/AddCatalogue.html.twig', [
            'CatalogueForm' => $form->createView(),
        ]);
    }
     /**
     * @Route("/list",name="list")
     */
    public function catalogueslist(CatalogueRepository $catalogue)
    {
return $this ->render("catalogue/catalogue.html.twig", [
    'catalogues'=>$catalogue->findAll()
]);
    }
}
