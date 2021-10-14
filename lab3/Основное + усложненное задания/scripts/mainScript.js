let skyButton = document.getElementById('sky-button');
let stars = document.getElementById('starsArea');
let cloud = document.getElementById('cloud');
let moonDots = document.getElementById('moonDots');
let sun = document.getElementById('sun');

function rollBack() {
    skyButton.style.animationName = "buttonUpdate";
    skyButton.style.animationDuration = "3s";
    skyButton.style.animationDirection = "reverse";
    stars.style.animationDelay = "3s";
    stars.style.animationDuration = "2s";
    stars.style.animationName = "showStars";
    stars.style.animationDirection = "reverse";
    sun.style.animationDelay = "5s, 7s";
    sun.style.animationDuration = "2s, 5s";
    sun.style.animationName = "repaintSun, moveSun";
    sun.style.animationDirection = "reverse";
    moonDots.style.animationDelay = "5s";
    moonDots.style.animationDuration = "2s";
    moonDots.style.animationName = "showDots";
    moonDots.style.animationDirection = "reverse";
    cloud.style.animationDelay = "5s, 7s";
    cloud.style.animationDuration = "2s, 5s";
    cloud.style.animationName = "hideCloud, moveCloud";
    cloud.style.animationDirection = "reverse";
}
skyButton.addEventListener("click", rollBack);