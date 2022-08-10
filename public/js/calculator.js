let inputAmount = document.getElementById('amount');
let output = document.getElementById('output');

inputAmount.oninput = function (){
    let comission = inputAmount.value * 0.01;
    output.innerText = Number(inputAmount.value) + comission;
}
