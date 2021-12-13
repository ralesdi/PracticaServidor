<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">


<form action="?controller=<?=$controller?>&action=sendMessage" method="POST">
        Receiver: <input name="receiver" type="text" placeholder="username" required> <br>
        Content: <textarea name="content" id="" cols="40" rows="5" style="resize: none;"></textarea> <br>
        <input type="submit" name="send" value="Send">
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

    <a target="_BLANK" href="?controller=<?=$controller?>&action=pdfDirectMessages"><button>Print</button></a>

    <? if($directMessages): ?>
        <? foreach($directMessages as $directMessage): ?>
        <h4><?=$directMessage->getSender()?> dice: <?=$directMessage->getContent()?></h4>
        <? endforeach; ?>
    <? else: ?>
        <h3>THERE ARE NO MESSAGES YET!</h3>
    <? endif; ?>
    
    

    
</section>
<?php require 'includes/footer.php'; ?>