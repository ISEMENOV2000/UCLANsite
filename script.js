async function searchProducts() {
    const searchInput = document.getElementById("search");
    const query = searchInput.value.trim();
    const productsContainer = document.getElementById("products-container");
    productsContainer.innerHTML = "";

    if (!query) {
        productsContainer.innerHTML = "Please enter a search query.";
        return;
    }

    try {
        const response = await fetch(`search.php?query=${query}`);
        if (response.ok) {
            const products = await response.text();
            productsContainer.innerHTML = products;
        } else {
            new Error("Error fetching search results");
        }
    } catch (error) {
        console.error(`Error fetching search results: ${error}`);
        productsContainer.innerHTML = "Error fetching search results. Please try again later.";
    }
}

function openReviewModal() {
    const reviewModal = document.getElementById("review-modal");
    reviewModal.style.display = "block";
}

function closeReviewModal() {
    const reviewModal = document.getElementById("review-modal");
    reviewModal.style.display = "none";
}

window.onclick = function (event) {
    const reviewModal = document.getElementById("review-modal");
    if (event.target == reviewModal) {
        reviewModal.style.display = "none";
    }
};

document
    .querySelector(".close")
    .addEventListener("click", closeReviewModal);
