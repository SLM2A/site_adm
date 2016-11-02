<div class="content cat_list">

    <section>

        <h1>Categorias:</h1>

        <?php
        if ($empty):
            WSErro("Você tentou editar ou remover uma categoria que não existe no sistema!", WS_INFOR);
        endif;
        ?>

        <?php
        $readSes = new Read();
        $readSes->ExeRead("ws_categories", "WHERE category_parent IS NULL ORDER BY category_title ASC");
        if (!$readSes->getResult()):

        else:
            foreach ($readSes->getResult() as $ses):
                extract($ses);

                $countSesPosts = '';
                $countSesCats = '';
                ?>
                <section>

                    <header>
                        <h1><?= $category_title; ?> <span>( <?= $countSesPosts; ?> posts ) ( <?= $countSesCats; ?> Categorias )</span></h1>
                        <p class="tagline"><?= $category_content;?></p>

                        <ul class="info post_actions">
                            <li><strong>Data:</strong> <?= date('d/m/Y H:i'); ?>Hs</li>
                            <li><a class="act_view" target="_blank" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Ver no site">Ver no site</a></li>
                            <li><a class="act_edit" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Editar">Editar</a></li>
                            <li><a class="act_delete" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Excluir">Deletar</a></li>
                        </ul>
                    </header>

                    <h2>Sub categorias de vídeo aulas:</h2>

                    <?php
                    $a = 1;
                    ?>
                    <article<?php if ($a % 3 == 0) echo ' class="right"'; ?>>
                        <h1><a target="_blank" href="../categoria/uri-da-categoria" title="Ver Categoria">Programação com PHP:</a>  ( 7 posts )</h1>

                        <ul class="info post_actions">
                            <li><strong>Data:</strong> <?= date('d/m/Y H:i'); ?>Hs</li>
                            <li><a class="act_view" target="_blank" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Ver no site">Ver no site</a></li>
                            <li><a class="act_edit" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Editar">Editar</a></li>
                            <li><a class="act_delete" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Excluir">Deletar</a></li>
                        </ul>
                    </article>
                    <?php
                    ?>

                </section>
                <?php
            endforeach;
        endif;
        ?>

        <div class="clear"></div>
    </section>

    <div class="clear"></div>
</div> <!-- content home -->