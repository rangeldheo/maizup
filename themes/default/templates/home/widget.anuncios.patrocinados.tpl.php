<div class="component carrossel">
    <label class="session-title">Anúncios patrocinados</label>
    <div class="body">
        <!--[loop]-->
        <div class="item cs-item bounceIn">
            <a href="{base}/anuncio">  
                <!--img class="cover" src="{base}/tim.php?src={cover}&w=235&h=150"/-->
                <img class="cover" src="{cover}">
            </a>
            <div class="item-main">
                <p>{descricao}</p>                        
            </div>  
            <div class="foot">
                <label class="price bold black">R${valor}</label>
                <div class="user-data" data-end-point="/ajax/add.desejos">
                    <img src="https://img.icons8.com/bubbles/50/000000/administrator-male.png">
                    <label class="title">{nome}</label>
                    <img src="{include_path}/assets/images/icones/{patente}.png" alt="Medalha" class="medalha"/>
                    <img class="favoritar j-add-desejos"
                         data-id="{id}" 
                         data-form=".user-data" 
                         data-action="add"
                         src="{include_path}/assets/images/icones/coracao.png" />
                </div>
            </div>
        </div> 
        <!--[loop]-->
    </div>   
</div>  