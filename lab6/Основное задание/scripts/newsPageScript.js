let newsList = [];
let buttonsArea = document.getElementById('nav-buttons');
let newsArea = document.querySelector('main');
const newsPerPage = 5;
buttonsArea.innerHTML = '';
let currentPage;
let pageCount;
let modalArea = document.getElementById('modal-area');
let closeButton = document.getElementById('close-button');
let modalContent = modalArea.querySelector('#modal-window>main');
let content = {
    "title": modalContent.children[0],
    "image": modalContent.children[1],
    "text": modalContent.children[2]
}
let navButtons;
let currentButton;
let prevButton;
let nextButton;

closeButton.onclick = closeNewsWindow;

window.onload = function () {
    fetch('news.json')
        .then((response)=> {
            return response.json();
        })
        .then((json)=> {
            newsList = json.data;
            pageCount = Math.ceil(newsList.length / newsPerPage);
            buttonsArea.innerHTML = '<button onclick="loadPrevPage()">Prev</button>';
            for (let i = 1; i <= pageCount; i++) {
                buttonsArea.innerHTML += `<button value="${i}" onclick="loadPage(value)">${i}</button>`;
            }
            buttonsArea.innerHTML += '<button style="margin: 0" onclick="loadNextPage()">Next</button>';
            currentPage = 1;
            navButtons = buttonsArea.children;
            prevButton = navButtons[0];
            nextButton = navButtons[navButtons.length - 1];
            currentButton = navButtons[currentPage];
            loadNewsForCurrentPage();
        })
}

function loadNewsForCurrentPage() {
    newsArea.innerHTML = '';
    redrawButtons();
    if (currentPage * newsPerPage <= newsList.length) {
        for (let i = (currentPage - 1) * newsPerPage; i < currentPage * newsPerPage; i++) {
            newsArea.innerHTML += `
                <div class="news-card">
                    <div class="news-title">
                        ${newsList[i].title}
                    </div>
                    <img src="${newsList[i].image}" alt="#">
                    <p>${newsList[i].body.split(' ').slice(0, 50).join(' ')}...</p>
                    <a href="javascript://" rel = ${i} onclick="showNewsWindow(rel)">More info</a>
                </div>
            `
        }
    }
    else {
        for (let i = (currentPage - 1) * newsPerPage; i < newsList.length; i++) {
            newsArea.innerHTML += `
                <div class="news-card">
                    <div class="news-title">
                        ${newsList[i].title}
                    </div>
                    <img src="${newsList[i].image}" alt="#">
                    <p>${newsList[i].body.split(' ').slice(0, 50).join(' ')}...</p>
                    <a href="javascript://" rel = ${i} onclick="showNewsWindow(rel)">More info</a>
                </div>
            `
        }
    }
}

function loadPage(value) {
    currentPage = parseInt(value);
    navButtons[currentPage].classList.add('disabled-button');
    loadNewsForCurrentPage();
    window.scrollTo(0, 0);
}

function loadPrevPage() {
    currentPage--;
    loadNewsForCurrentPage();
    window.scrollTo(0, 0);
}

function loadNextPage() {
    currentPage++;
    loadNewsForCurrentPage();
    window.scrollTo(0, 0);
}

function showNewsWindow (i) {
    i = parseInt(i);
    content.title.textContent = newsList[i].title;
    content.image.setAttribute('src', newsList[i].image);
    content.text.textContent = newsList[i].body;
    modalArea.setAttribute('rel', 'active');
    modalContent.scrollTo(0, 0);
}

function closeNewsWindow () {
    modalArea.removeAttribute('rel');
}

function redrawButtons() {
    prevButton.classList.remove('disabled-button');
    nextButton.classList.remove('disabled-button');
    currentButton.classList.remove('disabled-button');
    currentButton = navButtons[currentPage];
    currentButton.classList.add('disabled-button');
    if (currentPage === 1) {
        prevButton.classList.add('disabled-button');
    }
    if (currentPage === navButtons.length - 2) {
        nextButton.classList.add('disabled-button');
    }
}