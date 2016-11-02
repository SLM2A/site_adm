<div class="content form_create">

    <article>

        <header>
            <h1>Cadastrar Empresa:</h1>
        </header>

        <?php
//        WSErro("<b>Erro ao cadastrar:</b> Existem campos ogrigatórios sem preencher.", WS_ALERT);
//        WSErro("<b>Erro ao cadastrar:</b> A logo da empresa deve ser em JPG ou PNG e ter exatamente 578x288px", WS_ALERT);
//        WSErro("<b>Sucesso:</b> Empresa cadastrada com sucesso. <a target=\"_blank\" href=\"../empresa/nome_empresa\">Ver Empresa no Site</a>", WS_ACCEPT);        
        ?>
        
        
        
        <form name="PostForm" action="" method="post" enctype="multipart/form-data">


            <label class="label">
                <span class="field">Areas de Atuação:</span>
                <input type="text" id="txtAreaAtuacao"/>

                <ul class="resultados">

                </ul>
            </label>


            <label class="label">
                <span class="field">Foto de Perfil<sup>Exatamente 578x288px (JPG ou PNG)</sup></span>
                <input type="file" name="cover" />
            </label>

            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Nome:</span>
                    <input type="text" name="txtNomeUsuario" />
                </label>

                <label class="label_medium">
                    <span class="field">Sobrenome</span>
                    <input type="text" name="txtSobrenomeUsuario" />
                </label>
            </div>

            <label class="label">
                <span class="field">Sexo:</span>
                <select name="cbSexoUsuario">
                    <option value="" disabled selected> Indique a empresa como </option>
                    <option value="masculino"> Masculino </option>
                    <option value="feminino">  Feminino  </option>
                </select>
            </label>


            <div class="label_line">
                <label class="label_medium">
                    <span class="field">CPF</span>
                    <input type="text" name="txtCPFUsuario" class="formCPF center"/>
                </label>


                <label class="label_medium">
                    <span class="field">Data de Nascimento</span>
                    <input type="text" name="txtDataNascimento" class="formDataMask center"/>
                </label>
            </div>
            <label class="label">
                <span class="field">CEP</span>
                <input type="text" name="txtCEP" />
            </label>

            <label class="label">
                <span class="field">Endereço</span>
                <input type="text" name="txtEndereco" />
            </label>

            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Número</span>
                    <input type="text" name="txtNumero" />
                </label>

                <label class="label_medium">
                    <span class="field">Complemento</span>
                    <input type="text" name="txtComplemento" />
                </label>
            </div><!--/line-->

            <div class="label_line">

                <label class="label_medium">
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

                <label class="label_medium">
                    <span class="field">Cidade:</span>
                    <select class="j_loadcity" name="post_category" disabled>
                        <option value="" disabled selected> Selecione antes um estado </option>
                    </select>
                </label>

            </div><!--/line-->


            <div class="gbform"></div>

            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostFormPublish" />

        </form>

    </article>
    <div class="clear"></div>
<!--</div>  content form- -->