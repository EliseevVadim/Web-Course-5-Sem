let writeableSpan = document.getElementById('field');
let leftArrow = document.getElementById('leftArrow');
let  rightArrow = document.getElementById('rightArrow');
let arrowsTops = document.getElementsByClassName('arrow-top');
let arrowsBottoms = document.getElementsByClassName('arrow-bottom');

if (writeableSpan.textContent === '1'){
    leftArrow.style.opacity = '0.5';
    arrowsTops[0].style.transform = 'rotate(0deg)';
    arrowsBottoms[0].style.transform = 'rotate(0deg)';
    leftArrow.setAttribute('aria-disabled', 'true');
}

