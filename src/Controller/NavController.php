<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class NavController extends AbstractController
{

public function navbar() {
    return $this->render('navs/navbar.html.twig');
}

}
