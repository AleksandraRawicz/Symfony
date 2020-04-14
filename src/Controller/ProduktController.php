<?php

namespace App\Controller;

use App\Entity\Produkt;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduktController extends AbstractController
{
    /**
     * @Route("/produkt/{nazwa}", name="produkt")
     */
    public function createProduct($nazwa = "unknown"): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Produkt();
        $product->setName($nazwa);
        $product->setPrice(19);
        $product->setDescription('Cheap and good');
        $product->setAmount(0);
        $product->setDelivery(false);
        $product->setAvailable(true);
        $product->setDeliveryDate(null);
        $product->setComment("");
        $product->setWeight(0);
        $product->setTime(null);


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Zapisano nowy produkt do bazy: '.$product->getName());
    }
}
