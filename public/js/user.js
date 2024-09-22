const allFilterItems = document.querySelectorAll('.filter-item');
const allFilterBtns = document.querySelectorAll('.filter-btn');
const totalProductsElement = document.getElementById('total-products');

// window.addEventListener('DOMContentLoaded', () => {
//     allFilterBtns[0].classList.add('active-btn');
//     updateProductCount();
// });

allFilterBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
        showFilteredContent(btn);
        updateProductCount();
    });
});

window.addEventListener('DOMContentLoaded', () => {
    const allBtn = document.getElementById('all');
    allBtn.classList.add('active-btn'); 
    showFilteredContent(allBtn); 
    updateProductCount();
});

document.addEventListener('DOMContentLoaded', () => {
    const allBtn = document.getElementById('all');
    const urlCategory = window.location.pathname.split('/').pop() || 'all';
    const categoryBtn = document.getElementById(urlCategory);
    if (categoryBtn) {
        showFilteredContent(categoryBtn);
    }else {
        showFilteredContent(allBtn);
    }

    // allBtn.classList.add('active-btn');
    updateProductCount();

    const allFilterBtns = document.querySelectorAll('.filter-btn');
    allFilterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            showFilteredContent(btn);
            updateProductCount();
        });
    });
});

function showFilteredContent(btn){
    const allFilterItems = document.querySelectorAll('.filter-item');
    allFilterItems.forEach((item) => {
        if (btn.id === 'all' || item.classList.contains(btn.id)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
    resetActiveBtn();
    btn.classList.add('active-btn');
}

function resetActiveBtn(){
    const allFilterBtns = document.querySelectorAll('.filter-btn');
    allFilterBtns.forEach((btn) => {
        btn.classList.remove('active-btn');
    });
}

function updateProductCount() {
    let visibleProducts = document.querySelectorAll('.filter-item[style="display: block;"]');
    const totalProductsElement = document.getElementById('total-products');
    totalProductsElement.textContent = `Total des produits: ${visibleProducts.length}`;
}

/* ****************************** */

// Tri des produits par prix
(function() {
    let field = document.querySelector('.items');
    let li = Array.from(field.children);

    function SortProduct() {
        let select = document.getElementById('sort-select');
        let selectBrand = document.getElementById('select-brand');
        let ar = [];
        for (let i of li) {
            const last = i.querySelector('.price');
            const brandElement = i.querySelector('.marque-pr');
            const price = parseFloat(priceElement.textContent.trim().replace(' DT', ''));
            const brandId = brandElement.getAttribute('data-brand-id');  
            i.setAttribute("data-price", y);
            i.setAttribute("data-brand-id", brandId);
            ar.push(i);
        }

        this.run = () => {
            addevent();
        }

        function addevent() {
            select.onchange = sortingValue;
            selectBrand.onchange = sortingValue; 
        }

        function sortingValue() {
            if (this.value === 'Default') {
                while (field.firstChild) {
                    field.removeChild(field.firstChild);
                }
                field.append(...ar);
            } else if (this.value === 'LowToHigh') {
                SortElem(field, ar, true);
            } else if (this.value === 'HighToLow') {
                SortElem(field, ar, false);
            }
            updateProductCount();
        }

        function SortElem(field, ar, asc) {
            let dm = asc ? 1 : -1;
            let sortli = ar.sort((a, b) => {
                const ax = parseFloat(a.getAttribute('data-price'));
                const bx = parseFloat(b.getAttribute('data-price'));
                return ax > bx ? (1 * dm) : (-1 * dm);
            });
            while (field.firstChild) {
                field.removeChild(field.firstChild);
            }
            field.append(...sortli);
        }
    }

    new SortProduct().run();
})();


// ************************************************************
document.addEventListener('DOMContentLoaded', function() {
    const viewButtonsProduct = document.querySelectorAll('.view-button');
    viewButtonsProduct.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const modal_view = document.getElementById('modal_view' + productId);
            if (modal_view) {
                modal_view.style.display = "block";
                closeAllPopups();
            }
        });
    });

    const closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                modal.style.display = "none";
            }
        });
    });

    window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    };
});
