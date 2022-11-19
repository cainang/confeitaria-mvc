let cadbutton = document.querySelector('#cadastro-hidden');

cadbutton.onclick = () => {
    let url = window.location.protocol + '//';

    let urlArray = window.location.href.split('?')[0].split('/');
    urlArray.shift();
    urlArray.shift();

    urlArray.forEach((term, index) => {
        url += (index < urlArray.length - 1 ? term : 'login') + (index < urlArray.length - 1 ? '/' : '');
    })
    window.location.href = url;
}