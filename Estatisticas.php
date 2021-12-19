<html>
<?php
    $db = new SQLite3("./filme.db");
    $db->exec("PRAGMA foreign_keys = ON");
    echo "<form name=\"insert\" method=\"post\">";
    echo "<h1>Nome do Filme de um dado gênero com 2 dados atores no elenco</h1>";
    $G = $db->query('select nome from genero');
    while($gen = $G->fetchArray()){
        $generos[] = $gen['nome'];
    }
    $A = $db->query('select nome from ator');
    while($at = $A->fetchArray()){
        $atores[] = $at['nome'];
    }
    $C = 0;
    $CC = 0;
    $CCC = 0;
    $GT = sizeof($generos);
    $AT = sizeof($atores);
    echo "<select name=\"genero\">";
    while($GT>$C){
         echo "<option value=\"".$generos[$C]."\">".$generos[$C]."</option>";
        $C++;
    }
    echo "</select>";
    echo "<br> <br>";
    echo "<select name=\"ator1\">";
    while($AT>$CC){
         echo "<option value=\"".$atores[$CC]."\">".$atores[$CC]."</option>";
        $CC++;
    }
    echo "</select>";
    echo "&nbsp; + &nbsp;";
    echo "<select name=\"ator2\">";
    while($AT>$CCC){
         echo "<option value=\"".$atores[$CCC]."\">".$atores[$CCC]."</option>";
        $CCC++;
    }
    echo "</select>";
    echo "<input type=\"submit\" value=\"Enviar\" name=\"confirma\">";
    if (isset($_POST["confirma"])) {
        $genero = $_POST['genero'];
        $BETITOWANTSTHEREALFINALNSWERCOUNTPLUSPLUS = 0;
        $BETITOWANTSTHEREALFINALNSWERVALUE='';
        $BETITOWANTSTHEREALFINALNSWER = array();
        $atorr = $_POST['ator1'];
        $atorr2 = $_POST['ator2']; 
        if($atorr == $atorr2){
            $BETITOWANTSTHEREALFINALNSWERVALUE = 'Os atores selecionados não podem ser iguais';
        }else{
        $BETITOWANTSTHEFINALNSWER = $db->query("select filmes.nome from filmes join generofilme on generofilme.filme = filmes.codigo join genero on genero.codigo = generofilme.genero join atorfilme on atorfilme.filme = filmes.codigo join ator on ator.CPFCNPJ = atorfilme.ator where genero.nome =\"".$genero."\" and ator.nome =\"".$atorr."\" intersect select filmes.nome from filmes join generofilme on generofilme.filme = filmes.codigo join genero on genero.codigo = generofilme.genero join atorfilme on atorfilme.filme = filmes.codigo join ator on ator.CPFCNPJ = atorfilme.ator where genero.nome =\"".$genero."\" and ator.nome= \"".$atorr2."\"");

        while($BETITOWANTSTHEFINALNSWER2 = $BETITOWANTSTHEFINALNSWER->fetchArray()){
            $BETITOWANTSTHEREALFINALNSWER[] = $BETITOWANTSTHEFINALNSWER2['nome'];
        }
        $BETITOWANTSTHEREALFINALNSWERLENGTH = sizeof($BETITOWANTSTHEREALFINALNSWER);
       while($BETITOWANTSTHEREALFINALNSWERCOUNTPLUSPLUS <$BETITOWANTSTHEREALFINALNSWERLENGTH ){
       $BETITOWANTSTHEREALFINALNSWERVALUE .= $BETITOWANTSTHEREALFINALNSWER[$BETITOWANTSTHEREALFINALNSWERCOUNTPLUSPLUS].' | ';
        $BETITOWANTSTHEREALFINALNSWERCOUNTPLUSPLUS++;
       }
       if($BETITOWANTSTHEREALFINALNSWERVALUE==''){
           $BETITOWANTSTHEREALFINALNSWERVALUE = 'Nenhum filme encontrado.';   
       }
       echo '<br>';
       echo '<br>';
        }
        echo $BETITOWANTSTHEREALFINALNSWERVALUE;
    }
    echo "</form>";

echo "<h1>O Ator mais assistido nos últimos 6 meses</h1>";
$A = $db->query("select ator.nome, count(*) as contagem from ator join atorfilme on atorfilme.ator = ator.CPFCNPJ join filmes on filmes.codigo = atorfilme.filme join assistido on assistido.filme = filmes.codigo where date(assistido.data) between date('now', '-6 months') and date('now') group by ator.nome limit 1");
        
while($ator = $A->fetchArray()){
        $atores = $ator['nome']; 
        $atoresc = $ator['contagem']; 
} 
    echo "<h2>$atores assistido um total de $atoresc vezes</h2>";

$db->close();
?>
</html>