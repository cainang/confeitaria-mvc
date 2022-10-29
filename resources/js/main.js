function formatPricesFromCard() {
    let cardsPrices = document.querySelectorAll('.card #preco');
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });

    cardsPrices.forEach((cardPrice) => {
        let price = parseFloat(cardPrice.innerText);
        cardPrice.innerText = formatter.format(price);
    });
}

formatPricesFromCard();