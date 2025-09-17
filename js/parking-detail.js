// === Import des dépendances ===

import { cloneTemplate, renderMessage } from "./utils/dom.js";

// === Fonctions liées au rendu DOM ===

function renderParkingDetail(parking, container) {
  const card = cloneTemplate("parking-card-template");

  const img = card.querySelector(".photo");
  img.src = `assets/profile-pictures/${parking.photo}`;
  img.alt = `Photo de ${parking.username}`;

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

  container.appendChild(card);
}

function renderReviews(reviews, summary, container) {
  const section = cloneTemplate("reviews-template");
  const title = section.querySelector(".reviews-title");
  const list = section.querySelector(".reviews-list");
  const model = section.querySelector(".review-model");

  title.textContent = `${summary.count} avis - ${summary.average}/5`;

  if (reviews.length) {
    for (const rev of reviews) {
      const el = model.cloneNode(true);
      el.classList.remove("review-model");
      el.querySelector(".reviewer-name").textContent = rev.reviewer_name;
      el.querySelector(".rating").textContent = `Note : ${rev.rating}/5`;
      el.querySelector(".comment").textContent = rev.comment || "";
      list.appendChild(el);
    }

    model.remove();
    container.appendChild(section);
  } else {
    section.remove();
    renderMessage("Aucun avis pour le moment", container, "empty", false);
  }
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

const container = document.getElementById("results");
const parkingId = new URLSearchParams(window.location.search).get("id");

if (parkingId) {
  fetchParkingDetail(parkingId, container);
} else {
  renderMessage("Aucun parking sélectionné.", container);
}
