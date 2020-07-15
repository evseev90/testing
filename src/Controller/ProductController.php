<?php

namespace App\Controller;


use App\Entity\Currency;
use App\Entity\Product;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/api")
 * Class ProductController
 * @package App\Controller
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="product")
     */
    public function index()
    {
        $host = $this->getParameter('host') . $this->getParameter('files.root');
        /**
         * EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Product::class)->findAll();

        $jsonResponse = $this->json([
            'products' => array_map(function ($p) use ($host) {
                $item = $p->toArray();
                $item['image'] = $host.$item['image'];
                return $item;
            }, $products)
        ]);
        $jsonResponse->headers->set('Access-Control-Allow-Origin', '*');

        return $jsonResponse;
    }

    /**
     * @Route("/create", name="create")
     */
    public function create()
    {
        $em = $this->getDoctrine()->getManager();

        $p = new Product();
        $p->setName('Test');
        $p->setImage('image-path');
        $p->setCurrencyId(1);
        $p->setCurrency($em->getRepository(Currency::class)->find(1));
        $p->setPrice(990);

        $em->persist($p);
        $em->flush();

        return $this->json([
            'product' => $p->toArray()
        ]);
    }
}
