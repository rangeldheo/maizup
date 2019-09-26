 <div class="header-notification sys-alert">
                <div class="head">
                    <label>Notificações</label>
                    <a href="#">Ver todos</a>
                </div>
                <div class="body">
                    <?php
                    $ar = [0, 1, 2, 3, 4, 5];
                    foreach ($ar as $k):
                        ?>
                        <div class="alert alert_<?= $k ?>">
                            <span class="close-alert remove-comp" data-remove=".alert_<?= $k ?>"><img src="https://img.icons8.com/material/24/cf8d8d/cancel.png"></span>
                            <a href="#"><img src="https://img.icons8.com/bubbles/50/000000/administrator-male.png" width="34px"></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis.</p>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <div class="foot">
                    <button class="btn-primary close-comp" data-close=".sys-alert">Fechar</button>
                </div>
            </div>
            <div class="header-notification sys-question">
                <div class="head">
                    <label>Mensagens de venda</label>
                    <a href="#">Ver todos</a>
                </div>
                <div class="body">
                    <?php
                    $ar = [0, 1, 2, 3, 4, 5];
                    foreach ($ar as $k):
                        ?>
                        <div class="alert msg_<?= $k ?>">
                            <span class="close-alert remove-comp" data-remove=".msg_<?= $k ?>"><img src="https://img.icons8.com/material/24/cf8d8d/cancel.png"></span>                           
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis.</p>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <div class="foot">
                    <button class="btn-primary close-comp" data-close=".sys-question">Fechar</button>
                </div>
            </div> 
            