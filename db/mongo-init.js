db = db.getSiblingDB("parkoo");
db.reviews.insertMany([
  {
    reviewer_id: 3,
    reviewed_user_id: 1,
    rating: 4,
    comment: "Place bien située, propriétaire très sympa !",
    created_at: "2025-08-22T14:30:00Z",
  },
  {
    reviewer_id: 2,
    reviewed_user_id: 1,
    rating: 4,
    comment: "Rien à redire !",
    created_at: "2025-09-22T14:30:00Z",
  },
]);
