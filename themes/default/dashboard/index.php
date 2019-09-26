<div class="container">
    <div class="dashboard">
        <div class="menu-lateral">
            <div class="menu-profile">
                <img class="user-photo circle" src="https://img.icons8.com/ios-filled/50/cccccc/user.png" width="50" />
                <div class="user-data">
                    <label>Niemerson</label>
                    <label>Membro desde abril /2019</label>
                </div>
                <div class="flex-center ver-perfil">
                    <a href="#" class="btn">Visualizar perfil</a>
                </div>
            </div>
            <div class="user-menus">
                <a href="<?=BASE?>/dashboard" class="title home">Início</a>               
                <label class="title vendas">Minhas Vendas</label>
                <ul>
                    <li><a href="#">Meus anúncios</a></li>
                    <li><a href="<?=BASE?>/dashboard/promocoes">Faça promoções</a></li>
                    <li><a href="<?=BASE?>/dashboard/perguntas">Perguntas</a></li>
                </ul>
                <label class="title compras">Minhas Compras</label>
                <ul>
                    <li><a href="<?=BASE?>/dashboard/minhas-compras">Minhas compras</a></li>
                    <li><a href="<?=BASE?>/dashboard/perguntas">Perguntas</a></li>
                    <li><a href="#">Favoritos</a></li>
                </ul>       
                <label class="title configs">Configurações</label>
            </div>
        </div>
        <div class="main">
            <?php
            /**
             * TODO | INTEGRAR TEMPLATES COM DADOS DAS TABELAS
             * NESSE MOMENTO APENAS CARREGAMOS OS TEMPLATES DE CADA TELA 
             * COM DADOS ESTÁTICOS DIRETOS NO HTML
             */
            $objWidget = WidgetCreate::getInstance();
            $objWidget->createWidget('widget')
                    ->setWidgetTemplate("admin/{$pagina}")
                    ->setWidgetConfig([
                        'base' => BASE,
                        'include_path' => INCLUDE_PATH,
                    ]);
            $objWidget->renderWidget();
            ?>
        </div>
    </div>
</div>