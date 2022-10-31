const formatter = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
});

function formatPricesFromCard() {
    let cardsPrices = document.querySelectorAll('.card #preco');

    cardsPrices.forEach((cardPrice) => {
        let price = parseFloat(cardPrice.innerText);
        cardPrice.innerText = formatter.format(price);
    });
}

function formatPriceFromCompraPage() {
    let priceElement = document.querySelector('#content #desc #bottom #left #preco');
    if (priceElement) {
        let price = parseFloat(priceElement.innerText);
        priceElement.innerText = formatter.format(price);
    }
}

formatPriceFromCompraPage();

formatPricesFromCard();