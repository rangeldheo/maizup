<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_USERS;

if ((!APP_USERS && !APP_EAD) || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Você não tem permissão para essa ação ou não está logado como administrador!', E_USER_ERROR);
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Users';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ
    if (empty($Read)):
        $Read = new Read;
    endif;

    // AUTO INSTANCE OBJECT CREATE
    if (empty($Create)):
        $Create = new Create;
    endif;

    // AUTO INSTANCE OBJECT UPDATE
    if (empty($Update)):
        $Update = new Update;
    endif;

    // AUTO INSTANCE OBJECT DELETE
    if (empty($Delete)):
        $Delete = new Delete;
    endif;
    $Upload = new Upload('../../uploads/');

    //SELECIONA AÇÃO
    switch ($Case):
        case 'manager':
            $UserId = $PostData['user_id'];
            unset($PostData['user_id'], $PostData['user_thumb']);

            $Read->FullRead("SELECT user_id FROM " . DB_USERS . " WHERE user_email = :email AND user_id != :id", "email={$PostData['user_email']}&id={$UserId}");
            if ($Read->getResult()):
                $jSON['trigger'] = AjaxErro("<b class='icon-warning'>OPSS:</b> Olá {$_SESSION['userLogin']['user_name']}. O e-mail <b>{$PostData['user_email']}</b> já está cadastrado na conta de outro usuário!", E_USER_WARNING);
            else:
                $Read->FullRead("SELECT user_id FROM " . DB_USERS . " WHERE user_document = :dc AND user_id != :id", "dc={$PostData['user_document']}&id={$UserId}");
                if ($Read->getResult()):
                    $jSON['trigger'] = AjaxErro("<b class='icon-warning'>OPSS:</b> Olá {$_SESSION['userLogin']['user_name']}. O CPF <b>{$PostData['user_document']}</b> já está cadastrado na conta de outro usuário!", E_USER_WARNING);
                else:
                    if (Check::CPF($PostData['user_document']) != true):
                        $jSON['trigger'] = AjaxErro("<b class='icon-warning'>OPSS:</b> Olá {$_SESSION['userLogin']['user_name']}. O CPF <b>{$PostData['user_document']}</b> informado não é válido!", E_USER_WARNING);
                        echo json_encode($jSON);
                        return;
                    endif;

                    if (!empty($_FILES['user_thumb'])):
                        $UserThumb = $_FILES['user_thumb'];
                        $Read->FullRead("SELECT user_thumb FROM " . DB_USERS . " WHERE user_id = :id", "id={$UserId}");
                        if ($Read->getResult()):
                            if (file_exists("../../uploads/{$Read->getResult()[0]['user_thumb']}") && !is_dir("../../uploads/{$Read->getResult()[0]['user_thumb']}")):
                                unlink("../../uploads/{$Read->getResult()[0]['user_thumb']}");
                            endif;
                        endif;

                        $Upload->Image($UserThumb, $UserId . "-" . Check::Name($PostData['user_name'] . $PostData['user_lastname']) . '-' . time(), 600);
                        if ($Upload->getResult()):
                            $PostData['user_thumb'] = $Upload->getResult();
                        else:
                            $jSON['trigger'] = AjaxErro("<b class='icon-image'>ERRO AO ENVIAR FOTO:</b> Olá {$_SESSION['userLogin']['user_name']}, selecione uma imagem JPG ou PNG para enviar como foto!", E_USER_WARNING);
                            echo json_encode($jSON);
                            return;
                        endif;
                    endif;

                    if (!empty($PostData['user_password'])):
                        if (strlen($PostData['user_password']) >= 5):
                            $PostData['user_password'] = hash('sha512', $PostData['user_password']);
                        else:
                            $jSON['trigger'] = AjaxErro("<b class='icon-warning'>ERRO DE SENHA:</b> Olá {$_SESSION['userLogin']['user_name']}, a senha deve ter no mínimo 5 caracteres para ser redefinida!", E_USER_WARNING);
                            echo json_encode($jSON);
                            return;
                        endif;
                    else:
                        unset($PostData['user_password']);
                    endif;

                    if ($UserId == $_SESSION['userLogin']['user_id']):
                        if ($PostData['user_level'] != $_SESSION['userLogin']['user_level']):
                            $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>PERFIL ATUALIZADO COM SUCESSO:</b> Olá {$_SESSION['userLogin']['user_name']}, seus dados foram atualizados com sucesso!<p class='icon-warning'>Seu nível de usuário não foi alterado pois não é permitido atualizar o próprio nível de acesso!</p>");
                        else:
                            $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>PERFIL ATUALIZADO COM SUCESSO:</b> Olá {$_SESSION['userLogin']['user_name']}, seus dados foram atualizados com sucesso!");
                        endif;
                        $SesseionRenew = true;
                        unset($PostData['user_level']);
                    elseif ($PostData['user_level'] > $_SESSION['userLogin']['user_level']):
                        $PostData['user_level'] = $_SESSION['userLogin']['user_level'];
                        $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>TUDO CERTO:</b> Olá {$_SESSION['userLogin']['user_name']}. O usuário {$PostData['user_name']} {$PostData['user_lastname']} foi atualizado com sucesso!<p class='icon-warning'>Você não pode criar usuários com nível de acesso maior que o seu. Então o nível gravado foi " . getWcLevel($PostData['user_level']) . "!</p>");
                    else:
                        $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>TUDO CERTO:</b> Olá {$_SESSION['userLogin']['user_name']}. O usuário {$PostData['user_name']} {$PostData['user_lastname']} foi atualizado com sucesso!");
                    endif;

                    $PostData['user_datebirth'] = (!empty($PostData['user_datebirth']) ? Check::Nascimento($PostData['user_datebirth']) : null);

                    //ATUALIZA USUÁRIO
                    $Update->ExeUpdate(DB_USERS, $PostData, "WHERE user_id = :id", "id={$UserId}");
                    if (!empty($SesseionRenew)):
                        $Read->ExeRead(DB_USERS, "WHERE user_id = :id", "id={$UserId}");
                        if ($Read->getResult()):
                            $_SESSION['userLogin'] = $Read->getResult()[0];
                        endif;
                    endif;
                endif;
            endif;
            break;

        case 'delete':
            $UserId = $PostData['del_id'];
            $Read->ExeRead(DB_USERS, "WHERE user_id = :user", "user={$UserId}");
            if (!$Read->getResult()):
                $jSON['trigger'] = AjaxErro("<b class='icon-warning'>USUÁRIO NÃO EXISTE:</b> Olá {$_SESSION['userLogin']['user_name']}, você tentou deletar um usuário que não existe ou já foi removido!", E_USER_WARNING);
            else:
                extract($Read->getResult()[0]);
                if ($user_id == $_SESSION['userLogin']['user_id']):
                    $jSON['trigger'] = AjaxErro("<b class='icon-warning'>OPPSSS:</b> Olá {$_SESSION['userLogin']['user_name']}, por questões de segurança, o sistema não permite que você remova sua própria conta!", E_USER_WARNING);
                elseif ($user_level > $_SESSION['userLogin']['user_level']):
                    $jSON['trigger'] = AjaxErro("<b class='icon-warning'>PERMISSÃO NEGADA:</b> Desculpe {$_SESSION['userLogin']['user_name']}, mas {$user_name} tem acesso superior ao seu. Você não pode remove-lo!", E_USER_WARNING);
                else:
                    $Delete->ExeDelete(DB_ORDERS_ITEMS, "WHERE order_id IN(SELECT order_id FROM " . DB_ORDERS . " WHERE user_id = :user)", "user={$user_id}");
                    $Delete->ExeDelete(DB_ORDERS, "WHERE user_id = :user", "user={$user_id}");
                    $Delete->ExeDelete(DB_USERS_ADDR, "WHERE user_id = :user", "user={$user_id}");

                    //COMMENT CONTROL
                    $Read->FullRead("SELECT id FROM " . DB_COMMENTS . " WHERE user_id = :user", "user={$user_id}");
                    if ($Read->getResult()):
                        //RESPONSES REMOVE
                        foreach ($Read->getResult() as $DelId):
                            $Delete->ExeDelete(DB_COMMENTS, "WHERE alias_id = :in", "in={$DelId['id']}");
                        endforeach;
                        //COMMENT REMOVE
                        $Delete->ExeDelete(DB_COMMENTS, "WHERE user_id = :user", "user={$user_id}");
                        $Delete->ExeDelete(DB_COMMENTS_LIKES, "WHERE user_id = :user", "user={$user_id}");
                    endif;

                    if (file_exists("../../uploads/{$user_thumb}") && !is_dir("../../uploads/{$user_thumb}")):
                        unlink("../../uploads/{$user_thumb}");
                    endif;

                    $Delete->ExeDelete(DB_USERS, "WHERE user_id = :user", "user={$user_id}");
                    $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>USUÁRIO REMOVIDO COM SUCESSO!</b>");
                    $jSON['redirect'] = "dashboard.php?wc=users/home";
                endif;
            endif;
            break;

        case 'addr_add':
            $AddrId = $PostData['addr_id'];
            unset($PostData['addr_id']);

            $Update->ExeUpdate(DB_USERS_ADDR, $PostData, "WHERE addr_id = :addr", "addr={$AddrId}");
            $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>ENDEREÇO ATUALIZADO COM SUCESSO!</b>");
            break;

        case 'addr_delete':
            $Read->ExeRead(DB_ORDERS, "WHERE order_addr = :addr", "addr={$PostData['del_id']}");
            if ($Read->getResult()):
                $jSON['trigger'] = AjaxErro("<b class='icon-warning'>ERRO AO DELETAR:</b> Olá {$_SESSION['userLogin']['user_name']}, deletar um endereço vinculado a pedidos não é permitido pelo sistema!", E_USER_WARNING);
            else:
                $Delete->ExeDelete(DB_USERS_ADDR, "WHERE addr_id = :addr", "addr={$PostData['del_id']}");
                $jSON['sucess'] = true;
            endif;
            break;

        case 'block_user':

            //ADD NOTE
            $Read->ExeRead(DB_USERS, "WHERE user_id = :user", "user={$PostData['admin_id']}");
            $AdminName = $Read->getResult()[0]['user_name'] . ' ' . $Read->getResult()[0]['user_lastname'];
            $NoteBlock = [
                'user_id' => $PostData['user_id'],
                'admin_id' => $PostData['admin_id'],
                'note_text' => "<b class='font_red'>Usuário bloqueado</b> Motivo: {$PostData['user_blocking_reason']}",
                'note_datetime' => date('Y-m-d H:i:s')
            ];

            $Create->ExeCreate(DB_USERS_NOTES, $NoteBlock);

            //BLOCK USER
            $Block = [
                'user_blocking_reason' => $PostData['user_blocking_reason']
            ];
            $Update->ExeUpdate(DB_USERS, $Block, "WHERE user_id = :user", "user={$PostData['user_id']}");

            //SEND NOTIFICATION
            $Read->LinkResult(DB_USERS, "user_id", $PostData['user_id']);
            $Student = $Read->getResult()[0];

            require '../../_ead/wc_ead.email.php';
            $MailBody = "
                    <p style='font-size: 1.4em;'>Olá {$Student['user_name']},</p>
                    <p>Este e-mail é para informar que sua conta foi <b>bloqueada</b> na nossa Escola Online.</p>
                    <p>Analise o motivo do bloqueio abaixo:</p>
                    <p>{$Block['user_blocking_reason']}</p>
                    <p>Se acredita que sua conta foi bloqueada de forma equivocada, não deixe de responder este e-mail!</p>
                ";

            $MailContent = str_replace("#mail_body#", $MailBody, $MailContent);
            $Email = new Email;
            $Email->EnviarMontando("Sua conta foi suspensa da escola online!", $MailContent, MAIL_SENDER, MAIL_USER, "{$Student['user_name']} {$Student['user_lastname']}", $Student['user_email']);


            $jSON['redirect'] = 'dashboard.php?wc=teach/students_gerent&id=' . $PostData['user_id'];
            $jSON['success'] = true;
            $jSON['clear'] = true;
            break;

        case 'unblock_user':

            //ADD NOTE
            $Read->ExeRead(DB_USERS, "WHERE user_id = :user", "user={$PostData['admin_id']}");
            $AdminName = $Read->getResult()[0]['user_name'] . ' ' . $Read->getResult()[0]['user_lastname'];
            $NoteBlock = [
                'user_id' => $PostData['user_id'],
                'admin_id' => $PostData['admin_id'],
                'note_text' => "<b class='font_green'>Usuário desbloqueado!</b> Motivo: {$PostData['user_blocking_reason']}",
                'note_datetime' => date('Y-m-d H:i:s')
            ];

            $Create->ExeCreate(DB_USERS_NOTES, $NoteBlock);

            //BLOCK USER
            $Block = [
                'user_blocking_reason' => null
            ];
            $Update->ExeUpdate(DB_USERS, $Block, "WHERE user_id = :user", "user={$PostData['user_id']}");

            //SEND NOTIFICATION
            $Read->LinkResult(DB_USERS, "user_id", $PostData['user_id']);
            $Student = $Read->getResult()[0];

            require '../../_ead/wc_ead.email.php';
            $MailBody = "
                    <p style='font-size: 1.4em;'>Olá {$Student['user_name']},</p>
                    <p>Este e-mail é para informar que sua conta foi <b>desbloqueada</b> na nossa Escola Online.</p>
                    <p>Seja bem vindo de volta!</p>
                    <p>Se tiver qualquer problema, não deixe de responder este e-mail!</p>
                ";

            $MailContent = str_replace("#mail_body#", $MailBody, $MailContent);
            $Email = new Email;
            $Email->EnviarMontando("Sua conta foi desbloqueada na escola online!", $MailContent, MAIL_SENDER, MAIL_USER, "{$Student['user_name']} {$Student['user_lastname']}", $Student['user_email']);

            $jSON['redirect'] = 'dashboard.php?wc=teach/students_gerent&id=' . $PostData['user_id'];
            $jSON['success'] = true;
            $jSON['clear'] = true;
            break;

        case 'note_draft':
            $Draft = ['note_status' => 1];
            $Update->ExeUpdate(DB_USERS_NOTES, $Draft, "WHERE note_id = :id", "id={$PostData['del_id']}");
            $jSON['success'] = true;
            break;

        case 'note_add':
            $Note = [
                'user_id' => $PostData['user_id'],
                'admin_id' => $PostData['admin_id'],
                'note_text' => $PostData['note_text'],
                'note_datetime' => date('Y-m-d H:i:s')
            ];

            $Create->ExeCreate(DB_USERS_NOTES, $Note);

            //GET NOTES USER
            $Read->ExeRead(DB_USERS_NOTES, "WHERE user_id = :user AND note_status IS NULL ORDER BY note_datetime DESC", "user={$PostData['user_id']}");
            if ($Read->getResult()):
                $ContentDiv = "";

                foreach ($Read->getResult() as $Note):
                    $Read->LinkResult(DB_USERS, "user_id", "{$Note['admin_id']}", 'user_id, user_name, user_lastname');
                    $UserName = $Read->getResult()[0]['user_name'] . ' ' . $Read->getResult()[0]['user_lastname'];
                    $DateNote = date('d/m/Y H:i', strtotime($Note['note_datetime']));
                    $ContentDiv .= "<article class='student_gerent_home_anotation' id='" . $Note['note_id'] . "'>
                        <span class='icon-cross icon-notext student_gerent_home_anotation_remove j_delete_action_confirm' callback='Users' callback_action='note_draft' id='" . $Note['note_id'] . "' rel='student_gerent_home_anotation'></span>
                        <div class='student_gerent_home_anotation_content icon-pushpin'>
                            " . nl2br($Note['note_text']) . "
                            <p class='icon-calendar'>" . $DateNote . " por " . $UserName . "</p>
                        </div>
                    </article>";
                endforeach;
            endif;

            $jSON['content'] = ['.j_content_note' => $ContentDiv];
            $jSON['success'] = true;
            $jSON['clear'] = true;
            break;

        case 'list_notes_all':

            //GET NOTES USER
            $Read->ExeRead(DB_USERS_NOTES, "WHERE user_id = :user ORDER BY note_datetime DESC", "user={$PostData['user_id']}");
            if ($Read->getResult()):
                $ContentDiv = "";

                foreach ($Read->getResult() as $Note):
                    $Read->LinkResult(DB_USERS, "user_id", "{$Note['admin_id']}", 'user_id, user_name, user_lastname');
                    $UserName = $Read->getResult()[0]['user_name'] . ' ' . $Read->getResult()[0]['user_lastname'];
                    $DateNote = date('d/m/Y H:i', strtotime($Note['note_datetime']));
                    $ContentDiv .= "<article class='student_gerent_home_anotation' id='" . $Note['note_id'] . "'>
                        <span class='icon-cross icon-notext student_gerent_home_anotation_remove j_delete_action_confirm' callback='Users' callback_action='note_draft' id='" . $Note['note_id'] . "' rel='student_gerent_home_anotation'></span>
                        <div class='student_gerent_home_anotation_content icon-pushpin'>
                            " . nl2br($Note['note_text']) . "
                            <p class='icon-calendar'>" . $DateNote . " por " . $UserName . "</p>
                        </div>
                    </article>";
                endforeach;
            endif;

            $jSON['content'] = ['.j_content_note' => $ContentDiv];
            $jSON['success'] = true;
            break;
    endswitch;

    //RETORNA O CALLBACK
    if ($jSON):
        echo json_encode($jSON);
    else:
        $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
        echo json_encode($jSON);
    endif;
else:
    //ACESSO DIRETO
    die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
endif;
