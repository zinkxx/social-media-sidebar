document.querySelectorAll('.sms-sidebar ul li a').forEach(item => {
    item.addEventListener('mouseover', () => {
        item.querySelector('img').style.transform = 'scale(1.1)';
    });

    item.addEventListener('mouseout', () => {
        item.querySelector('img').style.transform = 'scale(1)';
    });
});
