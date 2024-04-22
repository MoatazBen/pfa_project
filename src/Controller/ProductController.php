<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


class ProductController extends AbstractController
{
    /**
     * @Route("/product/new", name="product_new", methods={"GET", "POST"})
     */
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $product->getImageFilename();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move($this->getParameter('products_directory'), $newFilename);
                } catch (FileException $e) {
                }

                $product->setImageFilename($newFilename);
            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }
    /**

     * @Route("/", name="home")

     */

    /*public function home(ProductRepository $productRepository): Response

     {
 
         $products = $productRepository->findAllWithDescription();
 
 
         return $this->render('home.html.twig', [
 
             'products' => $products,
 
         ]);
 
     }*/
     public function home(ProductRepository $productRepository): Response {
        $products = $productRepository->findAllWithDescription(); // Fetch actual product data
        dump($products); // Add this line for debugging
        if (empty($products)) {
            // Handle the case when there are no products
            $message = 'There are no products to display.';
            return $this->render('home/index.html.twig', [
                'message' => $message,
            ]);
        }
        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }
    
}
