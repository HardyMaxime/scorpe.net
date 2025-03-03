<section id="demontration" class="product-video-wrapper">
    <h2 class="video-title skew-title">
        <?= LanguageController::translateStaticText("demonstration", "démonstration"); ?>
    </h2>
    <section class="details-content product-videos">
        <div class="video-poster responsive-iframe" >
            <iframe
                width="1400"
                height="760"
                src="https://www.youtube.com/embed/<?= esc_attr(ProductController::hasVideo(get_the_ID())['id']); ?>&autoplay=1"
                srcdoc="<style>*{padding:0;margin:0;overflow:hidden;}html,body{height:100%;}.video-poster-icon{position:absolute;transition:all ease .3s;display: flex;align-items: center;justify-content: center;top:50%;left:50%;width:130px;height:130px;background:rgba(151,210,70,.8);transform: translate(-50%, -50%) scale(1);z-index:10;border-radius:50%;}img{position:absolute;width:100%;top:0;bottom:0;margin:auto;}.video-poster-icon::before{content:'';background: transparent;display: inline-block;height: 0;width: 0;border-top: 12px solid transparent;border-bottom: 12px solid transparent;border-left: 14px solid #ffffff;}a:hover .video-poster-icon{transform: translate(-50%, -50%) scale(0.9);}@media only screen and (max-width:999px){.video-poster-icon{width: 80px;height: 80px;}}</style><a href=https://www.youtube.com/embed/<?= esc_attr(ProductController::hasVideo(get_the_ID())['id']); ?>?autoplay=1><span class='video-poster-icon' ></span><picture><img src='<?= (ProductController::hasVideo(get_the_ID())['thumbnail']); ?>' alt='<?= esc_attr(ProductController::hasVideo(get_the_ID())['title']); ?>' /></picture></a>"
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                title="<?= esc_attr(ProductController::hasVideo(get_the_ID())['title']); ?>">
            </iframe>
        </div>
    </section>
</section>