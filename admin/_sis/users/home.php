<?php
$AdminLevel = LEVEL_WC_USERS;
if (!APP_USERS || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

//AUTO DELETE USER TRASH
if (DB_AUTO_TRASH):
    $Delete = new Delete;
    $Delete->ExeDelete(DB_USERS, "WHERE user_name IS NULL AND user_email IS NULL and user_password IS NULL and user_level = :st", "st=1");
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

$S = filter_input(INPUT_GET, "s", FILTER_DEFAULT);
$O = filter_input(INPUT_GET, "opt", FILTER_DEFAULT);

$WhereString = (!empty($S) ? " AND user_name LIKE '%{$S}%' OR user_lastname LIKE '%{$S}%' OR concat(user_name, ' ', user_lastname) LIKE '%{$S}%' OR user_email LIKE '%{$S}%' OR user_id LIKE '%{$S}%' OR user_document LIKE '%{$S}%' " : "");
$WhereOpt = ((!empty($O) && $O == 'customers') ? " AND user_level <= 5" : ((!empty($O) && $O == 'team') ? " AND user_level >= 6 " : ""));

$Search = filter_input_array(INPUT_POST);
if ($Search && $Search['s']):
    $S = urlencode($Search['s']);
    $O = urlencode($Search['opt']);
    header("Location: dashboard.php?wc=users/home&opt={$O}&s={$S}");
    exit;
endif;
?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-users">Usuários</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            Usuários
        </p>
    </div>

    <div class="dashboard_header_search">
        <form name="searchUsers" action="" method="post" enctype="multipart/form-data" class="ajax_off">
            <input type="search" value="<?= $S; ?>" name="s" placeholder="Pesquisar:" style="width: 38%; margin-right: 3px;" />
            <select name="opt" style="width: 45%; margin-right: 3px; padding: 5px 10px">
                <option value="">Todos</option>
                <option <?= ($O == 'customers' ? "selected='selected'" : ''); ?> value="customers">Clientes</option>
                <option <?= ($O == 'team' ? "selected='selected'" : ''); ?> value="team">Equipe</option>
            </select>
            <button class="btn btn_green icon icon-search icon-notext"></button>
        </form>
    </div>
</header>

<div class="dashboard_content">
    <?php
    $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    $Page = ($getPage ? $getPage : 1);
    $Pager = new Pager("dashboard.php?wc=users/home&page=", "<<", ">>", 5);
    $Pager->ExePager($Page, 12);
    $Read->ExeRead(DB_USERS, "WHERE 1 = 1 $WhereString $WhereOpt ORDER BY user_name ASC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    if (!$Read->getResult()):
        $Pager->ReturnPage();
        echo Erro("<span class='al_center icon-notification'>Ainda não existem usuários cadastrados {$Admin['user_name']}. Comece agora mesmo cadastrando um novo usuário. Ou aguarde novos clientes!</span>", E_USER_NOTICE);
    else:
        foreach ($Read->getResult() as $Users):
            extract($Users);
            $user_name = ($user_name ? $user_name : 'Novo');
            $user_lastname = ($user_lastname ? $user_lastname : 'Usuário');
            $UserThumb = "../uploads/{$user_thumb}";
            $user_thumb = (file_exists($UserThumb) && !is_dir($UserThumb) ? "uploads/{$user_thumb}" : 'admin/_img/no_avatar.jpg');
            echo "<article class='single_user box box25 al_center'>
                    <div class='box_content wc_normalize_height'>
                        <img alt='Este é {$user_name}' title='Este é {$user_name}' src='../tim.php?src={$user_thumb}&w=400&h=400'/>
                        <h1>{$user_name} {$user_lastname}</h1>
                        <p class='nivel icon-equalizer'>" . getWcLevel($user_level) . "</p>
                        <p class='info icon-envelop'>{$user_email}</p>
                        <p class='info icon-calendar'>Desde " . date('d/m/Y \a\s H\h\si', strtotime($user_registration)) . "</p>
                    </div>
                    <div class='single_user_actions'>
                        <a class='btn btn_green icon-user' href='dashboard.php?wc=users/create&id={$user_id}' title='Gerenciar Usuário!'>Gerenciar Usuário!</a>
                    </div>
                </article>";
        endforeach;
        $Pager->ExePaginator(DB_USERS);
        echo $Pager->getPaginator();
    endif;
    ?>
</div>