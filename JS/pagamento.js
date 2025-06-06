//MASCARA TITULAR DO CARTAO
// Obtém o elemento input
const inputTitular = document.getElementById('TitularCartao');

// Adiciona um listener para o evento input
inputTitular.addEventListener('input', function(event) {
let valor = inputTitular.value;

// Remove todos os caracteres que não sejam letras
let valorValido = valor.replace(/[^A-Za-z\s]/g, '');

// Atualiza o valor do input com os caracteres válidos
inputTitular.value = valorValido;
});

//MASCARA CVV
// Obtém o elemento input
const inputNumerico = document.getElementById('cvv');

// Adiciona um listener para o evento input
inputNumerico.addEventListener('input', function(event) {
// Obtém o valor atual do input
let valor = inputNumerico.value;

// Remove todos os caracteres que não sejam letras
let inputNumerico = valorSemEspacos.replace(/\D/g, '');
// Atualiza o valor do input com os caracteres válidos
inputNumerico.value = valorValido;
});

//MASCARA NUMERO DO CARTAO
// Obtém o elemento input
const input = document.getElementById('NumeroCartao');

// Adiciona um listener para o evento input
input.addEventListener('input', function(event) {
// Obtém o valor atual do input
let valor = input.value;

// Remove todos os espaços em branco do valor atual
let valorSemEspacos = valor.replace(/\s/g, '');

// Remove todos os caracteres não numéricos
let valorNumerico = valorSemEspacos.replace(/\D/g, '');

// Adiciona um espaço a cada 4 caracteres
let valorFormatado = '';
for (let i = 0; i < valorNumerico.length; i++) {
if (i > 0 && i % 4 === 0) {
valorFormatado += ' ';
}
valorFormatado += valorNumerico[i];
}

// Atualiza o valor do input com a nova formatação
input.value = valorFormatado;
});


document.querySelector('.card-number-input').oninput = () => {
    document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
}

document.querySelector('.card-holder-input').oninput = () => {
    document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
}

document.querySelector('.month-input').oninput = () => {
    document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
}

document.querySelector('.year-input').oninput = () => {
    document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
}

document.querySelector('.cvv-input').onmouseenter = () => {
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
}

document.querySelector('.cvv-input').onmouseleave = () => {
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
}

document.querySelector('.cvv-input').oninput = () => {
    document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
}

document.getElementById('cartaoVisa').onclick = () => {
    document.getElementById('imageContainer').innerHTML = '<img src="images/visa.png" alt="" style="position: absolute; top: 10px; right: 20px;">';
}

document.getElementById('cartaoMasterCard').onclick = () => {
    document.getElementById('imageContainer').innerHTML = '<img src="images/mastercard.png" alt="" style="position: absolute; top: 10px; right: 20px;">';
}