<div class="flex-equal add-saldo">
    <div class="box_50 flex-equal">
        <span class="tag">Compras</span>
        <div class="flex-equal block-w-100 info">
            <div class="flex-center mark">
                <img src="https://img.icons8.com/ios/40/a3a3a3/wallet.png" width="40" height="40" />
            </div>
            <div class="flex-center money-data">
                <label class="block-w-100">Saldo para compras</label>
                <label class="block-w-100">R$1.249,00</label>
            </div>
            <div class="flex-center actions">
                <a href="{base}/dashboard/add-saldo" class="button button-primary">Adicionar</a>
            </div>
        </div>
    </div>                                          
    <div class="box_50 flex-equal">
        <span class="tag">Vendas</span>
        <div class="flex-equal block-w-100 ">
            <div class="flex-center mark">
                <img src="https://img.icons8.com/ios/40/a3a3a3/cheap-2.png" width="40" height="40" />
            </div>                       
            <div class="flex-center money-data">
                <label class="block-w-100">Saldo disponível</label>
                <label class="block-w-100">R$0,00</label>
            </div>
            <div class="flex-center actions">
                <a href="{base}/dashboard/sacar" class="button button-secondary">Sacar</a>
            </div>
        </div>
    </div>  
    <div class="box_100">
        <span class="tag">Vendas</span>
        <div class="flex-equal block-w-100 info">
            <div class="flex-center mark">
                <img src="https://img.icons8.com/ios/40/a3a3a3/cheap-2.png" />
            </div>                       
            <div class="flex-center money-data">
                <label class="block-w-100">Saldo a liberar</label>
                <label class="block-w-100">R$0,00</label>
            </div>  
            <div class="flex-center actions"></div>
        </div>
    </div> 
    <div class="box_50 flex-equal plataformas-pagamento">
        <span class="tag">Escolha a plataforma de pagamento</span>
        <div class="flex-start block-w-100 info">
            <div class="fake-radio">                  
                <input type="radio" name="option" id="opt01" />
                <label  for="opt01"></label>                
            </div> 
            <img class="img" src="{include_path}/assets/images/layout/mercadopago.png"  width="120"/>
            <label class="lbl">Tarifa 5,31%</label>
        </div>
        <div class="flex-start block-w-100 info">
            <div class="fake-radio">                  
                <input type="radio" name="option" id="opt02" />
                <label for="opt02"></label>                
            </div> 
            <img class="img" src="{include_path}/assets/images/layout/pagseguro.png"  width="120"/>
            <label class="lbl">Tarifa 6.90% + R$0,40</label>
        </div>
        <div class="flex-start block-w-100 info">
            <div class="fake-radio">                  
                <input type="radio" name="option" id="opt03" />
                <label for="opt03"></label>                
            </div> 
            <img class="img" src="{include_path}/assets/images/layout/paypal.png"  width="120"/>
            <label class="lbl">Tarifa 6,90% + R$0,60</label>
        </div>
    </div>
    <div class="box_50 flex-equal">
        <label class="title">Digite o valor que deseja adicionar</label>
        <div class="form-control">
            <label class="tag">Digite o valor que deseja adicionar</label>
            <input type="text" name="" placeholder="R$0,00">
        </div>
        <label class="tag">Taxa cobrada pelo Mercado pago é 5,31%</label>
        <label class="title">Você recebe R$0,00</label>
        <button class="btn btn-primary btn-block">FAZER PAGAMENTO</button>
        <div class="flex-equal servicos-suporte">
            <ul class="lista-servicos">
                <li>Após a compra você recebe:</li>
                <li class="item-list">Suporte especial</li>
                <li class="item-list">Ganrantia de até 45 dias</li>
            </ul>
        </div>
    </div>
</div>