function filterMenu(type) {
    const sections = document.querySelectorAll('.menu-section');
    sections.forEach(section => {
        if (type === 'all' || section.dataset.type === type) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}

document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", () => {
        const badge = document.querySelector('.cart-count');
        badge.classList.add("bump");

        setTimeout(() => {
            badge.classList.remove("bump");
        }, 300);
    });
});

document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', () => {
        const itemId = button.getAttribute('data-id');

        fetch('index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `item_id=${encodeURIComponent(itemId)}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.cart-count').textContent = data.cartCount;
            }
        });
    });
});

document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('index.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Update cart count in header
                document.querySelectorAll('.cart-count').forEach(el => {
                    el.textContent = data.cartCount;
                });
            }
        });
    });
});

function showSlide(type) {
    // Activate the correct menu section
    document.querySelectorAll('.menu-section').forEach(section => {
        if (section.dataset.type === type) {
            section.classList.add('active');
        } else {
            section.classList.remove('active');
        }
    });

    // Activate the correct tab button
    document.querySelectorAll('.tab-button').forEach(btn => {
        if (btn.textContent.toLowerCase().includes(type)) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}

// Show the first section by default on page load
document.addEventListener('DOMContentLoaded', function() {
    showSlide('pizza'); // or your default category
});

let lastScrollY = window.scrollY;
const header = document.getElementById('mainHeader');

window.addEventListener('scroll', function() {
    if (!header) return;
    if (window.scrollY > lastScrollY && window.scrollY > 50) {
        // Scrolling down
        header.classList.add('hide');
    } else {
        // Scrolling up
        header.classList.remove('hide');
    }
    lastScrollY = window.scrollY;
});


