const stage = document.querySelector('[data-game-stage]');
const startButton = document.querySelector('[data-game-start]');
const phoneNote = document.querySelector('[data-game-phone-note]');
const fullscreenButton = document.querySelector('[data-game-fullscreen]');

const pageScrollKeys = new Set(['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'Space']);

let game = null;

function startGame() {
    if (game) {
        return;
    }

    game = document.createElement('iframe');
    game.src = stage.dataset.gameUrl;
    game.title = 'Bugged Out Rally';
    game.allow = 'fullscreen; autoplay; gamepad';
    game.className = 'block size-full border-0';

    startButton.remove();
    stage.append(game);
    game.focus();
}

if (window.matchMedia('(hover: none) and (pointer: coarse)').matches) {
    startButton.remove();
    fullscreenButton.remove();
    phoneNote.hidden = false;
} else {
    startButton.addEventListener('click', startGame);

    fullscreenButton.addEventListener('click', () => {
        startGame();
        game.requestFullscreen();
    });

    window.addEventListener('keydown', (event) => {
        if (!game || !pageScrollKeys.has(event.code)) {
            return;
        }

        if (event.code === 'Space' && event.target.closest?.('a, button')) {
            return;
        }

        event.preventDefault();
    });
}
