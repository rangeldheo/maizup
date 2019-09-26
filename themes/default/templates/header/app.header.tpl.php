{widget.topbar}
<div class="container">    
    <div class="header">  
        <div class="logo">
            <a href="{base}"><img class="bounceIn" src="{logo}" /></a>
        </div>
        {widget.categorias}
        <form class="busca">
            <input type="text" />
            <button type="submit" ><i class="icon lupa"></i></button>
        </form>
        <div class="botoes">
            <a href="{link-announce}" class="btn-secondary"><i class="icon cifrao"></i>Anunciar</a>        
            <span class="btn-primary btn-cart open-alert" data-target=".sys-cart"><i class="icon cart"></i></span>
            <div class="header-notification sys-cart">
                <div class="head color-primary">
                    <img src="https://img.icons8.com/material-outlined/24/0aa1e6/shopping-cart.png">
                    <label>Meu Carrinho</label>
                </div>
                <div class="body">                    
                        <div class="alert cart_{id}">
                            <div>
                                <span class="close-alert remove-comp" data-remove=".cart_{id}"><img src="https://img.icons8.com/material/24/cf8d8d/cancel.png"></span>                           
                                <img src="http://i0.wp.com/maizup.com.br/uploads/anuncios/1be7e90216d42a0721dd3426b6005907.png" />
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>                
                </div>
                <div class="foot">
                    <button class="btn-primary close-comp" data-close=".sys-cart">Fechar</button>
                </div>
            </div>
        </div>        
    </div>    
</div>