let i = document.querySelector('#weighing');
if (i) {
    i.addEventListener('click', t);
}


function t() {
    console.log(i);
    let w = document.querySelector('#cgd_weight');
    w.value = +(1 + Math.random()).toFixed(2);
}
