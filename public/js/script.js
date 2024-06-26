const  sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu_bar');
const closeBtn = document.querySelector('#close_btn');

const themeToggler = document.querySelector('.theme-toggler');

menuBtn.addEventListener('click',()=>{
       sideMenu.style.display = "block"
})
closeBtn.addEventListener('click',()=>{
    sideMenu.style.display = "none"
})

themeToggler.addEventListener('click',()=>{
     document.body.classList.toggle('dark-theme-variables')
     themeToggler.querySelector('span:nth-child(1').classList.toggle('active')
     themeToggler.querySelector('span:nth-child(2').classList.toggle('active')
})

document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('currentDate');
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); 
    const dd = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${yyyy}-${mm}-${dd}`;
    dateInput.value = formattedDate;
});



document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('currentDate');
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); 
    const dd = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${yyyy}-${mm}-${dd}`;
    dateInput.value = formattedDate;
});

document.addEventListener('DOMContentLoaded', function() {
    const categoriesLink = document.getElementById('categories-link');
    const categoriesSubmenu = document.getElementById('categories-submenu');
    const dropdown = categoriesLink.closest('.dropdown');

    categoriesLink.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.classList.toggle('active');
    });
});

const moreIcons = document.querySelectorAll('.more-icon');

moreIcons.forEach(icon => {
    icon.addEventListener('click', function(e) {
        e.stopPropagation(); 
        const popup = this.nextElementSibling;
        
        if (popup.style.display === "block") {
            closeAllPopups(); 
        } else {
            closeAllPopups(); 
            popup.style.display = "block";
            popup.style.opacity = "1";
            popup.style.visibility = "visible";
            popup.style.pointerEvents = "all";
        }
    });
});

/*  ***** popup ******/
function closeAllPopups() {
    const popups = document.querySelectorAll('.popup');
    popups.forEach(popup => {
        popup.style.display = "none";
        popup.style.opacity = "0";
        popup.style.visibility = "hidden";
        popup.style.pointerEvents = "none";
    });
}

document.addEventListener('click', function() {
    closeAllPopups();
});

document.querySelectorAll('.popup').forEach(popup => {
    popup.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

const editButtons = document.querySelectorAll('.edit-button');
editButtons.forEach(button => {
    button.addEventListener('click', function() {
        const categoryId = this.getAttribute('data-category-id');
        const modal = document.getElementById('modal_' + categoryId);
        modal.style.display = "block";
        closeAllPopups();
    });
});

const viewButtons = document.querySelectorAll('.view-button');
viewButtons.forEach(button => {
    button.addEventListener('click', function() {
        const categoryId = this.getAttribute('data-category-id');
        const modal_view = document.getElementById('modal_view' + categoryId);
        modal_view.style.display = "block";
        closeAllPopups();
    });
});


closeButtons = document.querySelectorAll('.close');
closeButtons.forEach(button => {
    button.addEventListener('click', function() {
        const modal = this.closest('.modal');
        modal.style.display = "none";
    });
});

window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
}

// Get the modal
const modal = document.getElementById('modal');
const modal_all = document.getElementById('modal_all');

// Get the button that opens the modal
const btnOpenModal = document.getElementById('openModal');
const btnOpenModal_all = document.getElementById('openModal_all');

// Get the <span> element that closes the modal
var spanCloseModal = document.getElementsByClassName("close")[0];
var spanCloseModal_all = document.getElementsByClassName("close")[1];

// const spanCloseModal = document.querySelector('close');
// const spanCloseModal1 = document.querySelector('close');

// When the user clicks the button, open the modal 
btnOpenModal.onclick = function() {
    modal.style.display = "block";
    closeAllPopups(); 
}

btnOpenModal_all.onclick = function() {
    modal_all.style.display = "block";
    closeAllPopups(); 
}

// When the user clicks on <span> (x), close the modal
spanCloseModal.onclick = function() {
    modal.style.display = "none";
}

spanCloseModal_all.onclick = function() {
    modal_all.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

window.onclick = function(event) {
    if (event.target == modal_all) {
        modal_all.style.display = "none";
    }
}








