<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as controlador;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route as rota;

class AuthController extends controlador
{
    #[rota(path:"/user/login", name:"login_route", methods: ["POST"])]
    public function login(Request $request){
        
    }
}