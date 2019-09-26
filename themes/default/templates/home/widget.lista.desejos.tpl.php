<div class="lista-desejos">
    <button class="remove-modal" data-target="{id_modal}"></button>
    <label class="title"> Lista de desejos :)</label>
    <p class="text">
        Caso o produto adicionado a sua lista de desejo não esteja disponível provavelmente já foi vendido ou o dono(a) do produto apagou ou o pausou. 
    </p>
    <div class="lista-desejos-anuncios">
        <!--[loop]-->
        <div class="anuncio">                        
            <div class="product-cover">
                <img src="https://i0.wp.com/maizup.com.br/uploads/anuncios/1be7e90216d42a0721dd3426b6005907.png" />
            </div>
            <div class="product-data">
                <div class="center">
                    <label>{titulo}</label> 
                    <br />
                    <button class="btn-primary"><img src="https://img.icons8.com/material-outlined/24/ffffff/shopping-cart.png">Colocar no carrinho</button>
                </div>
            </div>                 
            <div class="product-price">
                <div class="center">
                    <label class="valor">{valor}</label>
                    <label class="parcelamento">{parcelamento}</label>
                    <div class="botoes">
                        <button class="btn-primary"><img src="https://img.icons8.com/material-outlined/24/ffffff/shopping-cart.png">COMPRAR</button>
                        <button class="btn-secondary"><img src="https://img.icons8.com/material-outlined/24/ff0000/delete-sign.png">Excuir</button>
                    </div>
                </div>
            </div>                    
        </div>   
        <!--[loop]-->
    </div>
</div>