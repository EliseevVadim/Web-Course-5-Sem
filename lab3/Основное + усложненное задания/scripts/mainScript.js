let skyButton = document.getElementById('sky-button');
let stars = document.getElementById('starsArea');
let cloud = document.getElementById('cloud');
let moonDots = document.getElementById('moonDots');
let sun = document.getElementById('sun');

let flag = false;
function rollBack() {
    skyButton.setAttribute('rel', 'rollBack');
}
skyButton.addEventListener("click", rollBack);