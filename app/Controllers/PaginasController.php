<?php

namespace App\Controllers;

class PaginasController extends BaseController
{
    public function comercializacion()
    {
        $data['titulo'] = 'Comercialización - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('paginas/comercializacion');
        echo view('layouts/footer.php');
    }

    public function terminos()
    {
        $data['titulo'] = 'Términos y Condiciones - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('paginas/terminos');
        echo view('layouts/footer.php');
    }

    public function quienesSomos()
    {
        $data['titulo'] = 'Quiénes Somos - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('paginas/quienes-somos');
        echo view('layouts/footer.php');
    }
}