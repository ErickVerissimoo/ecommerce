<?php

namespace App\Entity;

enum Status: string
{
    case PENDENTE = 'PENDENTE';
    case FINALIZADO='FINALIZADO';
    case CANCELADO='CANCELADO';
}