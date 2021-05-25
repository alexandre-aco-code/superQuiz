<div class="alert-section" id="zonedenotification">

    <?php if (\Session::hasFlashes('error')) : ?>
        <div class="alert-danger is-active">
            <div class="text">
                <?php foreach (\Session::getFlashes('error') as $message) : ?>
                    <p><?= $message ?></p>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>

    <?php if (\Session::hasFlashes('success')) : ?>
        <div class="alert-success is-active">
            <div class="text">
                <?php foreach (\Session::getFlashes('success') as $message) : ?>
                    <p><?= $message ?></p>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>

</div>