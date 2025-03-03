<section class="paragraph-with-tiny-title reveal">
    <h2 class="is-title title-with-arrow-icon white-arrow slide-out-in reveal-2" >
        <?= ServiceController::getServicePartContent(get_the_ID(), "title"); ?>
    </h2>
    <?php if(!empty(ServiceController::getServicePartContent(get_the_ID(), "description"))): ?>
        <p class="is-paragraph slide-in-out reveal-4" >
            <?= ServiceController::getServicePartContent(get_the_ID(), "description"); ?>
        </p>
    <?php endif; ?>
</section>