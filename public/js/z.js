let i = document.querySelector('#weighing');
if (i) {
    i.addEventListener('click', t);
}

let doc = document.querySelector('#doc');
if (doc) {
    doc.addEventListener('blur', showDoc);
}

function showDoc() {
    let docTable = document.querySelector('#docTable');
    let saveBtn = document.querySelector('#saveBtn');
    fetch(location.origin + '/api/mains?sn=' + doc.value)
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            console.log(data);
            docTable.classList.remove('d-none');
            saveBtn.disabled = false;
        }
        else {
            docTable.classList.add('d-none');
            saveBtn.disabled = true;
        }
    }
    );
}

function t() {
    console.log(i);
    let w = document.querySelector('[id$=_weight]');
    w.value = +(1 + Math.random()).toFixed(2);
}
