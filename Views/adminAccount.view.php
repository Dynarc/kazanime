<?php ob_start() ?>

    <h2 class="crud-title">Liste des comptes</h2>
    <section class="crud-list">
        <article>
            <?php if(!empty($accounts)) foreach ($accounts as $account) { ?>
                <div>
                    <p><?=$account->getPseudo()?></p>
                    <p><?=$account->getEmail()?></p>
                    <p><?=date("d-m-Y",strtotime($account->getDate_inscription()))?></p>
                    <p><?= $account->getRole() == 1 ? 'admin' : 'user' ?></p>
                    <div>
                        <button value="<?=URL?>admin/account/history/<?=$account->getId()?>">Historique</button>
                        <button>
                            <a href="<?=URL?>admin/account/sanction/<?=$account->getId()?>">Sanctionner</a>
                        </button>
                    </div>
                </div>
            <?php } ?>

        </article>
    </section>

<?php
$titre = "Admin account";
$content = ob_get_clean();
require_once "template.php";