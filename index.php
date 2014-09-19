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

                $("#option").change(function() {
                    $("#option option:selected").each(function() {
                        CURSO = $(this).val();
                        
                        switch (CURSO) {
                            case 'login':
       
                                $.get("http://www.unasp-ec.com/unaspserver/login.php?ra=86539&senha=9886", function(data) {
                                    $("#result").html(data);
                                   
                                });

                                break;

                            case 'curso':
        
                                $.get("http://www.unasp-ec.com/unaspserver/notas/curso.php?ra=86539", function(data) {
                                    $("#result").html(data);
                                   
                                });
                                break;
                            case 'periodo':
                        
                                $.get("http://www.unasp-ec.com/unaspserver/notas/periodo.php?ra=86539&curso=800", function(data) {
                                    $("#result").html(data);
                                    
                                });
                                break;

                            case 'turma':
          
                                $.get("http://www.unasp-ec.com/unaspserver/notas/turma.php?ra=86539&curso=800&ano=2014&periodo=1", function(data) {
                                    $("#result").html(data);
                                 
                                });
                                break;
                            case 'disciplina':
                           
                                $.get("http://www.unasp-ec.com/unaspserver/notas/disciplina.php?ra=86539&curso=800&ano=2014&periodo=1&turma=5A800", function(data) {
                                    $("#result").html(data);
                                
                                });
                                break;
                            case 'media':
                         
                                $.get("http://www.unasp-ec.com/unaspserver/notas/media.php?ra=86539&ano=2014&turma=5A800&periodo=1&disciplina=G1311", function(data) {
                                    $("#result").html(data);
                              
                                });
                                break;

                            case 'financeiro':
                           
                                $.get("http://www.unasp-ec.com/unaspserver/financeiro/getFinanceiro.php?ra=86539", function(data) {
                                    $("#result").html(data);
                      
                                });
                            default:
                                $.get("http://www.unasp-ec.com/unaspserver/login.php?ra=86539&senha=9886", function(data) {
                                    $("#result").html(data);
                                  
                                });
                        }
                    });
                });


//LOGIN
//            $.get("http://www.unasp-ec.com/unaspserver/login.php?ra=86539&senha=9886", function(data) {
//            $("#result").html(data);
//                    alert("Load was performed.");
//            });
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
//                  $.get("http://www.unasp-ec.com/unaspserver/notas/disciplina.php?ra=86539&curso=800&ano=2014&periodo=1&turma=5A800", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });
//                

//MEDIA                   
//
//              $.get("http://www.unasp-ec.com/unaspserver/notas/media.php?ra=86539&ano=2014&turma=5A800&periodo=1&disciplina=G1311", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });

//FINANCEIRO                   
//
//              $.get("http://www.unasp-ec.com/unaspserver/financeiro/getFinanceiro.php?ra=86539", function(data) {
//                    $("#result").html(data);
//                    alert("Load was performed.");
//                });

            });

        </script>

        $(document).ready(function() {

        <h3>Login</h3>

        <p> 


            //                $.get("http://www.unasp-ec.com/unaspserver/login.php?ra=86539&senha=9886", function(data) {
            //                    $("#result").html(data);
            //                    alert("Load was performed.");
            //                });
        </p>


        <h3>CURSO</h3>
        // 
        //                $.get("http://www.unasp-ec.com/unaspserver/notas/curso.php?ra=86539", function(data) {
        //                    $("#result").html(data);
        //                    alert("Load was performed.");
        //                });



        <h3>PERIODO</h3>          
        //                $.get("http://www.unasp-ec.com/unaspserver/notas/periodo.php?ra=86539&curso=800", function(data) {
        //                    $("#result").html(data);
        //                    alert("Load was performed.");
        //                });
        //                

        <h3>TURMA</h3>         
        //                $.get("http://www.unasp-ec.com/unaspserver/notas/turma.php?ra=86539&curso=800&ano=2014&periodo=1", function(data) {
        //                    $("#result").html(data);
        //                    alert("Load was performed.");
        //                });

        <h3>DISCIPLINA</h3>
        //                  $.get("http://www.unasp-ec.com/unaspserver/notas/disciplina.php?ra=86539&curso=800&ano=2014&periodo=1&turma=5A800", function(data) {
        //                    $("#result").html(data);
        //                    alert("Load was performed.");
        //                });
        //                

        <h3>MEDIA</h3>                   
        //
        //              $.get("http://www.unasp-ec.com/unaspserver/notas/media.php?ra=86539&ano=2014&turma=5A800&periodo=1&disciplina=G1311", function(data) {
        //                    $("#result").html(data);
        //                    alert("Load was performed.");
        //                });

        <h3>FINANCEIRO</h3>                   
        //
        //              $.get("http://www.unasp-ec.com/unaspserver/financeiro/getFinanceiro.php?ra=86539", function(data) {
        //                    $("#result").html(data);
        //                    alert("Load was performed.");
        //                });

        <br/>
        <select id="option">
            <option id="login" name="login" value="login">Login</option>
            <option id="curso" name="curso" value="curso">curso</option>
            <option id="periodo" name="periodo" value="periodo">periodo</option>
            <option id="turma" name="turma" value="turma">turma</option>
            <option id="disciplina" name="disciplina" value="disciplina">disciplina</option>
            <option id="media" name="media" value="media">media</option>
            <option id="financeiro" name="financeiro" value="financeiro">financeiro</option>
        </select>
        <div id="result"></div>

    </body>

</html>
