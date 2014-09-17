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

//TESTE login 
            $(document).ready(function() {
                $.get("http://www.unasp-ec.com/unaspserver/login.php?ra=86539&senha=9886", function(data){
                    $("#result").html(data);
                    alert("Load was performed.");
                });



//TESTE Curso
//            $(document).ready(function() {
//                $.get("http://www.unasp-ec.com/unaspserver/curso.php?ra=86539", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });



//                $.get("http://www.unasp-ec.com/unaspserver/periodo.php?ra=86539&curso=800", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });
//                
                
                
                
                
            });


        </script>

        <div id="result"></div>


    </body>
</html>
