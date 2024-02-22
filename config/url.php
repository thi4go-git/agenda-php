<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . '?') . '/';

/*
$BASE_URL irá conter o URL base do site atual, incluindo o protocolo (HTTP), o nome do servidor e o caminho para o diretório pai da página atual.
Este URL base pode ser útil para construir URLs relativos em um site, por exemplo, para links internos, imagens, arquivos CSS, JavaScript, etc.

1 - $_SERVER['SERVER_NAME']: Esta é uma variável superglobal do PHP que contém o nome do servidor onde o script atual está sendo executado.

2 - $_SERVER['REQUEST_URI']: Esta é outra variável superglobal do PHP que contém a URI (Uniform Resource Identifier) da página atual.

3 - dirname($_SERVER['REQUEST_URI'] . '?'): Esta parte pega a URI da página atual, adiciona um ponto de interrogação no final (se ainda não houver um) e, 
em seguida, obtém o diretório pai desse caminho. Isso é feito pela função dirname(), que retorna o diretório pai de uma dada localização no sistema de arquivos.

4 - $BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . '?') . '/';: Finalmente, esta linha concatena "http://", o nome do servidor, 
o diretório pai da URI atual (se houver), e uma barra, para formar o URL base do site.s
*/