<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= numPalabras($_REQUEST['comentario']) ?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= letraRepetida($_REQUEST['comentario']) ?></td></tr>
<tr><td>Palabra + repetida:</td><td><?= palabraRepetida($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de vocales:     </td><td><?= numVocales($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de espacios:    </td><td><?= substr_count($_REQUEST['comentario'], ' ') ?></td></tr>
</table>
</div>

