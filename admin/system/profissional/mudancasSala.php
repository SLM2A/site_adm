<div class="content form_create">

    <?php
    require('_models/AdminProfissional.class.php');

    $teste = new AdminProfissional();
    $teste-> readAreaAtuacao();

    ?>

    <div class="clear"></div>
</div> <!-- content form- -->