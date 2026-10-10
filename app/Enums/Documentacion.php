<?php

namespace App\Enums;
enum Documentacion: string 
{
    case CEDULA_IDENTIDAD = 'cedula_identidad';
    case LIQUIDACIONES = '6_liquidaciones';
    case CERTIFICADO_COTIZACIONES_24_MESES = 'certificado_cotizaciones_24_meses';
    case CERTIFICADO_DEUDA = 'certificado_deuda';
    case FORMULARIO_EESS = 'formulario_eess';
    case PATRON_VEHICULOS = 'patron_vehiculos';
    case BOLETA_DOMICILIO = 'boleta_domicilio';
    case AVALUO_PROPIEDAD = 'avaluo_propiedad';
    case CERTIFICADO_ANTIGUEDAD = 'certificado_antiguedad';
    case CERTIFICADO_PARENTESCO = 'certificado_parentesco';
}
