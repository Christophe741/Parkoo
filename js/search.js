import { domReady } from "./domReady.js";
import { cloneTemplate, renderError } from "./utils/dom.js";

// === Fonctions liées au rendu DOM ===

function buildCard(parking) {
  const card = cloneTemplate("parking-card-template");
  updateCardImage(card, parking);
  updateCardText(card, parking);
  return card;
}

function updateCardImage(card, parking) {
  const img = card.querySelector(".photo");
  img.src = `assets/profile-pictures/${parking.photo}`;
  img.alt = `Photo de ${parking.username}`;
}

function updateCardText(card, parking) {
  card.querySelector(".city").textContent = parking.city;
  card.querySelector(".display_name").textContent = parking.display_name;
  card.querySelector(".description").textContent = parking.description;
  card.querySelector(".price").textContent = `${parking.price_per_hour} €/jour`;
}
// === Fonctions utilitaires ===

function getPageParams() {
  const params = new URLSearchParams(window.location.search);
  return {
    city: params.get("city"),
  };
}

// === Fonctions métier ===

function fetchParkings(city, container) {
  container.innerHTML = "";
  fetch(`api/get_parkings.php?city=${encodeURIComponent(city)}`)
    .then((res) => res.json())
    .then((data) => {
      if (data.success && data.parkings.length) {
        data.parkings.forEach((parking) =>
          container.appendChild(buildCard(parking))
        );
      } else {
        renderError("Aucune annonce trouvé pour cette recherche.", container);
      }
    })
    .catch(() => {
      renderError("Erreur lors du chargement des annonces.", container);
    });
}

function handleFormSubmit(e, form, container) {
  e.preventDefault();
  const city = form.elements.city.value;

  if (!city) {
    container.textContent = "Veuillez saisir une ville.";
    return;
  }

  fetchParkings(city, container);
}

// === Point d’entrée du script ===

domReady(() => {
  const container = document.getElementById("results");
  const form = document.getElementById("search-form");
  const { city } = getPageParams();
  if (city) {
    fetchParkings(city, container);
  }
  form.addEventListener("submit", (e) => handleFormSubmit(e, form, container));
});
