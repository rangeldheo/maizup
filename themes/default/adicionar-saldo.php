<?php
require REQUIRE_PATH . '/inc/dashboard.php';
?>
<div class="content dashboard">
    <div class="container dash-main">
        <label class="title">Adicionar Saldo</label>
        <div class="add-saldo">
            <div class="metodo">
                <label class="title text-center">Adicionar Saldo</label>
                <p class="text text-center">Escolha uma plataforma para adicionar saldo</p>
                <div class="gatways">
                    <div class="met-item">
                        <label class="fake-radio">
                            <input type="radio" id="mecpag" name="metodo" />
                            <label for="mecpag"></label>
                        </label>
                        <img src="<?= INCLUDE_PATH ?>/assets/images/layout/mercadopago.png" />
                    </div>
                    <div class="met-item">
                        <label class="fake-radio">
                            <input type="radio" id="pagseg" name="metodo" />
                            <label for="pagseg"></label>
                        </label>
                        <img src="<?= INCLUDE_PATH ?>/assets/images/layout/pagseguro.png" />
                    </div>
                    <div class="met-item">
                        <label class="fake-radio">
                            <input type="radio" id="paypal" name="metodo" />
                            <label for="paypal"></label>
                        </label>
                        <img src="<?= INCLUDE_PATH ?>/assets/images/layout/paypal.png" />
                    </div>
                </div>
            </div>
            <div class="metodo">
                <label class="title text-center">Adicionar Saldo usando Mercado Pago</label>
                <p class="text">Digite o valor que você deseja adicionar:</p>
                <div class="valor-add">
                    <input type="text" class="valor-add" placeholder="Informe o valor em R$" />
                    <label class="lbl-small">A taca do mercado pago é de 4.99%</label>
                    <div class="total">
                        <span class="lbl-small">Total em Reais</span><span class="saldo">R$83,99</span>
                    </div>
                    <div class="termos">
                        <label class="fake-checkbox">
                            <input type="checkbox" id="termos" name="termos" />
                            <label for="termos"></label>
                        </label>
                        <label>Li e concordo com os termos e condições.</label>
                    </div>
                    <button class="btn-air btn-ok block-w-100">Adicionar Saldo</button>
                </div>
            </div>
        </div>
    </div>
</div>
