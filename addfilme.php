<html>
    <style>
        html{
            background-color: #dbdbd3;
        }
        h3{
            margin: 10px;
        }
        table, tr, td{
            border: 2px solid black;
        }
        .td{
            width: 95px;
            text-align: center; 
            vertical-align: middle;
        }
        .td2, .td3{
            width: 160px;
            text-align: center; 
            vertical-align: middle;
        }
    </style>
    <script>
        p=-1
        p2=-1
        p3=-1
        function add(){
            click = event.target.id
            if(click=='botaog'){
                p++
            selectv = document.getElementById('select').value;
            document.getElementById('tabela').innerHTML+="<tr id=\""+p+"\"><td class=\"td\"><input readonly name=tabelag"+p+" value=\""+selectv+"\"></td><td><input class=\"deleta\" type=\"button\" value=\"-\" onclick=\"exc()\"></td></tr>"
            document.getElementById('input1').value= p;
            
            }else if(click=='botaod'){
                p2++
            selectv = document.getElementById('select2').value;
            document.getElementById('tabela2').innerHTML+="<tr id=\""+p2+"\"><td class=\"td\"><input readonly name=tabelad"+p2+" value=\""+selectv+"\"></td><td><input class=\"deleta2\" type=\"button\" value=\"-\" onclick=\"exc()\"></td></tr>" 
            document.getElementById('input2').value= p2;
            }else{
                p3++
            selectv = document.getElementById('select3').value;
            document.getElementById('tabela3').innerHTML+="<tr id=\""+p3+"\"><td class=\"td\"><input readonly name=tabelaa"+p3+" value=\""+selectv+"\"></td><td><input class=\"deleta3\" type=\"button\" value=\"-\" onclick=\"exc()\"></td></tr>" 
            document.getElementById('input3').value= p3;
            }
        }
        function exc(){
            click2 = event.target.className;
            if(click2=='deleta'){
            row = event.target.parentNode.parentNode.rowIndex;
            document.getElementById('tabela').deleteRow(row);
      
            document.getElementById('input1').value= p;
            }else if (click2=='deleta2'){
            row = event.target.parentNode.parentNode.rowIndex;
            document.getElementById('tabela2').deleteRow(row);
     
            document.getElementById('input2').value= p2;
            }else{
            row = event.target.parentNode.parentNode.rowIndex;
            document.getElementById('tabela3').deleteRow(row);     
         
            document.getElementById('input2').value= p2;    
            }
        }
    </script>
    <?php
    
    $db = new SQLite3("./filme.db"); 
    $db->exec("PRAGMA foreign_keys = ON"); 
    echo "<h2>Adicionar filmes ao catalogo</h2>";
    echo "<form name=\"insert\" method=\"post\">";
    $s = $db->query("select * from selos");
        while($sel =$s->fetchArray()){
        $selo[] = $sel['nome'];
    }
    $p = $db->query("select * from pais");
    while($pai = $p->fetchArray()){
        $pais[] = $pai['nome'];
    }
    $g = $db->query("select * from genero");
    while($gen = $g->fetchArray()){
        $genero[] = $gen['nome'];
    }
    $a = $db->query("select * from ator");
    while($ato = $a->fetchArray()){
        $ator[] = $ato['nome'];
    }
    $d = $db->query("select * from diretor");
    while($dir = $d->fetchArray()){
        $diretor[] = $dir['nome'];
    }

    $ST = sizeof($selo);
    $PT = sizeof($pais);
    $GT = sizeof($genero);
    $AT = sizeof($ator);
    $DT = sizeof($diretor);
    $db->close();
    $contadorS = 0;
    $contadorP = 0;
    $contadorG = 0;
    $contadorA = 0;
    $contadorD = 0;

    echo "<h3><b>Selo &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b><select name=\"selo\">";
    while($contadorS<$ST){
        echo "<option>$selo[$contadorS]</option>";
        $contadorS++;
    };
    echo "</select><br><br>";

    echo "<h3><b>Titulo &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b><input required name=\"titulo\" style=\"width: 300px;\"><br><br>";

    echo "<h3><b>País &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b><select name=\"pais\">";
    while($contadorP<$PT){
        echo "<option>$pais[$contadorP]</option>";
        $contadorP++;
    };
    echo "</select><br><br>";

    echo "<h3><b>Lançamento  &nbsp; &nbsp; &nbsp; </b><input required name=\"lancamento\" style=\"width: 80px;\"><br><br>";

    echo "<h3><b>Duração  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b><input name=\"duracao\" required style=\"width: 80px;\"> &nbsp;minutos<br><br>";

    echo "<h3><b>Gênero &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b><select id=\"select\" name=\"select\">";
    while($contadorG<$GT){
        echo "<option>$genero[$contadorG]</option>";
        $contadorG++;
    };
    echo "</select>&nbsp;<input type=\"button\" id=\"botaog\" value=\"+\" onclick=\"add();\">";

    echo "<table name=\"tabela\" id=\"tabela\"></table><br><br>";
    echo "<input type=\"hidden\" name=\"input1\" id= \"input1\">";
    echo "<input type=\"hidden\" name=\"input2\" id= \"input2\">";
    echo "<input type=\"hidden\" name=\"input3\" id= \"input3\">";
    echo "<h3><b>Diretor &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b><select id=\"select2\" name=\"select2\">";
    while($contadorD<$DT){
        echo "<option>$diretor[$contadorD]</option>";
        $contadorD++;
    };
    echo "</select>&nbsp;<input type=\"button\" id=\"botaod\" value=\"+\" onclick=\"add();\">";

    echo "<table name=\"tabela2\" id=\"tabela2\"></table><br><br>";

    echo "<h3><b>Atores &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b><select id=\"select3\" name=\"select3\">";
    while($contadorA<$AT){
        echo "<option>$ator[$contadorA]</option>";
        $contadorA++;
    };
    echo "</select>&nbsp;<input type=\"button\" id=\"botaoa\" value=\"+\" onclick=\"add();\">   ";

    echo "<table name=\"tabela3\" id=\"tabela3\"></table><br><br>";

    echo "<input name=\"confirmaa\" value=\"Adiciona\" type=\"submit\"></form>";
           if (isset($_POST["confirmaa"])) {
        $error='';
        $geneross = array();
        $diretoress = array();
        $atoress = array();
        $nadag = array();
        $nadad = array();
        $nadaa = array();
        $input1 = $_POST['input1'];
        $input2 = $_POST['input2'];
        $input3 = $_POST['input3'];

        $contador = 0;
        $contaodorteste = 0;
        while($contaodorteste<=$input1){
        if (isset($_POST["tabelag".$contador])== true) {
            $geneross[] = $_POST["tabelag".$contador];
        }
        $contador++;
        $contaodorteste++;
    }

    $contador2 = 0;
    $contaodorteste2 = 0;
    while($contaodorteste2<=$input2){
    if (isset($_POST["tabelad".$contador2])== true) {
        $diretoress[] = $_POST["tabelad".$contador2];
    }
    $contador2++;
    $contaodorteste2++;
}

$contador3 = 0;
$contaodorteste3 = 0;
while($contaodorteste3<=$input3){
if (isset($_POST["tabelaa".$contador3])== true) {
    $atoress[] = $_POST["tabelaa".$contador3];
}
$contador3++;
$contaodorteste3++;
}
$seloquaseoficial = $_POST['selo'];
$paisquaseoficial = $_POST['pais'];
$titulooficial = $_POST['titulo'];
$titulooficial = strtolower($titulooficial);
$lancamentooficial = $_POST['lancamento'];
$duracaooficial = $_POST['duracao'];

$db = new SQLite3("./filme.db"); 
    $db->exec("PRAGMA foreign_keys = ON");
    $mov =$db->query("select * from filmes");
    while($Movie = $mov->fetchArray()){
        $movie_code[] = $Movie['codigo'];
        $movie_name[] = strtolower($Movie['nome']);
    }


    $generosunico = array_unique($geneross);
    $generos = array_merge($generosunico, $nadag);

    $diretoresunico = array_unique($diretoress);
    $diretores = array_merge($diretoresunico, $nadad);

    $atoresunico = array_unique($atoress);
    $atores = array_merge($atoresunico, $nadaa);



if (in_array($titulooficial, $movie_name)) {
    $error .= "Filme já cadastrado;";     
        }
if (!preg_match('/^[1-9][0-9]*$/', $lancamentooficial)) {
            $error.='  Data de lançamento incorreta;';
}else if ((strlen($lancamentooficial)!=4)){
            $error.='  Data deve conter 4 digitos;';
        }
if (!preg_match('/^[1-9][0-9]*$/', $duracaooficial)) {
            $error.='  Duração incorreta;';
}elseif((strlen($duracaooficial)>3)){
    $error.='  Duração deve ser em minutos e conter menos de 3 digitos;';
}
if (empty($generos) == true) {
    $error.='  Insira o(s) genero(s) do filme;';
}
if (empty($atores) == true) {
    $error.='  Insira o(s) ator(es) do filme;';
}
if (empty($diretores) == true) {
    $error.='  Insira o(s) diretor(es) do filme;';
}
$generosT = sizeof($generos);
$diretoresT = sizeof($diretores);
$atoresT = sizeof($atores);

$cg = 0;
$cd = 0;
$ca = 0;

        echo "<font color=\"red\">".$error."</font>";
        $codigofinal = end($movie_code) + 1;

        if($error==''){
            
            $paisoficial = $db->query("select codigo from pais where nome ='$paisquaseoficial'")->fetchArray()['codigo'];
            $selooficial = $db->query("select codigo from selos where nome ='$seloquaseoficial'")->fetchArray()['codigo'];

            $db->exec('insert into filmes (codigo, nome, selo, estreia, duracao, pais) values ("'.$codigofinal.'","'.$titulooficial.'","'.$selooficial.'","'.$lancamentooficial.'","'.$duracaooficial.'","'.$paisoficial.'")');
            while($cg<$generosT){
                $generoatual = $db->query("select codigo from genero where nome ='$generos[$cg]'")->fetchArray()['codigo'];
                $db->exec('insert into generofilme (genero, filme) values ("'.$generoatual.'","'.$codigofinal.'")');
                $cg++;
            }
            while($cd<$diretoresT){
                $diretoratual = $db->query("select CPFCNPJ from diretor where nome ='$diretores[$cd]'")->fetchArray()['CPFCNPJ'];
                $db->exec('insert into diretorfilme (diretor, filme) values ("'.$diretoratual.'","'.$codigofinal.'")');
                $cd++;
            }
            while($ca<$atoresT){
                $atoratual = $db->query("select CPFCNPJ from ator where nome ='$atores[$ca]'")->fetchArray()['CPFCNPJ'];
                $db->exec('insert into atorfilme (ator, filme) values ("'.$atoratual.'","'.$codigofinal.'")');
                $ca++;
            }


        }
 }
    ?>
    <?php
    if (isset($_POST["confirma"])) {
        echo "<script>setTimeout(function () { window.open(\"Inicio.php\",\"_self\"); }, 3000);</script>";
    }?>
    </html>