<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Criar Area de Atuacao (Somente para os admins do site):</h1>
        </header>
        
        <?php
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if(!empty($data['SendPostForm'])):
                unset($data['SendPostForm']);
                                
                require '_models/AdminAreaAtuacao.class.php';
                $cadastra = new AdminAreaAtuacao;
                $cadastra->ExeCreate($data);
                
                if (!$cadastra->getResult()):
                    WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
                else:
                    header ('Location: painel.php?exe=categories/update&create=true&catid='.$cadastra->getResult());
                endif;
            endif;
        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">


            <label class="label">
                <span class="field">Nome:</span>
                <input type="text" name="nomeProfissao" value="<?php if (isset($data)) echo $data['nomeProfissao']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea name="descricaoProfissao" rows="5"><?php if (isset($data)) echo $data['descricaoProfissao']; ?></textarea>
            </label>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Cadastrar" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->