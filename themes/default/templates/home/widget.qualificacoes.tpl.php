<div class="component evaluation">       
    <div class="container">
        <label class="session-title">Qualificações recentes</label>
        <div class="body">
            <!--[loop]-->
            <div class="item eva-item">
                <img src="{include_path}/assets/images/icones/{qualificacao_tipo}.png" class="status">
                <p class="head note">
                    {msg}
                </p>
                <p class="item-main">{titulo}</p>
                <div class="foot">
                    <div class="user-data">
                        <img src="https://img.icons8.com/bubbles/50/000000/administrator-male.png">
                        <label class="title">{nome}</label>
                        <span class="data-publicacao">{data_pt}</span>
                    </div>
                </div>
            </div>           
            <!--[loop]-->                                                                                 
        </div>
        {paginacao}
        <a class="link" href="{base}/qualificacoes">ver mais</a>        
        <ul class="redes-sociais">
            <li><a href="#"><img src="https://img.icons8.com/material-outlined/24/ffffff/facebook-f.png" /></a></li>
            <li><a href="#"><img src="https://img.icons8.com/ios/24/ffffff/twitter.png" /></a></li>
            <li><a href="#"><img src="https://img.icons8.com/material-outlined/24/ffffff/youtube-play.png" /></a></li>
            <li><a href="#"><img src="https://img.icons8.com/material-outlined/24/ffffff/instagram-new.png"></a></li>
        </ul>
    </div> 
</div>