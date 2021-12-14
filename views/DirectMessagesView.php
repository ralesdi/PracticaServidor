<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 m-5 text-center">


<div class="card w-50 p-5 m-auto mb-3 color">
    <form action="?controller=<?=$controller?>&action=sendMessage" method="POST">
        Receiver: <input class="form-control m-1" name="receiver" type="text" placeholder="username" required> <br>
        Content: <textarea class="form-control m-1" name="content" id="" cols="40" rows="5" style="resize: none;"></textarea> <br>
        <input class="btn btn-light round" type="submit" name="send" value="Send">
    </form>
</div>


    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

    <a target="_BLANK" href="?controller=<?=$controller?>&action=pdfDirectMessages"><button class="btn btn-primary btn-lg round" >Print</button></a>

    <?php if($directMessages): ?>
        <?php foreach($directMessages as $directMessage): ?>
            <div class="card color m-auto w-25 mt-5 mb-5">
                <div class="card-header text-start">
                <?=$directMessage->getSender()?>
                </div>
                <div class="card-body">
                <?=$directMessage->getContent()?>
                </div>
                <div class="card-footer">
                    <?=$directMessage->getsendingDateTime()?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>THERE ARE NO MESSAGES YET!</h3>
    <?php endif; ?>
    
    

    
</section>
<?php require 'includes/footer.php'; ?>