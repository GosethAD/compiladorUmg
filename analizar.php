<?php
require_once "tokens.php";
$tokensCodigo = array();
$tokensSalida = array();
$erroresSalida = array();
$prueba = "";
$contadorLinea = 1;

//obtengo el codigo del formulario
$codigo = file_get_contents('php://input');
//decodifico el json
$codigo = json_decode($codigo);
foreach ($codigo as $dato) {
    $saltoLinea = strpos($dato, "\n");
    //compruebo si el codigo tiene varias lineas
    if ($saltoLinea === false) {
        $palabras = explode(" ", $dato);
        if (in_array($palabras[0], $tokens)) {
        } else {
            $error = array(
                "linea" => $contadorLinea,
                "tipo" => "Léxico",
                "error" => 'Token no identificado "' . $palabras[0] . '"'
            );
            array_push($erroresSalida, $error);
        }
    } else {
        $lineas = explode("\n", $dato);
        foreach ($lineas as $linea) {
            $palabras = explode(" ", $linea);
            if (in_array($palabras[0], $tokens)) {
                if ($palabras[0] == "CREATE") {
                    $contadorPalabras = count($palabras);
                    if ($contadorPalabras >= 3) {

                        $token = array(
                            "tipo" => "PALABRA RESERVADA",
                            "valor" => $palabras[0]
                        );
                        array_push($tokensSalida, $token);

                        if ($palabras[1] == "TABLE" || $palabras[1] == "table") {
                            $token = array(
                                "tipo" => "PALABRA RESERVADA",
                                "valor" => $palabras[1]
                            );
                            array_push($tokensSalida, $token);

                            $token = array(
                                "tipo" => "IDENTIFICADOR TABLA",
                                "valor" => $palabras[2]
                            );
                            array_push($tokensSalida, $token);

                        } else {
                            $error = array(
                                "linea" => $contadorLinea,
                                "tipo" => "Sintáctico",
                                "error" => 'Se esperaba token TABLE '
                            );
                            array_push($erroresSalida, $error);
                        }
                    }else{
                        $error = array(
                            "linea" => $contadorLinea,
                            "tipo" => "Semántico",
                            "error" => 'T-SQL incompleta'
                        );
                        array_push($erroresSalida, $error);
                    }
                } else if ($palabras[0] == "INTO" || $palabras[0] == "into") {
                    $error = array(
                        "linea" => $contadorLinea,
                        "tipo" => "Sintáctico",
                        "error" => 'Se esperaba token INSERT antes del token "' . $palabras[0] . '"'
                    );
                    array_push($erroresSalida, $error);
                } else if ($palabras[0] == "INSERT") {
                    $token = array(
                        "tipo" => "PALABRA RESERVADA",
                        "valor" => $palabras[0]
                    );
                    array_push($tokensSalida, $token);

                    if ($palabras[1] == "INTO" || $palabras[1] == "into") {
                        $token = array(
                            "tipo" => "PALABRA RESERVADA",
                            "valor" => $palabras[1]
                        );
                        array_push($tokensSalida, $token);
                    } else {
                        $error = array(
                            "linea" => $contadorLinea,
                            "tipo" => "Sintáctico",
                            "error" => 'Se esperaba token INTO '
                        );
                        array_push($erroresSalida, $error);
                    }
                }
            } else {
                $error = array(
                    "linea" => $contadorLinea,
                    "tipo" => "Léxico",
                    "error" => 'Token no identificado "' . $palabras[0] . '"'
                );
                array_push($erroresSalida, $error);
            }
            $contadorLinea++;
        }
    }
}

$salida = array(
    "tokens" => $tokensSalida,
    "errores" => $erroresSalida
);

echo json_encode($salida);
