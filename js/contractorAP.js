profileButton = document.querySelector(".button-profile");
servicesButton = document.querySelector(".button-services");
requestsButton = document.querySelector(".button-requests");

profileSection = document.querySelector(".profile");
servicesSection = document.querySelector(".services");
requestsSection = document.querySelector(".requests");

let profileState = 1;
let servicesState = 0;
servicesSection.style.display = "none";
let requestsState = 0;
requestsSection.style.display = "none";

function profileToggle() {
  if (profileState === 0) {
    profileState = 1;
    profileSection.style.display = "flex";
    servicesState = 0;
    servicesSection.style.display = "none";
    requestsState = 0;
    requestsSection.style.display = "none";
  }
}

function servicesToggle() {
  if (servicesState === 0) {
    profileState = 0;
    profileSection.style.display = "none";
    servicesState = 1;
    servicesSection.style.display = "flex";
    requestsState = 0;
    requestsSection.style.display = "none";
  }
}

function requestsToggle() {
  if (requestsState === 0) {
    profileState = 0;
    profileSection.style.display = "none";
    servicesState = 0;
    servicesSection.style.display = "none";
    requestsState = 1;
    requestsSection.style.display = "flex";
  }
}

profileButton.addEventListener("click", profileToggle);
servicesButton.addEventListener("click", servicesToggle);
requestsButton.addEventListener("click", requestsToggle);

const imgLK = document.querySelector(".header__logo");

imgLK.addEventListener('click', function() {
    window.location.href = 'index.html';
}) 