<?php

namespace App\Enums;

enum TicketStatus: string {

    case EnCours = 'En cours';
    
    case Resolu = 'Resolu';

    case NonResolu = 'Non Resolu';

    case Annule = 'Annule';
}
