<html>
<style>
        html{
            background-color: #dbdbd3;
        }
    </style>
    <?php
    echo "<h2>Catálogo de Filmes</h2><br><br>";
    $db = new SQLite3("./filme.db");
    $db->exec("PRAGMA foreign_keys = ON");
    echo "<table border=\"1\">";
    echo "<td style=\"width: 80px\"><b>Selo</b></td>";
    echo "<td style=\"width: 130px\"><b>Inclusão</b></td>";
    echo "<td style=\"width: 220px\"><b>Titulo</b></td>";
    echo "<td style=\"width: 140px\"><b>Pais</b></td>";
    echo "<td style=\"width: 120px\"><b>Lançamento</b</td>";
    echo "<td style=\"width: 110px\"><b>Duração (min)</b</td>";
    echo "<td style=\"width: 250px\"><b>Gênero</b</td>";
    echo "<td style=\"width: 250px\"><b>Direção</b</td>";
    echo "<td style=\"width: 300px\"><b>Elenco</b</td>";
    echo "</tr>";

    $f = $db->query("select * from filmes");
    while($filme = $f->fetcharray()){
        $filmesc[] = $filme['codigo'];
        $filmesn[] = $filme['nome'];
        $filmesi[] = date("d/m/Y" ,strtotime($filme['data']));
        $filmesd[] = $filme['duracao'];
        $filmesl[] = $filme['estreia'];
    }

    $ft = sizeof($filmesc);
    $contador = 0;
    $contador2 = 0;
    $contador3 = 0;
    $contador4 = 0;
    $generos = '';
    $atores = '';
    $diretores = '';
    while($contador < $ft){
        $selo = $db->query('select selos.nome from selos join filmes on filmes.selo = selos.codigo where filmes.codigo ='.$filmesc[$contador])->fetchArray()['nome'];
        echo "<td>$selo</td>";
        echo "<td>$filmesi[$contador]</td>";
        echo "<td>$filmesn[$contador]</td>";
        $pais = $db->query('select pais.nome from pais join filmes on filmes.pais = pais.codigo where filmes.codigo ='.$filmesc[$contador])->fetchArray()['nome'];
        echo "<td>$pais</td>";
        echo "<td>$filmesl[$contador]</td>";
        echo "<td>$filmesd[$contador]</td>";
        $G = $db->query('select distinct genero.nome from genero join generofilme on generofilme.genero = genero.codigo join filmes on filmes.codigo = generofilme.filme where filmes.codigo ='.$filmesc[$contador]);
        while($gen = $G->fetchArray()){
            $genero[$contador2] = $gen['nome'];
            $generos.= $genero[$contador2].", ";
        $contador2++;
        }
        echo "<td>$generos</td>";
        $generos ='';
        $D = $db->query('select distinct diretor.nome from diretor join diretorfilme on diretorfilme.diretor = diretor.CPFCNPJ join filmes on filmes.codigo = diretorfilme.filme where filmes.codigo ='.$filmesc[$contador]);
        while($dir = $D->fetchArray()){
            $diretor[$contador3] = $dir['nome'];
            $diretores.= $diretor[$contador3].", ";
        $contador3++;
        }
        echo "<td>$diretores</td>";
        $diretores = '';
        $E = $db->query('select distinct ator.nome from ator join atorfilme on atorfilme.ator = ator.CPFCNPJ join filmes on filmes.codigo = atorfilme.filme where filmes.codigo ='.$filmesc[$contador]);
        while($ele = $E->fetchArray()){
            $ator[$contador4] = $ele['nome'];
            $atores.= $ator[$contador4].", ";
        $contador4++;
        }
        echo "<td>$atores</td>";
        $atores = '';
        echo "</tr>";
        $contador++;
    }
    ?>
</html>