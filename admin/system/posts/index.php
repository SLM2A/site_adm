<div class="content list_content">

    <section>

        <h1>Posts:</h1>

        <?php for ($i = 1; $i <= 10; $i++): ?>
            <article<?php if($i%2==0) echo ' class="right"';?>>

                <div class="img thumb_small"></div>
                <h1><a target="_blank" href="../artigo/uri-do-artigo" title="Ver Post">Tchau iPhone: Galaxy S3 supera o 4S e é o celular mais vendido do mundo</a></h1>
                <ul class="info post_actions">
                    <li><strong>Data:</strong> <?= date('d/m/Y H:i'); ?>Hs</li>
                    <li><a class="act_view" target="_blank" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Ver no site">Ver no site</a></li>
                    <li><a class="act_edit" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Editar">Editar</a></li>
                    <!--<li><a class="act_inative" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Ativar">Ativar</a></li>-->
                    <li><a class="act_ative" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Inativar">Ativar</a></li>
                    <li><a class="act_delete" href="painel.php?exe=posts/post&id=ID_DO_POST" title="Excluir">Deletar</a></li>
                </ul>

            </article>
        <?php endfor; ?>

        <div class="clear"></div>
    </section>
    
    <div class="paginator">
        <a href="#">Primeira Página</a>
        <a href="#">1</a>
        <a href="#">2</a>
        <span class="atv">3</span>
        <a href="#">4</a>
        <a href="#">5</a> 
        <a href="#">Última Página</a>
    </div>

    <div class="clear"></div>
</div> <!-- content home -->