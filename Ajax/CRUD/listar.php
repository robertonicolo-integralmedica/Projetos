<?php 

require_once 'conexao.php';

$html = '';

$sql = "SELECT * FROM crud_ajax";
$stmt = $pdo->prepare($sql);
if($stmt->execute()){
    while ($row = $stmt->fetch()) { 
        $html .= '<tr>
        <th scope="row">'.$row['nome'].'</th>
        <td>'.$row['idade'].'</td>
        </tr>';
    }
    print $html;
}


?>