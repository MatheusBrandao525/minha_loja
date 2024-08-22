<?php
include 'components/header.php';
?>
<style>
    .container-preto {
        padding-left: 0 !important;
    }

    .profile-container {
        display: flex;
        max-width: 100%;
        margin: 0 auto;
    }

    .sidebar {
        width: 25%;
        background-color: #131313;
        color: #fff;
        padding: 20px;
        box-sizing: border-box;
        min-height: 100vh;
    }

    .user-avatar-section {
        text-align: center;
        margin-bottom: 30px;
    }

    .user-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .sidebar-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav ul li {
        margin-bottom: 20px;
    }

    .sidebar-nav ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        display: block;
        padding: 10px;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .sidebar-nav ul li a:hover {
        background-color: #2c3a52;
    }

    .profile-main {
        flex: 1;
        background-color: #fff;
        padding: 30px;
        box-sizing: border-box;
    }

    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .back-link {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .header-buttons .btn-premium,
    .header-buttons .btn-logout {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        margin-left: 10px;
        transition: background 0.3s;
    }

    .header-buttons .btn-logout {
        background-color: #dc3545;
    }

    .header-buttons .btn-premium:hover,
    .header-buttons .btn-logout:hover {
        background-color: #0056b3;
    }

    .header-buttons .btn-logout:hover {
        background-color: #c82333;
    }

    .profile-content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .profile-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-section h3 {
        margin-top: 0;
        color: #333;
    }

    .profile-section form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .profile-section form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .btn-save {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-save:hover {
        background-color: #218838;
    }

    .invoices-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .invoices-list a {
        text-decoration: none;
        color: #131313;
    }

    .invoices-list li {
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .close-account-section {
        grid-column: span 2;
        background-color: #fff3cd;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #ffeeba;
    }

    .close-account-section p {
        margin: 0 0 20px;
        color: #856404;
    }

    .close-account-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-close-account {
        background-color: #dc3545;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-keep-account {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-close-account:hover {
        background-color: #c82333;
    }

    .btn-keep-account:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .profile-content {
            grid-template-columns: 1fr;
        }
    }
</style>
<div class="container container-preto">
    <div class="profile-container">
        <aside class="sidebar">
            <div class="user-avatar-section">
                <img src="public/assets/img/placeholder.jpg" alt="User Avatar" class="user-avatar">
                <h2><?php echo $dadosUsuario['nome']; ?></h2>
                <p><?php echo $dadosUsuario['email']; ?></p>
            </div>
        </aside>
        <main class="profile-main">
            <header class="profile-header">
                <a href="home" class="back-link">home</a>
                <div class="header-buttons">
                    <a href="logout" class="btn-logout">Sair</a>
                </div>
            </header>
            <section class="profile-content">
                <div class="profile-section">
                    <h3>Informações Pessoais</h3>
                    <form>
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $dadosUsuario['nome']; ?>">

                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" value="<?php echo $dadosUsuario['cpf']; ?>">

                        <label for="cpf">E-mail</label>
                        <input type="text" id="cpf" name="cpf" value="<?php echo $dadosUsuario['email']; ?>">

                        <label for="cpf">Telefone</label>
                        <input type="text" id="cpf" name="cpf" value="<?php echo $dadosUsuario['telefone']; ?>">
                    </form>
                </div>
                <div class="profile-section">
                    <h3>Endereço Padrão</h3>
                    <form action="alteraendereco" method="post">
                        <label for="direccion">Endereço</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo $dadosUsuario['endereco']; ?>">

                        <label for="numero">Número</label>
                        <input type="text" id="numero" name="numero" value="<?php echo $dadosUsuario['numero']; ?>">

                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro" value="<?php echo $dadosUsuario['bairro']; ?>">

                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" value="<?php echo $dadosUsuario['cep']; ?>">

                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento" value="<?php echo $dadosUsuario['complemento']; ?>">

                        <button type="submit" class="btn-save">Alterar Dados</button>
                    </form>
                </div>
                <div class="profile-section">
                    <h3>Alterar Senha</h3>
                    <form>
                        <label for="current-password">Senha Atual</label>
                        <input type="password" id="current-password" name="current-password">

                        <label for="new-password">Nova Senha</label>
                        <input type="password" id="new-password" name="new-password">

                        <label for="confirm-password">Repita a Nova Senha</label>
                        <input type="password" id="confirm-password" name="confirm-password">

                        <button type="submit" class="btn-save">Alterar Senha</button>
                    </form>
                </div>
                <div class="profile-section">
                    <h3>Últimas Compras</h3>
                    <ul class="invoices-list">
                        <?php
                        if (!empty($pedidosCliente)) {
                            foreach ($pedidosCliente as $pedido): ?>
                                <li>
                                    <form action="detalhespedido" method="post">
                                        <input type="hidden" name="clienteid" value="<?php echo $_SESSION['ID']; ?>">
                                        <input type="hidden" name="pedidoid" value="<?php echo $pedido['pedido_id']; ?>">
                                        <input type="hidden" name="ticketpedido" value="<?php echo $pedido['ticket_pedido']; ?>">
                                        <button type="submit"><?php echo $pedido['ticket_pedido']; ?> - <?php echo date('d/m/Y', strtotime($pedido['data_pedido'])); ?></button>
                                    </form>
                                </li>
                            <?php endforeach;
                        } else { ?>
                            <h6>Você ainda não realizou nenhum pedido.</h6>
                        <?php } ?>
                    </ul>
                </div>
            </section>
        </main>
    </div>


</div>

<?php
include 'components/footer.php';
?>