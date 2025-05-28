document.addEventListener('DOMContentLoaded', function () {
    // Btn show navbar
    const menuBtn = document.querySelector('.navbar-icon');
    const myMenu = document.querySelector('.header__nav');
    if (menuBtn && myMenu) {
        menuBtn.onclick = function () {
            myMenu.classList.toggle('show');
            menuBtn.classList.toggle('open');
        };
    }

    // Go to Top
    window.goToTop = function () {
        const timer = setInterval(function () {
            document.documentElement.scrollTop -= 20;
            if (document.documentElement.scrollTop <= 0) clearInterval(timer);
        }, 10);
    };

    // Tabline
    const tabItems = document.querySelectorAll('.tab-item');
    const tabPanes = document.querySelectorAll('.tab-pane');
    const line = document.querySelector('.tabs .line');
    const activeTab = document.querySelector('.tab-item.active');

    if (line && activeTab) {
        line.style.left = activeTab.offsetLeft + 'px';
        line.style.width = activeTab.offsetWidth + 'px';
    }
    if (tabItems.length && tabPanes.length) {
        tabItems.forEach((tab, i) => {
            tab.addEventListener('click', function () {
                const currentTab = document.querySelector('.tab-item.active');
                const currentPane = document.querySelector('.tab-pane.active');

                if (currentTab) currentTab.classList.remove('active');
                if (currentPane) currentPane.classList.remove('active');

                line.style.left = this.offsetLeft + 'px';
                line.style.width = this.offsetWidth + 'px';

                this.classList.add('active');
                if (tabPanes[i]) tabPanes[i].classList.add('active');
            });
        });
    }

    // Input quantity controls
    const inputQty = document.querySelector('.input-qty');
    let value = 0;
    let maxProduct = 0;
    if (inputQty) {
        value = parseInt(inputQty.value, 10) || 0;
        maxProduct = parseInt(inputQty.getAttribute('max'), 10) || 0;
    }

    window.minusProduct = function () {
        if (!inputQty) return;
        if (value > 0) value--;
        inputQty.value = value;
    };
    window.plusProduct = function () {
        if (!inputQty) return;
        value++;
        if (maxProduct && value > maxProduct) {
            value = maxProduct;
            alert('Số sản phẩm trong kho của shop đã đạt giới hạn');
        }
        inputQty.value = value;
    };

    // Add to cart notification
    const addToCartBtn = document.getElementById('addToCartBtn');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function () {
            const notification = document.getElementById('notification');
            if (!notification) return;
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        });
    }

    // Star rating helper
    window.calcRate = function (r) {
        const f = Math.floor(r);
        const id = 'star' + f + (r % 1 ? 'half' : '');
        const el = document.getElementById(id);
        if (el) el.checked = true;
    };
});
