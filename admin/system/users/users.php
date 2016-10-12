<div class="content form_create">

    <article>

        <?php extract($_SESSION['userlogin']); ?>

        <h1>Usuários: <a href="painel.php?exe=users/create" title="Cadastrar Novo" class="user_cad">Cadastrar Usuário</a></h1>

        <ul class="ultable">
            <li class="t_title">
                <span class="ui center">Res:</span>
                <span class="un">Nome:</span>
                <span class="ue">E-mail:</span>
                <span class="ur center">Registro:</span>
                <span class="ua center">Atualização:</span>
                <span class="ul center">Nível:</span>
                <span class="ed center">-</span>
            </li>
            
            <?php for($u=1;$u<=5;$u++):?>            
            <li>
                <span class="ui center"><?=$u;?></span>
                <span class="un">Robson Vidaletti Leite</span>
                <span class="ue">contato@upinside.com.br</span>
                <span class="ur center"><?=date('d/m/Y');?></span>
                <span class="ua center"><?=date('d/m/Y H:i');?>Hs</span>
                <span class="ul center">Admin</span>
                <span class="ed center">
                    <a href="" title="Editar" class="action user_edit">Editar</a>
                    <a href="" title="Deletar" class="action user_dele">Deletar</a>
                </span>
            </li>
            <?php endfor;?>
            
        </ul>


    </article>

    <div class="clear"></div>
</div> <!-- content home -->