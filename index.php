<?php
    $ruta_powershell = 'c:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe';
    $opciones_para_ejecutar_comando = "-c";
    $espacio = " ";
    $comillas = '"';
    $comando = 'get-WmiObject -class Win32_printer |ft shared, name';
    $delimitador = "True";
    $lista_de_impresoras = array();
    exec(
        $ruta_powershell
        . $espacio
        . $opciones_para_ejecutar_comando
        . $espacio
        . $comillas
        . $comando
        . $comillas,
        $resultado,
        $codigo_salida);
    if ($codigo_salida === 0) {
        if (is_array($resultado)) {
           
            for($x = 3; $x < count($resultado); $x++){
                $impresora = trim($resultado[$x]);

                if (strlen($impresora) > 0) {
   
                    if (strpos($impresora, $delimitador) === 0){
                        
                        $nombre_limpio = substr($impresora, strlen($delimitador) + 1, strlen($impresora) - strlen($delimitador) + 1);
                        array_push($lista_de_impresoras, $nombre_limpio);
                    }
                }
            }
        }
        echo "<pre>";
        print_r($lista_de_impresoras);
        echo "</pre>";
    } else {
        echo "Error al ejecutar el comando.";
    }
?>