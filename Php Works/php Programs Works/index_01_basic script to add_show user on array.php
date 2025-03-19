<?php
// Classe para representar um Usuário
class Usuario {
    public $nome;
    public $email;

    public function __construct($nome, $email) {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function mostrarDetalhes() {
        return "Nome: {$this->nome}, Email: {$this->email}";
    }
}

// Função para exibir o menu
function exibirMenu() {
    echo "1. Adicionar Usuário\n";
    echo "2. Exibir Usuários\n";
    echo "3. Sair\n";
    echo "Escolha uma opção: ";
}

// Array para armazenar os usuários
$usuarios = [];

// Loop principal
while (true) {
    exibirMenu();
    $opcao = trim(fgets(STDIN)); // Captura a opção do usuário

    if ($opcao == "1") {
        echo "Digite o nome do usuário: ";
        $nome = trim(fgets(STDIN));
        echo "Digite o email do usuário: ";
        $email = trim(fgets(STDIN));

        // Validação de entrada
        if (empty($nome) || empty($email)) {
            echo "Nome e email não podem estar vazios. Tente novamente.\n\n";
            continue;
        }

        // Adiciona o usuário ao array
        $novoUsuario = new Usuario($nome, $email);
        $usuarios[] = $novoUsuario;
        echo "Usuário adicionado com sucesso!\n\n";

    } elseif ($opcao == "2") {
        if (empty($usuarios)) {
            echo "Nenhum usuário cadastrado ainda.\n\n";
        } else {
            echo "Usuários cadastrados:\n";
            foreach ($usuarios as $usuario) {
                echo $usuario->mostrarDetalhes() . "\n";
            }
            echo "\n";
        }

    } elseif ($opcao == "3") {
        echo "Saindo do programa. Até mais!\n";
        break;

    } else {
        echo "Opção inválida. Tente novamente.\n\n";
    }
}
?>
