
<?php $this->includeTemplate('panel', array('titre' => 'Messages'));
if (isset($erreur)):
    ?>
    <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
<?php endif ?>
    
<?php if ($nombreMessagesNonLus && $nombreMessagesNonLus[0]->nombre != 0): ?>
    Vous avez reçu <?php echo $nombreMessagesNonLus[0]->nombre; ?> nouveaux messages.<br><br> 
    <?php
    $conversation_id = 0;
    foreach ($messages as $message):
        if ($conversation_id == 0):
            $conversation_id = $message->conversation_id;
            echo "Conversation numéro : " . $conversation_id;
            ?>
            <br>
            <?php
        endif;
        if ($conversation_id != $message->conversation_id):
            $conversation_id = $message->conversation_id;
            ?>
            <br><br>
            <?php echo "Conversation numéro : " . $conversation_id; ?>
            <br>
        <?php endif; ?>
        <strong><?php echo $message->login; ?></strong> : <?php echo $message->contenu; ?><br>
    <?php endforeach; ?><br><br>

    <form action="<?php $this->bu('user', 'repondreOuArchiverMessage') ?>" method="post">
        <table>
            <tr>
                <th>Numéro de la conversation :</th>
                <td>
                    <select id='numeroConversation' class="selectpicker show-tick form-control" name="numeroConversation">
                        <?php
                        $test = 0;
                        foreach ($messages as $message):
                            if ($test != $message->conversation_id || $test == 0): $test = $message->conversation_id;
                                ?>
                                <option><?php echo $message->conversation_id; ?></option>
                            <?php endif;
                        endforeach;
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Message réponse :</th>
                <td><input type="text" placeholder="tapez un message" class="input-control form-control" name="message"></td>
            </tr>
        </table><br>
        <button id="btn-repondre" type="submit" class="btn btn-lg center">Répondre</button>
    </form>

<?php else: ?>
    Vous n'avez reçu aucun nouveau message.
<?php endif; ?>
    
<?php $this->includeTemplate('panelFin'); ?>
    
<?php $this->includeTemplate('panel', array('titre' => 'Envoyer un message')); ?>

<form action="<?php $this->bu('user', 'envoyerMessage') ?>" method="post">
<?php if ($amis != NULL): ?>
        <table>
            <tr>
                <th>Destinataire :</th>
                <td>
                    <select id='loginAmi' class="selectpicker show-tick form-control" name="loginAmi">
                        <?php foreach ($amis as $ami): ?>
                            <option><?php echo $ami->login; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Message :</th>
                <td><input type="text" placeholder="tapez votre message" class="input-control form-control" name="message"></td>
            </tr>
        </table><br>
        <button id="btn-envoyer" type="submit" class="btn btn-lg center">Envoyer le message</button>
<?php else: ?>
    Vous n'avez aucun ami enregistré.
<?php endif; ?>
</form>
    
<?php $this->includeTemplate('panelFin'); ?>
