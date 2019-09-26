<div class="content main_categorias">   
    <div class="filtros">
        <div class="filtro-title">
            <div class="pelicula">
                <h1 class="container">{category_name}</h1>
            </div>
        </div>
        <div class="filtro-tipo">
            <div class="container">
                <ul class="tipos">
                    <li class="active">                   
                        <a href="#"><img src="{include_path}/assets/images/layout/contas.png" /></a>
                        <span>Contas</span>
                        <span>(40)</span>
                    </li>
                    <li>
                        <a href="#"><img src="{include_path}/assets/images/layout/itens.png" /></a>
                        <span>(Itens)</span>
                        <span>(35)</span>
                    </li>
                    <li>
                        <a href="#"><img src="{include_path}/assets/images/layout/moedas.png" /></a>
                        <span>(Moedas)</span>
                        <span>(27)</span>
                    </li>
                </ul>
            </div>
        </div>
        {filtros}
        <div class="container garantia-do-site">
            <a href="#">Garantia do site</a>
        </div>
        <div class="container barra-de-pesquisa">
            <form>
                <div class="group input-busca">
                    <input type="text" class="input" placeholder="Pesquisa Rápida" />
                    <button class="btn icon lupa"></button>
                </div>
            </form>
        </div>
    </div>  
    <div class="container anuncios-by-cat">
        <!--lista de anuncio appended -->
        {lista_anuncios}
        <!--lista de anuncio appended -->
        {paginacao}
        <div class="actions">            
            <button class="btn-primary">O site é confiável?</button>
        </div>
        <ul class="redes-sociais">
            <li><a href="#"><img src="https://img.icons8.com/material-outlined/24/ffffff/facebook-f.png" /></a></li>
            <li><a href="#"><img src="https://img.icons8.com/ios/24/ffffff/twitter.png" /></a></li>
            <li><a href="#"><img src="https://img.icons8.com/material-outlined/24/ffffff/youtube-play.png" /></a></li>
            <li><a href="#"><img src="https://img.icons8.com/material-outlined/24/ffffff/instagram-new.png"></a></li>
        </ul>
    </div>
</div>