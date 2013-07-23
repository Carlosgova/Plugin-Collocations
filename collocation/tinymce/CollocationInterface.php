<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Collocation Module</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1>Collocations tool</h1> 
        <form action="collocation.php" method="post">
        Write here your collocation: <input type="text" name="collocation" value="<?php  echo $_GET[text];?>"><br />
        Please choose the case:<br />
        <b>Evaluar una colocación (Case 1):</b><input type="checkbox" name="case1" onclick="ButtonsCase('hidden-input1', this,'hide');"><div id="hidden-input1" ><br />
        <b>Extraer contextos del corpus (Case 2):</b><input type="checkbox" name="case2" onclick="ButtonsCase('hidden-input2', this,'show');"><div id="hidden-input2" style="display: none;"> Perpage parameter: <input  type="number" name="Perpage" ></div><br/>
        <b>Buscar una colocación mediante la base o el colocativo (Case 3):</b><input type="checkbox" name="case3" onclick="ButtonsCase('hidden-input3', this,'show');"><div id="hidden-input3" style="display: none;"> Inputpos: <input  type="text" name="Inputpos"> Colpos: <input  type="text" name="Colpos"> Position: <input  type="text" name="Position"> <br/> <i>*The collocation has to be one word only in this case!</i></div><br/>
        <b>El usuario introduce un texto y el sistema identifica y evalúa las colocaciones(Case 4):</b><input type="checkbox" name="case4"><br/></div>
        <input type="submit"><br/><br/>
        <a href="http://patexpert-engine.upf.edu/cgi-bin/har/harapi.pl" target="_blank">Go to the Documentation</a><br />
        </form>
    </body>
    <script type="text/javascript">
        function ButtonsCase(it, box,param) {
            var check;
            if(param == 'show'){
            check = (box.checked) ? "block" : "none";
            }else{ check = !(box.checked) ? "block" : "none";}
            document.getElementById(it).style.display = check;
        }
    </script>
</html>
