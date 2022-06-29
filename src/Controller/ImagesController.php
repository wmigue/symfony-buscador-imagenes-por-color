<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Imagenes as entidad;
use App\Entity\Imagenes;
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;





class ImagesController extends AbstractController
{

//TODAS LAS IMAGENES
    public function getAllImages()
    {
        $em = $this->getDoctrine()->getManager();
        $lista = $em->getRepository(entidad::class)->findBy([], ['url' => 'asc']);
        return $this->render('imagenes/todas.html.twig', [
            'lista' => $lista
        ]);
    }



//AGREGANDO NUEVAS IMAGENES
    public function addImages(Request $request, SluggerInterface $slugger)
    {
        $em = $this->getDoctrine()->getManager();
        $imagen = new \App\Entity\Imagenes();
        $form = $this->createForm(\App\Form\ImagenesType::class, $imagen);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('url')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('directorio_imagenes'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new Exception('error en guardar imagen.');
                }

                //Get image information
                $rutaImagen = $this->getParameter('directorio_imagenes') . "/" . $newFilename;
                $getImageInfo = getimagesize($rutaImagen);
                $altoOriginal = $getImageInfo[1];
                $anchoOriginal = $getImageInfo[0];
                $altoUsuario = $form->get('alto')->getData();
                //calculando el ancho en funcion del alto enviado por parametro
                $aspecto = $anchoOriginal / $altoOriginal;
                $width = $altoUsuario * $aspecto;

                $imagen->setAncho($width);
                $imagen->setUrl($newFilename);
            }

            $em->persist($imagen);
            $em->flush();

            return $this->redirectToRoute('todasLasImagenes');
        }
        return $this->render('imagenes/agregar.html.twig', [
            'form' => $form->createView()
        ]);
    }







    //CALCULANDO DISTANCIA ENTRE COLORES.
    public function searchColors(Request $request)
    {
        //funcion interna
        function calcularDistanciaColor($colorElegido,  $colorAProcesar)
        {
            $color1 = substr($colorElegido, -6); //LE QUITAMOS EL "#"
            $color2 = $colorAProcesar;

            $c1_parte1 = hexdec("0x" . $color1[0] . $color1[1]);
            $c1_parte2 = hexdec("0x" . $color1[2] . $color1[3]);
            $c1_parte3 = hexdec("0x" . $color1[4] . $color1[5]);

            $c2_parte1 = hexdec("0x" . $color2[0] . $color2[1]);
            $c2_parte2 = hexdec("0x" . $color2[2] . $color2[3]);
            $c2_parte3 = hexdec("0x" . $color2[4] . $color2[5]);

            $resultado = pow(($c1_parte1 - $c2_parte1), 2) + pow(($c1_parte2 - $c2_parte2), 2) + pow(($c1_parte3 - $c2_parte3), 2);
            $resultado = sqrt($resultado);

            return $resultado;
        }



        $em = $this->getDoctrine()->getManager();
        $lista = $em->getRepository(entidad::class)->findAll();
        $form = $this->createForm(\App\Form\BuscarType::class);
        $form->handleRequest($request);

        $result = $lista;

        if ($form->isSubmitted() && $form->isValid()) {
            $result = [];
            $color = $form->get('color')->getData();
            $distancia = $form->get('distancia')->getData();
            foreach ($lista as $item) {
                $cadena = $item->getColores();
                $separados = explode(",", $cadena);
                foreach ($separados as $v) {
                    $res = calcularDistanciaColor($color, $v);
                    // $values[] = $res;
                    if ($res <= $distancia) {
                        if (!in_array($item, $result)) {
                            $result[] = $item;
                        }
                    }
                }
            }

            return $this->render('imagenes/todas.html.twig', [
                'lista' => $result,
                //'res' => $values,
            ]);
        }


        return $this->render('imagenes/buscar.html.twig', [
            'form' => $form->createView()
        ]);
    }












////////////////////////////////////SOLO TESTEANDO ENDPOINTS////////////////////////////////
    public function Test1()
    {
        $em = $this->getDoctrine()->getManager();
        $lista = $em->getRepository(entidad::class)->findAll();

        foreach ($lista as $item) {
            $cadena = $item->getColores();
            $idImagen = $item->getId();
            $separados = explode(",", $cadena);

            $arrayCollection[$idImagen] = $separados;
        }

        $response = new JsonResponse();
        $response->setData($arrayCollection);
        return $response;
    }


    public function Test2()
    {
        $em = $this->getDoctrine()->getManager();
        $listaImagenes = $em->getRepository(entidad::class)->findAll();

        foreach ($listaImagenes as $item) {
            $cadena = $item->getColores();
            $idImagen = $item->getId();
            $separados = explode(",", $cadena);

            $array[$idImagen] = $separados;
        }


        $colorABuscar = "ff0080";
        foreach ($array as $v) {
            foreach ($v as $interno) {
                $array2[] = $interno;
            }
        }

        $response = new JsonResponse();
        $response->setData($array2);
        return $response;
    }

    public function Test3()
    {
        $color1 = "FF0000";
        $color2 = "FF0005";

        $c1_parte1 = hexdec("0x" . $color1[0] . $color1[1]);
        $c1_parte2 = hexdec("0x" . $color1[2] . $color1[3]);
        $c1_parte3 = hexdec("0x" . $color1[4] . $color1[5]);

        $c2_parte1 = hexdec("0x" . $color2[0] . $color2[1]);
        $c2_parte2 = hexdec("0x" . $color2[2] . $color2[3]);
        $c2_parte3 = hexdec("0x" . $color2[4] . $color2[5]);

        $resultado = (pow(($c1_parte1 - $c2_parte1), 2) + pow(($c1_parte2 - $c2_parte2), 2) + pow(($c1_parte3 - $c2_parte3), 2));
        $resultado = sqrt($resultado);


        $response = new JsonResponse();
        $response->setData($resultado);
        return $response;
    }














}