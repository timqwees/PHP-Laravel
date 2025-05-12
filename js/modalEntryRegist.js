const registrationModal = document.querySelector(".registration");
const authorizationModal = document.querySelector(".authorization");
const codeModal = document.querySelector(".code");

document.querySelector(".navigation__authenticate").addEventListener("click", (event) => {
    event.preventDefault();
    registrationModal.showModal();
});

document.querySelector(".hero__link").addEventListener("click", (event) => {
    event.preventDefault();
    registrationModal.showModal();
});


document.querySelector(".registration__authorization").addEventListener("click", (event) => {
    registrationModal.close();
    authorizationModal.showModal();
});

document.querySelector(".authorization__registration").addEventListener("click", (event) => {
    authorizationModal.close();
    registrationModal.showModal();
});

document.querySelector(".registration__registrate").addEventListener("click", (event) => {
    registrationModal.close();
    codeModal.showModal();  
});

registrationModal.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.close();
    }
});

authorizationModal.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.close();
    }
});

document.querySelector(".code__cancel").addEventListener("click", (event) => {
    codeModal.close();  
});