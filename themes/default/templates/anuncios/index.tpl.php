<!--[loop]-->
<div class="anuncio">    
    <div class="user-data">
        <div class="head">
            <img src="https://img.icons8.com/bubbles/50/000000/administrator-male.png">
            <label class="title">{nome}</label> 
            <img class="verified" src="https://img.icons8.com/ios-glyphs/24/0884d3/ok.png">
        </div>
        <div class="item-main tooltip-cont">
            <div class="tooltip">
                <span class="label">Nível de vendas</span>
                <a href="#">Saiba mais</a>
            </div>
            <img src="{include_path}/assets/images/icones/{patente}.png" alt="Medalha" class="medalha"/>
        </div>                   
    </div>
    <div class="product-cover">
        <a href="{base}/anuncio">
            <!--img src="{base}/{cover}" /-->
            <img src="{cover}" />
        </a>
    </div>
    <div class="product-data">
        <label>{titulo}</label>        
        {filtros_do_anuncio}
    </div>
    <div class="product-info">
        <span>+ informações</span>
        <ul>
            <li>
                <div class="icon dias tooltip-cont">
                    <div class="tooltip">
                        <span class="label">Garantia do vendedor</span>
                        <a href="#">Saiba mais</a>
                    </div>
                </div>
                <span>{garantia} dias</span>
            </li>
            <li><span class="icon disponiveis"></span><span>{prazo_entrega}</span></li>
            <li><span class="icon prazo"></span><span>{quantidade_formated}</span></li>            
        </ul>
    </div>
    <div class="product-price">
        <div>
            <label class="valor">R${valor}</label>
            <label class="parcelamento">{parcelamento}</label>
            <a class="btn btn-primary" href="{base}/anuncio">ver detalhes</a>
        </div>
    </div>
    <span class="add-lista-desejos"><img src="https://img.icons8.com/material-outlined/24/fac008/hearts.png"></span>
</div>  
<!--[loop]-->     