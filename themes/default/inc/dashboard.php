<div class="block dashboard">
    <div class="container">
        <div class="dash_header">  
            <div class="user-col">
                <div class="info">
                    <label class="lbl-normal">Niemerson Leal</label>
                    <label class="lbl-small">Apelido: DDTtakStore</label>
                </div>
                <div class="info">
                    <label class="lbl-small">Saldo para compras</label>
                    <label class="lbl-large">R$260,50</label>
                </div>
                <a href="#" class="btn-primary">Adicionar Saldo</a>
            </div>
            <div class="user-col">
                <div class="info">
                    <button class="btn-white-outline">Seguidores 32</button>
                </div>
                <div class="info">
                    <img src="<?= INCLUDE_PATH ?>/assets/images/icones/medalha-bronze-big.png" width="50" />
                </div>
            </div>
            <div class="info-vendas">
                <div class="saldo-vendas">
                    <div class="info">
                        <label class="lbl-normal">Saldo de vendas</label>
                    </div>
                    <div class="info">
                        <label class="lbl-small">Saldo a liberar</label>
                        <label class="lbl-large">R$60,50</label>
                        <label class="lbl-small">Detalhes</label>
                    </div>
                    <div class="info">
                        <label class="lbl-small">Saldo disponível para saque</label>
                        <label class="lbl-large">R$00,00</label>
                        <label class="lbl-small">Detalhes</label>
                        <a href="#" class="btn-secondary">Sacar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dash_menu">
            <button class="menu-trigger" data-target=".dash-menu-list"><img src="https://img.icons8.com/material-outlined/35/ffffff/drag-list-down.png"></button>
            <ul class="dash-menu-list">
                <li><a href="<?=BASE?>">Início</a></li>
                <li><a href="<?=BASE?>/dashboard">Dashboard</a></li>
                <li><a href="<?=BASE?>/adicionar-saldo">Add Saldo</a></li>
                <li><a href="<?=BASE?>/chat">Perguntas</a></li>
                <li><a href="#">Qualificações</a></li>
                <li><a href="<?=BASE?>/saque">Saque</a></li>
                <li><a href="<?=BASE?>">Minha Conta</a></li>
            </ul>
        </div>
    </div>
</div>