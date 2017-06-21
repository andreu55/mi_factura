
<?php

// "001/17", Num factura [0]
// "Jose Ángel Rodriguez", Cliente [1]
// "30/04/2017", Fecha [2]
// "2000", Cantidad / Horas [3]
// "0", Precio por hora / Precio final (si 'cantidad' = 0) [4]
// "1" Pagada? [5]
// "1" Persona fisica? (Para retener irpf o no!) [6]

$facturas = [
              ["001/17", "Jose Ángel Rodriguez", "30/04/2017", "0", "2000", "1", "1"],
              ["002/17", "Taxo Valoración", "01/06/2017", "100", "51", "0", "0"],
              ["003/17", "Taxo Valoración", "20/06/2017", "100", "51", "0", "0"],

              ["Test", "O'Clock Digital", "00/00/0000", "0", "5125", "0", "0"],
              ["Pagar", "O'Clock Digital", "00/00/0000", "0", "5075", "0", "0"],





              // Las que habia emitido pero ya no valen
              // ["Recalc.2", "O'Clock Digital", "30/04/2017", "0", "1600", "0", "0"],
              // ["Recalc.3", "O'Clock Digital", "18/05/2017", "125", "15", "0", "0"],
              // ["Recalc.4", "O'Clock Digital", "31/05/2017", "110", "15", "0", "0"],


              // Las que deberían ser (pero no son)
              // ["Prof", "O'Clock Digital", "30/01/2017", "100", "15", "0", "0"],
              // ["Prof", "O'Clock Digital", "30/02/2017", "100", "15", "0", "0"],
              // ["Prof", "O'Clock Digital", "30/03/2017", "80", "15", "0", "0"],
              // ["Prof", "O'Clock Digital", "30/04/2017", "85", "15", "1", "0"],


          ];
