const scaleCoefficient = 3;

let imageContainers = document.getElementsByClassName('image-container');
let currentContainer = imageContainers[0];
let image = currentContainer.children[0];
let zoomPoint = currentContainer.children[1];
let url = image.getAttribute('src');
zoomPoint.style.backgroundImage = 'url(' + url +')';
console.log(zoomPoint.style.cssText);
let width = image.width;
let height = image.height;
zoomPoint.style.backgroundSize = `${width * scaleCoefficient}px ${height * scaleCoefficient}px`;

currentContainer.onmousemove = function (e) {
    zoomPoint.style.display = 'block';
    console.log(e.offsetY, e.offsetY);
    let x = e.offsetX;
    let y = e.offsetY;
    if (x > 0 && y > 0) {
        console.log(x, y);
        zoomPoint.style.left = `${x}px`;
        zoomPoint.style.top = `${y}px`;
        zoomPoint.style.backgroundPositionX = `${-x * scaleCoefficient}px`;
        zoomPoint.style.backgroundPositionY = `${-y * scaleCoefficient}px`;
    }
}

currentContainer.onmouseout = function () {
    zoomPoint.style.display = 'none';
}