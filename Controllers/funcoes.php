<?php 
function conectar()
{
$servername = "localhost"; // Nome do servidor (geralmente localhost)
$username = "root"; // Nome de usuário do banco de dados
$password = "root"; // Senha do banco de dados
$dbname = "db_projetoscrum"; // Nome do banco de dados

try {
    // Cria a conexão usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Define o modo de erro do PDO para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão bem-sucedida";
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}
return $conn;
}

function criarCarrinho($nometabela,$camposTabela,$valores){
$conn = conectar();
$lista = $conn->prepare("INSERT INTO $nometabela($camposTabela) VALUES ($valores)");
$lista->execute();
if ($lista->rowCount() > 0) {
    return 'Cadastrado';

} else {
    return 'Vazio';
}

}

function mostrarItem($campos, $nometabela)
{
    $conn = conectar();
    $lista = $conn->query("SELECT $campos FROM $nometabela");
    $lista->execute();

    if ($lista->rowCount() > 0) {
        return $lista->fetchAll(PDO::FETCH_OBJ);
    } else {
        return array(); // Retorna um array vazio quando não há resultados
    }
}


?>