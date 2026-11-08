const stage = document.querySelector('[data-game-stage]');
const startChoice = document.querySelector('[data-game-start]');
const startKeyboardButton = document.querySelector('[data-game-start-keyboard]');
const startTouchButton = document.querySelector('[data-game-start-touch]');
const fullscreenButton = document.querySelector('[data-game-fullscreen]');
const rotateNote = document.querySelector('[data-game-rotate-note]');
const switchButton = document.querySelector('[data-game-switch]');
const switchIcon = document.querySelector('[data-game-switch-icon]');
const switchLabel = document.querySelector('[data-game-switch-label]');

const windowedStageClasses = ['relative', 'aspect-video', 'w-full'];
const filledStageClasses = ['fixed', 'inset-0', 'z-50', 'h-dvh', 'w-dvw', 'bg-black'];

const isTouchOnly = window.matchMedia('(hover: none) and (pointer: coarse)').matches;

const pageScrollKeys = new Set(['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'Space']);

let game = null;
let touchMode = false;
let screenFilled = false;

function startGame(withTouch) {
    if (game) {
        return;
    }

    touchMode = withTouch;

    game = document.createElement('iframe');
    game.src = gameUrl(withTouch);
    game.title = 'Bugged Out Rally';
    game.allow = 'fullscreen; autoplay; gamepad';
    game.className = 'block size-full border-0';

    startChoice.remove();
    stage.append(game);
    game.focus();
    showSwitchButton();
}

function gameUrl(withTouch) {
    return withTouch ? `${stage.dataset.gameUrl}?touch` : stage.dataset.gameUrl;
}

function showSwitchButton() {
    switchButton.hidden = false;
    switchIcon.src = touchMode ? switchButton.dataset.keyboardIcon : switchButton.dataset.touchIcon;
    switchLabel.textContent = touchMode ? 'Switch to keyboard' : 'Switch to touch';
}

function switchControls() {
    touchMode = !touchMode;
    game.src = gameUrl(touchMode);
    showSwitchButton();

    if (touchMode) {
        fillScreen();
    } else if (screenFilled) {
        leaveFilledScreen();
    }
}

// Not every phone browser has the Fullscreen API, so the stage covers the page either way.
function fillScreen() {
    stage.classList.remove(...windowedStageClasses);
    stage.classList.add(...filledStageClasses);
    rotateNote.classList.add('portrait:flex');
    screenFilled = true;
    stage.requestFullscreen?.().catch(() => {});
    sendScreenState();
}

function leaveFilledScreen() {
    stage.classList.remove(...filledStageClasses);
    stage.classList.add(...windowedStageClasses);
    rotateNote.classList.remove('portrait:flex');
    screenFilled = false;

    if (document.fullscreenElement) {
        document.exitFullscreen();
    }

    sendScreenState();
}

function isGameFullscreen() {
    return touchMode ? screenFilled : document.fullscreenElement === game;
}

function sendScreenState() {
    game?.contentWindow?.postMessage({ type: 'bugged-out-rally:fullscreen-state', filled: isGameFullscreen() }, '*');
}

function toggleGameFullscreen() {
    if (touchMode) {
        if (screenFilled) {
            leaveFilledScreen();
        } else {
            fillScreen();
        }
    } else if (document.fullscreenElement) {
        document.exitFullscreen();
    } else {
        game.requestFullscreen().catch(() => {});
    }
}

startKeyboardButton.addEventListener('click', () => startGame(false));

startTouchButton.addEventListener('click', () => {
    startGame(true);
    fillScreen();
});

switchButton.addEventListener('click', switchControls);

fullscreenButton.addEventListener('click', () => {
    startGame(isTouchOnly);

    if (touchMode) {
        fillScreen();
    } else {
        game.requestFullscreen();
    }
});

window.addEventListener('message', (event) => {
    if (!game || event.source !== game.contentWindow) {
        return;
    }

    if (event.data?.type === 'bugged-out-rally:request-fullscreen-state') {
        sendScreenState();
    } else if (event.data?.type === 'bugged-out-rally:toggle-fullscreen') {
        toggleGameFullscreen();
    }
});

// Leaving real fullscreen with Esc or the back gesture also leaves full-page mode.
document.addEventListener('fullscreenchange', () => {
    if (screenFilled && !document.fullscreenElement) {
        leaveFilledScreen();
    }

    sendScreenState();
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
