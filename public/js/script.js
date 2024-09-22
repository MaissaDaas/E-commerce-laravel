const  sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu_bar');
const closeBtn = document.querySelector('#close_btn');
const themeToggler = document.querySelector('.theme-toggler');

// *********Sidebar menu toggle
menuBtn.addEventListener('click',()=>{
       sideMenu.style.display = "block"
})
closeBtn.addEventListener('click',()=>{
    sideMenu.style.display = "none"
})

// *********Theme toggle
themeToggler.addEventListener('click',()=>{
     document.body.classList.toggle('dark-theme-variables')
     themeToggler.querySelector('span:nth-child(1').classList.toggle('active')
     themeToggler.querySelector('span:nth-child(2').classList.toggle('active')
})

// *********Set current date input value
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('currentDate');
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); 
    const dd = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${yyyy}-${mm}-${dd}`;
    dateInput.value = formattedDate;
});

// Dropdown submenu toggle
document.addEventListener('DOMContentLoaded', function() {
    const categoriesLink = document.getElementById('categories-link');
    const categoriesSubmenu = document.getElementById('categories-submenu');
    const dropdown = categoriesLink.closest('.dropdown');

    categoriesLink.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.classList.toggle('active');
    });
});

// More icon popup toggle
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

// ********* Close all popups
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


// Edit and view button modals 
document.addEventListener('DOMContentLoaded', function() {
    //************** category edit modal
    const editButtons = document.querySelectorAll('.edit-button');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');
            const modal = document.getElementById('modal_' + categoryId);
            modal.style.display = "block";
            closeAllPopups();
        });
    });

    //************** product edit modal
    const editButtonsProduct = document.querySelectorAll('.edit-button');
    editButtonsProduct.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const modal = document.getElementById('modal_' + productId);
            modal.style.display = "block";
            closeAllPopups();
        });
    });

    //************** order edit modal
    const editButtonsOrder = document.querySelectorAll('.edit-button');
    editButtonsOrder.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            const modal = document.getElementById('modal_' + orderId);
            modal.style.display = "block";
            closeAllPopups();
        });
    });

        //************** brand edit modal
        const editButtonsBrand = document.querySelectorAll('.edit-button');
        editButtonsBrand.forEach(button => {
            button.addEventListener('click', function() {
                const brandId = this.getAttribute('data-brand-id');
                const modal = document.getElementById('modal_' + brandId);
                modal.style.display = "block";
                closeAllPopups();
            });
        });


    //************** category view modal
    const viewButtons = document.querySelectorAll('.view-button');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');
            const modal_view = document.getElementById('modal_view' + categoryId);
            modal_view.style.display = "block";
            closeAllPopups();
        });
    });

    //************** product view modal
    const viewButtonsProduct = document.querySelectorAll('.view-button');
    viewButtonsProduct.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const modal_view = document.getElementById('modal_view' + productId);
            modal_view.style.display = "block";
            closeAllPopups();
        });
    });

    //************** order view modal
    const viewButtonsOrder = document.querySelectorAll('.view-button');
    viewButtonsOrder.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            const modal_view = document.getElementById('modal_view' + orderId);
            modal_view.style.display = "block";
            closeAllPopups();
        });
    });

        //************** brand view modal
        const viewButtonsBrand = document.querySelectorAll('.view-button');
        viewButtonsBrand.forEach(button => {
            button.addEventListener('click', function() {
                const brandId = this.getAttribute('data-brand-id');
                const modal_view = document.getElementById('modal_view' + brandId);
                modal_view.style.display = "block";
                closeAllPopups();
            });
        });

    //************** user view modal
    const viewButtonsUser = document.querySelectorAll('.view-button');
    viewButtonsUser.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const modal_view = document.getElementById('modal_view' + userId);
            modal_view.style.display = "block";
            closeAllPopups();
        });
    });
});

// Close modals
closeButtons = document.querySelectorAll('.close');
closeButtons.forEach(button => {
    button.addEventListener('click', function() {
        const modal = this.closest('.modal');
        modal.style.display = "none";
    });
});

closeButtons = document.querySelectorAll('.cancel__button');
closeButtons.forEach(button => {
    button.addEventListener('click', function() {
        const modal = this.closest('.modal');
        modal.style.display = "none";
    });
});

// Click outside modal to close
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

//is active edit 
function toggleIsActive(categoryId, isActive) {
    const isActiveSpan = document.getElementById('isActive_' + categoryId);
    const newIsActive = isActive ? 0 : 1; // Inverser l'état actuel

    // Envoi d'une requête AJAX pour mettre à jour l'état dans la base de données
    fetch('/admin/category/updateIsActive/' + categoryId + '?isActive=' + newIsActive, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            // body: JSON.stringify({ isActive: newIsActive }) // Utilisation de JSON si nécessaire
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                isActiveSpan.classList.toggle('icon-active', newIsActive === 1);
                isActiveSpan.classList.toggle('icon-inactive', newIsActive === 0);
                isActiveSpan.textContent = newIsActive === 1 ? 'check_circle' : 'cancel';
            } else {
                console.error('Erreur lors de la mise à jour de l\'état.');
            }
        })
        .catch(error => console.error('Erreur:', error));
}


/* **************************** */
function updateCheckboxValue(input) {
    var spanText = input.nextElementSibling.innerText; // Récupère le texte du span voisin
    input.value = input.checked ? spanText : ''; // Met à jour la valeur de l'input checkbox
}


