function openLightbox(imageSrc) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    lightboxImg.src = imageSrc.src;
    lightbox.style.display = 'block';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    lightbox.style.display = 'none';
    lightboxImg.src = '';
}

function openModal() {
    document.getElementById('askModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('askModal').style.display = 'none';
}

function showModal(id) {
    document.getElementById(id).style.display = 'flex';
}

function hideModal(id) {
    document.getElementById(id).style.display = 'none';
}

function removeModal(id) {
    const el = document.getElementById(id);
    if (el) {
        el.remove();
    }
}


// Map English digits to Bengali digits
const englishToBengaliDigits = {
    '0': '০',
    '1': '১',
    '2': '২',
    '3': '৩',
    '4': '৪',
    '5': '৫',
    '6': '৬',
    '7': '৭',
    '8': '৮',
    '9': '৯'
};

/*
String(1024) → "1024"
.split('') → ['1', '0', '2', '4']
.map(...) → ['১', '০', '২', '৪']
.join('') → "১০২৪"
*/

// Convert function
function convertToBengali(num) {
    return String(num).split('').map(char => {
        return englishToBengaliDigits[char] ?? char;
    }).join('');
}

function toggleAdminSidebar() {
    const adminSidebar = document.getElementById('admin-sidebar');
    adminSidebar.classList.toggle('collapsed');
}

function adminLogout() {
    const logout = confirm('আপনি কি লগআউট করতে চান?');
    if (logout) {
        window.location.replace('/admin/logout');
    } else {
        return false;
    }
}

function logout() {
    var confirmLogout = confirm('আপনি কি চাইলে লগ আউট করতে?');

    if (confirmLogout) {
        axios.get('/logout')
            .then(response => {
                if (response.data == "logged out") {
                    window.location.replace('/');
                }
                else {
                    window.location.replace('/');
                }
            })
            .catch(error => { });
    }
}

window.addEventListener('load', function () {
    function isMostlyEnglish2(text) {
        const englishChars = text.match(/[A-Za-z]/g) || [];
        return englishChars.length / text.length > 0.7;
    }

    function checkLanguageAndReplaceFontFamily2() {
        const elements = document.getElementsByClassName('as-check-language');

        for (const element of elements) {
            const text = element.innerText.trim();
            if (text && !isMostlyEnglish2(text)) {
                element.style.fontFamily = "'Tiro Bangla', serif";
            }
        }
    }

    // Run once at load
    checkLanguageAndReplaceFontFamily2();

    // Also watch for dynamic content changes
    const observer = new MutationObserver(() => {
        checkLanguageAndReplaceFontFamily2();
    });

    observer.observe(document.body, { childList: true, subtree: true });
});