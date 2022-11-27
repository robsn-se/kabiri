document.querySelectorAll(".closer").forEach(item => {
    item.addEventListener("click", event => {
        event.target.parentElement.classList.remove("is_visible");
    });
});