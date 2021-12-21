let images = document.querySelectorAll('figure>img');

for (let image of images) {
    image.onclick = openImage;
}

function openImage() {
    let id = this.getAttribute('id');
    location.href = 'view/' + id;
}
