<div class="content form_create">

    <article>

        <header>
            <h1>Criar Post:</h1>
        </header>

        <?php
        //WSErro("Erro ao cadastrar:", "Existem campos ogrigatórios sem preencher.", WS_ALERT);
        //WSErro("Erro ao cadastrar:", "A capa deve ser JPG, PNG ou GIF com até 2MB!.", WS_ALERT);
        //WSErro("Sucesso:", "Seu post foi cadastrado com sucesso. <a target=\"_blank\" href=\"../artigo/titulo\">Ver Post</a>", WS_ACCEPT);
        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="cover" />
            </label>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content" rows="10"></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_title" value="<?= date('d/m/Y H:i:s'); ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="post_category">
                        <option value=""> Selecione a categoria: </option>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Author:</span>
                    <select name="post_category">
                        <option value=""> <?= "{$_SESSION['userlogin']['user_name']} {$_SESSION['userlogin']['user_lastname']}"; ?> </option>
                    </select>
                </label>

            </div><!--/line-->

            <div class="label gbform">

                <label class="label">             
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers" />
                </label>

                <ul class="gallery">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <li<?php if ($i % 5 == 0) echo ' class="right"'; ?>>
                            <div class="img thumb_small"></div>
                            <a class="del" href="#delete">Deletar</a>                    
                        </li>
                    <?php endfor; ?>
                </ul>                
            </div>


            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostFormPublish" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->