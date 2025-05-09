document.addEventListener('DOMContentLoaded', () => {
    const accountType = document.getElementById('accountType');
    const titleContainer = document.getElementById('titleContainer');
    const fullNameLabel = document.getElementById('fullNameLabel');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePassword');
    
    // If the selected account type is Company, update the "Full Name" field label to "Contact Name" and add an additional field to collect the contact person's title
    if (accountType) {
        accountType.addEventListener('change', () => {
            if (accountType.value === "Company") {
                fullNameLabel.innerHTML= "Contact name";
                titleContainer.style.display = "flex";
            } else {
                fullNameLabel.innerHTML = "Full name";
                titleContainer.style.display = 'none';
            }
        });
    };

    // Toggle password visibility
    toggleIcon.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        toggleIcon.classList.toggle('fa-eye');
        toggleIcon.classList.toggle('fa-eye-slash');
    });
})

