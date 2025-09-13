// === Import des dépendances ===

import { domReady } from "./dom-ready.js";
import { cloneTemplate, renderMessage } from "./utils/dom.js";

// === Fonctions liées au rendu DOM ===

function buildParkingDetail(parking) {
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
  card.querySelector(".display-name").textContent = parking.display_name;
  card.querySelector(".description").textContent = parking.description;
  card.querySelector(".price").textContent = `${parking.price_per_hour} €/jour`;
  card.querySelector(".is-covered").textContent = parking.is_covered
    ? "Oui"
    : "Non";
  card.querySelector(".is-accessible").textContent = parking.is_accessible
    ? "Oui"
    : "Non";
  card.querySelector(".has-ev-charging").textContent = parking.has_ev_charging
    ? "Oui"
    : "Non";
}

function renderParkingDetail(parking, container) {
  container.appendChild(buildParkingDetail(parking));
}

function buildReview(review) {
  const reviewEl = cloneTemplate("review-template");
  reviewEl.querySelector(".reviewer-name").textContent = review.reviewer_name;
  reviewEl.querySelector(".rating").textContent = `Note : ${review.rating}/5`;
  reviewEl.querySelector(".comment").textContent = review.comment || "";
  return reviewEl;
}

function renderReviews(reviews, summary, container) {
  const section = document.createElement("section");
  section.classList.add("reviews");

  const title = document.createElement("h2");
  if (summary.count) {
    title.textContent = `Avis (${summary.count}) - ${summary.average}/5`;
  }
  section.appendChild(title);

  if (reviews.length) {
    reviews.forEach((rev) => section.appendChild(buildReview(rev)));
  } else {
    renderMessage("Aucun avis pour le moment", container, "empty", false);
  }

  container.appendChild(section);
}

// === Fonctions métier ===

function fetchParkingDetail(parkingId, container) {
  fetch(`api/get_parking_detail.php?id=${encodeURIComponent(parkingId)}`)
    .then((res) => res.json())
    .then((data) => {
      if (!data.success) {
        renderMessage(data.message || "Parking introuvable.", container);
        return;
      }

      renderParkingDetail(data.parking, container);
      renderReviews(data.reviews, data.reviews_summary, container);
    })
    .catch(() => {
      renderMessage("Erreur lors du chargement du parking.", container);
    });
}

// === Point d’entrée du script ===

domReady(() => {
  const container = document.getElementById("results");
  const parkingId = new URLSearchParams(window.location.search).get("id");

  if (!parkingId) {
    renderMessage("Aucun parking sélectionné.", container);
    return;
  }

  fetchParkingDetail(parkingId, container);
});
