let alertComponent = document.querySelector('#alert');

function initAlert() {
    alertComponent.style.display = 'flex';
    alertComponent.className = 'animationAlertIn';

    let interval = setInterval(() => {
        alertComponent.className = 'animationAlertOut';
        clearInterval(interval);
    }, 5000)
}

initAlert();