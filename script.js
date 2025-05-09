document.addEventListener('DOMContentLoaded', () => {
    const accountType = document.getElementById('accountType');
    const titleContainer = document.getElementById('titleContainer');
    const fullNameLabel = document.getElementById('fullNameLabel');
    
    // If the selected account type is Company, update the "Full Name" field label to "Contact Name" and add an additional field to collect the contact person's title
    if (accountType) {
        accountType.addEventListener('change', (event) => {
            if (accountType.value === "Company") {
                fullNameLabel.innerHTML= "Contact Name";
                titleContainer.style.display = "flex";
            } else {
                fullNameLabel.innerHTML = "Full Name";
                titleContainer.style.display = 'none';
            }
        });
    };
})