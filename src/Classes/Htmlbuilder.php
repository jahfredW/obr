<?php 

namespace App\Classes;

class Htmlbuilder{
    public static $html;

    public static function render($clientIntervention, $name, $clientDescription, $clientEmail, $telephone ){
        self::$html = "<div class = container-fluid>";
        self::$html .= '<h1> Bonjour Olivier, vous avez une demande d\' intervention pour :' . $clientIntervention . '</h1>' . 
        '<p>De la part de : ' . $name . '</p></br>';
        self::$html .= '<p>Motif : ' . $clientDescription . '</p></br>';
        self::$html .= '<p>Répondre : <a href= ' . "$clientEmail" . '>Répondre à ' . $clientEmail . ' </a> <p>
        </br>';
        self::$html .= '<p>Rappeler : ' . $telephone . '</p>';
        self::$html .= '</div>';

        return self::$html;
    }
}