<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <script>

//LOGIN 
            $(document).ready(function() {
                
//                $.get("http://www.unasp-ec.com/unaspserver/login.php?ra=86539&senha=9886", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });



//CURSO
// 
//                $.get("http://www.unasp-ec.com/unaspserver/notas/curso.php?ra=86539", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });



//PERIODO          
//                $.get("http://www.unasp-ec.com/unaspserver/notas/periodo.php?ra=86539&curso=800", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });
//                

//TURMA         
//                $.get("http://www.unasp-ec.com/unaspserver/notas/turma.php?ra=86539&curso=800&ano=2014&periodo=1", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });

//DISCIPLINA
                  $.get("http://www.unasp-ec.com/unaspserver/notas/disciplina.php?ra=86539&curso=800&ano=2014&periodo=1&turma=5A800", function(data) {
                    $("#result").html(data);
                    alert("Load was performed.");
                });
//                
            });


        </script>
        <div id="result"></div>
    </body>
</html>
