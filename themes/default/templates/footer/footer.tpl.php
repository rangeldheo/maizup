<div class="footer"> 
    <div class="container">
        <div class="menu-footer">
            <label class="title">MAIZUP</label>
            <ul>
                <li><a href="#">Sobre nós</a></li>
                <li><a href="#">Programa de afiliados</a></li>
                <li><a href="#">Mapa do site</a></li>             
            </ul>
        </div>
        <div class="menu-footer">
            <label class="title">APOIO</label>
            <ul>
                <li><a href="#">Central de ajuda</a></li>
                <li><a href="#">Contate-nos</a></li>
                <li><a href="#">Como comprar</a></li>             
                <li><a href="#">Como vender</a></li>                                         
            </ul>
        </div>
        <div class="menu-footer">
            <label class="title">AVISO</label>
            <ul>
                <li><a href="#">Termo de uso</a></li>
                <li><a href="#">Política de privacidade</a></li>
                <li><a href="#">Política de reembolso</a></li>             
                <li><a href="#">Direitos autorais</a></li>                                         
            </ul>
        </div>
    </div> 
</div>

<!--modais-->
<div class="modal m-login">
    <div class="modal-container">
        <div class="cadastro">
            <button class="close-modal"></button>
            <label class="title">Login</label>
            <form>
                <input type="text" class="input icon-email" placeholder="Digite seu e-mail" />
                <input type="text" class="input icon-senha" placeholder="Digite su a senha" />
                <input type="submit" class="btn-secondary btn-block" value="Cadastrar" />
            </form>
            <div class="termos">                
                <label>Não tem conta? <a href="#">Cadastre-se grátis</a></label>
            </div>
        </div>
    </div>
</div>

<div class="modal m-cadastro">
    <div class="modal-container">
        <div class="cadastro">
            <button class="close-modal"></button>
            <label class="title">Cadastro</label>
            <form action="{base}/cadastro" method="post">
                <input type="text" class="input icon-email" placeholder="Digite seu e-mail" name="email" />
                <input type="password" class="input icon-senha" placeholder="Digite sua a senha" name="password" />
                <input type="submit" class="btn-secondary btn-block" value="Cadastrar" />
            </form>
            <div class="termos">
                <label>Ao se cadastrar você concorda com os <a href="#">termos de uso</a> e <a href="#">políticas de privacidade</a></label>
                <label>Já tem uma conta? <a href="#">Acesse já</a></label>
            </div>
        </div>
    </div>
</div>