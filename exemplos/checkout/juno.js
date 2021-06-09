/*
* By Paulo - paulo@cliqueti.com.br
* */

function getCardHash(PUBLIC_TOKEN, callback, production = false) {

    /* Em sandbox utilizar o construtor new Directcard('PUBLIC_TOKEN', false); */
    var card = new DirectCheckout(PUBLIC_TOKEN, production);

    /* Card Status */
    var cardStatus = document.getElementById('cardStatus');

    /* Clear Card Number */
    var cardNumber = document.getElementById('cardNumber').value;
    var cardNumber = cardNumber.replace(/\s/g, '');

    /* Data Card */
    var cardData = {
        cardNumber:         cardNumber,
        holderName:         document.getElementById('holderName').value,
        securityCode:       document.getElementById('securityCode').value,
        expirationMonth:    document.getElementById('expirationMonth').value,
        expirationYear:     document.getElementById('expirationYear').value,
    };

    /* CardNumber Validation */
    if(!card.isValidCardNumber(cardData.cardNumber)){
        cardStatus.innerText = 'Número do Cartão Inválido';
        return;
    }

    /* ExpireDate Validation */
    if(!card.isValidExpireDate(cardData.expirationMonth, cardData.expirationYear)){
        cardStatus.innerText = 'Data Vencimento do Cartão Inválida';
        return;
    }

    /* SecurityCode Validation */
    if(!card.isValidSecurityCode(cardData.cardNumber, cardData.securityCode)){
        cardStatus.innerText = 'Código do Cartão Inválido (CCV)';
        return;
    }

    card.getCardHash(cardData, function(cardHash) {
        /* Sucesso - A variável cardHash conterá o hash do cartão de crédito */
        callback(cardHash);
    }, function(error) {
        cardStatus.innerText = error;
    });

}