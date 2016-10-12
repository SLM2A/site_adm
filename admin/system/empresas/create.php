<div class="content form_create">

    <article>

        <header>
            <h1>Cadastrar Empresa:</h1>
        </header>

        <?php
        WSErro("<b>Erro ao cadastrar:</b> Existem campos ogrigatórios sem preencher.", WS_ALERT);
        WSErro("<b>Erro ao cadastrar:</b> A logo da empresa deve ser em JPG ou PNG e ter exatamente 578x288px", WS_ALERT);
        WSErro("<b>Sucesso:</b> Empresa cadastrada com sucesso. <a target=\"_blank\" href=\"../empresa/nome_empresa\">Ver Empresa no Site</a>", WS_ACCEPT);
        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Logo da empresa: <sup>Exatamente 578x288px (JPG ou PNG)</sup></span>
                <input type="file" name="cover" />
            </label>

            <label class="label">
                <span class="field">Nome da Empresa:</span>
                <input type="text" name="post_title" />
            </label>

            <label class="label">
                <span class="field">Ramo de atividade:</span>
                <input type="text" name="post_title" />
            </label>

            <label class="label">
                <span class="field">Sobre a empresa:</span>
                <textarea name="" rows="3"></textarea>
            </label>

            <label class="label">
                <span class="field">Nome da rua / Número:</span>
                <input type="text" name="post_title" />
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Estado UF:</span>
                    <select class="j_loadstate" name="post_category">
                        <option value="" disabled selected> Selecione o estado </option>
                        <?php
                        $readState = new Read;
                        $readState->ExeRead("app_estados", "ORDER BY estado_nome ASC");
                        foreach ($readState->getResult() as $estado):
                            extract($estado);
                            echo "<option value=\"{$estado_id}\"> {$estado_uf} / {$estado_nome} </option>";
                        endforeach;
                        ?>                        
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Cidade:</span>
                    <select class="j_loadcity" name="post_category" disabled>
                        <option value="" disabled selected> Selecione antes um estado </option>
                    </select>
                </label>


                <label class="label_small">
                    <span class="field">Indicação:</span>
                    <select name="post_category">
                        <option value="" disabled selected> Indique a empresa como </option>
                        <option value="onde-comer"> Onde Comer </option>
                        <option value="onde-ficar"> Onde Ficar </option>
                        <option value="onde-comprar"> Onde Comprar </option>
                        <option value="onde-se-divertir"> Onde se Divertir </option>
                    </select>
                </label>

            </div><!--/line-->


            <div class="gbform"></div>

            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostFormPublish" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content form- -->