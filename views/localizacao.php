<?php
require 'components/header.php';
?>

<style>
    .container-mapa {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .mapa-iframe {
        width: 80%;
        height: 450px;
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container-mapa">
    <iframe
        class="mapa-iframe"
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3949.330635456083!2d-63.5696102!3d-12.0576565!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93c4ef7d4db1ef6b%3A0x8c2648b1c9a4a36!2s-12.0576565%2C%20-63.5696102!5e0!3m2!1sen!2sbr!4v1694022768184!5m2!1sen!2sbr"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

<?php
require 'components/footer.php';
?>