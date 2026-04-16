export function initFocusVideo() {
    const video = document.getElementById('focus-product-video');
    const btn = document.querySelector('.focus-product-video-btn');
    const fsBtn = document.querySelector('.focus-product-fullscreen-btn');
    if (!video || !btn) return;

    function setPlaying() {
        btn.classList.remove('is-paused');
        btn.setAttribute('aria-label', 'Pause la vidéo');
    }

    function setPaused() {
        btn.classList.add('is-paused');
        btn.setAttribute('aria-label', 'Lire la vidéo');
    }

    // Lecture déclenchée uniquement quand la vidéo est visible à 40%
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.intersectionRatio >= 0.4) {
                    video.play();
                    setPlaying();
                } else {
                    video.pause();
                    setPaused();
                }
            });
        }, { threshold: 0.4 });

        observer.observe(video);
    }

    // Bouton play/pause manuel
    btn.addEventListener('click', () => {
        if (video.paused) {
            video.play();
            setPlaying();
        } else {
            video.pause();
            setPaused();
        }
    });

    // Bouton plein écran
    if (fsBtn) {
        fsBtn.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                video.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        });

        document.addEventListener('fullscreenchange', () => {
            if (document.fullscreenElement === video) {
                fsBtn.classList.add('is-fullscreen');
                fsBtn.setAttribute('aria-label', 'Quitter le plein écran');
            } else {
                fsBtn.classList.remove('is-fullscreen');
                fsBtn.setAttribute('aria-label', 'Plein écran');
            }
        });
    }
}
