<?php
require 'components/header.php';
?>

<style>
    .container-contatos {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .contatos-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        width: 80%;
        margin: 0 auto;
    }

    .contato-item {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 20px;
        border-radius: 8px;
        color: white;
        font-family: "Saira Extra Condensed", sans-serif;
        font-size: 1.2rem;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .contato-item:hover {
        transform: scale(1.05);
    }

    .contato-item i {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .whatsapp {
        background-color: #25D366;
    }

    .facebook {
        background-color: #3b5998;
    }

    .instagram {
        background-color: #E4405F;
    }

    .email {
        background-color: #D44638;
    }
</style>

<div class="container-contatos">
    <div class="contatos-grid">
        <div class="contato-item whatsapp">
            <i class="fab fa-whatsapp"></i>
            <p>WhatsApp</p>
        </div>
        <div class="contato-item facebook">
            <i class="fab fa-facebook-f"></i>
            <p>Facebook</p>
        </div>
        <div class="contato-item instagram">
            <i class="fab fa-instagram"></i>
            <p>Instagram</p>
        </div>
        <div class="contato-item email">
            <i class="fas fa-envelope"></i>
            <p>Email</p>
        </div>
    </div>
</div>

<?php
require 'components/footer.php';
?>